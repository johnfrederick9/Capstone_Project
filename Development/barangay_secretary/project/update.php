<?php 
include('../../connection.php');

$project_name = $_POST['project_name'];
$response = [];

// Check for duplicate project
$check_sql = "SELECT * FROM `tb_project` WHERE `project_name` = '$project_name' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_project = mysqli_fetch_assoc($check_query);
    
    // Check if the duplicate is not the same as the current project being updated
    if (!isset($_POST['project_id']) || $existing_project['project_id'] != $_POST['project_id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['project_id'])) {
$project_id = $_POST['project_id'];
$project_name = $_POST["project_name"];
$project_start = $_POST["project_start"];
$project_end = $_POST["project_end"];
$project_budget = $_POST["project_budget"];
$project_source = $_POST["project_source"];
$project_location = $_POST["project_location"];
$project_description = $_POST["project_description"];
$project_managers = $_POST["project_managers"];
$project_stakeholders = $_POST["project_stakeholders"];
$project_status = $_POST["project_status"];
}

$sql = "UPDATE `tb_project` SET  `project_name`='$project_name' , `project_start`= '$project_start', 
`project_end`='$project_end',  `project_budget`='$project_budget',  `project_source`='$project_source'
,  `project_location`='$project_location',  `project_description`='$project_description',  `project_managers`='$project_managers'
,  `project_stakeholders`='$project_stakeholders',  `project_status`='$project_status' WHERE project_id= '$project_id' ";
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