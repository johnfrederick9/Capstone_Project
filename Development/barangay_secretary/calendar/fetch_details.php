<?php
include('../../connection.php'); // Ensure correct database connection


if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    $event_id = $_POST['event_id'];
    $sql = "SELECT * FROM tb_event WHERE event_id='$event_id' LIMIT 1";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    echo json_encode($row);    
    
} else {
    echo json_encode(['error' => 'event ID not provided']);
}
?>