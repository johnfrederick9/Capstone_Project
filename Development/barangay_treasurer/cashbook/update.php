<?php
include('../../connection.php');

// Capture POST data

$cashbook_id = mysqli_real_escape_string($con, $_POST["cashbook_id"] ?? '');
$cashbook_data_ids = json_decode($_POST["cashbook_data_id"]??'[]', true) ;


$period_covered = mysqli_real_escape_string($con, $_POST["period_covered"] ?? '');
$treasurer_name = mysqli_real_escape_string($con, $_POST["treasurer_name"] ?? '');
$clt_init_balance = mysqli_real_escape_string($con, $_POST["clt_init_balance"] ?? '');
$cb_init_balance = mysqli_real_escape_string($con, $_POST["cb_init_balance"] ?? '');

// $add_counter= is_array($_POST["add_counter"] ?? null) ? $_POST["add_counter"] : [];
// $date_data = is_array($_POST["date_data"] ?? null) ? $_POST["date_data"] : [];
// $particulars_1 = is_array($_POST["particulars_1"] ?? null) ? $_POST["particulars_1"] : [];
// $particulars_2 = is_array($_POST["particulars_2"] ?? null) ? $_POST["particulars_2"] : [];
// $reference_1 = is_array($_POST["reference_1"] ?? null) ? $_POST["reference_1"] : [];
// $reference_2= is_array($_POST["reference_2"] ?? null) ? $_POST["reference_2"] : [];
// $clt_in = is_array($_POST["clt_in_data"] ?? null) ? $_POST["clt_in_data"] : [];
// $clt_out = is_array($_POST["clt_out_data"] ?? null) ? $_POST["clt_out_data"] : [];
// $cb_in  = is_array($_POST["cb_in_data"] ?? null) ? $_POST["cb_in_data"] : [];
// $cb_out = is_array($_POST["cb_out_data"] ?? null) ? $_POST["cb_out_data"] : [];
// $ca_receipt = is_array($_POST["ca_receipt_data"] ?? null) ? $_POST["ca_receipt_data"] : [];
// $ca_disbursement = is_array($_POST["ca_disbursement_data"] ?? null) ? $_POST["ca_disbursement_data"] : [];
// $ca_balance  = is_array($_POST["ca_balance_data"] ?? null) ? $_POST["ca_balance_data"] : [];
// $pcf_receipt = is_array($_POST["pcf_receipt_data"] ?? null) ? $_POST["pcf_receipt_data"] : [];
// $pcf_payments = is_array($_POST["pcf_payments_data"] ?? null) ? $_POST["pcf_payments_data"] : [];

$cashbook_data_ids = json_decode($_POST["cashbook_data_id"], true);
$up_counter = json_decode($_POST['up_counter'] ?? '[]', true);
$date_data = json_decode($_POST['date_data'] ?? '[]', true);
$particulars_1 = json_decode($_POST['particulars_1'] ?? '[]', true);
$particulars_2 = json_decode($_POST['particulars_2'] ?? '[]', true);
$reference_1 = json_decode($_POST['reference_1'] ?? '[]', true);
$reference_2 = json_decode($_POST['reference_2'] ?? '[]', true);
$clt_in = json_decode($_POST['clt_in_data'] ?? '[]', true);
$clt_out = json_decode($_POST['clt_out_data'] ?? '[]', true);
$cb_in = json_decode($_POST['cb_in_data'] ?? '[]', true);
$cb_out = json_decode($_POST['cb_out_data'] ?? '[]', true);
$ca_receipt = json_decode($_POST['ca_receipt_data'] ?? '[]', true);
$ca_disbursement = json_decode($_POST['ca_disbursement_data'] ?? '[]', true);
// $ca_balance = json_decode($_POST['ca_balance_data'] ?? '[]', true);
$pcf_receipt = json_decode($_POST['pcf_receipt_data'] ?? '[]', true);
$pcf_payments = json_decode($_POST['pcf_payments_data'] ?? '[]', true);


$message = '';
$updated_inserted_records = [];

