<?php
include('../../connection.php');

$household_name = $_POST["household_name"];
$response = [];

// Check for duplicate resident
$check_sql = "SELECT * FROM `tb_household` WHERE `household_name` = '$household_name' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_household = mysqli_fetch_assoc($check_query);
    
    // Check if the duplicate is not the same as the current resident being updated
    if (!isset($_POST['id']) || $existing_household['id'] != $_POST['id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['id'])) {
    // Perform update if no duplicate exists
    $id = $_POST['id'];
    $household_name = $_POST['household_name'];
    $household_head = $_POST['household_head'];
    $household_address = $_POST['household_address'];
    $household_contact = $_POST['household_contact'];

    // Format contact number
    if (preg_match('/^0/', $household_contact)) {
        $household_contact = '+63' . substr($household_contact, 1);
    }
    $household_contact = preg_replace('/\+63(\d{3})(\d{3})(\d{4})/', '+63 $1 $2 $3', $household_contact);

    // Update query
    $update_sql = "UPDATE tb_household SET 
        household_name='$household_name',
        household_head='$household_head',
        household_address='$household_address',
        household_contact='$household_contact'
        WHERE id='$id'";

    $result = mysqli_query($con, $update_sql);

    if ($result) {
        $response['status'] = 'true';
    } else {
        $response['status'] = 'false';
    }
} else {
    $response['status'] = 'false';
}

echo json_encode($response);
?>
