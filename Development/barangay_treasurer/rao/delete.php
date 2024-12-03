<?php
include('../../connection.php');

try {
    // Retrieve and validate rao_ps_id
    $rao_ps_id = isset($_POST['rao_ps_id']) ? mysqli_real_escape_string($con, $_POST['rao_ps_id']) : '';

    if (empty($rao_ps_id) || !is_numeric($rao_ps_id)) {
        echo json_encode(['status' => 'failed', 'message' => 'Invalid or missing rao_ps_id']);
        exit();
    }

    // Update tb_rao_ps
    $sql_rao = "UPDATE tb_rao_ps SET isDisplayed = 0 WHERE rao_ps_id = ?";
    $stmt_rao = mysqli_prepare($con, $sql_rao);

    if (!$stmt_rao) {
        echo json_encode(['status' => 'failed', 'message' => 'Failed to prepare Rao update: ' . mysqli_error($con)]);
        exit();
    }

    mysqli_stmt_bind_param($stmt_rao, "i", $rao_ps_id);
    if (!mysqli_stmt_execute($stmt_rao)) {
        echo json_encode(['status' => 'failed', 'message' => 'Error updating Rao record: ' . mysqli_stmt_error($stmt_rao)]);
        mysqli_stmt_close($stmt_rao);
        exit();
    }
    mysqli_stmt_close($stmt_rao);

    // Update tb_rao_ps_ap
    $sql_ap = "UPDATE tb_rao_ps_ap SET isDisplayed = 0 WHERE rao_ps_id = ?";
    $stmt_ap = mysqli_prepare($con, $sql_ap);

    if (!$stmt_ap) {
        echo json_encode(['status' => 'failed', 'message' => 'Failed to prepare AP update: ' . mysqli_error($con)]);
        exit();
    }

    mysqli_stmt_bind_param($stmt_ap, "i", $rao_ps_id);
    if (!mysqli_stmt_execute($stmt_ap)) {
        echo json_encode(['status' => 'failed', 'message' => 'Error updating AP data: ' . mysqli_stmt_error($stmt_ap)]);
        mysqli_stmt_close($stmt_ap);
        exit();
    }
    mysqli_stmt_close($stmt_ap);

    // Update tb_rao_ps_ob
    $sql_ob = "UPDATE tb_rao_ps_ob SET isDisplayed = 0 WHERE rao_ps_id = ?";
    $stmt_ob = mysqli_prepare($con, $sql_ob);

    if (!$stmt_ob) {
        echo json_encode(['status' => 'failed', 'message' => 'Failed to prepare OB update: ' . mysqli_error($con)]);
        exit();
    }

    mysqli_stmt_bind_param($stmt_ob, "i", $rao_ps_id);
    if (!mysqli_stmt_execute($stmt_ob)) {
        echo json_encode(['status' => 'failed', 'message' => 'Error updating OB data: ' . mysqli_stmt_error($stmt_ob)]);
        mysqli_stmt_close($stmt_ob);
        exit();
    }
    mysqli_stmt_close($stmt_ob);

    // Update tb_rao_ps_totals
    $sql_totals = "UPDATE tb_rao_ps_totals SET isDisplayed = 0 WHERE rao_ps_id = ?";
    $stmt_totals = mysqli_prepare($con, $sql_totals);

    if (!$stmt_totals) {
        echo json_encode(['status' => 'failed', 'message' => 'Failed to prepare Totals update: ' . mysqli_error($con)]);
        exit();
    }

    mysqli_stmt_bind_param($stmt_totals, "i", $rao_ps_id);
    if (!mysqli_stmt_execute($stmt_totals)) {
        echo json_encode(['status' => 'failed', 'message' => 'Error updating Totals: ' . mysqli_stmt_error($stmt_totals)]);
        mysqli_stmt_close($stmt_totals);
        exit();
    }
    mysqli_stmt_close($stmt_totals);

    // Return success response
    echo json_encode(['status' => 'success', 'message' => 'Rao record and related data updated successfully']);
} catch (Exception $e) {
    echo json_encode(['status' => 'failed', 'message' => $e->getMessage()]);
} finally {
    // Close the database connection
    mysqli_close($con);
}
?>
