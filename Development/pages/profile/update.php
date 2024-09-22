<?php 
include('../../connection.php');
$item_name = $_POST['item_name'];
$item_description = $_POST['item_description'];
$item_count = $_POST['item_count'];
$item_status = $_POST['item_status'];
$item_id = $_POST['item_id'];

$sql = "UPDATE `tb_inventory` SET  `item_name`='$item_name' , `item_description`= '$item_description', 
`item_count`='$item_count',  `item_status`='$item_status' WHERE item_id='$item_id' ";
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