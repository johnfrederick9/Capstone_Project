<?php 
include('../../connection.php');
$requester_name = $_POST["requester_name"];
$request_type = $_POST["request_type"];
$request_description = $_POST["request_description"];
$request_date = $_POST["request_date"];
$request_status = $_POST["request_status"];
$request_id = $_POST['request_id'];

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