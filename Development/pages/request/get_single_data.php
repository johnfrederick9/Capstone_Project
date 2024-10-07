<?php include('../../connection.php');

$request_id = $_POST['request_id'];
$sql = "SELECT * FROM tb_request WHERE request_id='$request_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
