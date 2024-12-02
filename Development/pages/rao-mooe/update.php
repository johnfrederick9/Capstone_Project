<?php
include('../../connection.php');

mysqli_begin_transaction($con);
try {
    // Main record update
    $rao_mooe_id = $_POST['rao_mooe_id'];
    $chairman = $_POST['chairman'];
    $brgy_captain = $_POST['brgy_captain'];
    $period_covered = $_POST['period_covered'];

    $update_rao_mooe_query = "UPDATE tb_rao_mooe 
                              SET chairman = ?, brgy_captain = ?, period_covered = ? 
                              WHERE rao_mooe_id = ?";
    $stmt = mysqli_prepare($con, $update_rao_mooe_query);
    mysqli_stmt_bind_param($stmt, 'sssi', $chairman, $brgy_captain, $period_covered, $rao_mooe_id);
    mysqli_stmt_execute($stmt);

    // Process AP data
if (isset($_POST['ap_data']) && is_array($_POST['ap_data'])) {
    foreach ($_POST['ap_data'] as $apRow) {
        $rao_mooe_ap_id = !empty($apRow['rao_mooe_ap_id']) ? intval($apRow['rao_mooe_ap_id']) : 0;
        $ap_date = $apRow['date'];
        $ap_ref_no = $apRow['reference_no'];
        $ap_particulars = $apRow['particulars'];
        $ap_total = $apRow['total'];

        if ($rao_mooe_ap_id > 0) {
            // Update existing AP record
            $query = "UPDATE tb_rao_mooe_ap 
                      SET ap_ref_date = ?, ap_ref_no = ?, ap_particulars = ?, ap_totals = ? 
                      WHERE rao_mooe_ap_id = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'sssdi', $ap_date, $ap_ref_no, $ap_particulars, $ap_total, $rao_mooe_ap_id);
        } else {
            // Insert new AP record
            $query = "INSERT INTO tb_rao_mooe_ap 
                      (rao_mooe_id, ap_ref_date, ap_ref_no, ap_particulars, ap_totals) 
                      VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'isssd', $rao_mooe_id, $ap_date, $ap_ref_no, $ap_particulars, $ap_total);
        }
        mysqli_stmt_execute($stmt);

        if (!$rao_mooe_ap_id) {
            $rao_mooe_ap_id = mysqli_insert_id($con);
        }

        // Process AP attributes
        if (isset($apRow['attributes']) && is_array($apRow['attributes'])) {
            foreach ($apRow['attributes'] as $attributeId => $attributeValue) {
                // Check if the attribute already exists for this AP record
                $select_query = "SELECT rao_mooe_ap_data_id FROM tb_rao_mooe_ap_data 
                                 WHERE rao_mooe_ap_id = ? AND rao_mooe_att_id = ?";
                $select_stmt = mysqli_prepare($con, $select_query);
                mysqli_stmt_bind_param($select_stmt, 'ii', $rao_mooe_ap_id, $attributeId);
                mysqli_stmt_execute($select_stmt);
                mysqli_stmt_store_result($select_stmt);
                
                if (mysqli_stmt_num_rows($select_stmt) > 0) {
                    // If the attribute exists, update it
                    $update_query = "UPDATE tb_rao_mooe_ap_data 
                                     SET attribute_value = ? 
                                     WHERE rao_mooe_ap_id = ? AND rao_mooe_att_id = ?";
                    $update_stmt = mysqli_prepare($con, $update_query);
                    mysqli_stmt_bind_param($update_stmt, 'sii', $attributeValue, $rao_mooe_ap_id, $attributeId);
                    mysqli_stmt_execute($update_stmt);
                } else {
                    // If the attribute does not exist, insert it
                    $insert_query = "INSERT INTO tb_rao_mooe_ap_data 
                                     (rao_mooe_ap_id, rao_mooe_att_id, attribute_name, attribute_value, isDisplayed) 
                                     VALUES (?, ?, (SELECT attribute_name FROM tb_rao_mooe_attributes 
                                     WHERE rao_mooe_att_id = ?), ?, 1)";
                    $insert_stmt = mysqli_prepare($con, $insert_query);
                    mysqli_stmt_bind_param($insert_stmt, 'iiis', $rao_mooe_ap_id, $attributeId, $attributeId, $attributeValue);
                    mysqli_stmt_execute($insert_stmt);
                }
            }
        }
    }
}

    // Process OB data (similar to AP data processing)
