<?php
include('../../connection.php');

$target_date = isset($_GET['target_date']) ? $_GET['target_date'] : null;
$date_status = isset($_GET['date_status']) ? $_GET['date_status'] : null;

// Example: log or use the value
$updated_records = []; // Array to hold updated records

mysqli_begin_transaction($con);

try {

    if ($date_status == 'First') { 
        // If the date_status is 'First', recalculate all cashbook records
        // Add logic here to recalculate from the very first record

        //Step 0: Fetch the initial Balance from init
        $sql_initials = "SELECT clt_init_balance, cb_init_balance FROM tb_cashbook_init LIMIT 1";
        $stmt_initials = mysqli_prepare($con, $sql_initials);
        if (!$stmt_initials || !mysqli_stmt_execute($stmt_initials)) {
            throw new Exception("Failed to fetch initial balances: " . mysqli_stmt_error($stmt_initials));
        }
        mysqli_stmt_bind_result($stmt_initials, $clt_init_balance, $cb_init_balance);
        mysqli_stmt_fetch($stmt_initials);
        mysqli_stmt_close($stmt_initials);

        $initial_clt_balance = $clt_init_balance;
        $initial_cb_balance = $cb_init_balance;

       // Step 1: Fetch all cashbook entries starting from the first record
        $sql_cashbook = "SELECT * FROM tb_cashbook WHERE isDisplayed = 1 ORDER BY period_covered ASC";
        $stmt_cashbook = mysqli_prepare($con, $sql_cashbook);
        mysqli_stmt_execute($stmt_cashbook);
        $cashbook_result = mysqli_stmt_get_result($stmt_cashbook);

        if (!$cashbook_result) {
            throw new Exception("Failed to fetch cashbook entries: " . mysqli_error($con));
        }
        // Step 2: Fetch all cashbook data from for each cashbook entryand calculate
        while ($cashbook_row = mysqli_fetch_assoc($cashbook_result)) {
            $cashbook_id = $cashbook_row['cashbook_id'];
            $period_covered =  $cashbook_row['period_covered'];

            $sql_cashbook_data = "SELECT * FROM tb_cashbook_data WHERE cashbook_id = ? ORDER BY cashbook_data_id ASC";
            $stmt_cashbook_data = mysqli_prepare($con, $sql_cashbook_data);
            mysqli_stmt_bind_param($stmt_cashbook_data, 'i', $cashbook_id);
            mysqli_stmt_execute($stmt_cashbook_data);
            $cashbook_data_result = mysqli_stmt_get_result($stmt_cashbook_data);

            $current_clt_balance = $initial_clt_balance;
            $current_cb_balance = $initial_cb_balance;

            while ($data_row = mysqli_fetch_assoc($cashbook_data_result)) {
                $clt_in_value = $data_row['clt_in'];
                $clt_out_value = $data_row['clt_out'];
                $cb_in_value = $data_row['cb_in'];
                $cb_out_value = $data_row['cb_out'];

                $current_clt_balance += $clt_in_value - $clt_out_value;
                $current_cb_balance += $cb_in_value - $cb_out_value;

                $sql_update_data = "UPDATE tb_cashbook_data SET clt_balance = ?, cb_balance = ? WHERE cashbook_data_id = ?";
                $stmt_update_data = mysqli_prepare($con, $sql_update_data);
                mysqli_stmt_bind_param($stmt_update_data, "ddi", $current_clt_balance, $current_cb_balance, $data_row['cashbook_data_id']);
                if (!mysqli_stmt_execute($stmt_update_data)) {
                    throw new Exception("Failed to update tb_cashbook_data: " . mysqli_stmt_error($stmt_update_data));
                }
                mysqli_stmt_close($stmt_update_data);

                $updated_records[] = [
                    'cashbook_id' => $cashbook_id,
                    'cashbook_data_id' => $data_row['cashbook_data_id'],
                    'period_covered' => $period_covered,
                    'clt_balance' => $current_clt_balance,
                    'cb_balance' => $current_cb_balance
                ];

            }

            mysqli_stmt_close($stmt_cashbook_data);

            $sql_update_cashbook = "UPDATE tb_cashbook SET clt_init_balance = ?, clt_end_balance = ?, cb_init_balance = ?, cb_end_balance = ? WHERE cashbook_id = ? AND isDisplayed = 1";
            $stmt_update_cashbook = mysqli_prepare($con, $sql_update_cashbook);
            mysqli_stmt_bind_param($stmt_update_cashbook, "ddddi", $initial_clt_balance, $current_clt_balance, $initial_cb_balance, $current_cb_balance, $cashbook_id);
            if (!mysqli_stmt_execute($stmt_update_cashbook)) {
                throw new Exception("Failed to update tb_cashbook: " . mysqli_stmt_error($stmt_update_cashbook));
            }
            mysqli_stmt_close($stmt_update_cashbook);

            $sql_update_monthly = "UPDATE tb_cashbook_monthly SET clt_init_balance = ?, clt_end_balance = ?, cb_init_balance = ?, cb_end_balance = ? WHERE YEAR(date_data) = YEAR(?) AND MONTH(date_data) = MONTH(?) AND isDisplayed = 1";
            $stmt_update_monthly = mysqli_prepare($con, $sql_update_monthly);
            mysqli_stmt_bind_param($stmt_update_monthly, "ddddss", $initial_clt_balance, $current_clt_balance, $initial_cb_balance, $current_cb_balance, $period_covered, $period_covered);
            if (!mysqli_stmt_execute($stmt_update_monthly)) {
                throw new Exception("Failed to update tb_cashbook_monthly: " . mysqli_stmt_error($stmt_update_monthly));
            }
            mysqli_stmt_close($stmt_update_monthly);

            $initial_clt_balance = $current_clt_balance;
            $initial_cb_balance = $current_cb_balance;
        }
        
    } else { 
        // If the date_status is 'In Between', recalculate starting from the $target_date
        // Add logic here to recalculate starting from $target_date

        //Step 0: Fetch the init balance of the $target_date and set it as initial balance in the next record for recalculation
        $sql_initials = "SELECT clt_init_balance, cb_init_balance FROM tb_cashbook_monthly WHERE date_data = ? AND isDisplayed = 1 LIMIT 1";
        $stmt_initials = mysqli_prepare($con, $sql_initials);
        mysqli_stmt_bind_param($stmt_initials, 's', $target_date);
        if (!$stmt_initials || !mysqli_stmt_execute($stmt_initials)) {
            throw new Exception("Failed to fetch initial balances: " . mysqli_stmt_error($stmt_initials));
        }
        mysqli_stmt_bind_result($stmt_initials, $clt_init_balance, $cb_init_balance);
        mysqli_stmt_fetch($stmt_initials);
        mysqli_stmt_close($stmt_initials);

        $initial_clt_balance = $clt_init_balance;
        $initial_cb_balance = $cb_init_balance;

        // Step 1: Fetch all cashbook entries starting starting from the target date
        $sql_cashbook = "SELECT * FROM tb_cashbook WHERE period_covered >= ? AND isDisplayed = 1 ORDER BY period_covered ASC";
        $stmt_cashbook = mysqli_prepare($con, $sql_cashbook);
        mysqli_stmt_bind_param($stmt_cashbook, 's', $target_date);
        if (!$stmt_cashbook || !mysqli_stmt_execute($stmt_cashbook)) {
            throw new Exception("Failed to fetch initial balances: " . mysqli_stmt_error($stmt_cashbook));
        }
        $cashbook_result = mysqli_stmt_get_result($stmt_cashbook);

        if (!$cashbook_result) {
            throw new Exception("Failed to fetch cashbook entries: " . mysqli_error($con));
        }

        // Step 2: Fetch all cashbook data from for each cashbook entry and calculate
        while ($cashbook_row = mysqli_fetch_assoc($cashbook_result)) {
            $cashbook_id = $cashbook_row['cashbook_id'];
            $period_covered =  $cashbook_row['period_covered'];

            $sql_cashbook_data = "SELECT * FROM tb_cashbook_data WHERE cashbook_id = ? ORDER BY cashbook_data_id ASC";
            $stmt_cashbook_data = mysqli_prepare($con, $sql_cashbook_data);
            mysqli_stmt_bind_param($stmt_cashbook_data, 'i', $cashbook_id);
            mysqli_stmt_execute($stmt_cashbook_data);
            $cashbook_data_result = mysqli_stmt_get_result($stmt_cashbook_data);

            $current_clt_balance = $initial_clt_balance;
            $current_cb_balance = $initial_cb_balance;

            while ($data_row = mysqli_fetch_assoc($cashbook_data_result)) {
                $clt_in_value = $data_row['clt_in'];
                $clt_out_value = $data_row['clt_out'];
                $cb_in_value = $data_row['cb_in'];
                $cb_out_value = $data_row['cb_out'];

                $current_clt_balance += $clt_in_value - $clt_out_value;
                $current_cb_balance += $cb_in_value - $cb_out_value;

                $sql_update_data = "UPDATE tb_cashbook_data SET clt_balance = ?, cb_balance = ? WHERE cashbook_data_id = ? ";
                $stmt_update_data = mysqli_prepare($con, $sql_update_data);
                mysqli_stmt_bind_param($stmt_update_data, "ddi", $current_clt_balance, $current_cb_balance, $data_row['cashbook_data_id']);
                if (!mysqli_stmt_execute($stmt_update_data)) {
                    throw new Exception("Failed to update tb_cashbook_data: " . mysqli_stmt_error($stmt_update_data));
                }
                mysqli_stmt_close($stmt_update_data);

                $updated_records[] = [
                    'cashbook_id' => $cashbook_id,
                    'cashbook_data_id' => $data_row['cashbook_data_id'],
                    'period_covered' => $period_covered,
                    'clt_balance' => $current_clt_balance,
                    'cb_balance' => $current_cb_balance
                ];

            }
            mysqli_stmt_close($stmt_cashbook_data);

            $sql_update_cashbook = "UPDATE tb_cashbook SET clt_init_balance = ?, clt_end_balance = ?, cb_init_balance = ?, cb_end_balance = ? WHERE cashbook_id = ? AND isDisplayed = 1";
            $stmt_update_cashbook = mysqli_prepare($con, $sql_update_cashbook);
            mysqli_stmt_bind_param($stmt_update_cashbook, "ddddi", $initial_clt_balance, $current_clt_balance, $initial_cb_balance, $current_cb_balance, $cashbook_id);
            if (!mysqli_stmt_execute($stmt_update_cashbook)) {
                throw new Exception("Failed to update tb_cashbook: " . mysqli_stmt_error($stmt_update_cashbook));
            }
            mysqli_stmt_close($stmt_update_cashbook);

            $sql_update_monthly = "UPDATE tb_cashbook_monthly SET clt_init_balance = ?, clt_end_balance = ?, cb_init_balance = ?, cb_end_balance = ? WHERE YEAR(date_data) = YEAR(?) AND MONTH(date_data) = MONTH(?) AND isDisplayed = 1";
            $stmt_update_monthly = mysqli_prepare($con, $sql_update_monthly);
            mysqli_stmt_bind_param($stmt_update_monthly, "ddddss", $initial_clt_balance, $current_clt_balance, $initial_cb_balance, $current_cb_balance, $period_covered, $period_covered);
            if (!mysqli_stmt_execute($stmt_update_monthly)) {
                throw new Exception("Failed to update tb_cashbook_monthly: " . mysqli_stmt_error($stmt_update_monthly));
            }
            mysqli_stmt_close($stmt_update_monthly);

            $initial_clt_balance = $current_clt_balance;
            $initial_cb_balance = $current_cb_balance;
        }

    }    

    mysqli_commit($con);

} catch (Exception $e) {
    mysqli_rollback($con);
    echo json_encode(array('status' => 'false', 'error' => $e->getMessage()));
}

?>
