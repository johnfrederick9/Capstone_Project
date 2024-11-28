<?php
// Include the database connection file
include('../../database.php');

// Ensure the database connection is valid
if (!isset($conn) || $conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}

// Check if the household_id parameter is set in the GET request
if (isset($_GET['household_id'])) {
    // Sanitize and cast the household_id to an integer
    $household_id = intval($_GET['household_id']);
    
    // Prepare the SQL query to fetch residents based on household_id
    $query = "SELECT 
                  CONCAT(resident_firstname, ' ', resident_middlename, ' ', resident_lastname) AS full_name,
                  resident_householdrole 
              FROM 
                  tb_resident 
              WHERE 
                  household_id = ?";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $household_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $members = [];
        while ($row = $result->fetch_assoc()) {
            $members[] = $row; // Add each member to the array
        }
        
        $stmt->close();

        // Return the members as a JSON response
        header('Content-Type: application/json');
        echo json_encode($members);
    } else {
        // Handle errors with preparing the SQL statement
        http_response_code(500);
        echo json_encode(["error" => "Failed to prepare the SQL statement."]);
    }
} else {
    // If household_id is not provided, return an error response
    http_response_code(400);
    echo json_encode(["error" => "household_id parameter is required."]);
}
?>
