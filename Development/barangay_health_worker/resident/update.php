<?php
include('../../connection.php');

$response = array();

if (isset($_POST['resident_id'])) {
    $resident_id = $_POST['resident_id'];
    $resident_firstname = $_POST['resident_firstname'];
    $resident_middlename = $_POST['resident_middlename'];
    $resident_lastname = $_POST['resident_lastname'];
    $resident_maidenname = $_POST['resident_maidenname'];
    $resident_sex = $_POST['resident_sex'];
    $resident_suffixes = $_POST['resident_suffixes'];
    $resident_address = $_POST['resident_address'];
    $resident_educationalattainment = $_POST['resident_educationalattainment'];
    $resident_birthdate = $_POST['resident_birthdate'];
    $resident_contact = $_POST['resident_contact'];
    $resident_occupation = $_POST['resident_occupation'];
    $resident_religion = $_POST['resident_religion'];
    $resident_indigenous = $_POST['resident_indigenous'];
    $resident_status = $_POST['resident_status'];
    $resident_householdrole = $_POST['resident_householdrole'];
    $household_id = $_POST['household_id'];

    // Only add +63 if the number starts with 0
    if (preg_match('/^0/', $resident_contact)) {
        $resident_contact = '+63' . substr($resident_contact, 1); // Replace leading 0 with +63
    }

    // Format with spaces after every 3 digits following the +63 prefix
    $resident_contact = preg_replace('/\+63(\d{3})(\d{3})(\d{4})/', '+63 $1 $2 $3', $resident_contact);

    // Update query (age will be calculated by the MySQL trigger)
    $update_sql = "UPDATE tb_resident SET 
        resident_firstname='$resident_firstname',
        resident_middlename='$resident_middlename',
        resident_lastname='$resident_lastname',
        resident_maidenname='$resident_maidenname',
        resident_sex='$resident_sex',
        resident_suffixes='$resident_suffixes',
        resident_address='$resident_address',
        resident_educationalattainment='$resident_educationalattainment',
        resident_birthdate='$resident_birthdate',
        resident_contact='$resident_contact',
        resident_occupation='$resident_occupation',
        resident_religion='$resident_religion',
        resident_indigenous='$resident_indigenous',
        resident_status='$resident_status',
        resident_householdrole='$resident_householdrole',
        household_id='$household_id'
        WHERE resident_id='$resident_id'";

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
