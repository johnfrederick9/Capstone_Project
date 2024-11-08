<?php
include('../../connection.php'); // Ensure correct database connection


if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    $item_id = $_POST['item_id'];
    $sql = "SELECT * FROM tb_inventory WHERE item_id='$item_id' LIMIT 1";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    echo json_encode($row);    
    
} else {
    echo json_encode(['error' => 'item ID not provided']);
}
?>