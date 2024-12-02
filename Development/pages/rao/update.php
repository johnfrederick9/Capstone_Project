<?php
include('../../connection.php');

mysqli_begin_transaction($con);
try {
    // Main record update
    $rao_ps_id = $_POST['rao_ps_id'];
    $chairman = $_POST['chairman'];
    $brgy_captain = $_POST['brgy_captain'];
    $period_covered = $_POST['period_covered'];

    $update_rao_ps_query = "UPDATE tb_rao_ps 
                              SET chairman = ?, brgy_captain = ?, period_covered = ? 
                              WHERE rao_ps_id = ?";
    $stmt = mysqli_prepare($con, $update_rao_ps_query);
    mysqli_stmt_bind_param($stmt, 'sssi', $chairman, $brgy_captain, $period_covered, $rao_ps_id);
    mysqli_stmt_execute($stmt);

    ///////////////////////////////////// Process AP data
    if (isset($_POST['ap_data']) && is_array($_POST['ap_data'])) {
        foreach ($_POST['ap_data'] as $apRow) {
            $rao_ps_ap_id = !empty($apRow['rao_ps_ap_id']) ? intval($apRow['rao_ps_ap_id']) : 0;
            $date = $apRow['date'];
            $reference_no = $apRow['reference_no'];
            $particulars = $apRow['particulars'];
            $total = $apRow['total'];
            $salary = $apRow['salary'];
            $cash_gift = $apRow['cash_gift'];
            $year_end = $apRow['year_end'];
            $mid_year = $apRow['mid_year'];
            $sri = $apRow['sri'];
            $others = $apRow['others'];

            if ($rao_ps_ap_id > 0) {
                // Update existing AP record
                $query = "UPDATE tb_rao_ps_ap 
                        SET ap_ref_date = ?, ap_ref_no = ?, ap_particulars = ?, ap_total = ?,
                            ap_salary = ?, ap_cash_gift = ?, ap_year_end = ?, ap_mid_year = ?,
                            ap_sri = ?, ap_others = ?
                        WHERE rao_ps_ap_id = ? AND isDisplayed = 1";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 'sssdddddddi', $date, $reference_no, $particulars, $total, $salary, $cash_gift,
                                        $year_end, $mid_year, $sri, $others, $rao_ps_ap_id);
            } else {
                // Insert new AP record
                $query =  "INSERT INTO tb_rao_ps_ap (rao_ps_id, ap_ref_date, ap_ref_no,
                                        ap_particulars, ap_total, ap_salary, ap_cash_gift,
                                        ap_year_end, ap_mid_year, ap_sri, ap_others, isDisplayed) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 'isssddddddd', $rao_ps_id, $date, $reference_no, $particulars, $total, $salary, $cash_gift, $year_end, $mid_year, $sri, $others);
            }
            mysqli_stmt_execute($stmt);

        }
    }

    /////////////////////////////////////// Process OB data
    if (isset($_POST['ob_data']) && is_array($_POST['ob_data'])) {
        foreach ($_POST['ob_data'] as $obRow) {
            $rao_ps_ob_id = !empty($obRow['rao_ps_ob_id']) ? intval($obRow['rao_ps_ob_id']) : 0;
            $date = $obRow['date'];
            $reference_no = $obRow['reference_no'];
            $particulars = $obRow['particulars'];
            $total = $obRow['total'];
            $salary = $obRow['salary'];
            $cash_gift = $obRow['cash_gift'];
            $year_end = $obRow['year_end'];
            $mid_year = $obRow['mid_year'];
            $sri = $obRow['sri'];
            $others = $obRow['others'];

            if ($rao_ps_ob_id > 0) {
                // Update existing ob record
                $query = "UPDATE tb_rao_ps_ob 
                        SET ob_ref_date = ?, ob_ref_no = ?, ob_particulars = ?, ob_total = ?,
                            ob_salary = ?, ob_cash_gift = ?, ob_year_end = ?, ob_mid_year = ?,
                            ob_sri = ?, ob_others = ?
                        WHERE rao_ps_ob_id = ? AND isDisplayed = 1";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 'sssdddddddi', $date, $reference_no, $particulars, $total, $salary, $cash_gift,
                                        $year_end, $mid_year, $sri, $others, $rao_ps_ob_id);
            } else {
                // Insert new ob record
                $query =  "INSERT INTO tb_rao_ps_ob (rao_ps_id, ob_ref_date, ob_ref_no,
                                        ob_particulars, ob_total, ob_salary, ob_cash_gift,
                                        ob_year_end, ob_mid_year, ob_sri, ob_others, isDisplayed) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 'isssddddddd', $rao_ps_id, $date, $reference_no, $particulars, $total, $salary, $cash_gift, $year_end, $mid_year, $sri, $others);
            }
            mysqli_stmt_execute($stmt);

        }
    }

    // Process AP totals
    if (isset($_POST['ap_totals']) && is_array($_POST['ap_totals'])) {
        foreach ($_POST['ap_totals'] as $apRow) {
            $category = $apRow['category'];
            $total = $apRow['total'];
            $salary = $apRow['salary'];
            $cash_gift = $apRow['cash_gift'];
            $year_end = $apRow['year_end'];
            $mid_year = $apRow['mid_year'];
            $sri = $apRow['sri'];
            $others = $apRow['others'];

            // Insert AP totals into the database
            $sql_totals = "UPDATE tb_rao_ps_totals SET total = ?, salary = ?, cash_gift = ?,
                                year_end = ?, mid_year = ?, sri = ?, others = ? WHERE total_type = ? AND isDisplayed = 1";
            $stmt_totals = mysqli_prepare($con, $sql_totals);
            mysqli_stmt_bind_param($stmt_totals, 'ddddddds', $total, $salary, $cash_gift, $year_end, $mid_year, $sri, $others, $category);
            if (!mysqli_stmt_execute($stmt_totals)) {
                throw new Exception("Error inserting AP totals data: " . mysqli_error($con));
            }
        }
    }

       // Process OB totals
       if (isset($_POST['ob_totals']) && is_array($_POST['ob_totals'])) {
        foreach ($_POST['ob_totals'] as $obRow) {
            $category = $obRow['category'];
            $total = $obRow['total'];
            $salary = $obRow['salary'];
            $cash_gift = $obRow['cash_gift'];
            $year_end = $obRow['year_end'];
            $mid_year = $obRow['mid_year'];
            $sri = $obRow['sri'];
            $others = $obRow['others'];

            // Insert ob totals into the database
            $sql_totals = "UPDATE tb_rao_ps_totals SET total = ?, salary = ?, cash_gift = ?,
                                year_end = ?, mid_year = ?, sri = ?, others = ? WHERE total_type = ? AND isDisplayed = 1";
            $stmt_totals = mysqli_prepare($con, $sql_totals);
            mysqli_stmt_bind_param($stmt_totals, 'ddddddds', $total, $salary, $cash_gift, $year_end, $mid_year, $sri, $others, $category);
            if (!mysqli_stmt_execute($stmt_totals)) {
                throw new Exception("Error inserting ob totals data: " . mysqli_error($con));
            }
        }
    }


    mysqli_commit($con);
    $response = ['status' => 'true', 'message' => 'Data successfully updated'];

} catch (Exception $e) {
    mysqli_rollback($con);
    $response = ['status' => 'false', 'error' => $e->getMessage()];
    error_log("Error updating data: " . $e->getMessage());
}

mysqli_close($con);
echo json_encode($response);
?>
