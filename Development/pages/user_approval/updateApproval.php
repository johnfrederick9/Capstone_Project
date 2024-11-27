<?php
include('../../connection.php');

// Get POST data
$requestPayload = file_get_contents("php://input");
$data = json_decode($requestPayload, true);

$user_id = intval($data['user_id'] ?? 0);
$status = intval($data['status'] ?? 0);
$reason = $data['reason'] ?? '';

$response = ['success' => false, 'message' => 'Invalid request'];

// Validate user ID
if ($user_id > 0) {
    if ($status === 1) {
        // Approve user
        $query = "UPDATE tb_user SET isApproved = 1 WHERE user_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'User approved successfully.'];
        } else {
            $response['message'] = 'Failed to approve the user.';
        }
    } elseif ($status === 0) {
        // Disapprove user
        $query = "UPDATE tb_user SET isApproved = 3, disapprovalReason = ? WHERE user_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("si", $reason, $user_id);
        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'User disapproved successfully.'];
        } else {
            $response['message'] = 'Failed to disapprove the user.';
        }
    }
}

echo json_encode($response);
?>
