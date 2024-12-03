<?php
include('../../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $approval_status = mysqli_real_escape_string($con, $_POST['approval_status']);

    // Map approval status to isApproved
    $isApproved = ($approval_status === 'Approved') ? 1 : 3;

    $sql = "UPDATE tb_user SET isApproved = $isApproved WHERE user_id = $user_id";
    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => true, 'message' => 'User status updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update user status.']);
    }
}
?>
