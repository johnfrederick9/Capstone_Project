<?php
// Include the database connection file
include('../../connection.php');

// Collect POST data from the form submission
$user_id = $_POST['user_id'];
$last_name = $_POST['lastname'];
$first_name = $_POST['firstname'];
$middle_name = $_POST['middlename'];
$suffix = $_POST['suffix'];
$sex = $_POST['sex'];
$birth_date = $_POST['birthdate'];
$username = $_POST['username'];

// Construct SQL query to update the user's profile in the database
$sql = "UPDATE `tb_users` 
        SET `lastname` = '$last_name', 
            `firstname` = '$first_name', 
            `middlename` = '$middle_name', 
            `suffix` = '$suffix', 
            `sex` = '$sex', 
            `birthdate` = '$birth_date', 
            `username` = '$username' 
        WHERE `user_id` = '$user_id'";

$query = mysqli_query($con, $sql);

// Check if the query was successful and return a JSON response
if ($query) {
    echo json_encode(['status' => 'true']);
} else {
    echo json_encode(['status' => 'false', 'error' => mysqli_error($con)]);
}
?>
