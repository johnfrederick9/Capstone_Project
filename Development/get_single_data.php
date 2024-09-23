<?php 
include('connection.php');

// Check if user_id is provided in the POST request
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Prepare the SQL statement to fetch the user data securely
    $stmt = $con->prepare("SELECT * FROM tb_user WHERE user_id = ? LIMIT 1");
    $stmt->bind_param("i", $user_id);  // 'i' means the parameter is an integer
    $stmt->execute();
    
    // Get the result and fetch data as an associative array
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Return the fetched data as JSON
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'No data found']);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(['error' => 'No user ID provided']);
}

// Close the database connection
$con->close();
?>
