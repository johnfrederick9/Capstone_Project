<?php 
include('../../connection.php');

// Capture POST data
$period_covered = mysqli_real_escape_string($con, $_POST["period_covered"] ?? '');
$treasurer_name = mysqli_real_escape_string($con, $_POST["treasurer_name"] ?? '');
$clt_init_balance = mysqli_real_escape_string($con, $_POST["clt_init_balance"] ?? '');
$cb_init_balance = mysqli_real_escape_string($con, $_POST["cb_init_balance"] ?? '');

$clt_suggested_balance = mysqli_real_escape_string($con, $_POST["clt_suggested_balance"] ?? '');
$cb_suggested_balance = mysqli_real_escape_string($con, $_POST["cb_suggested_balance"] ?? '');

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

$add_counter = json_decode($_POST['add_counter'] ?? '[]', true);
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
$ca_balance = json_decode($_POST['ca_balance_data'] ?? '[]', true);
$pcf_receipt = json_decode($_POST['pcf_receipt_data'] ?? '[]', true);
$pcf_payments = json_decode($_POST['pcf_payments_data'] ?? '[]', true);

mysqli_begin_transaction($con);
try {

    $currentDate = date('Y-m');
    $monthYear = date('Y-m', strtotime($period_covered));

     // Check if the passed date is in the future
     if ($monthYear > $currentDate) {
        $response = [
            'status' => 'false',
            'error' => 'The selected date is yet to come. Please choose a valid date.'
        ];
        echo json_encode($response);
        exit;
    }
    
// Get the previous month in "YYYY-MM-DD" format (first day of the previous month)
$previous_month = date("Y-m-01", strtotime("-1 month", strtotime($period_covered)));

// Prepare the SQL query
$sql_fetch_previous = "SELECT isDefaultClt, isDefaultCb 
                       FROM tb_cashbook_monthly 
                       WHERE date_data = ? AND isDisplayed = 1 
                       LIMIT 1";
$stmt_fetch_previous = mysqli_prepare($con, $sql_fetch_previous);

if ($stmt_fetch_previous) {
    mysqli_stmt_bind_param($stmt_fetch_previous, "s", $previous_month);

    if (mysqli_stmt_execute($stmt_fetch_previous)) {
        mysqli_stmt_bind_result($stmt_fetch_previous, $prev_isDefaultClt, $prev_isDefaultCb);

        if (mysqli_stmt_fetch($stmt_fetch_previous)) {
            $prev_isDefaultClt = (int)$prev_isDefaultClt;
            $prev_isDefaultCb = (int)$prev_isDefaultCb;

            // Handle isDefaultClt logic
            if ($clt_init_balance == $clt_suggested_balance) {
                if ($prev_isDefaultClt === 1) {
                    $isDefaultClt = 1;
                } else if ($prev_isDefaultClt === 0) {
                    $isDefaultClt = 0;
                } else {
                    $isDefaultClt = 0; // Fallback for unexpected values
                }
            } else {
                $isDefaultClt = 0;
            }

            // Handle isDefaultCb logic
            if ($cb_init_balance == $cb_suggested_balance) {
                if ($prev_isDefaultCb === 1) {
                    $isDefaultCb = 1;
                } else if ($prev_isDefaultCb === 0) {
                    $isDefaultCb = 0;
                } else {
                    $isDefaultCb = 0; // Fallback for unexpected values
                }
            } else {
                $isDefaultCb = 0;
            }
        } else {
            // Handle no previous record
            $isDefaultClt = ($clt_init_balance == $clt_suggested_balance) ? 1 : 0;
            $isDefaultCb = ($cb_init_balance == $cb_suggested_balance) ? 1 : 0;
        }
    } else {
        // Log query execution failure
        error_log("Query execution failed: " . mysqli_error($con));
        $isDefaultClt = 0;
        $isDefaultCb = 0;
    }

    mysqli_stmt_close($stmt_fetch_previous);
} else {
    // Log statement preparation failure
    error_log("Failed to prepare statement: " . mysqli_error($con));
    $isDefaultClt = 0;
    $isDefaultCb = 0;
}


    // $previous_month = date("Y-m", strtotime("-1 month", strtotime($period_covered)));
    // //Check if the previous month balances is default or not
    // $sql_fetch_previous = "SELECT isDefaultClt, isDefaultCb FROM tb_cashbook_monthly WHERE date_data = ? AND isDisplayed = 1 LIMIT 1";
    // $stmt_fetch_previous = mysqli_prepare($con, $sql_fetch_previous);
    // mysqli_stmt_bind_param($stmt_fetch_previous, "s", $previous_month);
    // mysqli_stmt_execute($stmt_fetch_previous);
    // mysqli_stmt_bind_result($stmt_fetch_previous, $prev_isDefaultClt, $prev_isDefaultCb);
    // mysqli_stmt_fetch($stmt_fetch_previous);
    // mysqli_stmt_close($stmt_fetch_previous);
    
    // // // Check if the previous record exists and determine the default status
    // if ($prev_isDefaultClt == 1) {
    //     $isDefaultClt = 1;
    // } else if ($prev_isDefaultClt == 0) {
    //     $isDefaultClt = 0; 
    // } else {
    //     $isDefaultClt = $clt_init_balance == $clt_suggested_balance ? 1 : 0;
    // }

   
    // if ($prev_isDefaultCb == 1) {
    //     $isDefaultCb = 1; 
    // } else if ($prev_isDefaultCb == 0) {
    //     $isDefaultCb = 0; 
    // } else {
    //     $isDefaultCb = $cb_init_balance == $cb_suggested_balance ? 1 : 0;
    // }

    // // Compare if the suggested balance is equal to the initial balance for CLT and CB
    // $isDefaultClt = floatval($clt_init_balance) == floatval($clt_suggested_balance) ? 1 : 0;
    // $isDefaultCb = floatval($cb_init_balance) == floatval($cb_suggested_balance) ? 1 : 0;


    // Extract the month and year from the input period_covered
    $input_month = date('m', strtotime($period_covered));
    $input_year = date('Y', strtotime($period_covered));

    // Query to check for existing records with the same month and year
    $sql_date_check = "SELECT COUNT(*) FROM tb_cashbook WHERE MONTH(period_covered) = ? AND YEAR(period_covered) = ? AND isDisplayed = 1";
    $stmt_date_check = mysqli_prepare($con, $sql_date_check);
    mysqli_stmt_bind_param($stmt_date_check,"ii", $input_month, $input_year);
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

    // First, insert into tb_cashbook to get the cashbook_id
    $sql_cashbook = "INSERT INTO tb_cashbook (
        period_covered, treasurer_name, clt_init_balance, cb_init_balance,
        clt_end_in, clt_end_out, clt_end_balance,
        cb_end_in, cb_end_out, cb_end_balance,
        ca_end_receipt, ca_end_disbursement, ca_end_balance,
        pcf_end_receipt, pcf_end_payments, pcf_end_balance, isDisplayed
    ) VALUES (?, ?, ?, ?, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1)";
    $stmt_sql_cashbook = mysqli_prepare($con, $sql_cashbook);
    mysqli_stmt_bind_param($stmt_sql_cashbook, "ssdd", $period_covered, $treasurer_name, $clt_init_balance, $cb_init_balance);
    if (!mysqli_stmt_execute($stmt_sql_cashbook)) {
        throw new Exception("Failed to insert into tb_cashbook: " . mysqli_stmt_error($stmt_sql_cashbook));
    }
    mysqli_stmt_close($stmt_sql_cashbook);

        // Get the newly inserted cashbook_id
    $cashbook_id = mysqli_insert_id($con);

    $sql_cashbook_data = "INSERT INTO tb_cashbook_data(cashbook_id, date_data, particulars_1, particulars_2, reference_1, reference_2, clt_in, clt_out, clt_balance, cb_in, cb_out, cb_balance, ca_receipt, ca_disbursement, ca_balance, pcf_receipt, pcf_payments, pcf_balance)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_cashbook_data = mysqli_prepare($con,  $sql_cashbook_data);

    // Initialize running balances
    $current_clt_balance = $clt_init_balance;
    $current_cb_balance = $cb_init_balance;
    $current_ca_balance = 0;
    $current_pcf_balance = 0;

    // Loop through each record and insert into tb_cashbook_data
    for($i = 0; $i < count($add_counter); $i++) {
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

        // Bind and execute statement
        mysqli_stmt_bind_param($stmt_cashbook_data,
            "isssssdddddddddddd",
            $cashbook_id_var,
            $date_data_var,
            $particulars_1_var,
            $particulars_2_var,
            $reference_1_var,
            $reference_2_var,
            $clt_in_value,
            $clt_out_value,
            $current_clt_balance,
            $cb_in_value,
            $cb_out_value,
            $current_cb_balance,
            $ca_receipt_value,
            $ca_disbursement_value,
            $current_ca_balance,
            $pcf_receipt_value,
            $pcf_payments_value,
            $current_pcf_balance
        );


        if (!mysqli_stmt_execute($stmt_cashbook_data)) {
            throw new Exception("Failed to insert into tb_cashbook_data: " . mysqli_stmt_error($stmt_cashbook_data));
        }
        

        $clt_end_in += floatval($clt_in[$i]);
        $clt_end_out += floatval($clt_out[$i]);
        $cb_end_in += floatval($cb_in[$i]);
        $cb_end_out += floatval($cb_out[$i]);
        $ca_end_receipt += floatval($ca_receipt[$i]);
        $ca_end_disbursement += floatval($ca_disbursement[$i]);
        $pcf_end_receipt += floatval($pcf_receipt[$i]);
        $pcf_end_payments += floatval($pcf_payments[$i]);
    }
    mysqli_stmt_close($stmt_cashbook_data);
    $clt_end_balance = $clt_init_balance + $clt_end_in - $clt_end_out;
    $cb_end_balance = $cb_init_balance + $cb_end_in - $cb_end_out;
    $ca_end_balance = $ca_end_receipt - $ca_end_disbursement;
    $pcf_end_balance = $pcf_end_receipt - $pcf_end_payments;

    $sql_cashbook_up = "UPDATE tb_cashbook 
        SET clt_end_in = ?, clt_end_out = ?, clt_end_balance = ?,
                cb_end_in = ?, cb_end_out = ?, cb_end_balance = ?,
                ca_end_receipt = ?, ca_end_disbursement = ?, ca_end_balance = ?,
                pcf_end_receipt = ?, pcf_end_payments = ?, pcf_end_balance = ?
        WHERE cashbook_id = ?";
    $stmt_cashbook_up = mysqli_prepare($con, $sql_cashbook_up);
    mysqli_stmt_bind_param($stmt_cashbook_up, "ddddddddddddi", 
    $clt_end_in, $clt_end_out, $clt_end_balance,
        $cb_end_in, $cb_end_out, $cb_end_balance,
        $ca_end_receipt, $ca_end_disbursement, $ca_end_balance,
        $pcf_end_receipt, $pcf_end_payments, $pcf_end_balance,
        $cashbook_id
    );
    mysqli_stmt_execute($stmt_cashbook_up);
    mysqli_stmt_close($stmt_cashbook_up);
    
    $sql_monthly = "INSERT INTO tb_cashbook_monthly (
        cashbook_id, date_data, 
        clt_init_balance, clt_end_balance, 
        cb_init_balance, cb_end_balance,
        isDefaultClt, isDefaultCb,
        isDisplayed
    ) VALUES (?,?, ?, ?, ?, ?, ?, ?, 1)";
    $stmt_sql_monthly = mysqli_prepare($con, $sql_monthly);
    mysqli_stmt_bind_param($stmt_sql_monthly, "isddddii", $cashbook_id,$period_covered, $clt_init_balance, $clt_end_balance ,$cb_init_balance, $cb_end_balance, $isDefaultClt, $isDefaultCb);
    if (!mysqli_stmt_execute($stmt_sql_monthly)) {
        throw new Exception("Failed to insert into tb_cashbook_monthly: " . mysqli_stmt_error($stmt_sql_monthly));
    }
    mysqli_stmt_close($stmt_sql_monthly);

