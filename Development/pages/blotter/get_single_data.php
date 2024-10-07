<?php include('../../connection.php');

$blotter_id = $_POST['blotter_id'];
$sql = "SELECT * FROM tb_blotter WHERE blotter_id='$blotter_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
