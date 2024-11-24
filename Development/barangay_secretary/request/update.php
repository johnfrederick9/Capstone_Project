<?php 
include('../../connection.php');


$requester_name = $_POST['requester_name'];
$response = [];

// Check for duplicate request
$check_sql = "SELECT * FROM `tb_request` WHERE `requester_name` = '$requester_name'";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_request = mysqli_fetch_assoc($check_query);
    
    // Check if the duplicate is not the same as the current request being updated
    if (!isset($_POST['request_id']) || $existing_request['request_id'] != $_POST['request_id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['request_id'])) {
$request_id = $_POST['request_id'];
$requester_name = $_POST["requester_name"];
$request_type = $_POST["request_type"];
$request_description = $_POST["request_description"];
$request_date = $_POST["request_date"];
$request_status = $_POST["request_status"];
}

$sql = "UPDATE `tb_request` SET  `requester_name`='$requester_name' , `request_type`= '$request_type', `request_description`='$request_description',  `request_date`='$request_date', `request_status`='$request_status' WHERE request_id='$request_id' ";
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