//////////////////////////////////////////////////////////////////

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

    // Retrieve the status of the target date
    $sql_status = "SELECT isDefaultClt, isDefaultCb FROM tb_cashbook_monthly WHERE date_data = ? AND isDisplayed = 1";
    $stmt_status = mysqli_prepare($con, $sql_status);
    mysqli_stmt_bind_param($stmt_status, "s", $target_date);
    mysqli_stmt_execute($stmt_status);
    mysqli_stmt_bind_result($stmt_status, $CltStatus, $CbStatus);
    mysqli_stmt_fetch($stmt_status);
    mysqli_stmt_close($stmt_status);

    // Enhanced date position handling using switch statement
    switch (true) {
        case ($target_date == $earliest_date):
            // First date logic
            $_GET['target_date'] = $target_date;
            $_GET['date_status'] = 'Recalculate'; // Pass date_status via GET
            $_GET['CltStatus'] = $CltStatus; // Pass record status (manual or default)
            $_GET['CbStatus'] = $CbStatus;
            $message = "Recalculate from the first date";
            break;

        case ($target_date == $latest_date):
            // Latest date logic (do nothing)
            $message = "Do nothing";
            break;

        default:
            // Middle date logic
            $_GET['target_date'] = $target_date;
            $_GET['date_status'] = 'Recalculate'; // Pass date_status via GET
            $_GET['CltStatus'] = $CltStatus; // Pass record status (manual or default)
            $_GET['CbStatus'] = $CbStatus; // Pass record status (manual or default)
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
        'message' => 'Cashbook Record successfully!'
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
