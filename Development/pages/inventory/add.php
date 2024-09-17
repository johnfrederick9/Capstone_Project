<?php 
include('../../connection.php');
$item_name = $_POST['item_name'];
$item_description = $_POST['item_description'];
$item_count = $_POST['item_count'];
$item_status = $_POST['item_status'];

$sql = "INSERT INTO `tb_inventory` (`item_name`,`item_description`,`item_count`,`item_status`) values ('$item_name', '$item_description', '$item_count', '$item_status' )";
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