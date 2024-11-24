<?php include('../../connection.php');

$permit_id = $_POST['permit_id'];
$sql = "SELECT * FROM tb_permit WHERE permit_id='$permit_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
