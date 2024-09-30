<?php
include('../../connection.php');

// Retrieve and validate cashbook_id
$cashbook_id = mysqli_real_escape_string($con, $_POST["cashbook_id"] ?? '');

if (empty($cashbook_id)) {
    echo json_encode(array('status' => 'failed', 'message' => 'Invalid cashbook_id'));
    exit();
}

// Prepare the SQL statement to update the tb_cashbook table
$sql = "UPDATE tb_cashbook SET isDisplayed = 0 WHERE cashbook_id = ?";
$stmt = $con->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    echo json_encode(array('status' => 'failed', 'message' => 'Failed to prepare the SQL statement'));
    mysqli_close($con);
    exit();
}

// Bind the cashbook_id parameter to the prepared statement
$stmt->bind_param("i", $cashbook_id);

// Execute the query and check if it was successful
if ($stmt->execute()) {
    $data = array(
        'status' => 'success',
        'message' => 'Cashbook record is deleted successfully'
    );
} else {
    $data = array(
        'status' => 'failed',
        'message' => 'Failed to delete the cashbook record: ' . $stmt->error
    );
}

// Close the statement and connection
$stmt->close();
mysqli_close($con);

// Return the JSON response
echo json_encode($data);
?>
