<?php 
include('../../connection.php');

$event_name = $_POST["event_name"];
$event_location = $_POST["event_location"];
$event_type = $_POST["event_type"];
$event_start = $_POST["event_start"];
$event_end = $_POST["event_end"];
$event_id = $_POST['event_id'];

// Update query for the `tb_event` table
$sql = "UPDATE `tb_event` SET  
    `event_name` = '$event_name', 
    `event_location` = '$event_location', 
    `event_type` = '$event_type', 
    `event_start` = '$event_start', 
    `event_end` = '$event_end' 
    WHERE event_id = '$event_id'";

$query = mysqli_query($con, $sql);

if ($query == true) {
    $data = array(
        'status' => 'true'
    );

    echo json_encode($data);
} else {
    $data = array(
        'status' => 'false'
    );

    echo json_encode($data);
}
?>
