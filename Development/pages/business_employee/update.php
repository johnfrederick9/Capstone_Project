<?php 
include('../../connection.php');

$bemp_name = $_POST['bemp_name'];
$response = [];

// Check for duplicate bemp
$check_sql = "SELECT * FROM `tb_business_m` WHERE `bemp_name` = '$bemp_name' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_bemp = mysqli_fetch_assoc($check_query);
    
    // Check if the duplicate is not the same as the current bemp being updated
    if (!isset($_POST['bemp_id']) || $existing_bemp['bemp_id'] != $_POST['bemp_id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['bemp_id'])) {
$bemp_id = $_POST['bemp_id'];
$bemp_name = $_POST['bemp_name'];
$bemp_employed = $_POST['bemp_employed'];
$bemp_address = $_POST['bemp_address'];
$bemp_locate = $_POST['bemp_locate'];
$bemp_date = $_POST['bemp_date'];
$bemp_paid = $_POST['bemp_paid'];
$bemp_dst = $_POST['bemp_dst'];
}

$sql = "UPDATE `tb_business_m` SET  `bemp_name`='$bemp_name' , `bemp_employed`= '$bemp_employed', 
`bemp_locate`='$bemp_locate', `bemp_address`='$bemp_address', `bemp_date`='$bemp_date', `bemp_paid`='$bemp_paid'
, `bemp_dst`='$bemp_dst' WHERE bemp_id='$bemp_id' ";
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