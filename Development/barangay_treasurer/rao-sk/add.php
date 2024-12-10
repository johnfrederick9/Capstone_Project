<?php 
include('../../connection.php');

mysqli_begin_transaction($con);  // Start transaction
try {
    // Fetch the POST data sent from the form
    $rao_sk_id = $_POST['rao_sk_id'];  // The rao_sk_id from the form
    $period_covered = $_POST['period_covered'];
    $chairman = $_POST['chairman'];
    $brgy_captain = $_POST['brgy_captain'];

    // Update the tb_rao_sk with the chairman, period_covered, and brgy_captain
    $update_rao_sk_query = "UPDATE tb_rao_sk 
                              SET chairman = ?, brgy_captain = ?, period_covered = ? 
                              WHERE rao_sk_id = ? AND isDisplayed = 1";
    $stmt = mysqli_prepare($con, $update_rao_sk_query);
    mysqli_stmt_bind_param($stmt, 'sssi', $chairman, $brgy_captain, $period_covered, $rao_sk_id);
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Error updating tb_rao_sk: " . mysqli_error($con));
    }

    // Process AP data
    if (isset($_POST['ap_data']) && is_array($_POST['ap_data'])) {
        foreach ($_POST['ap_data'] as $apRow) {
            $date = $apRow['date'];
            $reference_no = $apRow['reference_no'];
            $particulars = $apRow['particulars'];
            $total = $apRow['total'];
            
            // Insert AP data into the database
            $sql = "INSERT INTO tb_rao_sk_ap (rao_sk_id, ap_ref_date, ap_ref_no, ap_particulars, ap_totals) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, 'isssd', $rao_sk_id, $date, $reference_no, $particulars, $total);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error inserting AP data: " . mysqli_error($con));
            }
            
            // Get the ID of the inserted AP row for attributes
            $rao_sk_ap_id = mysqli_insert_id($con); 

            // Insert AP dynamic attributes
            if (isset($apRow['attributes']) && is_array($apRow['attributes'])) {
                foreach ($apRow['attributes'] as $attributeId => $attributeValue) {
                    // Fetch attribute name based on attributeId
                    $sql_fetch_att_name = "SELECT attribute_name FROM tb_rao_sk_attributes WHERE rao_sk_att_id = ? AND isDisplayed = 1";
                    $stmt_fetch_att_name = mysqli_prepare($con, $sql_fetch_att_name);
                    mysqli_stmt_bind_param($stmt_fetch_att_name, "i", $attributeId);
                    if (!mysqli_stmt_execute($stmt_fetch_att_name)) {
                        throw new Exception("Error executing fetch attribute query: " . mysqli_error($con));
                    }
                    
                    // Get the result for the attribute name
                    mysqli_stmt_bind_result($stmt_fetch_att_name, $attributeName);
                    if (!mysqli_stmt_fetch($stmt_fetch_att_name)) {
                        throw new Exception("Error fetching attribute name for ID: " . $attributeId);
                    }
                    
                    // Free the result set to avoid "commands out of sync" error
                    mysqli_stmt_free_result($stmt_fetch_att_name);
                    
                    // Insert the dynamic attribute into tb_rao_sk_ob_data
                    $sql_insert_ap_data = "INSERT INTO tb_rao_sk_ap_data (rao_sk_ap_id, rao_sk_att_id, attribute_name, attribute_value, isDisplayed)                                 
                                           VALUES (?, ?, ?, ?, 1)";
                    $stmt_insert_ap_data = mysqli_prepare($con, $sql_insert_ap_data);
                    mysqli_stmt_bind_param($stmt_insert_ap_data, 'iiss', $rao_sk_ap_id, $attributeId, $attributeName, $attributeValue);
                    if (!mysqli_stmt_execute($stmt_insert_ap_data)) {
                        throw new Exception("Error inserting dynamic attribute: " . mysqli_error($con));
                    }
                }
            }
        }
    }

      // Process OB data
    if (isset($_POST['ob_data']) && is_array($_POST['ob_data'])) {
        foreach ($_POST['ob_data'] as $obRow) {
            $date = $obRow['date'];
            $reference_no = $obRow['reference_no'];
            $particulars = $obRow['particulars'];
            $total = $obRow['total'];
            
            // Insert OB data into the database
            $sql = "INSERT INTO tb_rao_sk_ob (rao_sk_id, ob_ref_date, ob_ref_no, ob_particulars, ob_totals) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, 'isssd', $rao_sk_id, $date, $reference_no, $particulars, $total);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error inserting OB data: " . mysqli_error($con));
            }
            
            $rao_sk_ob_id = mysqli_insert_id($con);

            // Insert OB dynamic attributes
            if (isset($obRow['attributes']) && is_array($obRow['attributes'])) {
                foreach ($obRow['attributes'] as $attributeId => $attributeValue) {
                    $sql_fetch_att_name = "SELECT attribute_name FROM tb_rao_sk_attributes WHERE rao_sk_att_id = ? AND isDisplayed = 1";
                    $stmt_fetch_att_name = mysqli_prepare($con, $sql_fetch_att_name);
                    mysqli_stmt_bind_param($stmt_fetch_att_name, "i", $attributeId);
                    if (!mysqli_stmt_execute($stmt_fetch_att_name)) {
                        throw new Exception("Error fetching attribute name: " . mysqli_error($con));
                    }
                    mysqli_stmt_bind_result($stmt_fetch_att_name, $attributeName);
                    if (!mysqli_stmt_fetch($stmt_fetch_att_name)) {
                        throw new Exception("No attribute name found for ID: $attributeId");
                    }
                    mysqli_stmt_free_result($stmt_fetch_att_name);

                    $sql_insert_ob_data = "INSERT INTO tb_rao_sk_ob_data (rao_sk_ob_id, rao_sk_att_id, attribute_name, attribute_value, isDisplayed) 
                                           VALUES (?, ?, ?, ?,1)";
                    $stmt_insert_ob_data = mysqli_prepare($con, $sql_insert_ob_data);
                    mysqli_stmt_bind_param($stmt_insert_ob_data, 'iiss', $rao_sk_ob_id, $attributeId, $attributeName, $attributeValue);
                    if (!mysqli_stmt_execute($stmt_insert_ob_data)) {
                        throw new Exception("Error inserting OB attribute data: " . mysqli_error($con));
                    }
                }
            }
        }
    }

   // In the AP totals processing section, modify the regex pattern:
