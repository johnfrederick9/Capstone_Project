<?php 
include('../../connection.php');

$residency_name = $_POST['residency_name'];
$response = [];

// Check for duplicate residency
$check_sql = "SELECT * FROM `tb_residency` WHERE `residency_name` = '$residency_name' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_residency = mysqli_fetch_assoc($check_query);
    
    // Check if the duplicate is not the same as the current residency being updated
    if (!isset($_POST['residency_id']) || $existing_residency['residency_id'] != $_POST['residency_id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['residency_id'])) {
$residency_id = $_POST['residency_id'];
$residency_name = $_POST['residency_name'];
$residency_issued = $_POST['residency_issued'];
$residency_date = $_POST['residency_date'];
$residency_paid = $_POST['residency_paid'];
$residency_dst = $_POST['residency_dst'];
}

$sql = "UPDATE `tb_residency` SET  `residency_name`='$residency_name' , `residency_issued`= '$residency_issued', 
`residency_date`='$residency_date',  `residency_paid`='$residency_paid' WHERE residency_dst='$residency_dst' ";
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