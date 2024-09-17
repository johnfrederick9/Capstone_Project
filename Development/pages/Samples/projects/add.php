<?php 
include('../../connection.php');
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


        
$sql = "INSERT INTO `tb_project` (`project_name`,`project_start`,`project_end`,`project_budget`,`project_source`,`project_location`,`project_managers`,`project_stakeholders`,`project_status`,`project_description`) values ('$project_name', '$project_start', '$project_end', '$project_budget', '$project_source', '$project_location', '$project_managers', '$project_stakeholders', '$project_status', '$project_description')";
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