<?php
include '../database.php'; // Adjust based on your structure

$sql = "SELECT * FROM tb_event WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($events);
?>
