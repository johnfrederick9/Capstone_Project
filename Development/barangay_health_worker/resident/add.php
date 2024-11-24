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
    $resident_birthdate = $_POST["resident_birthdate"];
    $resident_height = $_POST["resident_height"];
    $resident_weight = $_POST["resident_weight"];
    $resident_heightstat = $_POST["resident_heightstat"];
    $resident_weightstat = $_POST["resident_weightstat"];
    $resident_BMIstat = $_POST["resident_BMIstat"];
    $resident_medical = $_POST["resident_medical"];
    $resident_lactating = $_POST["resident_lactating"];
    $resident_pregnant = $_POST["resident_pregnant"];
    $resident_PWD = $_POST["resident_PWD"];
    $resident_SY = $_POST["resident_SY"];

    // Insert resident without resident_age (age will be calculated by the trigger)
    $sql = "INSERT INTO `tb_resident` (`resident_firstname`, `resident_lastname`, `resident_middlename`, `resident_birthdate`, `resident_height`, `resident_weight`, `resident_heightstat`, `resident_weightstat`, `resident_BMIstat`, `resident_medical`, `resident_lactating`, `resident_pregnant`, `resident_PWD`, `resident_SY`, `isDisplayed`) 
    VALUES ('$resident_firstname', '$resident_lastname', '$resident_middlename', '$resident_birthdate', '$resident_height', '$resident_weight', '$resident_heightstat', '$resident_weightstat', '$resident_BMIstat', '$resident_medical', '$resident_lactating', '$resident_pregnant', '$resident_PWD', '$resident_SY', 1)";

    $query = mysqli_query($con, $sql);
    
    if ($query) {
        echo json_encode(array('status' => 'true'));
    } else {
        echo json_encode(array('status' => 'false'));
    }
}
?>
