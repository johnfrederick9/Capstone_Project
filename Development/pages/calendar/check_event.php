<?php
include('../../connection.php');

if (isset($_POST['event_date'])) {
    $event_date = $_POST['event_date'];

    $query = "SELECT COUNT(*) as event_count FROM tb_event WHERE event_start = '$event_date' OR event_end = '$event_date'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    echo json_encode(['hasEvent' => $row['event_count'] > 0]);
}
?>
