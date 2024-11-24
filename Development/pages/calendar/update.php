<?php 
include('../../connection.php');


$event_name = $_POST['event_name'];
$response = [];

// Check for duplicate event
$check_sql = "SELECT * FROM `tb_event` WHERE `event_name` = '$event_name'  AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_event = mysqli_fetch_assoc($check_query);
    
    // Check if the duplicate is not the same as the current event being updated
    if (!isset($_POST['event_id']) || $existing_event['event_id'] != $_POST['event_id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['event_id'])) {
$event_id = $_POST['event_id'];
$event_name = $_POST["event_name"];
$event_location = $_POST["event_location"];
$event_type = $_POST["event_type"];
$event_start = $_POST["event_start"];
$event_end = $_POST["event_end"];
}

$sql = "UPDATE `tb_event` SET  `event_name`='$event_name' , `event_location`= '$event_location', `event_type`='$event_type',  `event_start`='$event_start', `event_end`='$event_end' WHERE event_id='$event_id' ";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>