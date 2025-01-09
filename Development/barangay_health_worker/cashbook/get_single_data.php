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

$period_covered = $record_result['period_covered'] ?? null;
// Calculate previous month
$previous_month = date('Y-m', strtotime('first day of previous month', strtotime($period_covered)));

// Fetch balances from tb_cashbook_monthly for the previous month
$sql_prev_balances = "SELECT cb_end_balance, clt_end_balance FROM tb_cashbook_monthly WHERE DATE_FORMAT(date_data, '%Y-%m') = ? LIMIT 1";
$stmt_prev_balances = mysqli_prepare($con, $sql_prev_balances);
mysqli_stmt_bind_param($stmt_prev_balances, "s", $previous_month);
mysqli_stmt_execute($stmt_prev_balances);
mysqli_stmt_bind_result($stmt_prev_balances, $cb_end_balance, $clt_end_balance);
mysqli_stmt_fetch($stmt_prev_balances);

// Close the prepared statement
mysqli_stmt_close($stmt_prev_balances);


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
    'cb_end_balance' => $cb_end_balance ?? '0.00',
    'clt_end_balance' => $clt_end_balance ?? '0.00',
];

// Return response as JSON
echo json_encode($response);
?>
