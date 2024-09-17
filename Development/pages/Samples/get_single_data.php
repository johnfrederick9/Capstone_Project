<?php include('../../connection.php');

$financial_id = $_POST['financial_id'];
$sql = "SELECT * FROM tb_financial WHERE financial_id='$financial_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
