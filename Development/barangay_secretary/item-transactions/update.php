<?php
include('../../connection.php');

$transaction_id = $_POST["transaction_id"];
echo ($transaction_id);
// Capture POST data
$borrower_name = $_POST["borrower_name"] ?? '';
$borrower_address = $_POST["borrower_address"] ?? '';
$reserved_on = $_POST["reserved_on"] ?? '';
$date_borrowed = $_POST["date_borrowed"] ?? '';
$return_date = $_POST["return_date"] ?? '';
$approved_by = $_POST["approved_by"] ?? '';
$released_by = $_POST["released_by"] ?? '';
$returned_by = $_POST["returned_by"] ?? '';
$date_returned = $_POST["date_returned"] ?? '';
$transaction_status = 'Ongoing';
$isDisplayed = '1';


// Ensure items is a JSON string
$item_names_json = isset($_POST["items"]) && is_string($_POST["items"]) ? $_POST["items"] : '[]';
$items = json_decode($item_names_json, true);

// Ensure borrow_quantities and return_quantities are arrays
// $borrow_quantities = isset($_POST["borrow_quantity"]) && is_array($_POST["borrow_quantity"]) ? $_POST["borrow_quantity"] : [];
// $return_quantities = isset($_POST["return_quantity"]) && is_array($_POST["return_quantity"]) ? $_POST["return_quantity"] : [];

// Fetch previous quantities for the items in this transaction
$previous_borrow_quantities = [];
$previous_return_quantities = [];

// Query for borrowed quantities
$sql_previous_items = "SELECT item_id, borrow_quantity, return_quantity FROM tb_transaction_items WHERE transaction_id = ?";
$stmt_previous_items = mysqli_prepare($con, $sql_previous_items);
mysqli_stmt_bind_param($stmt_previous_items,"i", $transaction_id);
mysqli_stmt_execute($stmt_previous_items);
mysqli_stmt_bind_result($stmt_previous_items, $item_id, $borrow_quantity, $return_quantity);
while (mysqli_stmt_fetch($stmt_previous_items)) {
    $previous_borrow_quantities[$item_id] = $borrow_quantity;
    $previous_return_quantities[$item_id] = $return_quantity;
}
mysqli_stmt_close($stmt_previous_items);

mysqli_begin_transaction($con);

