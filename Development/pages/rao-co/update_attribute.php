<?php 
include('../../connection.php');

$rao_co_id = $_POST['rao_co_id'];
$rao_co_att_ids = json_decode($_POST["rao_co_att_id"], true);
$attribute_names = json_decode($_POST["column_name"], true);

mysqli_begin_transaction($con);

try {
    // Check for duplicate attribute names
    $uniqueAttributes = array_unique($attribute_names);
    if (count($uniqueAttributes) !== count($attribute_names)) {
        throw new Exception("Each attribute name must be unique.");
    }

    $inserted_attributes = array();
    $att_names_to_remove = array();

    // Step 1: Get existing attribute IDs for the given rao_co_id
    $sql_existing_attributes = "SELECT rao_co_att_id, attribute_name FROM tb_rao_co_attributes 
        WHERE rao_co_id = ? AND isDisplayed = 1";
    $stmt_existing = mysqli_prepare($con, $sql_existing_attributes);
    mysqli_stmt_bind_param($stmt_existing, "i", $rao_co_id);
    mysqli_stmt_execute($stmt_existing);
    $result_existing = mysqli_stmt_get_result($stmt_existing);

    // Fetch the current list of attribute IDs from the database
    $existing_att_ids = [];
    $existing_att_names = [];
    while ($row = mysqli_fetch_assoc($result_existing)) {
        $existing_att_ids[] = $row['rao_co_att_id'];
        $existing_att_names[$row['rao_co_att_id']] = $row['attribute_name'];
    }
    mysqli_stmt_close($stmt_existing);

    // Step 2: Identify attributes to be removed (those that are in the database but not in the new list)
    $att_ids_to_remove = array_values(array_diff($existing_att_ids, $rao_co_att_ids)); // Ensure it's an indexed array

    // Optionally collect attribute names to remove (if needed)
    $att_names_to_remove = [];
    foreach ($att_ids_to_remove as $att_id) {
        $att_names_to_remove[] = $existing_att_names[$att_id];
    }

    $att_ids_to_remove = array_values($att_ids_to_remove);

    //Step 3: //Set the missing attributes to be removed to isDisplayed = 0;
    if (!empty($att_ids_to_remove)) {
        // Delete from tb_rao_co_attributes
        $sql_delete_attr = "UPDATE tb_rao_co_attributes SET isDisplayed = 0 WHERE rao_co_att_id = ? AND rao_co_id = ?";
        foreach($att_ids_to_remove as $att_id){
            $stmt_delete_attr = mysqli_prepare($con, $sql_delete_attr);
            mysqli_stmt_bind_param($stmt_delete_attr, "ii", $att_id, $rao_co_id);
            if (!mysqli_stmt_execute($stmt_delete_attr)) {
                throw new Exception("Failed to delete attribute from tb_rao_co_attributes: " . mysqli_stmt_error($stmt_delete_attr));
            }
            mysqli_stmt_close($stmt_delete_attr);

            // Delete from related tables (AP data and OB data)
            $sql_delete_ap = "UPDATE tb_rao_co_ap_data SET isDisplayed = 0 WHERE rao_co_att_id = ?";
            $stmt_delete_ap = mysqli_prepare($con, $sql_delete_ap);
            mysqli_stmt_bind_param($stmt_delete_ap, "i", $att_id);
            if (!mysqli_stmt_execute($stmt_delete_ap)) {
                throw new Exception("Failed to delete AP data: " . mysqli_stmt_error($stmt_delete_ap));
            }
            mysqli_stmt_close($stmt_delete_ap);

            $sql_delete_ob = "UPDATE tb_rao_co_ob_data SET isDisplayed = 0 WHERE rao_co_att_id = ?";
            $stmt_delete_ob = mysqli_prepare($con, $sql_delete_ob);
            mysqli_stmt_bind_param($stmt_delete_ob, "i", $att_id);
            if (!mysqli_stmt_execute($stmt_delete_ob)) {
                throw new Exception("Failed to delete OB data: " . mysqli_stmt_error($stmt_delete_ob));
            }
            mysqli_stmt_close($stmt_delete_ob);

            // Delete from AP totals
            $sql_delete_ap_totals = "UPDATE tb_rao_co_ap_totals SET isDisplayed = 0 WHERE rao_co_att_id = ?";
            $stmt_delete_ap_totals = mysqli_prepare($con, $sql_delete_ap_totals);
            mysqli_stmt_bind_param($stmt_delete_ap_totals, "i", $att_id);
            if (!mysqli_stmt_execute($stmt_delete_ap_totals)) {
                throw new Exception("Failed to delete AP totals: " . mysqli_stmt_error($stmt_delete_ap_totals));
            }
            mysqli_stmt_close($stmt_delete_ap_totals);

            // Delete from OB totals
            $sql_delete_ob_totals = "UPDATE tb_rao_co_ob_totals SET isDisplayed = 0 WHERE rao_co_att_id = ?";
            $stmt_delete_ob_totals = mysqli_prepare($con, $sql_delete_ob_totals);
            mysqli_stmt_bind_param($stmt_delete_ob_totals, "i", $att_id);
            if (!mysqli_stmt_execute($stmt_delete_ob_totals)) {
                throw new Exception("Failed to delete OB totals: " . mysqli_stmt_error($stmt_delete_ob_totals));
            }
            mysqli_stmt_close($stmt_delete_ob_totals);

        }
    }

    $restored_attributes = [];
    $updated_attributes = [];
    //Step 4:  Update existing attributes or insert new ones
    foreach ($attribute_names as $index => $name) {
        $att_id = $rao_co_att_ids[$index];

        // // Step 4a: Validate if the provided attribute ID is valid (exists in the database for the given rao_co_id)
        // if (!in_array($att_id, $existing_att_ids) && !empty($att_id)) {
        //     throw new Exception("Invalid attribute ID provided: " . $att_id);
        // }
        
        if (!empty($att_id)) {
         // Update existing attribute
            $sql_update = "UPDATE tb_rao_co_attributes 
            SET attribute_name = ? 
            WHERE rao_co_att_id = ? AND rao_co_id = ? AND isDisplayed = 1";
            $stmt = mysqli_prepare($con, $sql_update);
            mysqli_stmt_bind_param($stmt, "sii", $name, $att_id, $rao_co_id);

            if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Failed to update attribute: " . mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);

            // Update AP data
            $sql_update_ap_data = "UPDATE tb_rao_co_ap_data SET attribute_name = ? WHERE rao_co_att_id = ? AND isDisplayed = 1";
            $stmt_update_ap_data = mysqli_prepare($con, $sql_update_ap_data);
            mysqli_stmt_bind_param($stmt_update_ap_data, "si", $name, $att_id);

            if (!mysqli_stmt_execute($stmt_update_ap_data)) {
            throw new Exception("Failed to update attribute: " . mysqli_stmt_error($stmt_update_ap_data));
            }
            mysqli_stmt_close($stmt_update_ap_data);

            // Update OB data
            $sql_update_ob_data = "UPDATE tb_rao_co_ob_data SET attribute_name = ? WHERE rao_co_att_id = ? AND isDisplayed = 1";
            $stmt_update_ob_data = mysqli_prepare($con, $sql_update_ob_data);
            mysqli_stmt_bind_param($stmt_update_ob_data, "si", $name, $att_id);

            if (!mysqli_stmt_execute($stmt_update_ob_data)) {
            throw new Exception("Failed to update attribute: " . mysqli_stmt_error($stmt_update_ob_data));
            }
            mysqli_stmt_close($stmt_update_ob_data);

            // Update AP totals (CORRECTED)
            $sql_update_ap_totals = "UPDATE tb_rao_co_ap_totals SET attribute_name = ? WHERE rao_co_att_id = ? AND isDisplayed = 1";
            $stmt_update_ap_totals = mysqli_prepare($con, $sql_update_ap_totals); // Corrected: Use a separate statement for AP totals
            mysqli_stmt_bind_param($stmt_update_ap_totals, "si", $name, $att_id);

            if (!mysqli_stmt_execute($stmt_update_ap_totals)) {
            throw new Exception("Failed to update attribute: " . mysqli_stmt_error($stmt_update_ap_totals));
            }
            mysqli_stmt_close($stmt_update_ap_totals);

            // Update OB totals (CORRECTED)
            $sql_update_ob_totals = "UPDATE tb_rao_co_ob_totals SET attribute_name = ? WHERE rao_co_att_id = ? AND isDisplayed = 1";
            $stmt_update_ob_totals = mysqli_prepare($con, $sql_update_ob_totals); // Corrected: Use a separate statement for OB totals
            mysqli_stmt_bind_param($stmt_update_ob_totals, "si", $name, $att_id);

            if (!mysqli_stmt_execute($stmt_update_ob_totals)) {
            throw new Exception("Failed to update attribute: " . mysqli_stmt_error($stmt_update_ob_totals));
            }
            mysqli_stmt_close($stmt_update_ob_totals);

            $updated_attributes[] = $name;

        } else {
            // Check if the attribute exists and is displayed or is marked for restoration (isDisplayed = 0)
            $sql_check_existing = "SELECT attribute_name FROM tb_rao_co_attributes 
                    WHERE attribute_name = ? AND rao_co_id = ? AND isDisplayed = 0";
            $stmt_check_existing = mysqli_prepare($con, $sql_check_existing);
            mysqli_stmt_bind_param($stmt_check_existing, "si", $name, $rao_co_id);
            mysqli_stmt_execute($stmt_check_existing);
            $result_check_existing = mysqli_stmt_get_result($stmt_check_existing);


             // If the attribute exists but is hidden (isDisplayed = 0), restore it
             if (mysqli_num_rows($result_check_existing) > 0) {
                $sql_restore = "UPDATE tb_rao_co_attributes 
                                SET isDisplayed = 1
                                WHERE attribute_name = ? AND rao_co_id = ?";
                $stmt_restore = mysqli_prepare($con, $sql_restore);
                mysqli_stmt_bind_param($stmt_restore, "si", $name, $rao_co_id);
            
                if (!mysqli_stmt_execute($stmt_restore)) {
                    throw new Exception("Failed to restore attribute: " . mysqli_stmt_error($stmt_restore));
                }
                mysqli_stmt_close($stmt_restore);
            
                // Fetch the restored attribute ID
                $sql_fetch_id = "SELECT rao_co_att_id FROM tb_rao_co_attributes 
                                 WHERE attribute_name = ? AND rao_co_id = ?";
                $stmt_fetch_id = mysqli_prepare($con, $sql_fetch_id);
                mysqli_stmt_bind_param($stmt_fetch_id, "si", $name, $rao_co_id);
                if (!mysqli_stmt_execute($stmt_fetch_id)) {
                    throw new Exception("Failed to fetch restored attribute ID: " . mysqli_stmt_error($stmt_fetch_id));
                }
            
                mysqli_stmt_bind_result($stmt_fetch_id, $restored_id);
                mysqli_stmt_fetch($stmt_fetch_id);
                mysqli_stmt_close($stmt_fetch_id);

                //Restore Ap Data
                $sql_restore_rao_co_ap_data = "UPDATE tb_rao_co_ap_data
                                SET isDisplayed = 1
                                WHERE rao_co_att_id = ?";
                $stmt_restore_rao_co_ap_data = mysqli_prepare($con, $sql_restore_rao_co_ap_data);
                mysqli_stmt_bind_param($stmt_restore_rao_co_ap_data, "i", $restored_id);
            
                if (!mysqli_stmt_execute($stmt_restore_rao_co_ap_data)) {
                    throw new Exception("Failed to restore attribute: " . mysqli_stmt_error($stmt_restore_rao_co_ap_data));
                }
                mysqli_stmt_close($stmt_restore_rao_co_ap_data);


                //Restore Ob Data
                $sql_restore_rao_co_ob_data = "UPDATE tb_rao_co_ob_data
                                SET isDisplayed = 1
                                WHERE rao_co_att_id = ?";
                $stmt_restore_rao_co_ob_data = mysqli_prepare($con, $sql_restore_rao_co_ob_data);
                mysqli_stmt_bind_param($stmt_restore_rao_co_ob_data, "i", $restored_id);

                if (!mysqli_stmt_execute($stmt_restore_rao_co_ob_data)) {
                    throw new Exception("Failed to restore attribute: " . mysqli_stmt_error($stmt_restore_rao_co_ob_data));
                }
                mysqli_stmt_close($stmt_restore_rao_co_ob_data);

                  //Restore Ap Totals
                  $sql_restore_rao_co_ap_totals = "UPDATE tb_rao_co_ap_totals
                                SET isDisplayed = 1
                                WHERE rao_co_att_id = ? AND rao_co_id = ?";
                $stmt_restore_rao_co_ap_totals = mysqli_prepare($con, $sql_restore_rao_co_ap_totals);
                mysqli_stmt_bind_param($stmt_restore_rao_co_ap_totals, "ii", $restored_id, $rao_co_id);

                if (!mysqli_stmt_execute($stmt_restore_rao_co_ap_totals)) {
                    throw new Exception("Failed to restore attribute: " . mysqli_stmt_error($stmt_restore_rao_co_ap_totals));
                }
                mysqli_stmt_close($stmt_restore_rao_co_ap_totals);

                  //Restore Ob Totals
                  $sql_restore_rao_co_ob_totals = "UPDATE tb_rao_co_ob_totals
                                SET isDisplayed = 1
                                WHERE rao_co_att_id = ? AND rao_co_id = ?";
                $stmt_restore_rao_co_ob_totals = mysqli_prepare($con, $sql_restore_rao_co_ob_totals);
                mysqli_stmt_bind_param($stmt_restore_rao_co_ob_totals, "ii", $restored_id, $rao_co_id);

                if (!mysqli_stmt_execute($stmt_restore_rao_co_ob_totals)) {
                    throw new Exception("Failed to restore attribute: " . mysqli_stmt_error($stmt_restore_rao_co_ob_totals));
                }
                mysqli_stmt_close($stmt_restore_rao_co_ob_totals);

            
                $restored_attributes[] = array(
                    'rao_co_att_id' => $restored_id,
                    'attribute_name' => $name
                );


            }else{
                // Insert new attribute
                $sql_insert = "INSERT INTO tb_rao_co_attributes 
                            (rao_co_id, attribute_name, isDisplayed) 
                            VALUES (?, ?, 1)";
                $stmt = mysqli_prepare($con, $sql_insert);
                mysqli_stmt_bind_param($stmt, "is", $rao_co_id, $name);

                if (!mysqli_stmt_execute($stmt)) {
                    throw new Exception("Failed to save attribute: " . mysqli_stmt_error($stmt));
                }

                $new_att_id = mysqli_insert_id($con);
                mysqli_stmt_close($stmt);

                // Store the newly inserted attribute
                $inserted_attributes[] = array(
                    'rao_co_att_id' => $new_att_id,
                    'attribute_name' => $name
                );

                // Insert into AP data for existing AP entries
                $sql_ap_data = "INSERT INTO tb_rao_co_ap_data (rao_co_ap_id, rao_co_att_id, attribute_name, attribute_value, isDisplayed)
                            SELECT rao_co_ap_id, ?, ?, 0 , 1
                            FROM tb_rao_co_ap 
                            WHERE rao_co_id = ?";
                $stmt_ap_data = mysqli_prepare($con, $sql_ap_data);
                mysqli_stmt_bind_param($stmt_ap_data, "isi", $new_att_id, $name, $rao_co_id);
                if (!mysqli_stmt_execute($stmt_ap_data)) {
                    throw new Exception("Failed to insert AP data: " . mysqli_stmt_error($stmt_ap_data));
                }
                mysqli_stmt_close($stmt_ap_data);

                // Insert into OB data for existing OB entries
                $sql_ob_data = "INSERT INTO tb_rao_co_ob_data (rao_co_ob_id, rao_co_att_id, attribute_name, attribute_value, isDisplayed)
                            SELECT rao_co_ob_id, ?, ?, 0  , 1
                            FROM tb_rao_co_ob 
                            WHERE rao_co_id = ?";
                $stmt_ob_data = mysqli_prepare($con, $sql_ob_data);
                mysqli_stmt_bind_param($stmt_ob_data, "isi", $new_att_id, $name, $rao_co_id);
                if (!mysqli_stmt_execute($stmt_ob_data)) {
                    throw new Exception("Failed to insert OB data: " . mysqli_stmt_error($stmt_ob_data));
                }
                mysqli_stmt_close($stmt_ob_data);

                // Insert AP totals
                $total_types_ap = ['TA', 'BF'];
                foreach ($total_types_ap as $type) {
                    $sql_ap_totals = "INSERT INTO tb_rao_co_ap_totals 
                                    (rao_co_id, total_type, rao_co_att_id, attribute_name, attribute_value, isDisplayed)
                                    VALUES (?, ?, ?, ?, 0, 1)";
                    $stmt_ap_totals = mysqli_prepare($con, $sql_ap_totals);
                    mysqli_stmt_bind_param($stmt_ap_totals, "isis", $rao_co_id, $type, $new_att_id, $name);
                    if (!mysqli_stmt_execute($stmt_ap_totals)) {
                        throw new Exception("Failed to insert AP totals: " . mysqli_stmt_error($stmt_ap_totals));
                    }
                    mysqli_stmt_close($stmt_ap_totals);
                }

                // Insert OB totals
                $total_types_ob = ['TO', 'OB', 'AB'];
                foreach ($total_types_ob as $type) {
                    $sql_ob_totals = "INSERT INTO tb_rao_co_ob_totals 
                                    (rao_co_id, total_type, rao_co_att_id, attribute_name, attribute_value, isDisplayed)
                                    VALUES (?, ?, ?, ?, 0 , 1)";
                    $stmt_ob_totals = mysqli_prepare($con, $sql_ob_totals);
                    mysqli_stmt_bind_param($stmt_ob_totals, "isis", $rao_co_id, $type, $new_att_id, $name);
                    if (!mysqli_stmt_execute($stmt_ob_totals)) {
                        throw new Exception("Failed to insert OB totals: " . mysqli_stmt_error($stmt_ob_totals));
                    }
                    mysqli_stmt_close($stmt_ob_totals);
                }
            }
        }
    }

    mysqli_commit($con);
    $response = array(
        'status' => 'true',
        'rao_co_id' => $rao_co_id,
        'attribute_name' => $attribute_names,
        'new_attributes' => $inserted_attributes,
        'att_ids_to_remove' => $att_ids_to_remove,
        'att_names_to_remove' => $att_names_to_remove,
        'restored_attributes' => $restored_attributes,
        'updated_attributes' => $updated_attributes
        
    );

} catch (Exception $e) {
    mysqli_rollback($con);
    $response = array(
        'status' => 'false',
        'error' => $e->getMessage()
    );
    error_log("Error in Managing Attributes: " . $e->getMessage());
} finally {
    mysqli_close($con);
}

echo json_encode($response);
?>