if (isset($_POST['ob_data']) && is_array($_POST['ob_data'])) {
    foreach ($_POST['ob_data'] as $obRow) {
        $rao_mooe_ob_id = !empty($obRow['rao_mooe_ob_id']) ? intval($obRow['rao_mooe_ob_id']) : 0;
        $ob_date = $obRow['date'];
        $ob_ref_no = $obRow['reference_no'];
        $ob_particulars = $obRow['particulars'];
        $ob_total = $obRow['total'];

        if ($rao_mooe_ob_id > 0) {
            // Update existing OB record
            $query = "UPDATE tb_rao_mooe_ob 
                      SET ob_ref_date = ?, ob_ref_no = ?, ob_particulars = ?, ob_totals = ? 
                      WHERE rao_mooe_ob_id = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'sssdi', $ob_date, $ob_ref_no, $ob_particulars, $ob_total, $rao_mooe_ob_id);
        } else {
            // Insert new OB record
            $query = "INSERT INTO tb_rao_mooe_ob 
                      (rao_mooe_id, ob_ref_date, ob_ref_no, ob_particulars, ob_totals) 
                      VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'isssd', $rao_mooe_id, $ob_date, $ob_ref_no, $ob_particulars, $ob_total);
        }
        mysqli_stmt_execute($stmt);

        if (!$rao_mooe_ob_id) {
            $rao_mooe_ob_id = mysqli_insert_id($con);
        }

        // Process OB attributes
        if (isset($obRow['attributes']) && is_array($obRow['attributes'])) {
            foreach ($obRow['attributes'] as $attributeId => $attributeValue) {
                // Check if the attribute already exists for this OB record
                $select_query = "SELECT rao_mooe_ob_data_id FROM tb_rao_mooe_ob_data 
                                 WHERE rao_mooe_ob_id = ? AND rao_mooe_att_id = ?";
                $select_stmt = mysqli_prepare($con, $select_query);
                mysqli_stmt_bind_param($select_stmt, 'ii', $rao_mooe_ob_id, $attributeId);
                mysqli_stmt_execute($select_stmt);
                mysqli_stmt_store_result($select_stmt);
                
                if (mysqli_stmt_num_rows($select_stmt) > 0) {
                    // If the attribute exists, update it
                    $update_query = "UPDATE tb_rao_mooe_ob_data 
                                     SET attribute_value = ? 
                                     WHERE rao_mooe_ob_id = ? AND rao_mooe_att_id = ?";
                    $update_stmt = mysqli_prepare($con, $update_query);
                    mysqli_stmt_bind_param($update_stmt, 'sii', $attributeValue, $rao_mooe_ob_id, $attributeId);
                    mysqli_stmt_execute($update_stmt);
                } else {
                    // If the attribute does not exist, insert it
                    $insert_query = "INSERT INTO tb_rao_mooe_ob_data 
                                     (rao_mooe_ob_id, rao_mooe_att_id, attribute_name, attribute_value, isDisplayed) 
                                     VALUES (?, ?, (SELECT attribute_name FROM tb_rao_mooe_attributes 
                                     WHERE rao_mooe_att_id = ?), ?, 1)";
                    $insert_stmt = mysqli_prepare($con, $insert_query);
                    mysqli_stmt_bind_param($insert_stmt, 'iiis', $rao_mooe_ob_id, $attributeId, $attributeId, $attributeValue);
                    mysqli_stmt_execute($insert_stmt);
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
                        // Check if the AP total already exists for this attributeId and total_type
                        $sql_fetch_ap_totals = "SELECT * FROM tb_rao_mooe_ap_totals WHERE rao_mooe_att_id = ? AND total_type = ? AND rao_mooe_id = ? AND isDisplayed = 1";
                        $stmt_fetch_ap_totals = mysqli_prepare($con, $sql_fetch_ap_totals);
                        mysqli_stmt_bind_param($stmt_fetch_ap_totals, "isi", $attributeId, $identifier, $rao_mooe_id);
                        
                        if (!mysqli_stmt_execute($stmt_fetch_ap_totals)) {
                            throw new Exception("Error fetching AP totals: " . mysqli_error($con));
                        }
                        
                        mysqli_stmt_store_result($stmt_fetch_ap_totals);
                        
                        if (mysqli_stmt_num_rows($stmt_fetch_ap_totals) > 0) {
                            // Record exists, update the total value
                            $sql_update_ap_total = "UPDATE tb_rao_mooe_ap_totals 
                                                    SET attribute_value = ? 
                                                    WHERE rao_mooe_att_id = ? AND total_type = ? AND rao_mooe_id = ? AND isDisplayed = 1";
                            $stmt_update_ap_total = mysqli_prepare($con, $sql_update_ap_total);
                            mysqli_stmt_bind_param($stmt_update_ap_total, 'disi', $totalValue, $attributeId, $identifier, $rao_mooe_id);
                            
                            if (!mysqli_stmt_execute($stmt_update_ap_total)) {
                                throw new Exception("Error updating AP totals: " . mysqli_error($con));
                            }
                            mysqli_stmt_close($stmt_update_ap_total);
                        } else {
                            // Record doesn't exist, insert new record
                            // Fetch the attribute name
                            $sql_fetch_att_name = "SELECT attribute_name FROM tb_rao_mooe_attributes WHERE rao_mooe_att_id = ? AND isDisplayed = 1";
                            $stmt_fetch_att_name = mysqli_prepare($con, $sql_fetch_att_name);
                            mysqli_stmt_bind_param($stmt_fetch_att_name, "i", $attributeId);
                            
                            if (!mysqli_stmt_execute($stmt_fetch_att_name)) {
                                throw new Exception("Error fetching AP attribute name: " . mysqli_error($con));
                            }
                            
                            mysqli_stmt_bind_result($stmt_fetch_att_name, $attributeName);
                            mysqli_stmt_fetch($stmt_fetch_att_name);
                            mysqli_stmt_free_result($stmt_fetch_att_name);
        
                            // Insert new AP total
                            $sql_insert_ap_total = "INSERT INTO tb_rao_mooe_ap_totals 
                                                  (rao_mooe_id, total_type, rao_mooe_att_id, attribute_name, attribute_value, isDisplayed) 
                                                  VALUES (?, ?, ?, ?, ?, 1)";
                            $stmt_insert_ap_total = mysqli_prepare($con, $sql_insert_ap_total);
                            mysqli_stmt_bind_param($stmt_insert_ap_total, 'isisd', $rao_mooe_id, $identifier, $attributeId, $attributeName, $totalValue);
                            
                            if (!mysqli_stmt_execute($stmt_insert_ap_total)) {
                                throw new Exception("Error inserting AP totals: " . mysqli_error($con));
                            }
                            mysqli_stmt_close($stmt_insert_ap_total);
                        }
                        
                        mysqli_stmt_close($stmt_fetch_ap_totals);
                    }
                } else {
                    // Handle non-attribute totals (TA, BF)
                    // Check if the total already exists
                    $sql_fetch_ap_totals = "SELECT * FROM tb_rao_mooe_ap_totals WHERE total_type = ? AND rao_mooe_id = ? AND isDisplayed = 1";
                    $stmt_fetch_ap_totals = mysqli_prepare($con, $sql_fetch_ap_totals);
                    mysqli_stmt_bind_param($stmt_fetch_ap_totals, "si", $identifier, $rao_mooe_id);
                    
                    if (!mysqli_stmt_execute($stmt_fetch_ap_totals)) {
                        throw new Exception("Error fetching AP totals: " . mysqli_error($con));
                    }
                    
                    mysqli_stmt_store_result($stmt_fetch_ap_totals);
                    
                    if (mysqli_stmt_num_rows($stmt_fetch_ap_totals) > 0) {
                        // Total exists, update the value
                        $sql_update_ap_total = "UPDATE tb_rao_mooe_ap_totals 
                                                SET attribute_value = ? 
                                                WHERE total_type = ? AND rao_mooe_id = ? AND isDisplayed = 1";
                        $stmt_update_ap_total = mysqli_prepare($con, $sql_update_ap_total);
                        mysqli_stmt_bind_param($stmt_update_ap_total, 'dsi', $values, $identifier, $rao_mooe_id);
                        
                        if (!mysqli_stmt_execute($stmt_update_ap_total)) {
                            throw new Exception("Error updating AP totals: " . mysqli_error($con));
                        }
                        mysqli_stmt_close($stmt_update_ap_total);
                    } else {
                        // Total doesn't exist, insert a new record
                        $sql_insert_ap_total = "INSERT INTO tb_rao_mooe_ap_totals (rao_mooe_id, total_type, attribute_value, isDisplayed) 
                                                VALUES (?, ?, ?, 1)";
                        $stmt_insert_ap_total = mysqli_prepare($con, $sql_insert_ap_total);
                        mysqli_stmt_bind_param($stmt_insert_ap_total, 'isd', $rao_mooe_id, $identifier, $values);
                        
                        if (!mysqli_stmt_execute($stmt_insert_ap_total)) {
                            throw new Exception("Error inserting AP totals: " . mysqli_error($con));
                        }
                        mysqli_stmt_close($stmt_insert_ap_total);
                    }
                    
                    mysqli_stmt_close($stmt_fetch_ap_totals);
                }
            }
        }
        