mysqli_begin_transaction($con);
try {
    
    // Extract the month and year from the input period_covered
    $input_month = date('m', strtotime($period_covered));
    $input_year = date('Y', strtotime($period_covered));

    // Query to check for existing records with the same month and year
    $sql_date_check = "SELECT COUNT(*) FROM tb_cashbook WHERE MONTH(period_covered) = ? AND YEAR(period_covered) = ? AND isDisplayed = 1 and cashbook_id != ?";
    $stmt_date_check = mysqli_prepare($con, $sql_date_check);
    mysqli_stmt_bind_param($stmt_date_check,"iii", $input_month, $input_year, $cashbook_id);
    if (!mysqli_stmt_execute($stmt_date_check)) {
        throw new Exception("Date check query failed: " . mysqli_stmt_error($stmt_date_check));
    }
    mysqli_stmt_bind_result($stmt_date_check, $count);
    mysqli_stmt_fetch($stmt_date_check);
    mysqli_stmt_close($stmt_date_check);

    if ($count > 0) {
        echo json_encode(['status' => 'false', 'message' => "A record for the same month and year already exists. Please choose a different period."]);
        exit;
    }
    // Initialize variables for end balances
    $clt_end_in = 0;
    $clt_end_out = 0;
    $cb_end_in = 0;
    $cb_end_out = 0;
    $ca_end_receipt = 0;
    $ca_end_disbursement = 0;
    $pcf_end_receipt = 0;
    $pcf_end_payments = 0;
    $isDisplayed = 1;

    $existing_ids = [];
    $sql_existing = "SELECT cashbook_data_id FROM tb_cashbook_data WHERE cashbook_id = ?";
    $stmt_existing = mysqli_prepare($con, $sql_existing);
    mysqli_stmt_bind_param($stmt_existing, "i", $cashbook_id);
    if (!mysqli_stmt_execute($stmt_existing)) {
        throw new Exception("Date check query failed: " . mysqli_stmt_error($stmt_existing));
    }
    mysqli_stmt_bind_result($stmt_existing, $result_existing);
    while (mysqli_stmt_fetch($stmt_existing)) {
        $existing_ids[] = $result_existing; // Store the cashbook_data_id in the array
    }
    mysqli_stmt_close($stmt_existing);

    // Initialize running balances
    $current_clt_balance = $clt_init_balance;
    $current_cb_balance = $cb_init_balance;
    $current_ca_balance = 0;
    $current_pcf_balance = 0;

    // Track processed ids
    $processed_ids = [];

    if (empty($cashbook_data_ids)) {
        $sql_delete_all = "DELETE FROM tb_cashbook_data WHERE cashbook_id = ?";
        $stmt_delete_all = mysqli_prepare($con,$sql_delete_all);
        mysqli_stmt_bind_param($stmt_delete_all, "i", $cashbook_id);
        if (!mysqli_stmt_execute($stmt_delete_all)) {
            throw new Exception("Failed to delete tb_cashbook_data: " . mysqli_stmt_error($stmt_delete_all));
        }
        mysqli_stmt_close($stmt_delete_all);
    }
        for($i = 0; $i < count($up_counter); $i++) {
            // Update running balances
            // Check if the necessary indices exist before accessing them
            $clt_in_value = isset($clt_in[$i]) ? floatval($clt_in[$i]) : 0;
            $clt_out_value = isset($clt_out[$i]) ? floatval($clt_out[$i]) : 0;
            $cb_in_value = isset($cb_in[$i]) ? floatval($cb_in[$i]) : 0;
            $cb_out_value = isset($cb_out[$i]) ? floatval($cb_out[$i]) : 0;
            $ca_receipt_value = isset($ca_receipt[$i]) ? floatval($ca_receipt[$i]) : 0;
            $ca_disbursement_value = isset($ca_disbursement[$i]) ? floatval($ca_disbursement[$i]) : 0;
            $pcf_receipt_value = isset($pcf_receipt[$i]) ? floatval($pcf_receipt[$i]) : 0;
            $pcf_payments_value = isset($pcf_payments[$i]) ? floatval($pcf_payments[$i]) : 0;
            
            // Update running balances using the values with checks
            $current_clt_balance += $clt_in_value - $clt_out_value;
            $current_cb_balance += $cb_in_value - $cb_out_value;
            $current_ca_balance += $ca_receipt_value - $ca_disbursement_value;
            $current_pcf_balance += $pcf_receipt_value - $pcf_payments_value;
    
            // Bind parameters using temporary variables
            $cashbook_id_var = $cashbook_id;
            $date_data_var = isset($date_data[$i]) ? $date_data[$i] : '';
            $particulars_1_var = isset($particulars_1[$i]) ? $particulars_1[$i] : '';
            $particulars_2_var = isset($particulars_2[$i]) ? $particulars_2[$i] : '';
            $reference_1_var = isset($reference_1[$i]) ? $reference_1[$i] : '';
            $reference_2_var = isset($reference_2[$i]) ? $reference_2[$i] : '';

            $cashbook_data_id = isset($cashbook_data_ids[$i]) ? $cashbook_data_ids[$i] : '';

            $record_data = [
                'cashbook_data_id' => isset($cashbook_data_ids[$i]) ? $cashbook_data_ids[$i] : null,
                'date_data' => $date_data_var,
                'particulars_1' => $particulars_1_var,
                'particulars_2' => $particulars_2_var,
                'reference_1' => $reference_1_var,
                'reference_2' => $reference_2_var,
                'clt_in' => $clt_in[$i],
                'clt_out' => $clt_out[$i],
                'clt_balance' => $current_clt_balance,
                'cb_in' => $cb_in[$i],
                'cb_out' => $cb_out[$i],
                'cb_balance' => $current_cb_balance,
                'ca_receipt' => $ca_receipt[$i],
                'ca_disbursement' => $ca_disbursement[$i],
                'ca_balance' => $current_ca_balance,
                'pcf_receipt' => $pcf_receipt[$i],
                'pcf_payments' => $pcf_payments[$i],
                'pcf_balance' => $current_pcf_balance,
            ];

            if (!empty($cashbook_data_id)) {
                // If cashbook_data_id is present, update the existing record
                $sql_data = "UPDATE tb_cashbook_data SET
                    date_data = ?, particulars_1 = ?, particulars_2 = ?, 
                    reference_1 = ?, reference_2 = ?, clt_in = ?, clt_out = ?, clt_balance = ?, 
                    cb_in = ?, cb_out = ?, cb_balance = ?, 
                    ca_receipt = ?, ca_disbursement = ?, ca_balance = ?, 
                    pcf_receipt = ?, pcf_payments = ?, pcf_balance = ?
                WHERE cashbook_data_id = ?";
                $stmt_data = mysqli_prepare($con, $sql_data);
                mysqli_stmt_bind_param($stmt_data, "sssssddddddddddddi",  
                    $date_data_var, $particulars_1_var, $particulars_2_var, $reference_1_var, $reference_2_var, 
                    $clt_in_value, $clt_out_value, $current_clt_balance, 
                    $cb_in_value, $cb_out_value, $current_cb_balance, 
                    $ca_receipt_value, $ca_disbursement_value, $current_ca_balance, 
                    $pcf_receipt_value, $pcf_payments_value, $current_pcf_balance,
                    $cashbook_data_id
                );
                $updated_inserted_records[] = $record_data;
            }else{
                // If cashbook_data_id is not present, insert a new record
                    $sql_data = "INSERT INTO tb_cashbook_data(
                        cashbook_id, date_data, particulars_1, particulars_2, reference_1, reference_2, 
                        clt_in, clt_out, clt_balance, cb_in, cb_out, cb_balance, 
                        ca_receipt, ca_disbursement, ca_balance, pcf_receipt, pcf_payments, pcf_balance
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt_data = mysqli_prepare($con, $sql_data);
                    mysqli_stmt_bind_param($stmt_data, "isssssdddddddddddd", 
                        $cashbook_id_var, $date_data_var, $particulars_1_var, $particulars_2_var, $reference_1_var, $reference_2_var, 
                        $clt_in_value, $clt_out_value, $current_clt_balance, 
                        $cb_in_value, $cb_out_value, $current_cb_balance, 
                        $ca_receipt_value, $ca_disbursement_value, $current_ca_balance, 
                        $pcf_receipt_value, $pcf_payments_value, $current_pcf_balance,
                    );
                    $updated_inserted_records[] = array_merge($record_data, ['new' => true]);
            }
                if (!mysqli_stmt_execute($stmt_data)) {
                    throw new Exception("Failed to delete tb_cashbook_data: " . mysqli_stmt_error($stmt_data));
                }
                if (!empty($cashbook_data_id)) {
                    $processed_ids[] = $cashbook_data_id;
                }
        }
        mysqli_stmt_close($stmt_data);
    
    // Identify and delete records that were not processed (i.e., those that are gone)
    $ids_to_delete = array_diff($existing_ids, $processed_ids);
    if(!empty($ids_to_delete)){
        $ids_placeholder = implode(',', array_fill(0, count($ids_to_delete), '?'));
        $sql_delete = "DELETE FROM tb_cashbook_data WHERE cashbook_data_id IN ($ids_placeholder)";
        $stmt_delete = mysqli_prepare($con, $sql_delete);
        mysqli_stmt_bind_param($stmt_delete, str_repeat('i', count($ids_to_delete)), ...$ids_to_delete);

        if (!$stmt_delete->execute()) {
            throw new Exception("MySQL error (delete): " . $stmt_delete->error);
        }
        mysqli_stmt_close($stmt_delete);
    }
     // Calculate end balances
     for($i = 0; $i < count($up_counter); $i++) {
        $clt_end_in += floatval($clt_in[$i]);
        $clt_end_out += floatval($clt_out[$i]);
        $cb_end_in += floatval($cb_in[$i]);
        $cb_end_out += floatval($cb_out[$i]);
        $ca_end_receipt += floatval($ca_receipt[$i]);
        $ca_end_disbursement += floatval($ca_disbursement[$i]);
        $pcf_end_receipt += floatval($pcf_receipt[$i]);
        $pcf_end_payments += floatval($pcf_payments[$i]);
    }
    
    $clt_end_balance = $clt_init_balance + $clt_end_in - $clt_end_out;
    $cb_end_balance = $cb_init_balance + $cb_end_in - $cb_end_out;
    $ca_end_balance = $ca_end_receipt - $ca_end_disbursement;
    $pcf_end_balance = $pcf_end_receipt - $pcf_end_payments;

    $sql_cash_up = "UPDATE tb_cashbook SET 
                period_covered =?, treasurer_name = ?, clt_init_balance = ?, cb_init_balance = ?,
                clt_end_in = ?, clt_end_out = ?, clt_end_balance = ?,
                cb_end_in = ?, cb_end_out = ?, cb_end_balance = ?,
                ca_end_receipt = ?, ca_end_disbursement = ?, ca_end_balance = ?,
                pcf_end_receipt = ?, pcf_end_payments = ?, pcf_end_balance = ?
            WHERE cashbook_id = ?";
    $stmt_cash_up = mysqli_prepare($con, $sql_cash_up);
    mysqli_stmt_bind_param($stmt_cash_up, "ssddddddddddddddi", 
                $period_covered, $treasurer_name, $clt_init_balance, $cb_init_balance,
                $clt_end_in, $clt_end_out, $clt_end_balance,
                $cb_end_in, $cb_end_out, $cb_end_balance,
                $ca_end_receipt, $ca_end_disbursement, $ca_end_balance,
                $pcf_end_receipt, $pcf_end_payments, $pcf_end_balance, $cashbook_id
    );
    if (!mysqli_stmt_execute($stmt_cash_up)) {
        throw new Exception("Failed to update tb_cashbook: " . mysqli_stmt_error($stmt_cash_up));
    }
    mysqli_stmt_close($stmt_cash_up);
    
    //update tb_cashbook_monthly
    $sql_monthly_up = "UPDATE tb_cashbook_monthly SET 
            clt_end_balance = ?,
            cb_end_balance = ?
        WHERE date_data = ?";
    $stmt_monthly_up = mysqli_prepare($con, $sql_monthly_up);
    mysqli_stmt_bind_param($stmt_monthly_up, "dds", 
     $clt_end_balance,$cb_end_balance, $period_covered 
    );
    mysqli_stmt_execute($stmt_monthly_up);
    mysqli_stmt_close($stmt_monthly_up);


  // Query to get the earliest and latest dates
  $sql_dates = "SELECT 
  MIN(date_data) AS earliest_date,
  MAX(date_data) AS latest_date 
  FROM tb_cashbook_monthly
  WHERE isDisplayed = 1";

    $result_dates = mysqli_query($con, $sql_dates);

    // Check if the query was successful and returns data
    if ($result_dates && mysqli_num_rows($result_dates) > 0) {
    $dates = mysqli_fetch_assoc($result_dates);

    // Standardize date formats for comparison
    $earliest_date = !empty($dates['earliest_date']) ? date('Y-m-d', strtotime($dates['earliest_date'])) : null;
    $latest_date = !empty($dates['latest_date']) ? date('Y-m-d', strtotime($dates['latest_date'])) : null;
    $target_date = date('Y-m-d', strtotime($period_covered));

    // Enhanced date position handling using switch statement
    switch(true) {
        case ($target_date == $earliest_date):
            // First date logic
            $_GET['target_date'] = $target_date;
            $_GET['date_status'] = 'First'; // Pass date_status via GET
            //include('recalculate_data.php');
            $message = "Recalculate from the first date";
            break;
                
        case ($target_date == $latest_date):
            // Latest date logic (do nothing)
            $message = "Do nothing";
            break;
                
        default:
            // Middle date logic
            $_GET['target_date'] = $target_date;
            $_GET['date_status'] = 'In Between'; // Pass date_status via GET
            //include('recalculate_data.php');
            $message = "Recalculate from the starting date";
            break;
    }

    // Close the result set
    mysqli_free_result($result_dates);
    }


    // Send success response
    $response = array(
        'status' => 'true',
        'cashbook_id' => $cashbook_id,
        'cashbook_data_ids' => $cashbook_data_ids,
        'updated_inserted_records' => $updated_inserted_records,
        'message' => 'Cashbook Recorded successfully!',
        'emessage'=> $message
    );

    mysqli_commit($con);

    if (isset($_GET['target_date'])) {
        include('recalculate_data.php');
    }

} catch (Exception $e) {
    // Rollback transaction in case of failure
    mysqli_rollback($con);
    $response = array(
        'status' => 'false',
        'message' => $message,
        'error' => $e->getMessage(),

    );
    error_log("Error in Cashbook processing: " . $e->getMessage());
} finally {
    mysqli_close($con);
}

// Return response as JSON
echo json_encode($response);
?>
