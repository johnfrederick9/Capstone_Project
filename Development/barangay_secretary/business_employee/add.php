<?php 
include('../../connection.php');

$bemp_name = mysqli_real_escape_string($con, $_POST["bemp_name"]);

// Check for duplicate bemp
$check_sql = "SELECT * FROM `tb_business_m` WHERE `bemp_name` = '$bemp_name' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // Document exists
    echo json_encode(array('status' => 'duplicate'));
    exit;
}

$bemp_name =  mysqli_real_escape_string($con, $_POST["bemp_name"]);
$bemp_employed =  mysqli_real_escape_string($con, $_POST["bemp_employed"]);
$bemp_address =  mysqli_real_escape_string($con, $_POST["bemp_address"]);
$bemp_locate =  mysqli_real_escape_string($con, $_POST["bemp_locate"]);
$bemp_date = mysqli_real_escape_string($con, $_POST["bemp_date"]);
$bemp_paid = mysqli_real_escape_string($con, $_POST["bemp_paid"]);
$bemp_dst = mysqli_real_escape_string($con, $_POST["bemp_dst"]);

        
$sql = "INSERT INTO `tb_business_m` (`bemp_name`,`bemp_employed`,`bemp_address`,`bemp_locate`,`bemp_date`,`bemp_paid`,`bemp_dst`,`isDisplayed`) values ('$bemp_name', '$bemp_employed', '$bemp_address', '$bemp_locate', '$bemp_date', '$bemp_paid', '$bemp_dst',1)";
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