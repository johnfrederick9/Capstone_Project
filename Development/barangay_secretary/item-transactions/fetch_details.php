<?php
include('../../connection.php'); // Ensure correct database connection


if (isset($_POST['transaction_id'])) {
    $transaction_id = $_POST['transaction_id'];

    $transaction_id = $_POST['transaction_id'];
    $sql = "SELECT * FROM tb_item_transaction WHERE transaction_id='$transaction_id' LIMIT 1";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    echo json_encode($row);    
    
} else {
    echo json_encode(['error' => 'transaction ID not provided']);
}
?>