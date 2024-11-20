<?php 
include('../../connection.php');

$employee_firstname = $_POST["employee_firstname"];
$employee_lastname = $_POST["employee_lastname"];

// Check for duplicate employee
$check_sql = "SELECT * FROM `tb_employee` WHERE `employee_firstname` = '$employee_firstname' AND `employee_lastname` = '$employee_lastname' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // employee exists
    echo json_encode(array('status' => 'duplicate'));
} else {
    // Insert the new resident if no duplicate
$employee_middlename = $_POST["employee_middlename"];
$employee_maidenname = $_POST["employee_maidenname"];
$employee_sex = $_POST["employee_sex"];
$employee_suffixes = $_POST["employee_suffixes"];
$employee_address = $_POST["employee_address"];
$employee_educationalattainment = $_POST["employee_educationalattainment"];
$employee_birthdate = $_POST["employee_birthdate"];
$employee_status = $_POST["employee_status"];
$employee_position = $_POST["employee_position"];
$employee_contact= $_POST["employee_contact"];

 // Check if the number starts with '0' and replace it with '+63'
 if (preg_match('/^0/', $employee_contact)) {
    $employee_contact = '+63' . substr($employee_contact, 1); // Replace leading 0 with +63
}

    // If the number starts with '+63', or if we've just added it, ensure proper formatting
    $employee_contact = preg_replace('/\+63(\d{3})(\d{3})(\d{4})/', '+63 $1 $2 $3', $employee_contact);

    $sql = "INSERT INTO `tb_employee` (`employee_firstname`,`employee_middlename`,`employee_maidenname`,`employee_lastname`,`employee_sex`,`employee_suffixes`,`employee_address`,`employee_educationalattainment`,`employee_birthdate`,`employee_status`,`employee_position`,`employee_contact`, `isDisplayed`) 
    VALUES ('$employee_firstname', '$employee_middlename', '$employee_maidenname', '$employee_lastname', '$employee_sex', '$employee_suffixes', '$employee_address', '$employee_educationalattainment', '$employee_birthdate',  '$employee_status', '$employee_position', '$employee_contact', 1)";
    
    $query = mysqli_query($con, $sql);
    
    if ($query) {
        echo json_encode(array('status' => 'true'));
    } else {
        echo json_encode(array('status' => 'false'));
    }
}
?>