<?php
include('../../connection.php'); // Ensure correct database connection


if (isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];

    $project_id = $_POST['project_id'];
    $sql = "SELECT * FROM tb_project WHERE project_id='$project_id' LIMIT 1";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    echo json_encode($row);    
    
} else {
    echo json_encode(['error' => 'project ID not provided']);
}
?>