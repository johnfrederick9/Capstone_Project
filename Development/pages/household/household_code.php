<?php
require '../../database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $household_id = $_POST['household_id'];
    $household_familymembers = $_POST['household_familymembers'];
    $household_familyhead = $_POST['household_familyhead'];

    // Check if fields are not empty
    if (isset($household_familyhead) && !empty($household_familyhead)) {
        $sql = "INSERT INTO household_tb (household_id, total_members, family_head) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $household_id, $household_familymembers, $household_familyhead);
        
        if ($stmt->execute()) {
            echo "New household record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $stmt->close();
    } else {
        echo "Please fill in all required fields.";
    }
    
    $conn->close();
}
?>
