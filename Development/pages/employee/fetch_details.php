<?php
include('../../connection.php'); // Ensure correct database connection


if (isset($_POST['employee_id'])) {
    $employee_id = $_POST['employee_id'];

    $employee_id = $_POST['employee_id'];
    $sql = "SELECT * FROM tb_employee WHERE employee_id='$employee_id' LIMIT 1";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    echo json_encode($row);    
    
} else {
    echo json_encode(['error' => 'employee ID not provided']);
}
?>