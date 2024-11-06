<?php 
include('../../connection.php');
$indigency_cname = $_POST["indigency_cname"];
$indigency_mname = $_POST["indigency_mname"];
$indigency_fname = $_POST["indigency_fname"];
$indigency_date = $_POST["indigency_date"];

        
$sql = "INSERT INTO `tb_indigency` (`indigency_cname`,`indigency_mname`,`indigency_fname`,`indigency_date`) values ('$indigency_cname', '$indigency_mname', '$indigency_fname', '$indigency_date')";
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