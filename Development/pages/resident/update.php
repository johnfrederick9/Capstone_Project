<?php
include('../../connection.php');

$resident_firstname = $_POST["resident_firstname"];
$resident_lastname = $_POST["resident_lastname"];
$response = [];

// Check for duplicate resident
$check_sql = "SELECT * FROM `tb_resident` WHERE `resident_firstname` = '$resident_firstname' AND `resident_lastname` = '$resident_lastname'";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_resident = mysqli_fetch_assoc($check_query);
    
    // Check if the duplicate is not the same as the current resident being updated
    if (!isset($_POST['resident_id']) || $existing_resident['resident_id'] != $_POST['resident_id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['resident_id'])) {
    // Perform update if no duplicate exists
    $resident_id = $_POST['resident_id'];
    $resident_middlename = $_POST['resident_middlename'];
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
    $resident_pension = $_POST['resident_pension'];
    $resident_beneficiaries = $_POST['resident_beneficiaries'];

    // Format contact number
    if (preg_match('/^0/', $resident_contact)) {
        $resident_contact = '+63' . substr($resident_contact, 1);
    }
    $resident_contact = preg_replace('/\+63(\d{3})(\d{3})(\d{4})/', '+63 $1 $2 $3', $resident_contact);

    // Update query
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
        household_id='$household_id',
        resident_pension='$resident_pension',
        resident_beneficiaries='$resident_beneficiaries'
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
