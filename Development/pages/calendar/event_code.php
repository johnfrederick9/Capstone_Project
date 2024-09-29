<?php
// Check if the form is submitted and specifically for saving an event
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_event'])) {
    // Capture form data
    $event_name = $_POST['event_name'] ?? '';
    $event_location = $_POST['event_location'] ?? '';
    $event_type = $_POST['event_type'] ?? '';
    $event_start = $_POST['event_start'] ?? '';
    $event_end = $_POST['event_end'] ?? '';

    // Validate and sanitize the input
    $event_name = $conn->real_escape_string($event_name);
    $event_location = $conn->real_escape_string($event_location);
    $event_type = $conn->real_escape_string($event_type);
    $event_start = $conn->real_escape_string($event_start);
    $event_end = $conn->real_escape_string($event_end);

    // Check if required fields are not empty
    if (!empty($event_name) && !empty($event_location) && !empty($event_type) && !empty($event_start) && !empty($event_end)) {
        // Insert data into the database
        $sql = "INSERT INTO tb_event (event_name, event_location, event_type, event_start, event_end)
                VALUES ('$event_name', '$event_location', '$event_type', '$event_start', '$event_end')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully');</script>";
        } else {
            echo "<script>alert('Error: " . $sql . " - " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error: All fields are required.');</script>";
    }

    $conn->close();
}
?>