// Similarly for OB totals:
    if (isset($_POST['ob_totals']) && is_array($_POST['ob_totals'])) {
        foreach ($_POST['ob_totals'] as $identifier => $values) {
            if (is_array($values)) {
                foreach ($values as $attributeId => $totalValue) {
                    // Check if the OB total already exists for this attributeId and total_type
                    $sql_fetch_ob_totals = "SELECT * FROM tb_rao_mooe_ob_totals 
                                            WHERE rao_mooe_att_id = ? AND total_type = ? AND rao_mooe_id = ? AND isDisplayed = 1";
                    $stmt_fetch_ob_totals = mysqli_prepare($con, $sql_fetch_ob_totals);
                    mysqli_stmt_bind_param($stmt_fetch_ob_totals, "isi", $attributeId, $identifier, $rao_mooe_id);
                    
                    if (!mysqli_stmt_execute($stmt_fetch_ob_totals)) {
                        throw new Exception("Error fetching OB totals: " . mysqli_error($con));
                    }
                    
                    mysqli_stmt_store_result($stmt_fetch_ob_totals);
                    
                    if (mysqli_stmt_num_rows($stmt_fetch_ob_totals) > 0) {
                        // Record exists, update the total value
                        $sql_update_ob_total = "UPDATE tb_rao_mooe_ob_totals 
                                                SET attribute_value = ? 
                                                WHERE rao_mooe_att_id = ? AND total_type = ? AND rao_mooe_id = ? AND isDisplayed = 1";
                        $stmt_update_ob_total = mysqli_prepare($con, $sql_update_ob_total);
                        mysqli_stmt_bind_param($stmt_update_ob_total, 'disi', $totalValue, $attributeId, $identifier, $rao_mooe_id);
                        
                        if (!mysqli_stmt_execute($stmt_update_ob_total)) {
                            throw new Exception("Error updating OB totals: " . mysqli_error($con));
                        }
                        mysqli_stmt_close($stmt_update_ob_total);
                    } else {
                        // Record doesn't exist, insert new record
                        // Fetch the attribute name
                        $sql_fetch_att_name = "SELECT attribute_name FROM tb_rao_mooe_attributes WHERE rao_mooe_att_id = ? AND isDisplayed = 1";
                        $stmt_fetch_att_name = mysqli_prepare($con, $sql_fetch_att_name);
                        mysqli_stmt_bind_param($stmt_fetch_att_name, "i", $attributeId);
                        
                        if (!mysqli_stmt_execute($stmt_fetch_att_name)) {
                            throw new Exception("Error fetching OB attribute name: " . mysqli_error($con));
                        }
                        
                        mysqli_stmt_bind_result($stmt_fetch_att_name, $attributeName);
                        mysqli_stmt_fetch($stmt_fetch_att_name);
                        mysqli_stmt_free_result($stmt_fetch_att_name);
    
                        // Insert new OB total
                        $sql_insert_ob_total = "INSERT INTO tb_rao_mooe_ob_totals 
                                              (rao_mooe_id, total_type, rao_mooe_att_id, attribute_name, attribute_value, isDisplayed) 
                                              VALUES (?, ?, ?, ?, ?, 1)";
                        $stmt_insert_ob_total = mysqli_prepare($con, $sql_insert_ob_total);
                        mysqli_stmt_bind_param($stmt_insert_ob_total, 'isisd', $rao_mooe_id, $identifier, $attributeId, $attributeName, $totalValue);
                        
                        if (!mysqli_stmt_execute($stmt_insert_ob_total)) {
                            throw new Exception("Error inserting OB totals: " . mysqli_error($con));
                        }
                        mysqli_stmt_close($stmt_insert_ob_total);
                    }
                    
                    mysqli_stmt_close($stmt_fetch_ob_totals);
                }
            } else {
                // Handle non-attribute totals (TO, OB, AB)
                // Check if the total already exists
                $sql_fetch_ob_totals = "SELECT * FROM tb_rao_mooe_ob_totals WHERE total_type = ? AND rao_mooe_id = ? AND isDisplayed = 1";
                $stmt_fetch_ob_totals = mysqli_prepare($con, $sql_fetch_ob_totals);
                mysqli_stmt_bind_param($stmt_fetch_ob_totals, "si", $identifier, $rao_mooe_id);
                
                if (!mysqli_stmt_execute($stmt_fetch_ob_totals)) {
                    throw new Exception("Error fetching OB totals: " . mysqli_error($con));
                }
                
                mysqli_stmt_store_result($stmt_fetch_ob_totals);
                
                if (mysqli_stmt_num_rows($stmt_fetch_ob_totals) > 0) {
                    // Total exists, update the value
                    $sql_update_ob_total = "UPDATE tb_rao_mooe_ob_totals 
                                            SET attribute_value = ? 
                                            WHERE total_type = ? AND rao_mooe_id = ? AND isDisplayed = 1";
                    $stmt_update_ob_total = mysqli_prepare($con, $sql_update_ob_total);
                    mysqli_stmt_bind_param($stmt_update_ob_total, 'dsi', $values, $identifier, $rao_mooe_id);
                    
                    if (!mysqli_stmt_execute($stmt_update_ob_total)) {
                        throw new Exception("Error updating OB totals: " . mysqli_error($con));
                    }
                    mysqli_stmt_close($stmt_update_ob_total);
                } else {
                    // Total doesn't exist, insert a new record
                    $sql_insert_ob_total = "INSERT INTO tb_rao_mooe_ob_totals (rao_mooe_id, total_type, attribute_value, isDisplayed) 
                                            VALUES (?, ?, ?, 1)";
                    $stmt_insert_ob_total = mysqli_prepare($con, $sql_insert_ob_total);
                    mysqli_stmt_bind_param($stmt_insert_ob_total, 'isd', $rao_mooe_id, $identifier, $values);
                    
                    if (!mysqli_stmt_execute($stmt_insert_ob_total)) {
                        throw new Exception("Error inserting OB totals: " . mysqli_error($con));
                    }
                    mysqli_stmt_close($stmt_insert_ob_total);
                }
                
                mysqli_stmt_close($stmt_fetch_ob_totals);
            }
        }
    }
    

    mysqli_commit($con);
    $response = ['status' => 'true', 'message' => 'Data successfully updated'];

} catch (Exception $e) {
    mysqli_rollback($con);
    $response = ['status' => 'false', 'error' => $e->getMessage()];
    error_log("Error updating data: " . $e->getMessage());
}

mysqli_close($con);
echo json_encode($response);
?>
