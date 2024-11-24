<?php 
include('../../connection.php');

$indigency_cname = $_POST['indigency_cname'];
$response = [];

// Check for duplicate indigency
$check_sql = "SELECT * FROM `tb_indigency` WHERE `indigency_cname` = '$indigency_cname' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_indigency = mysqli_fetch_assoc($check_query);
    
    // Check if the duplicate is not the same as the current indigency being updated
    if (!isset($_POST['indigency_id']) || $existing_indigency['indigency_id'] != $_POST['indigency_id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['indigency_id'])) {
$indigency_id = $_POST['indigency_id'];
$indigency_cname = $_POST['indigency_cname'];
$indigency_mname = $_POST['indigency_mname'];
$indigency_fname = $_POST['indigency_fname'];
$indigency_date = $_POST['indigency_date'];
$indigency_paid = $_POST['indigency_paid'];
$indigency_dst = $_POST['indigency_dst'];
}

$sql = "UPDATE `tb_indigency` SET  `indigency_cname`='$indigency_cname' , `indigency_mname`= '$indigency_mname', 
`indigency_fname`='$indigency_fname', `indigency_date`='$indigency_date', `indigency_paid`='$indigency_paid'
, `indigency_dst`='$indigency_dst' WHERE indigency_id='$indigency_id' ";
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