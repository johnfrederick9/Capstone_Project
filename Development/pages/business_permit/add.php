<?php 
include('../../connection.php');

$permit_name = mysqli_real_escape_string($con, $_POST["permit_name"]);

// Check for duplicate permit
$check_sql = "SELECT * FROM `tb_permit` WHERE `permit_name` = '$permit_name' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // Document exists
    echo json_encode(array('status' => 'duplicate'));
    exit;
}

$permit_name =  mysqli_real_escape_string($con, $_POST["permit_name"]);
$permit_business =  mysqli_real_escape_string($con, $_POST["permit_business"]);
$permit_locate =  mysqli_real_escape_string($con, $_POST["permit_locate"]);
$permit_date = mysqli_real_escape_string($con, $_POST["permit_date"]);
$permit_paid = mysqli_real_escape_string($con, $_POST["permit_paid"]);
$permit_dst = mysqli_real_escape_string($con, $_POST["permit_dst"]);

        
$sql = "INSERT INTO `tb_permit` (`permit_name`,`permit_business`,`permit_locate`,`permit_date`,`permit_paid`,`permit_dst`,`isDisplayed`) values ('$permit_name', '$permit_business', '$permit_locate', '$permit_date', '$permit_paid', '$permit_dst',1)";
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