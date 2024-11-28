<?php 
include('../../connection.php');

$resident_firstname = $_POST["resident_firstname"];
$resident_lastname = $_POST["resident_lastname"];

// Check for duplicate resident with isDisplayed = 1
$check_sql = "SELECT * FROM `tb_resident` WHERE `resident_firstname` = '$resident_firstname' AND `resident_lastname` = '$resident_lastname' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // Resident exists with isDisplayed = 1
    echo json_encode(array('status' => 'duplicate'));
} else {
    // Insert the new resident if no duplicate with isDisplayed = 1
    $resident_middlename = $_POST["resident_middlename"];
    $resident_maidenname = $_POST["resident_maidenname"];
    $resident_sex = $_POST["resident_sex"];
    $resident_suffixes = $_POST["resident_suffixes"];
    $resident_address = $_POST["resident_address"];
    $resident_educationalattainment = $_POST["resident_educationalattainment"];
    $resident_birthdate = $_POST["resident_birthdate"];
    $resident_contact = $_POST["resident_contact"];
    $resident_occupation = $_POST["resident_occupation"];
    $resident_religion = $_POST["resident_religion"];
    $resident_indigenous = $_POST["resident_indigenous"];
    $resident_status = $_POST["resident_status"];
    $resident_householdrole = $_POST["resident_householdrole"];
    $household_id = $_POST["household_id"];
    $resident_pension = $_POST["resident_pension"];
    $resident_beneficiaries = $_POST["resident_beneficiaries"];
    
    // Check if the number starts with '0' and replace it with '+63'
    if (preg_match('/^0/', $resident_contact)) {
        $resident_contact = '+63' . substr($resident_contact, 1); // Replace leading 0 with +63
    }

    // Ensure proper formatting for contact numbers
    $resident_contact = preg_replace('/\+63(\d{3})(\d{3})(\d{4})/', '+63 $1 $2 $3', $resident_contact);

    // Validate household_id
    $check_household_sql = "SELECT * FROM `tb_household` WHERE `household_id` = '$household_id'";
    $check_household_query = mysqli_query($con, $check_household_sql);

    if (mysqli_num_rows($check_household_query) == 0) {
        // If household_id does not exist, insert it into tb_household
        $insert_household_sql = "INSERT INTO `tb_household` (`household_id`) VALUES ('$household_id')";
        $insert_household_query = mysqli_query($con, $insert_household_sql);

        if (!$insert_household_query) {
            echo json_encode(array('status' => 'household_insert_failed'));
            exit;
        }
    }

    // Insert resident without resident_age (age will be calculated by the trigger)
    $sql = "INSERT INTO `tb_resident` (`resident_firstname`, `resident_middlename`, `resident_maidenname`, `resident_lastname`, `resident_sex`, `resident_suffixes`, `resident_address`, `resident_educationalattainment`, `resident_birthdate`, `resident_contact`, `resident_occupation`, `resident_religion`, `resident_indigenous`, `resident_status`, `resident_householdrole`, `household_id`, `isDisplayed`, `resident_pension`, `resident_beneficiaries`) 
    VALUES ('$resident_firstname', '$resident_middlename', '$resident_maidenname', '$resident_lastname', '$resident_sex', '$resident_suffixes', '$resident_address', '$resident_educationalattainment', '$resident_birthdate', '$resident_contact', '$resident_occupation', '$resident_religion', '$resident_indigenous', '$resident_status', '$resident_householdrole', '$household_id', 1, '$resident_pension', '$resident_beneficiaries')";

    $query = mysqli_query($con, $sql);
    
    if ($query) {
        echo json_encode(array('status' => 'true'));
    } else {
        echo json_encode(array('status' => 'false'));
    }
}
?>
