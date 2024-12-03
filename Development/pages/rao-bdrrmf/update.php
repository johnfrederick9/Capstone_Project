<?php
include('../../connection.php');

mysqli_begin_transaction($con);
try {
    // Main record update
    $rao_bd_id = $_POST['rao_bd_id'];
    $chairman = $_POST['chairman'];
    $brgy_captain = $_POST['brgy_captain'];
    $period_covered = $_POST['period_covered'];

    $update_rao_bd_query = "UPDATE tb_rao_bd 
                              SET chairman = ?, brgy_captain = ?, period_covered = ? 
                              WHERE rao_bd_id = ?";
    $stmt = mysqli_prepare($con, $update_rao_bd_query);
    mysqli_stmt_bind_param($stmt, 'sssi', $chairman, $brgy_captain, $period_covered, $rao_bd_id);
    mysqli_stmt_execute($stmt);

    ///////////////////////////////////// Process AP data
    if (isset($_POST['ap_data']) && is_array($_POST['ap_data'])) {
        foreach ($_POST['ap_data'] as $apRow) {
            $rao_bd_ap_id = !empty($apRow['rao_bd_ap_id']) ? intval($apRow['rao_bd_ap_id']) : 0;
            $date = $apRow['date'];
            $reference_no = $apRow['reference_no'];
            $particulars = $apRow['particulars'];
            $total = $apRow['total'];
            $pre_disaster = $apRow['pre_disaster'];
            $quick_response = $apRow['quick_response'];
            

            if ($rao_bd_ap_id > 0) {
                // Update existing AP record
                $query = "UPDATE tb_rao_bd_ap 
                        SET ap_ref_date = ?, ap_ref_no = ?, ap_particulars = ?, ap_total = ?,
                            ap_pre_disaster = ?, ap_quick_response = ?
                        WHERE rao_bd_ap_id = ? AND isDisplayed = 1";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 'sssdddi', $date, $reference_no, $particulars, $total, $pre_disaster, $quick_response, $rao_bd_ap_id);
            } else {
                // Insert new AP record
                $query =  "INSERT INTO tb_rao_bd_ap (rao_bd_id, ap_ref_date, ap_ref_no,
                                        ap_particulars, ap_total, ap_pre_disaster, ap_quick_response, isDisplayed) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 'isssddd', $rao_bd_id, $date, $reference_no, $particulars, $total, $pre_disaster, $quick_response);
            }
            mysqli_stmt_execute($stmt);

        }
    }

    /////////////////////////////////////// Process OB data
    if (isset($_POST['ob_data']) && is_array($_POST['ob_data'])) {
        foreach ($_POST['ob_data'] as $obRow) {
            $rao_bd_ob_id = !empty($obRow['rao_bd_ob_id']) ? intval($obRow['rao_bd_ob_id']) : 0;
            $date = $obRow['date'];
            $reference_no = $obRow['reference_no'];
            $particulars = $obRow['particulars'];
            $total = $obRow['total'];
            $pre_disaster = $obRow['pre_disaster'];
            $quick_response = $obRow['quick_response'];

            if ($rao_bd_ob_id > 0) {
                // Update existing ob record
                $query = "UPDATE tb_rao_bd_ob 
                        SET ob_ref_date = ?, ob_ref_no = ?, ob_particulars = ?, ob_total = ?,
                            ob_pre_disaster = ?, ob_quick_response = ?
                        WHERE rao_bd_ob_id = ? AND isDisplayed = 1";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 'sssdddi', $date, $reference_no, $particulars, $total, $pre_disaster, $quick_response, $rao_bd_ob_id);
            } else {
                // Insert new ob record
                $query =  "INSERT INTO tb_rao_bd_ob (rao_bd_id, ob_ref_date, ob_ref_no,
                                        ob_particulars, ob_total, ob_pre_disaster, ob_quick_response, isDisplayed) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 'isssddd', $rao_bd_id, $date, $reference_no, $particulars, $total, $pre_disaster, $quick_response);
            }
            mysqli_stmt_execute($stmt);

        }
    }

    // Process AP totals
    if (isset($_POST['ap_totals']) && is_array($_POST['ap_totals'])) {
        foreach ($_POST['ap_totals'] as $apRow) {
            $category = $apRow['category'];
            $total = $apRow['total'];
            $pre_disaster = $apRow['pre_disaster'];
            $quick_response = $apRow['quick_response'];

            $sql_totals = "UPDATE tb_rao_bd_totals SET total = ?, pre_disaster = ?, quick_response = ?
                            WHERE total_type = ? AND isDisplayed = 1";
            $stmt_totals = mysqli_prepare($con, $sql_totals);
            mysqli_stmt_bind_param($stmt_totals, 'ddds', $total,  $pre_disaster, $quick_response, $category);
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
            $pre_disaster = $obRow['pre_disaster'];
            $quick_response = $obRow['quick_response'];

            $sql_totals = "UPDATE tb_rao_bd_totals SET total = ?, pre_disaster = ?, quick_response = ?
                            WHERE total_type = ? AND isDisplayed = 1";
            $stmt_totals = mysqli_prepare($con, $sql_totals);
            mysqli_stmt_bind_param($stmt_totals, 'ddds', $total, $pre_disaster, $quick_response, $category);
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
