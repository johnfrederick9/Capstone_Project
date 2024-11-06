<?php 
include('../../connection.php');

$blotter_complainant = mysqli_real_escape_string($con, $_POST["blotter_complainant"]);
$blotter_complainee = mysqli_real_escape_string($con, $_POST["blotter_complainee"]);

// Check for duplicate project
$check_sql = "SELECT * FROM `tb_blotter` WHERE `blotter_complainant` = '$blotter_complainant' AND `blotter_complainee` = '$blotter_complainee' ";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // Blotter exists
    echo json_encode(array('status' => 'duplicate'));
    exit;
}
$blotter_complainant_no = mysqli_real_escape_string($con, $_POST["blotter_complainant_no"]);
$blotter_complainant_add = mysqli_real_escape_string($con, $_POST["blotter_complainant_add"]);
$blotter_complainee_no = mysqli_real_escape_string($con, $_POST["blotter_complainee_no"]);
$blotter_complainee_add = mysqli_real_escape_string($con, $_POST["blotter_complainee_add"]);
$blotter_complaint = mysqli_real_escape_string($con, $_POST["blotter_complaint"]);
$blotter_status = mysqli_real_escape_string($con, $_POST["blotter_status"]);
$blotter_action = mysqli_real_escape_string($con, $_POST["blotter_action"]);
$blotter_incidence = mysqli_real_escape_string($con, $_POST["blotter_incidence"]);
$blotter_date_recorded = mysqli_real_escape_string($con, $_POST["blotter_date_recorded"]);
$blotter_date_settled = mysqli_real_escape_string($con, $_POST["blotter_date_settled"]);
$blotter_recorded_by = mysqli_real_escape_string($con, $_POST["blotter_recorded_by"]);
        
$sql = "INSERT INTO `tb_blotter` (`blotter_complainant`,`blotter_complainant_no`,`blotter_complainant_add`,`blotter_complainee`,`blotter_complainee_no`,`blotter_complainee_add`,`blotter_complaint`,`blotter_status`,`blotter_action`,`blotter_incidence`,`blotter_date_recorded`,`blotter_date_settled`,`blotter_recorded_by`,`isDisplayed`) values ('$blotter_complainant', '$blotter_complainant_no', '$blotter_complainant_add', '$blotter_complainee', '$blotter_complainee_no', '$blotter_complainee_add', '$blotter_complaint', '$blotter_status', '$blotter_action', '$blotter_incidence', '$blotter_date_recorded', '$blotter_date_settled', '$blotter_recorded_by',1)";
$query = mysqli_query($con, $sql);
    
if ($query) {
    echo json_encode(array('status' => 'true'));
} else {
    echo json_encode(array('status' => 'false'));
}

?>