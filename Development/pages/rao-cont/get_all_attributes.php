<?php
include('../../connection.php');

try {
    // Fetch attribute names
    $sql_fetch_att_name = "SELECT DISTINCT attribute_name FROM tb_rao_cont_attributes WHERE isDisplayed = 1"; // Ensure uniqueness at the query level
    $stmt_fetch_att_name = mysqli_prepare($con, $sql_fetch_att_name);

    if (!$stmt_fetch_att_name) {
        throw new Exception("Failed to prepare statement: " . mysqli_error($con));
    }

    if (!mysqli_stmt_execute($stmt_fetch_att_name)) {
        throw new Exception("Error executing query: " . mysqli_error($con));
    }

    mysqli_stmt_bind_result($stmt_fetch_att_name, $attributeName);
    $attributesSet = []; // Use an associative array to ensure uniqueness

    while (mysqli_stmt_fetch($stmt_fetch_att_name)) {
        $attributesSet[$attributeName] = [
            'label' => $attributeName,
            'value' => $attributeName
        ];
    }

    $attributes = array_values($attributesSet); // Convert unique set to indexed array

    mysqli_stmt_free_result($stmt_fetch_att_name);
    mysqli_stmt_close($stmt_fetch_att_name);

    // Prepare response
    $response = [
        'status' => 'true',
        'attributes' => $attributes
    ];
} catch (Exception $e) {
    // Send error response
    $response = ['status' => 'false', 'error' => $e->getMessage()];
    error_log("Error fetching attributes: " . $e->getMessage());
} finally {
    // Close the connection
    mysqli_close($con);
}

echo json_encode($response);
