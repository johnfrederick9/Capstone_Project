<?php 
include('../../connection.php');
$employee_firstname = $_POST["employee_firstname"];
$employee_middlename = $_POST["employee_middlename"];
$employee_maidenname = $_POST["employee_maidenname"];
$employee_lastname = $_POST["employee_lastname"];
$employee_sex = $_POST["employee_sex"];
$employee_suffixes = $_POST["employee_suffixes"];
$employee_address = $_POST["employee_address"];
$employee_educationalattainment = $_POST["employee_educationalattainment"];
$employee_birthdate = $_POST["employee_birthdate"];
$employee_age = $_POST["employee_age"];
$employee_status = $_POST["employee_status"];
$employee_householdrole = $_POST["employee_householdrole"];
$household_id = $_POST["household_id"];
$employee_id = $_POST['employee_id'];

$sql = "UPDATE `tb_employee` SET  `employee_firstname`='$employee_firstname' , `employee_middlename`= '$employee_middlename', 
`employee_maidenname`='$employee_maidenname',  `employee_lastname`='$employee_lastname',  `employee_sex`='$employee_sex'
,  `employee_suffixes`='$employee_suffixes',  `employee_address`='$employee_address',  `employee_educationalattainment`='$employee_educationalattainment'
,  `employee_birthdate`='$employee_birthdate',  `employee_age`='$employee_age',  `employee_status`='$employee_status'
,  `employee_householdrole`='$employee_householdrole',  `household_id`='$household_id' WHERE employee_id= '$employee_id' ";
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