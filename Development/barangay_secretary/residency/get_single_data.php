<?php include('../../connection.php');

$residency_id = $_POST['residency_id'];
$sql = "SELECT * FROM tb_residency WHERE residency_id='$residency_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
