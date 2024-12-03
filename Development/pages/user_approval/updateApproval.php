<?php
include('../../connection.php');

// Get POST data
$requestPayload = file_get_contents("php://input");
$data = json_decode($requestPayload, true);

$user_id = intval($data['user_id'] ?? 0);
$status = intval($data['status'] ?? 0);
$reason = $data['reason'] ?? '';

$response = ['success' => false, 'message' => 'Invalid request'];

if ($user_id > 0) {
    $isApproved = ($status === 1) ? 1 : 3; // Map to isApproved
    $query = "UPDATE tb_user SET isApproved = ?, disapprovalReason = ? WHERE user_id = ?";
    $stmt = $con->prepare($query);
    $reason_value = ($status === 3) ? $reason : null;
    $stmt->bind_param("isi", $isApproved, $reason_value, $user_id);

    if ($stmt->execute()) {
        $response = [
            'success' => true,
            'message' => $status === 1 ? 'User approved successfully.' : 'User disapproved successfully.',
        ];
    } else {
        $response['message'] = 'Failed to update user status.';
    }
}

echo json_encode($response);
?>
