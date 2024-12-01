<?php
include '../../database.php';
header("Content-Type: application/json");


if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Get the raw POST data and decode it
$rawData = file_get_contents('php://input');
$input = json_decode($rawData, true);

// Check if the verification code is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$input || !isset($input['code'])) {
        echo json_encode(['success' => false, 'message' => 'Verification code not provided']);
        exit;
    }

    $verificationCode = $input['code'];

    // Validate code format
    if (!preg_match('/^\d{6}$/', $verificationCode)) {
        echo json_encode(['success' => false, 'message' => 'Invalid verification code format']);
        exit;
    }

    $userId = (int)$_SESSION['user_id'];

    // Save to database
    $query = "UPDATE tb_user SET verification_code = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("si", $verificationCode, $userId);
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Verification code saved successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save verification code']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
    }
} else {
    // Handle verification code check (GET request)
    $userId = (int)$_SESSION['user_id'];

    $query = "SELECT verification_code FROM tb_user WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($verificationCode);
        $stmt->fetch();

        echo json_encode(['success' => true, 'verification_code' => $verificationCode]);
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
    }
}

$conn->close();
?>
