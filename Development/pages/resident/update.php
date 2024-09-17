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
$resident_id = $_POST['resident_id'];

$sql = "UPDATE `tb_resident` SET  `resident_firstname`='$resident_firstname' , `resident_middlename`= '$resident_middlename', 
`resident_maidenname`='$resident_maidenname',  `resident_lastname`='$resident_lastname',  `resident_sex`='$resident_sex'
,  `resident_suffixes`='$resident_suffixes',  `resident_address`='$resident_address',  `resident_educationalattainment`='$resident_educationalattainment'
,  `resident_birthdate`='$resident_birthdate',  `resident_age`='$resident_age',  `resident_status`='$resident_status'
,  `resident_householdrole`='$resident_householdrole',  `household_id`='$household_id' WHERE resident_id= '$resident_id' ";
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