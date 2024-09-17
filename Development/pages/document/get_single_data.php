<?php include('../../connection.php');

$document_id = $_POST['document_id'];
$sql = "SELECT * FROM tb_document WHERE document_id='$document_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
