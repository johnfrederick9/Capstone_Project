<?php include('../../connection.php');

$resident_id = $_POST['resident_id'];
$sql = "SELECT * FROM tb_resident WHERE resident_id='$resident_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
