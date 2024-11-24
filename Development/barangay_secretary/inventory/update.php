<?php
include('../../connection.php');

// Capture POST data
$item_id = (int)($_POST['item_id'] ?? 0); // Ensure item_id is an integer
$item_name = $_POST["item_name"] ?? '';
$item_description = $_POST["item_description"] ?? '';
$item_brand = $_POST["item_brand"] ?? '';
$item_serialNo = $_POST["item_serialNo"] ?? '';
$item_custodian = $_POST["item_custodian"] ?? '';
$item_count = (int)($_POST["item_count"] ?? 0);
$item_price = (float)($_POST["item_price"] ?? 0.0);
$lendable_count = (int)($_POST["lendable_count"] ?? 0);
$item_year = $_POST["item_year"] ?? '';
$item_status = $_POST["item_status"] ?? '';

$item_amount = $item_count * $item_price;

mysqli_begin_transaction($con);

try {
    // Validate lendable_count
    $available_count = 0;
    $lendability = 0; // Default to false

    // Fetch current data from the database
    $sql_check = "SELECT lendable_count, available_count FROM tb_inventory WHERE item_id = ?";
    $stmt_check = mysqli_prepare($con, $sql_check);
    if (!$stmt_check) {
        throw new Exception("Failed to prepare statement: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt_check, "i", $item_id);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_bind_result($stmt_check, $current_lendable_count, $current_available_count);
    mysqli_stmt_fetch($stmt_check);
    mysqli_stmt_close($stmt_check);

    if ($current_lendable_count !== null) {
        $borrowed_item_count = $current_lendable_count - $current_available_count;

        // Validate lendable_count
        if ($lendable_count < 0 || $lendable_count > $item_count) {
            throw new Exception("Lendable count must be between 0 and item count.");
        }

        if ($lendable_count < $borrowed_item_count) {
            throw new Exception("Lendable count cannot be less than the number of borrowed items.");
        }

        // Set lendability based on item status
        $lendability = ($item_status === "Unserviceable") ? 0 : ($lendable_count > 0 ? 1 : 0);

        // Recalculate available_count based on the new lendable_count
        $available_count = $lendable_count - $borrowed_item_count;

        // Update the inventory
        $sql_update = "UPDATE tb_inventory SET 
            item_name = ?, 
            item_description = ?, 
            item_brand = ?, 
            item_serialNo = ?, 
            item_custodian = ?, 
            item_count = ?, 
            item_price = ?, 
            item_amount = ?, 
            item_year = ?, 
            item_status = ?, 
            lendable_count = ?, 
            available_count = ? 
            WHERE item_id = ?";
        $stmt_update = mysqli_prepare($con, $sql_update);
        if (!$stmt_update) {
            throw new Exception("Failed to prepare statement: " . mysqli_error($con));
        }
        mysqli_stmt_bind_param($stmt_update, "sssssidissiii", 
            $item_name, 
            $item_description, 
            $item_brand, 
            $item_serialNo, 
            $item_custodian, 
            $item_count, 
            $item_price, 
            $item_amount, 
            $item_year, 
            $item_status, 
            $lendable_count, 
            $available_count, 
            $item_id);

        if (!mysqli_stmt_execute($stmt_update)) {
            throw new Exception("Failed to update tb_inventory: " . mysqli_stmt_error($stmt_update));
        }
        mysqli_stmt_close($stmt_update);

    } else {
        throw new Exception("Item not found.");
    }

    mysqli_commit($con);

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
    mysqli_close($con);
}

// Return response as JSON
echo json_encode($response);
?>
