<?php include('../../connection.php');
$user_id = $_POST['user_id'];
$sql = "SELECT * FROM tb_user WHERE user_id='$user_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
