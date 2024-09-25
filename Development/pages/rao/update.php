<?php 
include('../../connection.php');

$period_covered = mysqli_real_escape_string($con, $_POST["period_covered"] ?? '');
$rao_id = mysqli_real_escape_string($con, $_POST["rao_id"] ?? '');

//For Appropriations
$rao_ap_data_id = json_decode($_POST["rao_ap_data_id"]??'[]', true) ;
$rao_ob_data_id =  json_decode($_POST["rao_ob_data_id"] ??'[]', true) ;
$ap_counter = json_decode($_POST["ap_counterUpdate"] ?? '[]', true);
$ob_counter = json_decode($_POST["ob_counterUpdate"] ?? '[]', true);

// //For Appropriations
// $ap_date_data = is_array($_POST["ap_date_data"] ?? null) ? $_POST["ap_date_data"] : [];
// $ap_reference_data = is_array($_POST["ap_reference"] ?? null) ? $_POST["ap_reference"] : [];
// $ap_particulars_data = is_array($_POST["ap_particulars"] ?? null) ? $_POST["ap_particulars"] : [];
// $ap_salary_data = is_array($_POST["ap_salary"] ?? null) ? $_POST["ap_salary"] : [];
// $ap_cash_gift_data = is_array($_POST["ap_cash_gift"] ?? null) ? $_POST["ap_cash_gift"] : [];
// $ap_year_end_data = is_array($_POST["ap_year_end"] ?? null) ? $_POST["ap_year_end"] : [];
// $ap_mid_year_data = is_array($_POST["ap_mid_year"] ?? null) ? $_POST["ap_mid_year"] : [];
// $ap_sri_data = is_array($_POST["ap_sri"] ?? null) ? $_POST["ap_sri"] : [];
// $ap_others_data = is_array($_POST["ap_others"] ?? null) ? $_POST["ap_others"] : [];

// //For Obligations
// $ob_date_data = is_array($_POST["ob_date_data"] ?? null) ? $_POST["ob_date_data"] : [];
// $ob_reference_data = is_array($_POST["ob_reference"] ?? null) ? $_POST["ob_reference"] : [];
// $ob_particulars_data = is_array($_POST["ob_particulars"] ?? null) ? $_POST["ob_particulars"] : [];
// $ob_salary_data = is_array($_POST["ob_salary"] ?? null) ? $_POST["ob_salary"] : [];
// $ob_cash_gift_data = is_array($_POST["ob_cash_gift"] ?? null) ? $_POST["ob_cash_gift"] : [];
// $ob_year_end_data = is_array($_POST["ob_year_end"] ?? null) ? $_POST["ob_year_end"] : [];
// $ob_mid_year_data = is_array($_POST["ob_mid_year"] ?? null) ? $_POST["ob_mid_year"] : [];
// $ob_sri_data = is_array($_POST["ob_sri"] ?? null) ? $_POST["ob_sri"] : [];
// $ob_others_data = is_array($_POST["ob_others"] ?? null) ? $_POST["ob_others"] : [];

$rao_ap_data_id = json_decode($_POST["rao_ap_data_id"], true);
$rao_ob_data_id = json_decode($_POST["rao_ob_data_id"], true);
// Decode the JSON data from form submission
$ap_counter = json_decode($_POST['ap_counterUpdate'], true);
$ap_date_data = json_decode($_POST['ap_date_data'], true);
$ap_reference_data = json_decode($_POST['ap_reference'], true);
$ap_particulars_data = json_decode($_POST['ap_particulars'], true);
$ap_salary_data = json_decode($_POST['ap_salary'], true);
$ap_cash_gift_data = json_decode($_POST['ap_cash_gift'], true);
$ap_year_end_data = json_decode($_POST['ap_year_end'], true);
$ap_mid_year_data = json_decode($_POST['ap_mid_year'], true);
$ap_sri_data = json_decode($_POST['ap_sri'], true);
$ap_others_data = json_decode($_POST['ap_others'], true);

