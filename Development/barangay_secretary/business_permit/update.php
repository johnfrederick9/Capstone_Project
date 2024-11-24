<?php 
include('../../connection.php');

$permit_name = $_POST['permit_name'];
$response = [];

// Check for duplicate permit
$check_sql = "SELECT * FROM `tb_permit` WHERE `permit_name` = '$permit_name' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_permit = mysqli_fetch_assoc($check_query);
    
    // Check if the duplicate is not the same as the current permit being updated
    if (!isset($_POST['permit_id']) || $existing_permit['permit_id'] != $_POST['permit_id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['permit_id'])) {
$permit_id = $_POST['permit_id'];
$permit_name = $_POST['permit_name'];
$permit_business = $_POST['permit_business'];
$permit_locate = $_POST['permit_locate'];
$permit_date = $_POST['permit_date'];
$permit_paid = $_POST['permit_paid'];
$permit_dst = $_POST['permit_dst'];
}

$sql = "UPDATE `tb_permit` SET  `permit_name`='$permit_name' , `permit_business`= '$permit_business', 
`permit_locate`='$permit_locate', `permit_date`='$permit_date', `permit_paid`='$permit_paid'
, `permit_dst`='$permit_dst' WHERE permit_id='$permit_id' ";
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