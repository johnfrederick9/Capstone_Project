<?php 
include('../../connection.php');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$cashbook_id = isset($_POST['cashbook_id']) ? $con->real_escape_string($_POST['cashbook_id']) : '';

// Validate cashbook_id
if (empty($cashbook_id)) {
    echo json_encode(array('error' => 'Invalid cashbook_id'));
    exit();
}

// Fetch the cashbook record
$sql_details = "SELECT * FROM tb_cashbook WHERE cashbook_id = ?";
$stmt_details = mysqli_prepare($con, $sql_details);
mysqli_stmt_bind_param($stmt_details,"i", $cashbook_id);
mysqli_stmt_execute($stmt_details);
$record_result = mysqli_stmt_get_result($stmt_details)->fetch_assoc();

$cashbook_data = [];

// Fetch the associated records from tb_cashbook_data
$sql_assoc = "SELECT * FROM tb_cashbook_data WHERE cashbook_id = ?";
$stmt_assoc = mysqli_prepare($con, $sql_assoc);
mysqli_stmt_bind_param($stmt_assoc, "i", $cashbook_id);
mysqli_stmt_execute($stmt_assoc);
$cashbook_result= mysqli_stmt_get_result($stmt_assoc);

// Populate $cashbook_data array
while ($row = $cashbook_result->fetch_assoc()) {
    $cashbook_data[] = $row; 
}

// Close the prepared statements
mysqli_stmt_close($stmt_details);
mysqli_stmt_close($stmt_assoc);
mysqli_close($con);

// Prepare response data
$response = [
    'status' => 'true',
    'record' => $record_result,
    'cashbook_data' => $cashbook_data,
];

// Return response as JSON
echo json_encode($response);
?>
