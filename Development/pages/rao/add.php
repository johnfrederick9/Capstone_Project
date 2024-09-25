<?php 
include('../../connection.php');
//Period Covered

$period_covered = mysqli_real_escape_string($con, $_POST["period_covered"] ?? '');

// Check if the input is exactly 4 digits
if (!preg_match('/^\d{4}$/', $period_covered)) {
    // If the input is not a valid 4-digit year, handle the error
    echo json_encode(array('status' => 'failed', 'message' => 'Invalid period_covered. It should be a 4-digit year.'));
    exit();
}

//For Appropriations
$ap_counter = is_array($_POST["ap_counter"] ?? null) ? $_POST["ap_counter"] : [];
$ap_date_data = is_array($_POST["ap_date_data"] ?? null) ? $_POST["ap_date_data"] : [];
$ap_reference_data = is_array($_POST["ap_reference"] ?? null) ? $_POST["ap_reference"] : [];
$ap_particulars_data = is_array($_POST["ap_particulars"] ?? null) ? $_POST["ap_particulars"] : [];
$ap_salary_data = is_array($_POST["ap_salary"] ?? null) ? $_POST["ap_salary"] : [];
$ap_cash_gift_data = is_array($_POST["ap_cash_gift"] ?? null) ? $_POST["ap_cash_gift"] : [];
$ap_year_end_data = is_array($_POST["ap_year_end"] ?? null) ? $_POST["ap_year_end"] : [];
$ap_mid_year_data = is_array($_POST["ap_mid_year"] ?? null) ? $_POST["ap_mid_year"] : [];
$ap_sri_data = is_array($_POST["ap_sri"] ?? null) ? $_POST["ap_sri"] : [];
$ap_others_data = is_array($_POST["ap_others"] ?? null) ? $_POST["ap_others"] : [];

//For Obligations
$ob_counter = is_array($_POST["ob_counter"] ?? null) ? $_POST["ob_counter"] : [];
$ob_date_data = is_array($_POST["ob_date_data"] ?? null) ? $_POST["ob_date_data"] : [];
$ob_reference_data = is_array($_POST["ob_reference"] ?? null) ? $_POST["ob_reference"] : [];
$ob_particulars_data = is_array($_POST["ob_particulars"] ?? null) ? $_POST["ob_particulars"] : [];
$ob_salary_data = is_array($_POST["ob_salary"] ?? null) ? $_POST["ob_salary"] : [];
$ob_cash_gift_data = is_array($_POST["ob_cash_gift"] ?? null) ? $_POST["ob_cash_gift"] : [];
$ob_year_end_data = is_array($_POST["ob_year_end"] ?? null) ? $_POST["ob_year_end"] : [];
$ob_mid_year_data = is_array($_POST["ob_mid_year"] ?? null) ? $_POST["ob_mid_year"] : [];
$ob_sri_data = is_array($_POST["ob_sri"] ?? null) ? $_POST["ob_sri"] : [];
$ob_others_data = is_array($_POST["ob_others"] ?? null) ? $_POST["ob_others"] : [];


// Decode the JSON data from form submission
$ap_counter = json_decode($_POST['ap_counter'], true);
$ap_date_data = json_decode($_POST['ap_date_data'], true);
$ap_reference_data = json_decode($_POST['ap_reference'], true);
$ap_particulars_data = json_decode($_POST['ap_particulars'], true);
$ap_salary_data = json_decode($_POST['ap_salary'], true);
$ap_cash_gift_data = json_decode($_POST['ap_cash_gift'], true);
$ap_year_end_data = json_decode($_POST['ap_year_end'], true);
$ap_mid_year_data = json_decode($_POST['ap_mid_year'], true);
$ap_sri_data = json_decode($_POST['ap_sri'], true);
$ap_others_data = json_decode($_POST['ap_others'], true);

$ob_counter = json_decode($_POST['ob_counter'], true);
$ob_date_data = json_decode($_POST['ob_date_data'], true);
$ob_reference_data = json_decode($_POST['ob_reference'], true);
$ob_particulars_data = json_decode($_POST['ob_particulars'], true);
$ob_salary_data = json_decode($_POST['ob_salary'], true);
$ob_cash_gift_data = json_decode($_POST['ob_cash_gift'], true);
$ob_year_end_data = json_decode($_POST['ob_year_end'], true);
$ob_mid_year_data = json_decode($_POST['ob_mid_year'], true);
$ob_sri_data = json_decode($_POST['ob_sri'], true);
$ob_others_data = json_decode($_POST['ob_others'], true);



