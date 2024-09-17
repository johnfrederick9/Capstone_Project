<?php include('../../connection.php');

$employee_id = $_POST['employee_id'];
$sql = "SELECT * FROM tb_employee WHERE employee_id='$employee_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
