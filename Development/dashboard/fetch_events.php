<?php
include '../database.php'; // Adjust based on your structure

$sql = "SELECT * FROM tb_event";
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
