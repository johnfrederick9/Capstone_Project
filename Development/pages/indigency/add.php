<?php 
include('../../connection.php');

$indigency_cname = mysqli_real_escape_string($con, $_POST["indigency_cname"]);

// Check for duplicate indigency
$check_sql = "SELECT * FROM `tb_indigency` WHERE `indigency_cname` = '$indigency_cname' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // Document exists
    echo json_encode(array('status' => 'duplicate'));
    exit;
}

$indigency_cname =  mysqli_real_escape_string($con, $_POST["indigency_cname"]);
$indigency_mname =  mysqli_real_escape_string($con, $_POST["indigency_mname"]);
$indigency_fname =  mysqli_real_escape_string($con, $_POST["indigency_fname"]);
$indigency_date = mysqli_real_escape_string($con, $_POST["indigency_date"]);

        
$sql = "INSERT INTO `tb_indigency` (`indigency_cname`,`indigency_mname`,`indigency_fname`,`indigency_date`,`isDisplayed`) values ('$indigency_cname', '$indigency_mname', '$indigency_fname', '$indigency_date',1)";
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