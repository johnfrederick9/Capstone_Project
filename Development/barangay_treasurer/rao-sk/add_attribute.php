<?php 
include('../../connection.php');

$attr_counter = is_array($_POST["attr_counter"] ?? null) ? $_POST["attr_counter"] : [];
$attribute_name = is_array($_POST["attribute_name"] ?? null) ? $_POST["attribute_name"] : [];

$attr_counter = json_decode($_POST['attr_counter'], true);
$attribute_name= json_decode($_POST['attribute_name'], true);

mysqli_begin_transaction($con);
try {
    // Insert a temporary blank data row into tb_rao_sk to get the id
    $sql_insert_blank = "INSERT INTO tb_rao_sk (chairman, period_covered, brgy_captain, isDisplayed)
                         VALUES ('Pending...', '0000-00-00', 'Pending...', 1)";
    $stmt_insert_blank = mysqli_prepare($con, $sql_insert_blank);
    
    if (!$stmt_insert_blank || !mysqli_stmt_execute($stmt_insert_blank)) {
        throw new Exception("Failed to insert blank data into tb_rao_sk: " . mysqli_error($con));
    }

    // Get the newly inserted rao_id
    $rao_sk_id = mysqli_insert_id($con);

    mysqli_stmt_close($stmt_insert_blank); // Close the blank insert statement

    // Check for duplicate attribute names in the current submission
    $uniqueAttributes = array_unique($attribute_name);

    if (count($uniqueAttributes) !== count($attribute_name)) {
        // If the count of unique values is different from the original count, duplicates exist
        throw new Exception("There are duplicate attribute names. Each attribute name must be unique.");
    }

    // If no duplicates, proceed with attribute insertion
    foreach ($attribute_name as $index => $name) {
        $sql_insert_attributes = "INSERT INTO tb_rao_sk_attributes (rao_sk_id, attribute_name, isDisplayed) VALUES (?, ?, 1)";
        $stmt_insert_attributes = mysqli_prepare($con, $sql_insert_attributes);
        
        if (!$stmt_insert_attributes) {
            throw new Exception("Failed to prepare statement for tb_rao_sk_attributes: " . mysqli_error($con));
        }

        mysqli_stmt_bind_param($stmt_insert_attributes, "is", $rao_sk_id, $name);
        
        if (!mysqli_stmt_execute($stmt_insert_attributes)) {
            throw new Exception("Failed to insert into tb_rao_sk_attributes: " . mysqli_stmt_error($stmt_insert_attributes));
        }
        
        mysqli_stmt_close($stmt_insert_attributes); // Close after each iteration
    }

    // Commit transaction if everything is valid
    mysqli_commit($con);
    $response = array(
        'status' => 'true',
        'rao_sk_id' => $rao_sk_id, // Total records before filtering
        'attribute_name' => $attribute_name  // Total records after filtering
    );

} catch (Exception $e) {
    // Rollback transaction if an error occurs
    mysqli_rollback($con);
    $response['status'] = 'false';
    $response['error'] = $e->getMessage();
    error_log("Error in Adding Attributes: " . $e->getMessage());
} finally {
    // Close database connection
    mysqli_close($con);
}

// Return the response
echo json_encode($response);
?>