mysqli_begin_transaction($con);
try{
    // Initialize totals for tb_rao
    $ap_totals = 0;
    $ob_totals = 0;
    $ap_salary_totals = 0;
    $ap_cash_gift_totals = 0;
    $ap_year_end_totals = 0;
    $ap_mid_year_totals = 0;
    $ap_sri_totals = 0;
    $ap_others_totals = 0;

    $ob_salary_totals = 0;
    $ob_cash_gift_totals = 0;
    $ob_year_end_totals = 0;
    $ob_mid_year_totals = 0;
    $ob_sri_totals = 0;
    $ob_others_totals = 0;

    

    // First, insert into tb_rao to get the rao_id
    $sql_rao = "INSERT INTO tb_rao (`period_covered`, `ap_total`, `ap_salary`, `ap_cash_gift`, `ap_year_end`, `ap_mid_year`, `ap_sri`, `ap_others`, 
                                `ob_total`, `ob_salary`, `ob_cash_gift`, `ob_year_end`, `ob_mid_year`, `ob_sri`, `ob_others`, 
                                `apbd_total`, `apbd_salary`, `apbd_cash_gift`, `apbd_year_end`, `apbd_mid_year`, `apbd_sri`, `apbd_others`) 
                VALUES (?, 0, 0, 0, 0, 0, 0, 0,
                        0, 0, 0, 0, 0, 0, 0,
                        0, 0, 0, 0, 0, 0, 0)";
    $stmt = mysqli_prepare($con, $sql_rao);
    mysqli_stmt_bind_param($stmt, "s", $period_covered);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Failed to insert into tb_rao: " . mysqli_stmt_error($stmt));
    }

    // Get the newly inserted rao_id
    $rao_id = mysqli_insert_id($con);

    $success_ap = true; // Initialize a success flag for appropriations
    // Insert into tb_rao_ap_data (Appropriations)
    $sql_ap = "INSERT INTO tb_rao_ap_data (`rao_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_total`, `ap_salary`, `ap_cash_gift`, `ap_year_end`, `ap_mid_year`, `ap_sri`, `ap_others`) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_ap = mysqli_prepare($con, $sql_ap);

    $ap_counter =array_map('intval',$ap_counter);

    foreach ($ap_counter as $index => $counter) {
        $date = mysqli_real_escape_string($con, $ap_date_data[$index]);
        $reference = mysqli_real_escape_string($con, $ap_reference_data[$index]);
        $particulars = mysqli_real_escape_string($con, $ap_particulars_data[$index]);
        $salary = !empty($ap_salary_data[$index]) ? floatval($ap_salary_data[$index]) : 0;
        $cash_gift = !empty($ap_cash_gift_data[$index]) ? floatval($ap_cash_gift_data[$index]) : 0;
        $year_end = !empty($ap_year_end_data[$index]) ? floatval($ap_year_end_data[$index]) : 0;
        $mid_year = !empty($ap_mid_year_data[$index]) ? floatval($ap_mid_year_data[$index]) : 0;
        $sri = !empty($ap_sri_data[$index]) ? floatval($ap_sri_data[$index]) : 0;
        $others = !empty($ap_others_data[$index]) ? floatval($ap_others_data[$index]) : 0;
        $total = $salary + $cash_gift + $year_end + $mid_year + $sri + $others;

            mysqli_stmt_bind_param($stmt_ap, "isssddddddd", $rao_id, $date, $reference, $particulars, $total, $salary, $cash_gift, $year_end, $mid_year, $sri, $others);
            if (!mysqli_stmt_execute($stmt_ap)) {
                throw new Exception("Failed to insert into tb_rao_ap_data: " . mysqli_stmt_error($stmt_ap));
            }

            // Accumulate totals for tb_rao
            $ap_totals += $total;
            $ap_salary_totals += $salary;
            $ap_cash_gift_totals += $cash_gift;
            $ap_year_end_totals += $year_end;
            $ap_mid_year_totals += $mid_year;
            $ap_sri_totals += $sri;
            $ap_others_totals += $others;
    }

    $success_ob = true; // Initialize a success flag for obligations
    // Insert into tb_rao_ob_data (Obligations)
    $sql_ob = "INSERT INTO tb_rao_ob_data (`rao_id`, `ob_ref_date`, `ob_ref_no`, `ob_particulars`, `ob_total`, `ob_salary`, `ob_cash_gift`, `ob_year_end`, `ob_mid_year`, `ob_sri`, `ob_others`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_ob = mysqli_prepare($con, $sql_ob);

    $ob_counter =array_map('intval',$ob_counter);

    foreach ($ob_counter as $index => $counter) {
        $date = mysqli_real_escape_string($con, $ob_date_data[$index]);
        $reference = mysqli_real_escape_string($con, $ob_reference_data[$index]);
        $particulars = mysqli_real_escape_string($con, $ob_particulars_data[$index]);
        $salary = !empty($ob_salary_data[$index]) ? floatval($ob_salary_data[$index]) : 0;
        $cash_gift = !empty($ob_cash_gift_data[$index]) ? floatval($ob_cash_gift_data[$index]) : 0;
        $year_end = !empty($ap_year_end_data[$index]) ? floatval($ob_year_end_data[$index]) : 0;
        $mid_year = !empty($ob_mid_year_data[$index]) ? floatval($ob_mid_year_data[$index]) : 0;
        $sri = !empty($ob_sri_data[$index]) ? floatval($ob_sri_data[$index]) : 0;
        $others = !empty($ob_others_data[$index]) ? floatval($ob_others_data[$index]) : 0;
        $total = $salary + $cash_gift + $year_end + $mid_year + $sri + $others;

            mysqli_stmt_bind_param($stmt_ob, "isssddddddd", $rao_id, $date, $reference, $particulars, $total, $salary, $cash_gift, $year_end, $mid_year, $sri, $others);
            if (!mysqli_stmt_execute($stmt_ob)) {
                throw new Exception("Failed to insert into tb_rao_ap_data: " . mysqli_stmt_error($stmt_ob));
            }

            // Accumulate totals for tb_rao
            $ob_totals += $total;
            $ob_salary_totals += $salary;
            $ob_cash_gift_totals += $cash_gift;
            $ob_year_end_totals += $year_end;
            $ob_mid_year_totals += $mid_year;
            $ob_sri_totals += $sri;
            $ob_others_totals += $others;
    }


    // Calculate totals and differences
    $apbd_total = $ap_totals - $ob_totals;
    $apbd_salary = $ap_salary_totals - $ob_salary_totals;
    $apbd_cash_gift = $ap_cash_gift_totals - $ob_cash_gift_totals;
    $apbd_year_end = $ap_year_end_totals - $ob_year_end_totals;
    $apbd_mid_year = $ap_mid_year_totals - $ob_mid_year_totals;
    $apbd_sri = $ap_sri_totals - $ob_sri_totals;
    $apbd_others = $ap_others_totals - $ob_others_totals;

    // Update tb_rao with the totals
    $sql_rao_update = "UPDATE tb_rao 
    SET ap_total = ?, ap_salary = ?, ap_cash_gift = ?, 
        ap_year_end = ?, ap_mid_year = ?, ap_sri = ?, 
        ap_others = ?, 
        ob_total = ?, ob_salary = ?, ob_cash_gift = ?, 
        ob_year_end = ?, ob_mid_year = ?, ob_sri = ?, 
        ob_others = ?, 
        apbd_total = ?, apbd_salary = ?, apbd_cash_gift = ?, 
        apbd_year_end = ?, apbd_mid_year = ?, apbd_sri = ?, apbd_others = ? 
    WHERE rao_id = ?";

    $stmt_update = mysqli_prepare($con, $sql_rao_update);
        mysqli_stmt_bind_param($stmt_update, "dddddddddddddddddddddi", 
            $ap_totals, $ap_salary_totals, $ap_cash_gift_totals, 
            $ap_year_end_totals, $ap_mid_year_totals, $ap_sri_totals, 
            $ap_others_totals, 
            $ob_totals, $ob_salary_totals, $ob_cash_gift_totals, 
            $ob_year_end_totals, $ob_mid_year_totals, $ob_sri_totals, 
            $ob_others_totals, 
            $apbd_total, $apbd_salary, $apbd_cash_gift, 
            $apbd_year_end, $apbd_mid_year, $apbd_sri, $apbd_others,
            $rao_id
        );
        mysqli_stmt_execute($stmt_update);

        mysqli_commit($con);

        $response = array('status' => 'true'); // or 'false' if there was an error
} catch (Exception $e) {
    mysqli_rollback($con);
    $response['status'] = 'false';
    $response['error'] = $e->getMessage();
    error_log("Error in RAO processing: " . $e->getMessage());
} finally {
    // Close prepared statements
    if (isset($stmt)) mysqli_stmt_close($stmt);
    if (isset($stmt_ap)) mysqli_stmt_close($stmt_ap);
    if (isset($stmt_ob)) mysqli_stmt_close($stmt_ob);
    if (isset($stmt_update)) mysqli_stmt_close($stmt_update);
    
    // Close database connection
    mysqli_close($con);
}

echo json_encode($response);
?>