$ob_counter = json_decode($_POST['ob_counterUpdate'], true);
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

    
    $success_ap = true; // Initialize a success flag for appropriations

    // Prepare statements
    $sql_ap_insert = "INSERT INTO tb_rao_ap_data (`rao_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_total`, `ap_salary`, `ap_cash_gift`, `ap_year_end`, `ap_mid_year`, `ap_sri`, `ap_others`) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_ap_insert = mysqli_prepare($con, $sql_ap_insert);

    $sql_ap_update = "UPDATE tb_rao_ap_data SET `ap_ref_date` = ?, `ap_ref_no` = ?, `ap_particulars` = ?, `ap_total` = ?, `ap_salary` = ?, `ap_cash_gift` = ?, `ap_year_end` = ?, `ap_mid_year` = ?, `ap_sri` = ?, `ap_others` = ? 
                        WHERE `rao_ap_data_id` = ?";
    $stmt_ap_update = mysqli_prepare($con, $sql_ap_update);

    $sql_ap_delete = "DELETE FROM tb_rao_ap_data WHERE rao_ap_data_id = ?";
    $stmt_ap_delete = mysqli_prepare($con, $sql_ap_delete);

    $ap_counter =array_map('intval',$ap_counter);
    $existing_ap_ids = [];

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

        // Check if the record exists
        $sql_check = "SELECT COUNT(*) FROM tb_rao_ap_data WHERE rao_ap_data_id = ?";
        $stmt_check_ap = mysqli_prepare($con, $sql_check);
        mysqli_stmt_bind_param($stmt_check_ap, "i", $rao_ap_data_id[$index]);
        mysqli_stmt_execute($stmt_check_ap);
        mysqli_stmt_bind_result($stmt_check_ap, $record_count);
        mysqli_stmt_fetch($stmt_check_ap);
        mysqli_stmt_close($stmt_check_ap);

        if ($record_count > 0) {
            // Record exists, perform update
            mysqli_stmt_bind_param($stmt_ap_update, "sssdddddddi", $date, $reference, $particulars, $total, $salary, $cash_gift, $year_end, $mid_year, $sri, $others,$rao_ap_data_id[$index]);
            if (!mysqli_stmt_execute($stmt_ap_update)) {
                $success_ap = false;
                throw new Exception("Failed to update tb_rao_ap_data: " . mysqli_stmt_error($stmt_ap_update));
            }
            $existing_ap_ids[] = $rao_ap_data_id[$index];
        } else {
            // Record does not exist, perform insert
            mysqli_stmt_bind_param($stmt_ap_insert, "isssddddddd", $rao_id, $date, $reference, $particulars, $total, $salary, $cash_gift, $year_end, $mid_year, $sri, $others);
            if (!mysqli_stmt_execute($stmt_ap_insert)) {
                $success_ap = false;
                throw new Exception("Failed to insert into tb_rao_ap_data: " . mysqli_stmt_error($stmt_ap_insert));
            }
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

     // Delete records that were not included in the update
     if (!empty($existing_ap_ids)) {
        $placeholders = implode(',', array_fill(0, count($existing_ap_ids), '?'));
        $sql_delete_ap = "DELETE FROM tb_rao_ap_data WHERE rao_ap_data_id NOT IN ($placeholders)";
        $stmt_delete_ap = mysqli_prepare($con, $sql_delete_ap);
        mysqli_stmt_bind_param($stmt_delete_ap, str_repeat('i', count($existing_ap_ids)), ...$existing_ap_ids);
        if (!mysqli_stmt_execute($stmt_delete_ap)) {
            throw new Exception("Failed to delete from tb_rao_ap_data: " . mysqli_stmt_error($stmt_delete_ap));
        }
    }


    $success_ob = true; // Initialize a success flag for obligations

    // Prepare SQL statements
    $sql_ob_insert = "INSERT INTO tb_rao_ob_data (`rao_id`, `ob_ref_date`, `ob_ref_no`, `ob_particulars`, `ob_total`, `ob_salary`, `ob_cash_gift`, `ob_year_end`, `ob_mid_year`, `ob_sri`, `ob_others`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_ob_insert = mysqli_prepare($con, $sql_ob_insert);

    $sql_ob_update = "UPDATE tb_rao_ob_data SET `ob_ref_date` = ?, `ob_ref_no` = ?, `ob_particulars` = ?, `ob_total` = ?, `ob_salary` = ?, `ob_cash_gift` = ?, `ob_year_end` = ?, `ob_mid_year` = ?, `ob_sri` = ?, `ob_others` = ? 
                    WHERE `rao_ob_data_id` = ?";
    $stmt_ob_update = mysqli_prepare($con, $sql_ob_update);

    $sql_ob_delete = "DELETE FROM tb_rao_ob_data WHERE rao_ob_data_id = ?";
    $stmt_ob_delete = mysqli_prepare($con, $sql_ob_delete);

    // Convert ob_counter to integers
    $ob_counter = array_map('intval', $ob_counter);
    $existing_ob_ids = [];
foreach ($ob_counter as $index => $counter) {
    
    $date = mysqli_real_escape_string($con, $ob_date_data[$index]);
    $reference = mysqli_real_escape_string($con, $ob_reference_data[$index]);
    $particulars = mysqli_real_escape_string($con, $ob_particulars_data[$index]);
    $salary = !empty($ob_salary_data[$index]) ? floatval($ob_salary_data[$index]) : 0;
    $cash_gift = !empty($ob_cash_gift_data[$index]) ? floatval($ob_cash_gift_data[$index]) : 0;
    $year_end = !empty($ob_year_end_data[$index]) ? floatval($ob_year_end_data[$index]) : 0;
    $mid_year = !empty($ob_mid_year_data[$index]) ? floatval($ob_mid_year_data[$index]) : 0;
    $sri = !empty($ob_sri_data[$index]) ? floatval($ob_sri_data[$index]) : 0;
    $others = !empty($ob_others_data[$index]) ? floatval($ob_others_data[$index]) : 0;
    $total = $salary + $cash_gift + $year_end + $mid_year + $sri + $others;

    // Check if record exists
    $sql_check_ob = "SELECT COUNT(*) FROM tb_rao_ob_data WHERE rao_ob_data_id = ?";
    $stmt_check_ob = mysqli_prepare($con, $sql_check_ob);
    mysqli_stmt_bind_param($stmt_check_ob, "i", $rao_ob_data_id[$index]);
    mysqli_stmt_execute($stmt_check_ob);
    mysqli_stmt_bind_result($stmt_check_ob, $record_count_ob);
    mysqli_stmt_fetch($stmt_check_ob);
    mysqli_stmt_close($stmt_check_ob);

    

    if ($record_count_ob > 0) {
        // Update existing record
        mysqli_stmt_bind_param($stmt_ob_update, "sssdddddddi", $date, $reference, $particulars, $total, $salary, $cash_gift, $year_end, $mid_year, $sri, $others,$rao_ob_data_id[$index]);
        if (!mysqli_stmt_execute($stmt_ob_update)) {
            throw new Exception("Failed to update tb_rao_ob_data: " . mysqli_stmt_error($stmt_ob_update));
        }
        $existing_ob_ids[] = $rao_ob_data_id[$index];
    } else {
        // Insert new record
        mysqli_stmt_bind_param($stmt_ob_insert, "isssddddddd", $rao_id, $date, $reference, $particulars, $total, $salary, $cash_gift, $year_end, $mid_year, $sri, $others);
        if (!mysqli_stmt_execute($stmt_ob_insert)) {
            throw new Exception("Failed to insert into tb_rao_ob_data: " . mysqli_stmt_error($stmt_ob_insert));
        }
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
    // Delete records that were not included in the update for Obligations
    if (!empty($existing_ob_ids)) {
        $placeholders = implode(',', array_fill(0, count($existing_ob_ids), '?'));
        $sql_delete_ob = "DELETE FROM tb_rao_ob_data WHERE rao_ob_data_id NOT IN ($placeholders)";
        $stmt_delete_ob = mysqli_prepare($con, $sql_delete_ob);
        mysqli_stmt_bind_param($stmt_delete_ob, str_repeat('i', count($existing_ob_ids)), ...$existing_ob_ids);
        if (!mysqli_stmt_execute($stmt_delete_ob)) {
            throw new Exception("Failed to delete from tb_rao_ob_data: " . mysqli_stmt_error($stmt_delete_ob));
        }
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

        

        $response = array(
            'status' => 'true',
            'rao_id' => $rao_id,
            'ap_total' => $ap_totals,
            'ob_total' => $ob_totals,
            'apbd_total' => $apbd_total
        );
        mysqli_commit($con);
} catch (Exception $e) {
    mysqli_rollback($con);
    $response = array(
        'status' => 'false',
        'error' => $e->getMessage()
    );
    error_log("Error in RAO processing: " . $e->getMessage());
} finally {
    // Close prepared statements
    if (isset($stmt_ap_insert)) mysqli_stmt_close($stmt_ap_insert);
    if (isset($stmt_ap_update)) mysqli_stmt_close($stmt_ap_update);
    if (isset($stmt_ap_update)) mysqli_stmt_close($stmt_ap_delete);
    if (isset($stmt_ob_insert)) mysqli_stmt_close($stmt_ob_insert);
    if (isset($stmt_ob_update)) mysqli_stmt_close($stmt_ob_update);
    if (isset($stmt_ob_update)) mysqli_stmt_close($stmt_ob_delete);
    if (isset($stmt_update)) mysqli_stmt_close($stmt_update);
    
    // Close database connection
    mysqli_close($con);
}
echo json_encode($response);
?>