try {
    
    // Update tb_item_transaction
    $sql_it_up = "UPDATE tb_item_transaction SET borrower_name = ?, borrower_address = ?, reserved_on = ?, date_borrowed = ?, return_date = ?, approved_by = ?, released_by = ?, returned_by = ?, date_returned =? WHERE transaction_id = ?";
    $stmt_it_up = mysqli_prepare($con, $sql_it_up);
    if (!$stmt_it_up) {
        throw new Exception("Failed to prepare statement: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt_it_up,"sssssssssi", $borrower_name, $borrower_address, $reserved_on, $date_borrowed, $return_date, $approved_by, $released_by, $returned_by, $date_returned, $transaction_id);
    mysqli_stmt_execute($stmt_it_up);
    mysqli_stmt_close($stmt_it_up);
    
     // Delete existing items
    $sql_del_ti = "DELETE FROM tb_transaction_items WHERE transaction_id = ?";
    $stmt_del_ti = mysqli_prepare($con,$sql_del_ti);
    mysqli_stmt_bind_param($stmt_del_ti,"i", $transaction_id);
    mysqli_stmt_execute($stmt_del_ti);
    mysqli_stmt_close($stmt_del_ti);

    $status = "Ongoing";
    $all_returned = true;
    $some_returned = false;

    $sql_ti_insert = "INSERT INTO tb_transaction_items (transaction_id, item_id, item_name, borrow_quantity, return_quantity, item_status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_ti_insert = mysqli_prepare($con, $sql_ti_insert);

    foreach($items as $item){
        $item_id = $item['item_id'];
        $borrow_qty = $item['borrow_quantity'];
        $return_qty = $item['return_quantity'];

        $sql_item_name = "SELECT item_name, lendability FROM tb_inventory WHERE item_id = ?";
        $stmt_item_name = mysqli_prepare($con, $sql_item_name);
        mysqli_stmt_bind_param($stmt_item_name, "i", $item_id);
        mysqli_stmt_execute($stmt_item_name);
        mysqli_stmt_bind_result($stmt_item_name, $item_name, $lendability);
        mysqli_stmt_fetch($stmt_item_name);
        mysqli_stmt_close($stmt_item_name);

        $previous_borrow_qty = $previous_borrow_quantities[$item_id] ?? 0;
        
        // Check if the item is not lendable and borrow quantity is being increased
        if ($lendability == 0 && $borrow_qty > $previous_borrow_qty) {
            echo "Error: Cannot modify borrow quantity for item '$item_name' as it is no longer lendable.";
            mysqli_rollback($con);
            exit;  // Stop further processing
        }

        // Determine the status of each item
        if ($return_qty > 0) {
            $some_returned = true;
        }
        if ($return_qty < $borrow_qty) {
            $all_returned = false;
        }
    
        $item_status = ($return_qty >= $borrow_qty) ? 'Returned' : 'Borrowed';

        mysqli_stmt_bind_param( $stmt_ti_insert,"iissis", $transaction_id, $item_id, $item_name, $borrow_qty, $return_qty, $item_status);
        mysqli_stmt_execute( $stmt_ti_insert);


        // Handle inventory updates based on return quantity
        if (isset($previous_return_quantities[$item_id])) {
            $previous_return_qty = $previous_return_quantities[$item_id];
            
            if ($return_qty == 0 && $previous_return_qty > 0) {
                // Subtract the previously returned quantity from available count
                $sql_inventory_min = "UPDATE tb_inventory SET available_count = available_count - ? WHERE item_id = ?";
                $stmt_inventory_min = mysqli_prepare($con, $sql_inventory_min);
                mysqli_stmt_bind_param($stmt_inventory_min,"ii", $previous_return_qty, $item_id);
                mysqli_stmt_execute($stmt_inventory_min);
                mysqli_stmt_close($stmt_inventory_min);

            }
             
            elseif ($return_qty > 0) {
                if ($return_qty > $previous_return_qty) {
                    // Add the difference to the available count
                    $diff = $return_qty - $previous_return_qty;

                    $sql_inventory_up = "UPDATE tb_inventory SET available_count = available_count + ? WHERE item_id = ?";
                    $stmt_inventory_up = mysqli_prepare($con, $sql_inventory_up);
                    mysqli_stmt_bind_param($stmt_inventory_up,"ii", $diff, $item_id);
                    mysqli_stmt_execute($stmt_inventory_up);
                    mysqli_stmt_close($stmt_inventory_up);

                } elseif ($return_qty < $previous_return_qty) {
                    // Subtract the difference from the available count
                    $diff = $previous_return_qty - $return_qty;

                    $sql_inventory_dif = "UPDATE tb_inventory SET available_count = available_count - ? WHERE item_id = ?";
                    $stmt_inventory_dif = mysqli_prepare($con, $sql_inventory_dif);
                    mysqli_stmt_bind_param($stmt_inventory_dif,"ii", $diff, $item_id);
                    mysqli_stmt_execute($stmt_inventory_dif);
                    mysqli_stmt_close($stmt_inventory_dif);
                }
            }
        } else {
            // Newly return item
            if ($return_qty > 0) {
                if ($return_qty <= $borrow_qty) {
                    // If return quantity is valid, subtract it from available count
                    $diff = $borrow_qty - $return_qty;

                    $sql_inventory_ret = "UPDATE tb_inventory SET available_count = available_count - ? WHERE item_id = ?";
                    $stmt_inventory_ret = mysqli_prepare($con, $sql_inventory_ret);
                    mysqli_stmt_bind_param($stmt_inventory_ret,"ii", $diff, $item_id);
                    mysqli_stmt_execute($stmt_inventory_ret);
                    mysqli_stmt_close($stmt_inventory_ret);

                } else {
                    // Handle error: return quantity cannot exceed borrowed quantity
                    echo "Error: Return quantity exceeds borrowed quantity for item ID: " . $item_id;
                }
            } 
        }

        // Handle inventory updates based on borrow quantity
        if (isset($previous_borrow_quantities[$item_id])) {
            $previous_borrow_qty = $previous_borrow_quantities[$item_id];
    
            if ($borrow_qty < $previous_borrow_qty) {
                $excess = $previous_borrow_qty - $borrow_qty;

                $sql_inventory_up_qty = "UPDATE tb_inventory SET available_count = available_count + ? WHERE item_id = ?";
                $stmt_inventory_up_qty = mysqli_prepare($con, $sql_inventory_up_qty);
                mysqli_stmt_bind_param($stmt_inventory_up_qty,"ii", $excess, $item_id);
                mysqli_stmt_execute($stmt_inventory_up_qty);
                mysqli_stmt_close($stmt_inventory_up_qty);

            } elseif ($borrow_qty > $previous_borrow_qty) {
                $shortage = $borrow_qty - $previous_borrow_qty;

                $sql_inventory_down_qty = "UPDATE tb_inventory SET available_count = available_count - ? WHERE item_id = ?";
                $stmt_inventory_down_qty = mysqli_prepare($con, $sql_inventory_down_qty);
                mysqli_stmt_bind_param($stmt_inventory_down_qty,"ii", $shortage, $item_id);
                mysqli_stmt_execute($stmt_inventory_down_qty);
                mysqli_stmt_close($stmt_inventory_down_qty);


            }
        }

    }
    mysqli_stmt_close($stmt_ti_insert);

    // Determine the final status
    if ($all_returned && count($items) > 0) {
        $status = 'Completed';
    } elseif ($some_returned) {
        $status = 'Partially';
    } else {
        $status = 'Ongoing';
    }

    // Update the transaction status
    $sql_it = "UPDATE tb_item_transaction SET transaction_status = ? WHERE transaction_id = ?";
    $stmt_it= mysqli_prepare($con,  $sql_it);
    mysqli_stmt_bind_param($stmt_it,"si", $status, $transaction_id);
    mysqli_stmt_execute($stmt_it);
    mysqli_stmt_close($stmt_it);


    mysqli_commit($con);

    $response = array(
        'status' => 'true',
        'item_id' => $item_id,
        'transaction_status' => $transaction_status,
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
