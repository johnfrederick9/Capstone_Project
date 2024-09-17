<?php 
include('../../connection.php');
$indigency_cname = $_POST['indigency_cname'];
$indigency_mname = $_POST['indigency_mname'];
$indigency_fname = $_POST['indigency_fname'];
$indigency_date = $_POST['indigency_date'];
$indigency_id = $_POST['indigency_id'];

$sql = "UPDATE `tb_indigency` SET  `indigency_cname`='$indigency_cname' , `indigency_mname`= '$indigency_mname', 
`indigency_fname`='$indigency_fname',  `indigency_date`='$indigency_date' WHERE indigency_id='$indigency_id' ";
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