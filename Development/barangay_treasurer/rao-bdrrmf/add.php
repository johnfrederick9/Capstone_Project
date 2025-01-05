<?php 
include('../../connection.php');

mysqli_begin_transaction($con);
try {
    $period_covered = $_POST['period_covered'];
    $chairman = $_POST['chairman'];
    $brgy_captain = $_POST['brgy_captain'];

    // First, insert into tb_rao_bd to get the rao_id
    $sql_rao_bd = "INSERT INTO tb_rao_bd (`chairman`, `period_covered`, `brgy_captain`, `isDisplayed`) 
                VALUES (?, ?, ?, 1)";
    $stmt = mysqli_prepare($con, $sql_rao_bd);
    mysqli_stmt_bind_param($stmt, "sss", $chairman, $period_covered, $brgy_captain);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Failed to insert into tb_rao_bd: " . mysqli_stmt_error($stmt));
    }

    // Get the newly inserted rao_bd_id
    $rao_bd_id = mysqli_insert_id($con);

    // Process AP data
    if (isset($_POST['ap_data']) && is_array($_POST['ap_data'])) {
        foreach ($_POST['ap_data'] as $apRow) {
            $date = $apRow['date'];
            $reference_no = $apRow['reference_no'];
            $particulars = $apRow['particulars'];
            $total = $apRow['total'];
            $pre_disaster = $apRow['pre_disaster'];
            $quick_response = $apRow['quick_response'];

            // Insert AP data into the database
            $sql_ap = "INSERT INTO tb_rao_bd_ap (rao_bd_id, ap_ref_date, ap_ref_no,
                                ap_particulars, ap_total, ap_pre_disaster, ap_quick_response, isDisplayed) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
            $stmt_ap = mysqli_prepare($con, $sql_ap);
            mysqli_stmt_bind_param($stmt_ap, 'isssddd', $rao_bd_id, $date, $reference_no, $particulars, $total, $pre_disaster, $quick_response);
            if (!mysqli_stmt_execute($stmt_ap)) {
                throw new Exception("Error inserting AP data: " . mysqli_error($con));
            }
        }
    }

    // Process OB data
    if (isset($_POST['ob_data']) && is_array($_POST['ob_data'])) {
        foreach ($_POST['ob_data'] as $apRow) {
            $date = $apRow['date'];
            $reference_no = $apRow['reference_no'];
            $particulars = $apRow['particulars'];
            $total = $apRow['total'];
            $pre_disaster = $apRow['pre_disaster'];
            $quick_response = $apRow['quick_response'];

            // Insert OB data into the database
            $sql_ob = "INSERT INTO tb_rao_bd_ob (rao_bd_id, ob_ref_date, ob_ref_no,
                                ob_particulars, ob_total, ob_pre_disaster, ob_quick_response, isDisplayed) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
            $stmt_ob = mysqli_prepare($con, $sql_ob);
            mysqli_stmt_bind_param($stmt_ob, 'isssddd', $rao_bd_id, $date, $reference_no, $particulars, $total, $pre_disaster, $quick_response);
            if (!mysqli_stmt_execute($stmt_ob)) {
                throw new Exception("Error inserting OB data: " . mysqli_error($con));
            }
        }
    }

    // Process AP totals
    if (isset($_POST['ap_totals']) && is_array($_POST['ap_totals'])) {
        foreach ($_POST['ap_totals'] as $apRow) {
            $category = $apRow['category'];
            $total = $apRow['total'];
            $pre_disaster = $apRow['pre_disaster'];
            $quick_response = $apRow['quick_response'];

            // Insert AP totals into the database
            $sql_totals = "INSERT INTO tb_rao_bd_totals (rao_bd_id, total_type, total, pre_disaster, quick_response, isDisplayed) 
                    VALUES (?, ?, ?, ?, ?, 1)";
            $stmt_totals = mysqli_prepare($con, $sql_totals);
            mysqli_stmt_bind_param($stmt_totals, 'isddd', $rao_bd_id, $category, $total, $pre_disaster, $quick_response);
            if (!mysqli_stmt_execute($stmt_totals)) {
                throw new Exception("Error inserting AP totals data: " . mysqli_error($con));
            }
        }
    }

    // Process OB totals
    if (isset($_POST['ob_totals']) && is_array($_POST['ob_totals'])) {
        foreach ($_POST['ob_totals'] as $apRow) {
            $category = $apRow['category'];
            $total = $apRow['total'];
            $pre_disaster = $apRow['pre_disaster'];
            $quick_response = $apRow['quick_response'];

            // Insert OB totals into the database
            $sql_totals = "INSERT INTO tb_rao_bd_totals (rao_bd_id, total_type, total, pre_disaster, quick_response, isDisplayed) 
                    VALUES (?, ?, ?, ?, ?, 1)";
            $stmt_totals = mysqli_prepare($con, $sql_totals);
            mysqli_stmt_bind_param($stmt_totals, 'isddd', $rao_bd_id, $category, $total, $pre_disaster, $quick_response);
            if (!mysqli_stmt_execute($stmt_totals)) {
                throw new Exception("Error inserting OB totals data: " . mysqli_error($con));
            }
        }
    }

    mysqli_commit($con);
    $response = array('status' => 'true');
} catch (Exception $e) {
    mysqli_rollback($con);
    $response['status'] = 'false';
    $response['error'] = $e->getMessage();
    error_log("Error in RAO processing: " . $e->getMessage());
} finally {
    if (isset($stmt)) mysqli_stmt_close($stmt);
    if (isset($stmt_ap)) mysqli_stmt_close($stmt_ap);
    if (isset($stmt_ob)) mysqli_stmt_close($stmt_ob);
    if (isset($stmt_totals)) mysqli_stmt_close($stmt_totals);
    
    mysqli_close($con);
}

echo json_encode($response);
?>
