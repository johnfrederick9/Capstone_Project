<?php
include('../../connection.php');

$target_date = isset($_GET['target_date']) ? $_GET['target_date'] : null;
$date_status = isset($_GET['date_status']) ? $_GET['date_status'] : null;

$CltStatus = isset($_GET['CltStatus']) ? $_GET['CltStatus'] : null;
$CbStatus = isset($_GET['CbStatus']) ? $_GET['CbStatus'] : null;

// Example: log or use the value
$updated_records = []; // Array to hold updated records

mysqli_begin_transaction($con);

try {

    // Handle CltStatus
    if ($CltStatus == 1) {
        // Logic for Default Clt
        $message = "Skipping recalculation for Clt (manual status).";

        if($date_status == 'Recalculate'){
            $sql_initials = "SELECT clt_init_balance FROM tb_cashbook_init LIMIT 1";
            $stmt_initials = mysqli_prepare($con, $sql_initials);
            if (!$stmt_initials || !mysqli_stmt_execute($stmt_initials)) {
                throw new Exception("Failed to fetch initial balances: " . mysqli_stmt_error($stmt_initials));
            }
            mysqli_stmt_bind_result($stmt_initials, $cltInitBalance,);
            mysqli_stmt_fetch($stmt_initials);
            mysqli_stmt_close($stmt_initials);
    
            $initial_clt_balance = $cltInitBalance;

            // Fetch all default dates ordered by date_data (ascending)
            $sql_default_clt = "SELECT date_data FROM tb_cashbook_monthly WHERE isDefaultClt = 1 AND isDisplayed = 1 ORDER BY date_data ASC";
            $stmt_default_clt = mysqli_prepare($con, $sql_default_clt);
            if (!$stmt_default_clt || !mysqli_stmt_execute($stmt_default_clt)) {
                throw new Exception("Failed to fetch initial balances: " . mysqli_stmt_error($stmt_default_clt));
            }
            $result_default_date_clt = mysqli_stmt_get_result($stmt_default_clt);

            $previous_month = null;
            $previous_year = null;

            while ($row = mysqli_fetch_assoc($result_default_date_clt)) {
                $date_data = $row['date_data'];

                 // Extract month and year from date_data
                $current_year = date("Y", strtotime($date_data));
                $current_month = date("m", strtotime($date_data));

                // Check if the months are sequential
                if ($previous_month !== null && $previous_year !== null) {
                    $next_month = (int)$previous_month + 1;
                    if ($next_month > 12) {
                        $next_month = 1;
                        $next_year = (int)$previous_year + 1;
                    } else {
                        $next_year = $previous_year;
                    }

                    // If the current month does not match the next expected month, stop recalculating
                    if (($current_year == $next_year && $current_month != $next_month) || ($current_year > $next_year)) {
                        break; // Stop the loop as the months are not sequential
                    }
                }

                // Proceed with the recalculation for this record
                $sql_cashbook = "SELECT * FROM tb_cashbook WHERE isDisplayed = 1 AND period_covered = ? ORDER BY period_covered ASC";
                $stmt_cashbook = mysqli_prepare($con, $sql_cashbook);
                mysqli_stmt_bind_param($stmt_cashbook, "s", $date_data);
                mysqli_stmt_execute($stmt_cashbook);
                $cashbook_result = mysqli_stmt_get_result($stmt_cashbook);

                if (!$cashbook_result) {
                    throw new Exception("Failed to fetch cashbook entries: " . mysqli_error($con));
                }

                while ($cashbook_row = mysqli_fetch_assoc($cashbook_result)) {
                    $cashbook_id = $cashbook_row['cashbook_id'];
                    $period_covered =  $cashbook_row['period_covered'];

                    $sql_cashbook_data = "SELECT * FROM tb_cashbook_data WHERE cashbook_id = ? ORDER BY cashbook_data_id ASC";
                    $stmt_cashbook_data = mysqli_prepare($con, $sql_cashbook_data);
                    mysqli_stmt_bind_param($stmt_cashbook_data, 'i', $cashbook_id);
                    mysqli_stmt_execute($stmt_cashbook_data);
                    $cashbook_data_result = mysqli_stmt_get_result($stmt_cashbook_data);

                    $current_clt_balance = $initial_clt_balance;

                    while ($data_row = mysqli_fetch_assoc($cashbook_data_result)) {
                        $clt_in_value = $data_row['clt_in'];
                        $clt_out_value = $data_row['clt_out'];

                        $current_clt_balance += $clt_in_value - $clt_out_value;

                        $sql_update_data = "UPDATE tb_cashbook_data SET clt_balance = ? WHERE cashbook_data_id = ?";
                        $stmt_update_data = mysqli_prepare($con, $sql_update_data);
                        mysqli_stmt_bind_param($stmt_update_data, "di", $current_clt_balance, $data_row['cashbook_data_id']);
                        if (!mysqli_stmt_execute($stmt_update_data)) {
                            throw new Exception("Failed to update tb_cashbook_data: " . mysqli_stmt_error($stmt_update_data));
                        }
                        mysqli_stmt_close($stmt_update_data);

                        $updated_records[] = [
                            'cashbook_id' => $cashbook_id,
                            'cashbook_data_id' => $data_row['cashbook_data_id'],
                            'period_covered' => $period_covered,
                            'clt_balance' => $current_clt_balance,
                        ];
                    }

                    mysqli_stmt_close($stmt_cashbook_data);

                    $sql_update_cashbook = "UPDATE tb_cashbook SET clt_init_balance = ?, clt_end_balance = ? WHERE cashbook_id = ? AND isDisplayed = 1";
                    $stmt_update_cashbook = mysqli_prepare($con, $sql_update_cashbook);
                    mysqli_stmt_bind_param($stmt_update_cashbook, "ddi", $initial_clt_balance, $current_clt_balance, $cashbook_id);
                    if (!mysqli_stmt_execute($stmt_update_cashbook)) {
                        throw new Exception("Failed to update tb_cashbook: " . mysqli_stmt_error($stmt_update_cashbook));
                    }
                    mysqli_stmt_close($stmt_update_cashbook);

                    $sql_update_monthly = "UPDATE tb_cashbook_monthly SET clt_init_balance = ?, clt_end_balance = ? WHERE YEAR(date_data) = YEAR(?) AND MONTH(date_data) = MONTH(?) AND isDisplayed = 1 AND isDefaultClt = 1";
                    $stmt_update_monthly = mysqli_prepare($con, $sql_update_monthly);
                    mysqli_stmt_bind_param($stmt_update_monthly, "ddss", $initial_clt_balance, $current_clt_balance, $period_covered, $period_covered);
                    if (!mysqli_stmt_execute($stmt_update_monthly)) {
                        throw new Exception("Failed to update tb_cashbook_monthly: " . mysqli_stmt_error($stmt_update_monthly));
                    }
                    mysqli_stmt_close($stmt_update_monthly);

                    $initial_clt_balance = $current_clt_balance;

                }
                // Update previous date for next iteration check
                $previous_month = $current_month;
                $previous_year = $current_year;
            }
        }
    } else { //If manual CLT
        // Logic for Manual Clt
        $message = "Proceed with recalculation for Clt (default status).";
        
    }





   ///////////////////////////////////////////////////////////////////////
// Handle CbStatus
if ($CbStatus == 1) {
    // Logic for default Cb
    $message .= " Skipping recalculation for Cb (manual status).";
} else {
    // Logic for manual Cb
    $message .= " Proceed with recalculation for Cb (default status).";

    if ($date_status == 'Recalculate') {
        $sql_initials_cb = "SELECT cb_init_balance FROM tb_cashbook_init LIMIT 1";
        $stmt_initials_cb = mysqli_prepare($con, $sql_initials_cb);
        if (!$stmt_initials_cb || !mysqli_stmt_execute($stmt_initials_cb)) {
            throw new Exception("Failed to fetch initial balances for Cb: " . mysqli_stmt_error($stmt_initials_cb));
        }
        mysqli_stmt_bind_result($stmt_initials_cb, $cbInitBalance);
        mysqli_stmt_fetch($stmt_initials_cb);
        mysqli_stmt_close($stmt_initials_cb);

        $initial_cb_balance = $cbInitBalance;

        // Fetch all default dates ordered by date_data (ascending)
        $sql_default_cb = "SELECT date_data FROM tb_cashbook_monthly WHERE isDefaultCb = 1 AND isDisplayed = 1 ORDER BY date_data ASC";
        $stmt_default_cb = mysqli_prepare($con, $sql_default_cb);
        if (!$stmt_default_cb || !mysqli_stmt_execute($stmt_default_cb)) {
            throw new Exception("Failed to fetch initial balances for Cb: " . mysqli_stmt_error($stmt_default_cb));
        }
        $result_default_date_cb = mysqli_stmt_get_result($stmt_default_cb);

        $previous_month_cb = null;
        $previous_year_cb = null;

        while ($row_cb = mysqli_fetch_assoc($result_default_date_cb)) {
            $date_data_cb = $row_cb['date_data'];

            // Extract month and year from date_data
            $current_year_cb = date("Y", strtotime($date_data_cb));
            $current_month_cb = date("m", strtotime($date_data_cb));

            // Check if the months are sequential
            if ($previous_month_cb !== null && $previous_year_cb !== null) {
                $next_month_cb = (int)$previous_month_cb + 1;
                if ($next_month_cb > 12) {
                    $next_month_cb = 1;
                    $next_year_cb = (int)$previous_year_cb + 1;
                } else {
                    $next_year_cb = $previous_year_cb;
                }

                // If the current month does not match the next expected month, stop recalculating
                if (($current_year_cb == $next_year_cb && $current_month_cb != $next_month_cb) || ($current_year_cb > $next_year_cb)) {
                    break; // Stop the loop as the months are not sequential
                }
            }

            // Proceed with the recalculation for this record
            $sql_cashbook_cb = "SELECT * FROM tb_cashbook WHERE isDisplayed = 1 AND period_covered = ? ORDER BY period_covered ASC";
            $stmt_cashbook_cb = mysqli_prepare($con, $sql_cashbook_cb);
            mysqli_stmt_bind_param($stmt_cashbook_cb, "s", $date_data_cb);
            mysqli_stmt_execute($stmt_cashbook_cb);
            $cashbook_result_cb = mysqli_stmt_get_result($stmt_cashbook_cb);

            if (!$cashbook_result_cb) {
                throw new Exception("Failed to fetch cashbook entries for Cb: " . mysqli_error($con));
            }

            while ($cashbook_row_cb = mysqli_fetch_assoc($cashbook_result_cb)) {
                $cashbook_id_cb = $cashbook_row_cb['cashbook_id'];
                $period_covered_cb = $cashbook_row_cb['period_covered'];

                $sql_cashbook_data_cb = "SELECT * FROM tb_cashbook_data WHERE cashbook_id = ? ORDER BY cashbook_data_id ASC";
                $stmt_cashbook_data_cb = mysqli_prepare($con, $sql_cashbook_data_cb);
                mysqli_stmt_bind_param($stmt_cashbook_data_cb, 'i', $cashbook_id_cb);
                mysqli_stmt_execute($stmt_cashbook_data_cb);
                $cashbook_data_result_cb = mysqli_stmt_get_result($stmt_cashbook_data_cb);

                $current_cb_balance = $initial_cb_balance;

                while ($data_row_cb = mysqli_fetch_assoc($cashbook_data_result_cb)) {
                    $cb_in_value = $data_row_cb['cb_in'];
                    $cb_out_value = $data_row_cb['cb_out'];

                    $current_cb_balance += $cb_in_value - $cb_out_value;

                    $sql_update_data_cb = "UPDATE tb_cashbook_data SET cb_balance = ? WHERE cashbook_data_id = ?";
                    $stmt_update_data_cb = mysqli_prepare($con, $sql_update_data_cb);
                    mysqli_stmt_bind_param($stmt_update_data_cb, "di", $current_cb_balance, $data_row_cb['cashbook_data_id']);
                    if (!mysqli_stmt_execute($stmt_update_data_cb)) {
                        throw new Exception("Failed to update tb_cashbook_data for Cb: " . mysqli_stmt_error($stmt_update_data_cb));
                    }
                    mysqli_stmt_close($stmt_update_data_cb);

                    $updated_records_cb[] = [
                        'cashbook_id' => $cashbook_id_cb,
                        'cashbook_data_id' => $data_row_cb['cashbook_data_id'],
                        'period_covered' => $period_covered_cb,
                        'cb_balance' => $current_cb_balance,
                    ];
                }

                mysqli_stmt_close($stmt_cashbook_data_cb);

                $sql_update_cashbook_cb = "UPDATE tb_cashbook SET cb_init_balance = ?, cb_end_balance = ? WHERE cashbook_id = ? AND isDisplayed = 1";
                $stmt_update_cashbook_cb = mysqli_prepare($con, $sql_update_cashbook_cb);
                mysqli_stmt_bind_param($stmt_update_cashbook_cb, "ddi", $initial_cb_balance, $current_cb_balance, $cashbook_id_cb);
                if (!mysqli_stmt_execute($stmt_update_cashbook_cb)) {
                    throw new Exception("Failed to update tb_cashbook for Cb: " . mysqli_stmt_error($stmt_update_cashbook_cb));
                }
                mysqli_stmt_close($stmt_update_cashbook_cb);

                $sql_update_monthly_cb = "UPDATE tb_cashbook_monthly SET cb_init_balance = ?, cb_end_balance = ? WHERE YEAR(date_data) = YEAR(?) AND MONTH(date_data) = MONTH(?) AND isDisplayed = 1 AND isDefaultCb = 1";
                $stmt_update_monthly_cb = mysqli_prepare($con, $sql_update_monthly_cb);
                mysqli_stmt_bind_param($stmt_update_monthly_cb, "ddss", $initial_cb_balance, $current_cb_balance, $period_covered_cb, $period_covered_cb);
                if (!mysqli_stmt_execute($stmt_update_monthly_cb)) {
                    throw new Exception("Failed to update tb_cashbook_monthly for Cb: " . mysqli_stmt_error($stmt_update_monthly_cb));
                }
                mysqli_stmt_close($stmt_update_monthly_cb);

                $initial_cb_balance = $current_cb_balance;
            }

            // Update previous date for next iteration check
            $previous_month_cb = $current_month_cb;
            $previous_year_cb = $current_year_cb;
        }
    }
}








    // if ($date_status == 'First') { 
    //     // If the date_status is 'First', recalculate all cashbook records
    //     // Add logic here to recalculate from the very first record

    //     //Step 0: Fetch the initial Balance from init
    //     $sql_initials = "SELECT clt_init_balance, cb_init_balance FROM tb_cashbook_init LIMIT 1";
    //     $stmt_initials = mysqli_prepare($con, $sql_initials);
    //     if (!$stmt_initials || !mysqli_stmt_execute($stmt_initials)) {
    //         throw new Exception("Failed to fetch initial balances: " . mysqli_stmt_error($stmt_initials));
    //     }
    //     mysqli_stmt_bind_result($stmt_initials, $clt_init_balance, $cb_init_balance);
    //     mysqli_stmt_fetch($stmt_initials);
    //     mysqli_stmt_close($stmt_initials);

    //     $initial_clt_balance = $clt_init_balance;
    //     $initial_cb_balance = $cb_init_balance;


    //     //Step 1: Fetch all records sequentially (ordered by date) from the table
    //     $sql_cashbook_monthly = "SELECT * FROM tb_cashbook_monthly WHERE isDisplayed = 1 ORDER BY period_covered ASC";
    //     $stmt_cashbook_monthly = mysqli_prepare($con, $sql_cashbook_monthly);
    //     mysqli_stmt_execute($stmt_cashbook_monthly);
    //     $cashbook_monthly_result = mysqli_stmt_get_result($stmt_cashbook_monthly);

    //     if (!$cashbook_monthly_result) {
    //         throw new Exception("Failed to fetch cashbook entries: " . mysqli_error($con));
    //     }


    //     //i have this columns in the tb_cashbook_monthly:
    //     //date_data, clt_init_balance, cb_init_balance, cb_end_balance, isDefaultCb, isDefaultClt, isDisplayed. how can i arrange them so that if 
        



    //    // Step 1: Fetch all cashbook entries starting from the first record
    //     $sql_cashbook = "SELECT * FROM tb_cashbook WHERE isDisplayed = 1 ORDER BY period_covered ASC";
    //     $stmt_cashbook = mysqli_prepare($con, $sql_cashbook);
    //     mysqli_stmt_execute($stmt_cashbook);
    //     $cashbook_result = mysqli_stmt_get_result($stmt_cashbook);

    //     if (!$cashbook_result) {
    //         throw new Exception("Failed to fetch cashbook entries: " . mysqli_error($con));
    //     }
        
    //     // Step 2: Fetch all cashbook data from for each cashbook entry and calculate
    //     while ($cashbook_row = mysqli_fetch_assoc($cashbook_result)) {
    //         $cashbook_id = $cashbook_row['cashbook_id'];
    //         $period_covered =  $cashbook_row['period_covered'];

    //         $sql_cashbook_data = "SELECT * FROM tb_cashbook_data WHERE cashbook_id = ? ORDER BY cashbook_data_id ASC";
    //         $stmt_cashbook_data = mysqli_prepare($con, $sql_cashbook_data);
    //         mysqli_stmt_bind_param($stmt_cashbook_data, 'i', $cashbook_id);
    //         mysqli_stmt_execute($stmt_cashbook_data);
    //         $cashbook_data_result = mysqli_stmt_get_result($stmt_cashbook_data);

    //         $current_clt_balance = $initial_clt_balance;
    //         $current_cb_balance = $initial_cb_balance;

    //         while ($data_row = mysqli_fetch_assoc($cashbook_data_result)) {
    //             $clt_in_value = $data_row['clt_in'];
    //             $clt_out_value = $data_row['clt_out'];
    //             $cb_in_value = $data_row['cb_in'];
    //             $cb_out_value = $data_row['cb_out'];

    //             $current_clt_balance += $clt_in_value - $clt_out_value;
    //             $current_cb_balance += $cb_in_value - $cb_out_value;

    //             $sql_update_data = "UPDATE tb_cashbook_data SET clt_balance = ?, cb_balance = ? WHERE cashbook_data_id = ?";
    //             $stmt_update_data = mysqli_prepare($con, $sql_update_data);
    //             mysqli_stmt_bind_param($stmt_update_data, "ddi", $current_clt_balance, $current_cb_balance, $data_row['cashbook_data_id']);
    //             if (!mysqli_stmt_execute($stmt_update_data)) {
    //                 throw new Exception("Failed to update tb_cashbook_data: " . mysqli_stmt_error($stmt_update_data));
    //             }
    //             mysqli_stmt_close($stmt_update_data);

    //             $updated_records[] = [
    //                 'cashbook_id' => $cashbook_id,
    //                 'cashbook_data_id' => $data_row['cashbook_data_id'],
    //                 'period_covered' => $period_covered,
    //                 'clt_balance' => $current_clt_balance,
    //                 'cb_balance' => $current_cb_balance
    //             ];

    //         }

    //         mysqli_stmt_close($stmt_cashbook_data);

    //         $sql_update_cashbook = "UPDATE tb_cashbook SET clt_init_balance = ?, clt_end_balance = ?, cb_init_balance = ?, cb_end_balance = ? WHERE cashbook_id = ? AND isDisplayed = 1";
    //         $stmt_update_cashbook = mysqli_prepare($con, $sql_update_cashbook);
    //         mysqli_stmt_bind_param($stmt_update_cashbook, "ddddi", $initial_clt_balance, $current_clt_balance, $initial_cb_balance, $current_cb_balance, $cashbook_id);
    //         if (!mysqli_stmt_execute($stmt_update_cashbook)) {
    //             throw new Exception("Failed to update tb_cashbook: " . mysqli_stmt_error($stmt_update_cashbook));
    //         }
    //         mysqli_stmt_close($stmt_update_cashbook);

    //         $sql_update_monthly = "UPDATE tb_cashbook_monthly SET clt_init_balance = ?, clt_end_balance = ?, cb_init_balance = ?, cb_end_balance = ? WHERE YEAR(date_data) = YEAR(?) AND MONTH(date_data) = MONTH(?) AND isDisplayed = 1";
    //         $stmt_update_monthly = mysqli_prepare($con, $sql_update_monthly);
    //         mysqli_stmt_bind_param($stmt_update_monthly, "ddddss", $initial_clt_balance, $current_clt_balance, $initial_cb_balance, $current_cb_balance, $period_covered, $period_covered);
    //         if (!mysqli_stmt_execute($stmt_update_monthly)) {
    //             throw new Exception("Failed to update tb_cashbook_monthly: " . mysqli_stmt_error($stmt_update_monthly));
    //         }
    //         mysqli_stmt_close($stmt_update_monthly);

    //         $initial_clt_balance = $current_clt_balance;
    //         $initial_cb_balance = $current_cb_balance;
    //     }
        
    // } else { 
    //     // If the date_status is 'In Between', recalculate starting from the $target_date
    //     // Add logic here to recalculate starting from $target_date

    //     //Step 0: Fetch the init balance of the $target_date and set it as initial balance in the next record for recalculation
    //     $sql_initials = "SELECT clt_init_balance, cb_init_balance FROM tb_cashbook_monthly WHERE date_data = ? AND isDisplayed = 1 LIMIT 1";
    //     $stmt_initials = mysqli_prepare($con, $sql_initials);
    //     mysqli_stmt_bind_param($stmt_initials, 's', $target_date);
    //     if (!$stmt_initials || !mysqli_stmt_execute($stmt_initials)) {
    //         throw new Exception("Failed to fetch initial balances: " . mysqli_stmt_error($stmt_initials));
    //     }
    //     mysqli_stmt_bind_result($stmt_initials, $clt_init_balance, $cb_init_balance);
    //     mysqli_stmt_fetch($stmt_initials);
    //     mysqli_stmt_close($stmt_initials);

    //     $initial_clt_balance = $clt_init_balance;
    //     $initial_cb_balance = $cb_init_balance;

    //     // Step 1: Fetch all cashbook entries starting starting from the target date
    //     $sql_cashbook = "SELECT * FROM tb_cashbook WHERE period_covered >= ? AND isDisplayed = 1 ORDER BY period_covered ASC";
    //     $stmt_cashbook = mysqli_prepare($con, $sql_cashbook);
    //     mysqli_stmt_bind_param($stmt_cashbook, 's', $target_date);
    //     if (!$stmt_cashbook || !mysqli_stmt_execute($stmt_cashbook)) {
    //         throw new Exception("Failed to fetch initial balances: " . mysqli_stmt_error($stmt_cashbook));
    //     }
    //     $cashbook_result = mysqli_stmt_get_result($stmt_cashbook);

    //     if (!$cashbook_result) {
    //         throw new Exception("Failed to fetch cashbook entries: " . mysqli_error($con));
    //     }

    //     // Step 2: Fetch all cashbook data from for each cashbook entry and calculate
    //     while ($cashbook_row = mysqli_fetch_assoc($cashbook_result)) {
    //         $cashbook_id = $cashbook_row['cashbook_id'];
    //         $period_covered =  $cashbook_row['period_covered'];

    //         $sql_cashbook_data = "SELECT * FROM tb_cashbook_data WHERE cashbook_id = ? ORDER BY cashbook_data_id ASC";
    //         $stmt_cashbook_data = mysqli_prepare($con, $sql_cashbook_data);
    //         mysqli_stmt_bind_param($stmt_cashbook_data, 'i', $cashbook_id);
    //         mysqli_stmt_execute($stmt_cashbook_data);
    //         $cashbook_data_result = mysqli_stmt_get_result($stmt_cashbook_data);

    //         $current_clt_balance = $initial_clt_balance;
    //         $current_cb_balance = $initial_cb_balance;

    //         while ($data_row = mysqli_fetch_assoc($cashbook_data_result)) {
    //             $clt_in_value = $data_row['clt_in'];
    //             $clt_out_value = $data_row['clt_out'];
    //             $cb_in_value = $data_row['cb_in'];
    //             $cb_out_value = $data_row['cb_out'];

    //             $current_clt_balance += $clt_in_value - $clt_out_value;
    //             $current_cb_balance += $cb_in_value - $cb_out_value;

    //             $sql_update_data = "UPDATE tb_cashbook_data SET clt_balance = ?, cb_balance = ? WHERE cashbook_data_id = ? ";
    //             $stmt_update_data = mysqli_prepare($con, $sql_update_data);
    //             mysqli_stmt_bind_param($stmt_update_data, "ddi", $current_clt_balance, $current_cb_balance, $data_row['cashbook_data_id']);
    //             if (!mysqli_stmt_execute($stmt_update_data)) {
    //                 throw new Exception("Failed to update tb_cashbook_data: " . mysqli_stmt_error($stmt_update_data));
    //             }
    //             mysqli_stmt_close($stmt_update_data);

    //             $updated_records[] = [
    //                 'cashbook_id' => $cashbook_id,
    //                 'cashbook_data_id' => $data_row['cashbook_data_id'],
    //                 'period_covered' => $period_covered,
    //                 'clt_balance' => $current_clt_balance,
    //                 'cb_balance' => $current_cb_balance
    //             ];

    //         }
    //         mysqli_stmt_close($stmt_cashbook_data);

    //         $sql_update_cashbook = "UPDATE tb_cashbook SET clt_init_balance = ?, clt_end_balance = ?, cb_init_balance = ?, cb_end_balance = ? WHERE cashbook_id = ? AND isDisplayed = 1";
    //         $stmt_update_cashbook = mysqli_prepare($con, $sql_update_cashbook);
    //         mysqli_stmt_bind_param($stmt_update_cashbook, "ddddi", $initial_clt_balance, $current_clt_balance, $initial_cb_balance, $current_cb_balance, $cashbook_id);
    //         if (!mysqli_stmt_execute($stmt_update_cashbook)) {
    //             throw new Exception("Failed to update tb_cashbook: " . mysqli_stmt_error($stmt_update_cashbook));
    //         }
    //         mysqli_stmt_close($stmt_update_cashbook);

    //         $sql_update_monthly = "UPDATE tb_cashbook_monthly SET clt_init_balance = ?, clt_end_balance = ?, cb_init_balance = ?, cb_end_balance = ? WHERE YEAR(date_data) = YEAR(?) AND MONTH(date_data) = MONTH(?) AND isDisplayed = 1";
    //         $stmt_update_monthly = mysqli_prepare($con, $sql_update_monthly);
    //         mysqli_stmt_bind_param($stmt_update_monthly, "ddddss", $initial_clt_balance, $current_clt_balance, $initial_cb_balance, $current_cb_balance, $period_covered, $period_covered);
    //         if (!mysqli_stmt_execute($stmt_update_monthly)) {
    //             throw new Exception("Failed to update tb_cashbook_monthly: " . mysqli_stmt_error($stmt_update_monthly));
    //         }
    //         mysqli_stmt_close($stmt_update_monthly);

    //         $initial_clt_balance = $current_clt_balance;
    //         $initial_cb_balance = $current_cb_balance;
    //     }

    // }    

    mysqli_commit($con);

} catch (Exception $e) {
    mysqli_rollback($con);
    echo json_encode(array('status' => 'false', 'error' => $e->getMessage()));
}

?>
