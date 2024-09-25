<?php 
include('../../connection.php');

$item_id = $_POST['item_id'];
$sql = "UPDATE tb_inventory SET isDisplayed = 0 WHERE item_id='$item_id'";
$delQuery =mysqli_query($con,$sql);
if($delQuery==true)
{
	 $data = array(
        'status'=>'success',       
    );
    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'failed',   
    );
    echo json_encode($data);
} 

?>