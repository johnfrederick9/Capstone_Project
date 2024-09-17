<?php 
include('../../connection.php');
$resident_firstname = $_POST["resident_firstname"];
$resident_middlename = $_POST["resident_middlename"];
$resident_maidenname = $_POST["resident_maidenname"];
$resident_lastname = $_POST["resident_lastname"];
$resident_sex = $_POST["resident_sex"];
$resident_suffixes = $_POST["resident_suffixes"];
$resident_address = $_POST["resident_address"];
$resident_educationalattainment = $_POST["resident_educationalattainment"];
$resident_birthdate = $_POST["resident_birthdate"];
$resident_age = $_POST["resident_age"];
$resident_status = $_POST["resident_status"];
$resident_householdrole = $_POST["resident_householdrole"];
$household_id = $_POST["household_id"];

        
$sql = "INSERT INTO `tb_resident` (`resident_firstname`,`resident_middlename`,`resident_maidenname`,`resident_lastname`,`resident_sex`,`resident_suffixes`,`resident_address`,`resident_educationalattainment`,`resident_birthdate`,`resident_age`,`resident_status`,`resident_householdrole`,`household_id`) values ('$resident_firstname', '$resident_middlename', '$resident_maidenname', '$resident_lastname', '$resident_sex', '$resident_suffixes', '$resident_address', '$resident_educationalattainment', '$resident_birthdate', '$resident_age', '$resident_status', '$resident_householdrole', '$household_id')";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
    $data = array(
        'status'=>'true',
    );
    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
    );

    echo json_encode($data);
} 

?>