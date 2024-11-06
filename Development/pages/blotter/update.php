<?php 
include('../../connection.php');

$blotter_complainant = $_POST['blotter_complainant'];
$blotter_complainee = $_POST['blotter_complainee'];
$response = [];

// Check for duplicate blotter
$check_sql = "SELECT * FROM `tb_blotter` WHERE `blotter_complainant` = '$blotter_complainant' AND `blotter_complainee` = '$blotter_complainee'";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_blotter = mysqli_fetch_assoc($check_query);
    
    // Check if the duplicate is not the same as the current blotter being updated
    if (!isset($_POST['blotter_id']) || $existing_blotter['blotter_id'] != $_POST['blotter_id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['blotter_id'])) {
$blotter_id = $_POST['blotter_id'];
$blotter_complainant = $_POST["blotter_complainant"];
$blotter_complainant_no = $_POST["blotter_complainant_no"];
$blotter_complainant_add = $_POST["blotter_complainant_add"];
$blotter_complainee = $_POST["blotter_complainee"];
$blotter_complainee_no = $_POST["blotter_complainee_no"];
$blotter_complainee_add = $_POST["blotter_complainee_add"];
$blotter_complaint = $_POST["blotter_complaint"];
$blotter_status = $_POST["blotter_status"];
$blotter_action = $_POST["blotter_action"];
$blotter_incidence = $_POST["blotter_incidence"];
$blotter_date_recorded = $_POST["blotter_date_recorded"];
$blotter_date_settled = $_POST["blotter_date_settled"];
$blotter_recorded_by = $_POST["blotter_recorded_by"];
}

$sql = "UPDATE `tb_blotter` SET  `blotter_complainant`='$blotter_complainant' , `blotter_complainant_no`= '$blotter_complainant_no', 
`blotter_complainant_add`='$blotter_complainant_add',  `blotter_complainee`='$blotter_complainee',  `blotter_complainee_no`='$blotter_complainee_no'
,  `blotter_complainee_add`='$blotter_complainee_add',  `blotter_complaint`='$blotter_complaint',  `blotter_status`='$blotter_status'
,  `blotter_action`='$blotter_action',  `blotter_incidence`='$blotter_incidence',  `blotter_date_recorded`='$blotter_date_recorded'
,  `blotter_date_settled`='$blotter_date_settled',  `blotter_recorded_by`='$blotter_recorded_by' WHERE blotter_id='$blotter_id' ";
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