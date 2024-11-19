<?php 
include('../../connection.php');

$clt_init_balance = mysqli_real_escape_string($con, $_POST["clt_init"] ?? '');
$cb_init_balance = mysqli_real_escape_string($con, $_POST["cb_init"] ?? '');

mysqli_begin_transaction($con);
try {
    // Step 1: Get the initial balance
    // Check if there is an initial balance record
    $checkQuery = "SELECT init_id FROM tb_cashbook_init LIMIT 1";
    $result = mysqli_query($con, $checkQuery);

    if (!$result) {
        throw new Exception("Error checking initial balance: " . mysqli_error($con));
    }

    if (mysqli_num_rows($result) > 0) {
        // Update existing initial balance
        $updateQuery = "
            UPDATE tb_cashbook_init 
            SET clt_init_balance = '$clt_init_balance', cb_init_balance = '$cb_init_balance'
            LIMIT 1";
        
        if (!mysqli_query($con, $updateQuery)) {
            throw new Exception("Error updating initial balance: " . mysqli_error($con));
        }
    } else {
        // Insert new initial balance
        $insertQuery = "
            INSERT INTO tb_cashbook_init (clt_init_balance, cb_init_balance) 
            VALUES ('$clt_init_balance', '$cb_init_balance')";
        
        if (!mysqli_query($con, $insertQuery)) {
            throw new Exception("Error inserting initial balance: " . mysqli_error($con));
        }
    }

    $initial_clt_balance = $clt_init_balance;
    $initial_cb_balance = $cb_init_balance;

    // Step 2: Fetch all cashbook entries in chronological order
    $sql_cashbook = "SELECT * FROM tb_cashbook WHERE isDisplayed = 1 ORDER BY period_covered ASC";
    $cashbook_result = mysqli_query($con, $sql_cashbook);

    if (!$cashbook_result) {
        throw new Exception("Failed to fetch cashbook entries: " . mysqli_error($con));
    }

    // Step 3: Loop through each cashbook entry to recalculate balances
    if ($cashbook_result) {
        while ($cashbook_row = mysqli_fetch_assoc($cashbook_result)) {
            $cashbook_id = $cashbook_row['cashbook_id'];
            $period_covered =  $cashbook_row['period_covered'];
    
            // Fetch related tb_cashbook_data for this cashbook_id ordered by cashbook_data_id
            $sql_cashbook_data = "SELECT * FROM tb_cashbook_data WHERE cashbook_id = $cashbook_id ORDER BY cashbook_data_id ASC";
            $cashbook_data_result = mysqli_query($con, $sql_cashbook_data);
    
            if ($cashbook_data_result) {
                // Initialize balances for this cashbook (can be fetched from tb_cashbook_init or previous values)
                $current_clt_balance = $initial_clt_balance; // or fetch from previous data
                $current_cb_balance = $initial_cb_balance; // or fetch from previous data

                while ($data_row = mysqli_fetch_assoc($cashbook_data_result)) {
                    // Recalculate data based on previous balances
                    // Update tb_cashbook_data with new values

                    $clt_in_value = $data_row['clt_in'];
                    $clt_out_value = $data_row['clt_out'];

                    $cb_in_value = $data_row['cb_in'];
                    $cb_out_value = $data_row['cb_out'];

                    // Recalculate the balances for the current cashbook_data entry
                    $current_clt_balance += $clt_in_value - $clt_out_value;
                    $current_cb_balance += $cb_in_value - $cb_out_value;

                    $sql_update_data = "UPDATE tb_cashbook_data SET 
                        clt_balance = ?, cb_balance = ?
                        WHERE cashbook_data_id = ?";
                    $stmt_update_data = mysqli_prepare($con, $sql_update_data);
                    mysqli_stmt_bind_param($stmt_update_data, "ddi",
                    $current_clt_balance, $current_cb_balance,
                    $data_row['cashbook_data_id']
                    );
                    if (!mysqli_stmt_execute($stmt_update_data)) {
                        throw new Exception("Failed to update tb_cashbook_data: " . mysqli_stmt_error($stmt_update_data));
                    }

                }
                // After processing all cashbook_data for this cashbook_id, update tb_cashbook with the final balances
                $sql_update_cashbook = "UPDATE tb_cashbook SET 
                        clt_init_balance = ?, clt_end_balance = ?,
                        cb_init_balance = ?, cb_end_balance = ?
                        WHERE cashbook_id = ?";
                    $stmt_update_cashbook = mysqli_prepare($con, $sql_update_cashbook);
                    mysqli_stmt_bind_param($stmt_update_cashbook, "ddddi",
                    $initial_clt_balance, $current_clt_balance, 
                    $initial_cb_balance, $current_cb_balance,
                    $cashbook_id
                    );
                    if (!mysqli_stmt_execute($stmt_update_cashbook)) {
                        throw new Exception("Failed to update tb_cashbook: " . mysqli_stmt_error($stmt_update_cashbook));
                    }
                    
                    //update also the tb_cashbook_monthly
                    $sql_update_monthly = "UPDATE tb_cashbook_monthly SET 
                            clt_init_balance = ?, clt_end_balance = ?,
                            cb_init_balance = ?, cb_end_balance = ?
                            WHERE YEAR(date_data) = YEAR(?) AND MONTH(date_data) = MONTH(?) AND isDisplayed = 1";
                    $stmt_update_monthly = mysqli_prepare($con, $sql_update_monthly);
                    mysqli_stmt_bind_param($stmt_update_monthly, "ddddss", 
                            $initial_clt_balance, $current_clt_balance, 
                            $initial_cb_balance, $current_cb_balance,
                            $period_covered, $period_covered);
                    if (!mysqli_stmt_execute($stmt_update_monthly)) {
                        throw new Exception("Failed to update tb_cashbook_monthly: " . mysqli_stmt_error($stmt_update_monthly));
                    }
            

                     // Store the final balances to be used as the initial balances for the next cashbook
                    $initial_clt_balance = $current_clt_balance;
                    $initial_cb_balance = $current_cb_balance;
            }

        }
    }

    
    // Commit transaction
    mysqli_commit($con);

    // Send success response with cashbook entries and their associated data
    $response = array(
        'status' => 'true',
        'message' => 'Success'
    );

} catch (Exception $e) {
    // Rollback transaction in case of failure
    mysqli_rollback($con);
    $response = array(
        'status' => 'false',
        'error' => $e->getMessage(),
    );
    error_log("Error in Cashbook processing: " . $e->getMessage());
} finally {
    mysqli_close($con);
}

// Return response as JSON
echo json_encode($response);
?>
