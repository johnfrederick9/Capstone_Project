<?php include('../../connection.php');

$event_id = $_POST['event_id'];
$sql = "SELECT * FROM tb_event WHERE event_id='$event_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
