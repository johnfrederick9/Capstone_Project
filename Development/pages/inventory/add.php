<?php 
include('../../connection.php');

// Capture POST data
$item_name = $_POST["item_name"] ?? '';
$item_description = $_POST["item_description"] ?? '';
$item_brand = $_POST["item_brand"] ?? '';
$item_serialNo = $_POST["item_serialNo"] ?? '';
$item_custodian = $_POST["item_custodian"] ?? '';

$item_count = (int)($_POST["item_count"] ?? 0); // Cast to integer
$item_price = (double)($_POST["item_price"] ?? 0.0); // Cast to double
$lendable_count = (int)($_POST["lendable_count"] ?? 0); // Cast to integer

$item_amount = $item_count * $item_price; 
$item_year = $_POST["item_year"] ?? '';
$item_status = $_POST["item_status"] ?? '';
$isDisplayed = 1;

mysqli_begin_transaction($con);
try {
    // Check for duplicate item
    $duplicateCheckQuery = "SELECT COUNT(*) FROM tb_inventory WHERE item_name = ? AND item_description = ? AND isDisplayed = ?";
    $duplicateStmt = mysqli_prepare($con, $duplicateCheckQuery);
    mysqli_stmt_bind_param($duplicateStmt, "ssi", $item_name, $item_description, $isDisplayed);
    mysqli_stmt_execute($duplicateStmt);
    mysqli_stmt_bind_result($duplicateStmt, $duplicateCount);
    mysqli_stmt_fetch($duplicateStmt);
    mysqli_stmt_close($duplicateStmt);

    if ($duplicateCount > 0) {
        throw new Exception("A record with the same item name and description already exists.");
    }

    // Validate lendable_count
    $available_count = 0;
    $lendability = 0; // Default to false

    if ($lendable_count >= 0 && $lendable_count <= $item_count) {
        $available_count = $lendable_count;
        $lendability = ($lendable_count > 0) ? 1 : 0;
    } else {
        $available_count = 0; 
        $lendability = 0; 
    }

    // Validate lendable_count
    if ($lendable_count < 0 || $lendable_count > $item_count) {
        throw new Exception("Lendable count must be between 0 and item count.");
    }

    // Validate input fields
    if (empty($item_name) || empty($item_description) || empty($item_brand) || empty($item_serialNo) || empty($item_custodian) || empty($item_count) || empty($item_year) || empty($item_status)) {
        throw new Exception("All fields are required.");
    }

    // SQL query to insert data into the inventory table
    $sql = "INSERT INTO tb_inventory (item_name, item_description, item_brand, item_serialNo, item_custodian, item_count, item_price, item_amount, item_year, item_status, lendability, lendable_count, available_count, isDisplayed) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare statement
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssssidissiiii", $item_name, $item_description, $item_brand, $item_serialNo, $item_custodian, $item_count, $item_price, $item_amount, $item_year, $item_status, $lendability, $lendable_count, $available_count, $isDisplayed);

    // Execute the statement
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Failed to insert into tb_inventory: " . mysqli_stmt_error($stmt));
    }

    // Get the inserted item ID
    $item_id = mysqli_insert_id($con);

    // Commit transaction
    mysqli_commit($con);

    // Send success response
    $response = array(
        'status' => 'true',
        'item_id' => $item_id,
        'item_amount' => $item_amount,
        'available_count' => $available_count,
    );

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
    if (isset($stmt)) mysqli_stmt_close($stmt);
    mysqli_close($con);
}

// Return response as JSON
echo json_encode($response);
?>
