<?php include('../../connection.php');

$bemp_id = $_POST['bemp_id'];
$sql = "SELECT * FROM tb_business_m WHERE bemp_id='$bemp_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
