<?php 
include('../../connection.php');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$transaction_id = isset($_POST['transaction_id']) ? $con->real_escape_string($_POST['transaction_id']) : '';

// Validate transaction_id
if (empty($transaction_id)) {
    echo json_encode(array('error' => 'Invalid transaction_id'));
    exit();
}

// Fetch the transaction details
$sql_details = "SELECT * FROM tb_item_transaction WHERE transaction_id = ?";
$stmt_details = mysqli_prepare($con, $sql_details);
mysqli_stmt_bind_param($stmt_details, "i", $transaction_id);
mysqli_stmt_execute($stmt_details);
$transaction_result = mysqli_stmt_get_result($stmt_details)->fetch_assoc();

// Fetch the associated items
$sql_assoc = "SELECT * FROM tb_transaction_items WHERE transaction_id = ?";
$stmt_assoc = mysqli_prepare($con, $sql_assoc);
mysqli_stmt_bind_param($stmt_assoc, "i", $transaction_id);
mysqli_stmt_execute($stmt_assoc);
$items_result = mysqli_stmt_get_result($stmt_assoc);

// Prepare arrays for previous quantities
$previous_borrow_quantities = [];
$previous_return_quantities = [];

// Query for borrowed quantities
$sql_bqty = "SELECT item_id, borrow_quantity, return_quantity FROM tb_transaction_items WHERE transaction_id = ?";
$stmt_bqty = mysqli_prepare($con, $sql_bqty);
mysqli_stmt_bind_param($stmt_bqty, "i", $transaction_id);
mysqli_stmt_execute($stmt_bqty);
$previous_items_result = mysqli_stmt_get_result($stmt_bqty);

// Store quantities in arrays
while ($row = $previous_items_result->fetch_assoc()) {
    $previous_borrow_quantities[$row['item_id']] = $row['borrow_quantity'];
    $previous_return_quantities[$row['item_id']] = $row['return_quantity'];
}

// Close the prepared statements
mysqli_stmt_close($stmt_details);
mysqli_stmt_close($stmt_assoc);
mysqli_stmt_close($stmt_bqty);
mysqli_close($con);

// Prepare response data
$response = [
    'status' => 'true',
    'transaction' => $transaction_result,
    'items' => $items_result->fetch_all(MYSQLI_ASSOC),
    'previous_borrow_quantities' => $previous_borrow_quantities,
    'previous_return_quantities' => $previous_return_quantities,
];

// Return response as JSON
echo json_encode($response);
?>
