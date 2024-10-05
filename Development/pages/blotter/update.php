<?php 
include('../../connection.php');
$blotter_complainant = $_POST["blotter_complainant"];
$blotter_complainant_no = $_POST["blotter_complainant_no"];
$blotter_complainant_add = $_POST["blotter_complainant_add"];
$blotter_complainee = $_POST["blotter_complainee"];
$blotter_complainee_no = $_POST["blotter_complainee_no"];
$blotter_complainee_add = $_POST["blotter_complainee_add"];
$blotter_complaint = $_POST["blotter_complaint"];
$blotter_status = $_POST["blotter_status"];
$blotter_action = $_POST["blotter_action"];
$blotter_incidence = $_POST["blotter_incidence"];
$blotter_date_recorded = $_POST["blotter_date_recorded"];
$blotter_date_settled = $_POST["blotter_date_settled"];
$blotter_recorded_by = $_POST["blotter_recorded_by"];
$blotter_id = $_POST['blotter_id'];

$sql = "UPDATE `tb_blotter` SET  `blotter_complainant`='$blotter_complainant' , `blotter_complainant_no`= '$blotter_complainant_no', 
`blotter_complainant_add`='$blotter_complainant_add',  `blotter_complainee`='$blotter_complainee',  `blotter_complainee_no`='$blotter_complainee_no'
,  `blotter_complainee_add`='$blotter_complainee_add',  `blotter_complaint`='$blotter_complaint',  `blotter_status`='$blotter_status'
,  `blotter_action`='$blotter_action',  `blotter_incidence`='$blotter_incidence',  `blotter_date_recorded`='$blotter_date_recorded'
,  `blotter_date_settled`='$blotter_date_settled',  `blotter_recorded_by`='$blotter_recorded_by' WHERE blotter_id='$blotter_id' ";
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