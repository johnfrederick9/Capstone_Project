<?php 
include('../../connection.php');

$requester_name = mysqli_real_escape_string($con, $_POST["requester_name"]);

// Check if the requester_name exists in resident_tb
$resident_check_sql = "SELECT * FROM `tb_resident` WHERE CONCAT(
    TRIM(LOWER(resident_firstname)), ' ',
    TRIM(LOWER(IF(resident_middlename != '' AND resident_middlename IS NOT NULL, CONCAT(LEFT(resident_middlename, 1), '.'), ''))), ' ',
    TRIM(LOWER(resident_lastname)),
    IFNULL(TRIM(LOWER(CONCAT(' ', resident_suffixes))), '')
) = TRIM(LOWER('$requester_name'))";
$resident_check_query = mysqli_query($con, $resident_check_sql);

if (mysqli_num_rows($resident_check_query) == 0) {
    // requester_name does not exist in resident_tb
    echo json_encode(array('status' => 'not_found'));
    exit;
}

// Check for duplicate project
$check_sql = "SELECT * FROM `tb_request` WHERE `requester_name` = '$requester_name'";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // Request already exists
    echo json_encode(array('status' => 'duplicate'));
    exit;
}

$request_type = mysqli_real_escape_string($con, $_POST["request_type"]);
$request_description = mysqli_real_escape_string($con, $_POST["request_description"]);
$request_date = mysqli_real_escape_string($con, $_POST["request_date"]);
$request_status = mysqli_real_escape_string($con, $_POST["request_status"]);

$sql = "INSERT INTO `tb_request` (`requester_name`,`request_type`,`request_description`,`request_date`,`request_status`,`isDisplayed`) 
        VALUES ('$requester_name','$request_type','$request_description','$request_date','$request_status',1)";
$query = mysqli_query($con, $sql);

if ($query) {
    echo json_encode(array('status' => 'true'));
} else {
    echo json_encode(array('status' => 'false'));
}
?>
