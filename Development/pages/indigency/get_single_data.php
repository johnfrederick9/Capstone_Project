<?php include('../../connection.php');

$indigency_id = $_POST['indigency_id'];
$sql = "SELECT * FROM tb_indigency WHERE indigency_id='$indigency_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
