<?php
include('../../connection.php');

$resident_firstname = $_POST["resident_firstname"];
$resident_lastname = $_POST["resident_lastname"];
$response = [];

// Check for duplicate resident
$check_sql = "SELECT * FROM `tb_resident` WHERE `resident_firstname` = '$resident_firstname' AND `resident_lastname` = '$resident_lastname' AND `isDisplayed` = 1";
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
    $resident_birthdate = $_POST['resident_birthdate'];
    $resident_height = $_POST["resident_height"];
    $resident_weight = $_POST["resident_weight"];
    $resident_heightstat = $_POST["resident_heightstat"];
    $resident_weightstat = $_POST["resident_weightstat"];
    $resident_medical = $_POST["resident_medical"];
    $resident_lactating = $_POST["resident_lactating"];
    $resident_pregnant = $_POST["resident_pregnant"];
    $resident_PWD = $_POST["resident_PWD"];
    $resident_SY = $_POST["resident_SY"];

    // Calculate BMI
    $resident_BMI = null;
    $resident_BMIstatus = 'N/A';
    if ($resident_height > 0 && $resident_weight > 0) {
        $height_meters = $resident_height / 100; // Convert height to meters
        $resident_BMI = round($resident_weight / ($height_meters * $height_meters), 2);

        // Determine BMI status
        if ($resident_BMI < 18.5) {
            $resident_BMIstatus = 'Underweight';
        } elseif ($resident_BMI >= 18.5 && $resident_BMI <= 24.9) {
            $resident_BMIstatus = 'Normal';
        } elseif ($resident_BMI >= 25 && $resident_BMI <= 29.9) {
            $resident_BMIstatus = 'Overweight';
        } elseif ($resident_BMI >= 30) {
            $resident_BMIstatus = 'Obese';
        }
    }

    // Update query
    $update_sql = "UPDATE tb_resident SET 
        resident_firstname='$resident_firstname',
        resident_middlename='$resident_middlename',
        resident_lastname='$resident_lastname',
        resident_birthdate='$resident_birthdate',
        resident_height='$resident_height',
        resident_weight='$resident_weight',
        resident_heightstat='$resident_heightstat',
        resident_weightstat='$resident_weightstat',
        resident_BMI='$resident_BMI',
        resident_BMIstatus='$resident_BMIstatus',
        resident_medical='$resident_medical',
        resident_lactating='$resident_lactating',
        resident_pregnant='$resident_pregnant',
        resident_PWD='$resident_PWD',
        resident_SY='$resident_SY'
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
