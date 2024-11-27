<?php
include('../../connection.php');

// Read JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['user_id'], $data['action'])) {
    $user_id = intval($data['user_id']);
    $action = $data['action'] === 'approve' ? 'Approved' : 'Disapproved';

    // Update the database
    $stmt = $con->prepare("UPDATE tb_user SET approval_status = ? WHERE user_id = ?");
    $stmt->bind_param("si", $action, $user_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false]);
}
?>
