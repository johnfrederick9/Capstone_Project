<?php 
include('../../connection.php');
$document_name = $_POST['document_name'];
$document_date = $_POST['document_date'];
$document_info = $_POST['document_info'];
$document_type = $_POST['document_type'];
//$document_filepath = $_POST["document_filepath"]["name"];
//       $targetDir = "file_uploads/";
//        $targetFilePath = $targetDir . $document_filepath;

        
$sql = "INSERT INTO `tb_document` (`document_name`,`document_date`,`document_info`,`document_type`) values ('$document_name', '$document_date', '$document_info', '$document_type')";
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