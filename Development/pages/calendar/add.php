<?php 
include('../../connection.php');


$event_name = mysqli_real_escape_string($con, $_POST["event_name"]);

// Check for duplicate project
$check_sql = "SELECT * FROM `tb_event` WHERE `event_name` = '$event_name'";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // Blotter exists
    echo json_encode(array('status' => 'duplicate'));
    exit;
}
$event_location = mysqli_real_escape_string($con, $_POST["event_location"]);
$event_type = mysqli_real_escape_string($con, $_POST["event_type"]);
$event_start = mysqli_real_escape_string($con, $_POST["event_start"]);
$event_end = mysqli_real_escape_string($con, $_POST["event_end"]);
        
$sql = "INSERT INTO `tb_event` (`event_name`,`event_location`,`event_type`,`event_start`,`event_end`,`isDisplayed`) values ('$event_name','$event_location','$event_type','$event_start','$event_end',1)";
$query = mysqli_query($con, $sql);
    
if ($query) {
    echo json_encode(array('status' => 'true'));
} else {
    echo json_encode(array('status' => 'false'));
}
?>