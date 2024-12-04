<?php
include('../../connection.php');

// Initialize an array to hold the attributes
$attributes = [];

try {
    // Validate rao_cocont_id
    if (!isset($_GET['rao_cocont_id']) || empty($_GET['rao_cocont_id'])) {
        throw new Exception("Missing or invalid rao_cocont_id");
    }
    $rao_cocont_id = intval($_GET['rao_cocont_id']);

    // Fetch attributes from tb_rao_cocont_attributes
    $sql_fetch_attr = "SELECT rao_cocont_att_id, attribute_name 
                       FROM tb_rao_cocont_attributes 
                       WHERE isDisplayed = 1 AND rao_cocont_id = ? 
                       ORDER BY rao_cocont_att_id ASC";
    
    $stmt = mysqli_prepare($con, $sql_fetch_attr);
    mysqli_stmt_bind_param($stmt, "i", $rao_cocont_id);
    
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Query execution failed: " . mysqli_error($con));
    }
    
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch all attributes with their IDs
    while ($row = mysqli_fetch_assoc($result)) {
        $attributes[] = [
            'rao_cocont_att_id' => $row['rao_cocont_att_id'],
            'attribute_name' => $row['attribute_name'],
            'has_ap_value' => false,
            'has_ob_value' => false
        ];
    }
    
    mysqli_stmt_close($stmt);

    // Check attribute values in tb_rao_cocont_ap_data and tb_rao_cocont_ob_data
    foreach ($attributes as &$attribute) {
        // Check tb_rao_cocont_ap_data for non-zero attribute values
        $sql_fetch_ap_data = "SELECT attribute_value 
                              FROM tb_rao_cocont_ap_data 
                              WHERE rao_cocont_att_id = ? AND attribute_name = ?";
        $stmt_ap = mysqli_prepare($con, $sql_fetch_ap_data);
        mysqli_stmt_bind_param($stmt_ap, "is", $attribute['rao_cocont_att_id'], $attribute['attribute_name']);
        
        if (mysqli_stmt_execute($stmt_ap)) {
            $result_ap = mysqli_stmt_get_result($stmt_ap);
            if ($row_ap = mysqli_fetch_assoc($result_ap)) {
                // Assuming 'attribute_value' is the field containing the actual value
                $attribute['has_ap_value'] = ($row_ap['attribute_value'] > 0);
            }
        } else {
            throw new Exception("Failed to execute query for AP data: " . mysqli_error($con));
        }
        mysqli_stmt_close($stmt_ap);

        // Check tb_rao_cocont_ob_data for non-zero attribute values
        $sql_fetch_ob_data = "SELECT attribute_value 
                              FROM tb_rao_cocont_ob_data 
                              WHERE rao_cocont_att_id = ? AND attribute_name = ?";
        $stmt_ob = mysqli_prepare($con, $sql_fetch_ob_data);
        mysqli_stmt_bind_param($stmt_ob, "is", $attribute['rao_cocont_att_id'], $attribute['attribute_name']);
        
        if (mysqli_stmt_execute($stmt_ob)) {
            $result_ob = mysqli_stmt_get_result($stmt_ob);
            if ($row_ob = mysqli_fetch_assoc($result_ob)) {
                // Assuming 'attribute_value' is the field containing the actual value
                $attribute['has_ob_value'] = ($row_ob['attribute_value'] > 0);
            }
        } else {
            throw new Exception("Failed to execute query for OB data: " . mysqli_error($con));
        }
        mysqli_stmt_close($stmt_ob);
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode(['attributes' => $attributes]);

} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}

// Close the connection
mysqli_close($con);
?>
