<?php 
include('../../connection.php');

$employee_firstname = $_POST["employee_firstname"];
$employee_lastname = $_POST["employee_lastname"];
$response = [];

// Check for duplicate employee
$check_sql = "SELECT * FROM `tb_employee` WHERE `employee_firstname` = '$employee_firstname' AND `employee_lastname` = '$employee_lastname'";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_employee = mysqli_fetch_assoc($check_query);
    
    // Check if the duplicate is not the same as the current employee being updated
    if (!isset($_POST['employee_id']) || $existing_employee['employee_id'] != $_POST['employee_id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['employee_id'])) {
    $employee_id = $_POST["employee_id"];
    $employee_firstname = $_POST["employee_firstname"];
    $employee_middlename = $_POST["employee_middlename"];
    $employee_maidenname = $_POST["employee_maidenname"];
    $employee_lastname = $_POST["employee_lastname"];
    $employee_sex = $_POST["employee_sex"];
    $employee_suffixes = $_POST["employee_suffixes"];
    $employee_address = $_POST["employee_address"];
    $employee_educationalattainment = $_POST["employee_educationalattainment"];
    $employee_birthdate = $_POST["employee_birthdate"];
    $employee_status = $_POST["employee_status"];
    $employee_position = $_POST["employee_position"];
    $employee_contact = $_POST["employee_contact"];

    // Only add +63 if the number starts with 0
    if (preg_match('/^0/', $employee_contact)) {
        $employee_contact = '+63' . substr($employee_contact, 1); // Replace leading 0 with +63
    }

    // Format with spaces after every 3 digits following the +63 prefix
    $employee_contact = preg_replace('/\+63(\d{3})(\d{3})(\d{4})/', '+63 $1 $2 $3', $employee_contact);

    // Update SQL statement
    $update_sql = "UPDATE `tb_employee` SET  
        `employee_firstname`='$employee_firstname', 
        `employee_middlename`='$employee_middlename', 
        `employee_maidenname`='$employee_maidenname',  
        `employee_lastname`='$employee_lastname',  
        `employee_sex`='$employee_sex',  
        `employee_suffixes`='$employee_suffixes',  
        `employee_address`='$employee_address',  
        `employee_educationalattainment`='$employee_educationalattainment',  
        `employee_birthdate`='$employee_birthdate', 
        `employee_status`='$employee_status',  
        `employee_position`='$employee_position',  
        `employee_contact`='$employee_contact' 
        WHERE `employee_id`='$employee_id'";
    
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
