<?php 
include('../../connection.php');

$residency_name = mysqli_real_escape_string($con, $_POST["residency_name"]);

// Check for duplicate residency
$check_sql = "SELECT * FROM `tb_residency` WHERE `residency_name` = '$residency_name' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // Document exists
    echo json_encode(array('status' => 'duplicate'));
    exit;
}

$residency_name =  mysqli_real_escape_string($con, $_POST["residency_name"]);
$residency_issued =  mysqli_real_escape_string($con, $_POST["residency_issued"]);
$residency_date =  mysqli_real_escape_string($con, $_POST["residency_date"]);
$residency_paid = mysqli_real_escape_string($con, $_POST["residency_paid"]);
$residency_dst = mysqli_real_escape_string($con, $_POST["residency_dst"]);

        
$sql = "INSERT INTO `tb_residency` (`residency_name`,`residency_issued`,`residency_date`,`residency_paid`,`residency_dst`,`isDisplayed`) values ('$residency_name', '$residency_issued', '$residency_date', '$residency_paid','$residency_dst',1)";
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