if (isset($_POST['ap_totals']) && is_array($_POST['ap_totals'])) {
    foreach ($_POST['ap_totals'] as $identifier => $values) {
        if (is_array($values)) {
            foreach ($values as $attributeId => $totalValue) {
                // Here we have the correct attributeId directly
                $sql_fetch_att_name = "SELECT attribute_name FROM tb_rao_sk_attributes WHERE rao_sk_att_id = ? AND isDisplayed = 1";
                $stmt_fetch_att_name = mysqli_prepare($con, $sql_fetch_att_name);
                mysqli_stmt_bind_param($stmt_fetch_att_name, "i", $attributeId);
                
                if (!mysqli_stmt_execute($stmt_fetch_att_name)) {
                    throw new Exception("Error fetching AP attribute name: " . mysqli_error($con));
                }
                
                mysqli_stmt_bind_result($stmt_fetch_att_name, $attributeName);
                mysqli_stmt_fetch(statement: $stmt_fetch_att_name);
                mysqli_stmt_free_result($stmt_fetch_att_name);

                $sql_insert_ap_total = "INSERT INTO tb_rao_sk_ap_totals (rao_sk_id, total_type, rao_sk_att_id, attribute_name, attribute_value, isDisplayed) 
                                      VALUES (?, ?, ?, ?, ?, 1)";
                $stmt_insert_ap_total = mysqli_prepare($con, $sql_insert_ap_total);
                mysqli_stmt_bind_param($stmt_insert_ap_total, 'isisd', $rao_sk_id, $identifier, $attributeId, $attributeName, $totalValue);
                
                if (!mysqli_stmt_execute($stmt_insert_ap_total)) {
                    throw new Exception("Error inserting AP totals: " . mysqli_error($con));
                }
            }
        } else {
            // Handle non-attribute totals (TA, BF)
            $sql_insert_ap_total = "INSERT INTO tb_rao_sk_ap_totals (rao_sk_id, total_type, attribute_value, isDisplayed) 
                                  VALUES (?, ?, ? , 1)";
            $stmt_insert_ap_total = mysqli_prepare($con, $sql_insert_ap_total);
            mysqli_stmt_bind_param($stmt_insert_ap_total, 'isd', $rao_sk_id, $identifier, $values);
            
            if (!mysqli_stmt_execute($stmt_insert_ap_total)) {
                throw new Exception("Error inserting AP totals: " . mysqli_error($con));
            }
        }
    }
}

