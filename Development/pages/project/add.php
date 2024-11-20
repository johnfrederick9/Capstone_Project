<?php 
include('../../connection.php');

$project_name = mysqli_real_escape_string($con, $_POST["project_name"]);

// Check for duplicate project
$check_sql = "SELECT * FROM `tb_project` WHERE `project_name` = '$project_name' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // Document exists
    echo json_encode(array('status' => 'duplicate'));
    exit;
}

$project_start = mysqli_real_escape_string($con, $_POST["project_start"]);
$project_end = mysqli_real_escape_string($con, $_POST["project_end"]);
$project_budget = mysqli_real_escape_string($con, $_POST["project_budget"]);
$project_source = mysqli_real_escape_string($con, $_POST["project_source"]);
$project_location = mysqli_real_escape_string($con, $_POST["project_location"]);
$project_description = mysqli_real_escape_string($con, $_POST["project_description"]);
$project_managers = mysqli_real_escape_string($con, $_POST["project_managers"]);
$project_stakeholders = mysqli_real_escape_string($con, $_POST["project_stakeholders"]);
$project_status = mysqli_real_escape_string($con, $_POST["project_status"]);


        
$sql = "INSERT INTO `tb_project` (`project_name`,`project_start`,`project_end`,`project_budget`,`project_source`,`project_location`,`project_managers`,`project_stakeholders`,`project_status`,`project_description`,`isDisplayed`) values ('$project_name', '$project_start', '$project_end', '$project_budget', '$project_source', '$project_location', '$project_managers', '$project_stakeholders', '$project_status', '$project_description',1)";
$query = mysqli_query($con, $sql);
    
if ($query) {
    echo json_encode(array('status' => 'true'));
} else {
    echo json_encode(array('status' => 'false'));
}
?>