<?php 
include('../../connection.php');


// Capture POST data
$borrower_name = $_POST["borrower_name"] ?? '';
$borrower_address = $_POST["borrower_address"] ?? '';
$reserved_on = $_POST["reserved_on"] ?? '';
$date_borrowed = $_POST["date_borrowed"] ?? '';
$return_date = $_POST["return_date"] ?? '';
$approved_by = $_POST["approved_by"] ?? '';
$released_by = $_POST["released_by"] ?? '';
$transaction_status = 'Ongoing';
$isDisplayed = '1';

$item_name = is_array($_POST["items"] ?? null) ? $_POST["items"] : [];
$borrow_quantity = is_array($_POST["borrow_quantity"] ?? null) ? $_POST["borrow_quantity"] : [];

$item_name  = json_decode($_POST['items'], true);
$borrow_quantity = json_decode($_POST['borrow_quantity'], true);

mysqli_begin_transaction($con);
try {

    // Validate input fields
    if (empty($borrower_name) || empty($borrower_address) || empty($reserved_on) || empty($date_borrowed) || empty($return_date) || empty($approved_by) || empty($released_by) || empty($item_name)|| empty($borrow_quantity)) {
        throw new Exception("All fields are required.");
    }
    
    $sql_trans = "INSERT INTO tb_item_transaction (borrower_name, borrower_address, reserved_on, date_borrowed, return_date, approved_by, released_by, transaction_status,isDisplayed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_trans = mysqli_prepare($con, $sql_trans);
    mysqli_stmt_bind_param($stmt_trans, "ssssssssi",  $borrower_name, $borrower_address, $reserved_on, $date_borrowed, $return_date , $approved_by, $released_by, $transaction_status, $isDisplayed);
    if (!mysqli_stmt_execute($stmt_trans)) {
        throw new Exception("Failed to insert into tb_item_transaction: " . mysqli_stmt_error($stmt_trans));
    }

    $transaction_id = mysqli_insert_id($con);

    $sql_items = "INSERT INTO tb_transaction_items (transaction_id, item_id, item_name, borrow_quantity, item_status) VALUES (?, ?, ?, ?, 'Borrowed')";
    $stmt_items = mysqli_prepare($con, $sql_items);
    
    $sql_inventory = "UPDATE tb_inventory SET available_count = available_count - ? WHERE item_id = ?";
    $stmt_inventory = mysqli_prepare($con, $sql_inventory);

    foreach ($item_name as $index => $item_id) {
        $quantity = $borrow_quantity[$index];

        // Query to get item_name based on item_id
        $sql_name= "SELECT item_name FROM tb_inventory WHERE item_id = ? LIMIT 1";
        $stmt_name = mysqli_prepare($con, $sql_name);
        mysqli_stmt_bind_param($stmt_name,"i", $item_id);
        mysqli_stmt_execute($stmt_name);
        mysqli_stmt_bind_result($stmt_name, $name);
        mysqli_stmt_fetch($stmt_name);
        mysqli_stmt_close($stmt_name);

        mysqli_stmt_bind_param($stmt_items,"iisi", $transaction_id, $item_id, $name, $quantity);
        if (!mysqli_stmt_execute($stmt_items)) {
            throw new Exception("Failed to insert into transaction Items: " . mysqli_stmt_error($stmt_items));
        }

        mysqli_stmt_bind_param($stmt_inventory,"ii", $quantity, $item_id);
        if (!mysqli_stmt_execute($stmt_inventory)) {
            throw new Exception("Failed to insert into transaction Items: " . mysqli_stmt_error($stmt_inventory));
        }

    }


    // Send success response
    $response = array(
        'status' => 'true',
        'item_id' => $item_id,
        'item_name' => $name,
        'transaction_status' => $transaction_status,
    );
    mysqli_commit($con);

} catch (Exception $e) {
    // Rollback transaction in case of failure
    mysqli_rollback($con);
    $response = array(
        'status' => 'false',
        'error' => $e->getMessage(),
    );
    error_log("Error in Inventory processing: " . $e->getMessage());
} finally {
    // Close the statement and connection
    if (isset($stmt_trans)) mysqli_stmt_close($stmt_trans);
    if (isset($stmt_inventory)) mysqli_stmt_close($stmt_inventory);
    if (isset($stmt_items)) mysqli_stmt_close($stmt_items);
    mysqli_close($con);
}

// Return response as JSON
echo json_encode($response);
?>