// Similarly for OB totals:
if (isset($_POST['ob_totals']) && is_array($_POST['ob_totals'])) {
    foreach ($_POST['ob_totals'] as $identifier => $values) {
        if (is_array($values)) {
            foreach ($values as $attributeId => $totalValue) {
                $sql_fetch_att_name = "SELECT attribute_name FROM tb_rao_sk_attributes WHERE rao_sk_att_id = ? AND isDisplayed = 1";
                $stmt_fetch_att_name = mysqli_prepare($con, $sql_fetch_att_name);
                mysqli_stmt_bind_param($stmt_fetch_att_name, "i", $attributeId);
                
                if (!mysqli_stmt_execute($stmt_fetch_att_name)) {
                    throw new Exception("Error fetching OB attribute name: " . mysqli_error($con));
                }
                
                mysqli_stmt_bind_result($stmt_fetch_att_name, $attributeName);
                mysqli_stmt_fetch($stmt_fetch_att_name);
                mysqli_stmt_free_result($stmt_fetch_att_name);

                $sql_insert_ob_total = "INSERT INTO tb_rao_sk_ob_totals (rao_sk_id, total_type, rao_sk_att_id, attribute_name, attribute_value, isDisplayed) 
                                      VALUES (?, ?, ?, ?, ?, 1)";
                $stmt_insert_ob_total = mysqli_prepare($con, $sql_insert_ob_total);
                mysqli_stmt_bind_param($stmt_insert_ob_total, 'isisd', $rao_sk_id, $identifier, $attributeId, $attributeName, $totalValue);
                
                if (!mysqli_stmt_execute($stmt_insert_ob_total)) {
                    throw new Exception("Error inserting OB totals: " . mysqli_error($con));
                }
            }
        } else {
            // Handle non-attribute totals (TO, OB, AB)
            $sql_insert_ob_total = "INSERT INTO tb_rao_sk_ob_totals (rao_sk_id, total_type, attribute_value, isDisplayed) 
                                  VALUES (?, ?, ?, 1)";
            $stmt_insert_ob_total = mysqli_prepare($con, $sql_insert_ob_total);
            mysqli_stmt_bind_param($stmt_insert_ob_total, 'isd', $rao_sk_id, $identifier, $values);
            
            if (!mysqli_stmt_execute($stmt_insert_ob_total)) {
                throw new Exception("Error inserting OB totals: " . mysqli_error($con));
            }
        }
    }
}


    // Commit transaction
    mysqli_commit($con);

    // Send success response
    $response = ['status' => 'true', 'message' => 'Data successfully inserted.'];

} catch (Exception $e) {
    // Rollback transaction in case of error
    mysqli_rollback($con);
    
    // Send error response
    $response = ['status' => 'false', 'error' => $e->getMessage()];
    error_log("Error processing data: " . $e->getMessage());
}

// Close connection
mysqli_close($con);

// Send response to client
echo json_encode($response);
?>
