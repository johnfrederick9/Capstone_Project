<?php 
include('../../connection.php');

$transaction_id = $_POST["transaction_id"];

// Validate transaction_id
if (empty($transaction_id)) {
    echo json_encode(array('status' => 'failed', 'message' => 'Invalid transaction_id'));
    exit();
}

// Prepare the SELECT statement to fetch borrow and return quantities
$sql_bqty = "SELECT item_id, borrow_quantity FROM tb_transaction_items WHERE transaction_id = ?";
$stmt_bqty = mysqli_prepare($con, $sql_bqty);
mysqli_stmt_bind_param($stmt_bqty, "i", $transaction_id);
mysqli_stmt_execute($stmt_bqty);
$result = mysqli_stmt_get_result($stmt_bqty);

// Check if there are any items to update
if (mysqli_num_rows($result) > 0) {

    // Prepare the UPDATE statement to set return_quantity = borrow_quantity and item_status = 'Returned'
    $sql_update = "UPDATE tb_transaction_items SET return_quantity = borrow_quantity, item_status = 'Returned' WHERE transaction_id = ? AND item_id = ?";
    $stmt_update = mysqli_prepare($con, $sql_update);

    // Prepare the SELECT and UPDATE for tb_inventory
    $sql_inventory_select = "SELECT available_count FROM tb_inventory WHERE item_id = ?";
    $stmt_inventory_select = mysqli_prepare($con, $sql_inventory_select);

    $sql_inventory_update = "UPDATE tb_inventory SET available_count = available_count + ? WHERE item_id = ?";
    $stmt_inventory_update = mysqli_prepare($con, $sql_inventory_update);

    // Loop through the items and update each one
    while ($row = mysqli_fetch_assoc($result)) {
        $item_id = $row['item_id'];
        $borrow_quantity = $row['borrow_quantity']; // Assuming borrow_quantity == return_quantity

        // Bind the transaction_id and item_id for the UPDATE statement
        mysqli_stmt_bind_param($stmt_update, "ii", $transaction_id, $item_id);
        mysqli_stmt_execute($stmt_update);

        // Fetch the current lendable_count from tb_inventory
        mysqli_stmt_bind_param($stmt_inventory_select, "i", $item_id);
        mysqli_stmt_execute($stmt_inventory_select);
        $inventory_result = mysqli_stmt_get_result($stmt_inventory_select);
        $inventory_row = mysqli_fetch_assoc($inventory_result);

        // Add the returned quantity (borrow_quantity) to the lendable_count and update tb_inventory
        mysqli_stmt_bind_param($stmt_inventory_update, "ii", $borrow_quantity, $item_id);
        mysqli_stmt_execute($stmt_inventory_update);
    }

    // Update the tb_item_transaction to set isDisplayed = 0
    $sql = "UPDATE tb_item_transaction SET isDisplayed = 0 WHERE transaction_id = '$transaction_id'";
    $delQuery = mysqli_query($con, $sql);

    // Check if the update query was successful
    if ($delQuery == true) {
        $data = array(
            'status' => 'success',
            'message' => 'All items returned, status updated, inventory updated, and transaction hidden successfully.'
        );
    } else {
        $data = array(
            'status' => 'failed',
            'message' => 'Failed to hide the transaction.'
        );
    }
    
} else {
    $data = array(
        'status' => 'failed',
        'message' => 'No items found for this transaction.'
    );
}

// Return the JSON response
echo json_encode($data);

// Close the statements and the connection
mysqli_stmt_close($stmt_bqty);
mysqli_stmt_close($stmt_update);
mysqli_stmt_close($stmt_inventory_select);
mysqli_stmt_close($stmt_inventory_update);
mysqli_close($con);

?>
