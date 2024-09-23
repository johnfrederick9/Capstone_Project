<?php 
include('../../connection.php');

// Get the user_id from the POST request
$user_id = $_POST['user_id'];

// Query to fetch the user data by ID
$sql = "SELECT * FROM tb_users WHERE user_id='$user_id' LIMIT 1";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($query);

// Return the fetched data as JSON
echo json_encode($row);
?>
