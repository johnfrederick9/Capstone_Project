<?php 
include('../../connection.php');

// Extract form data
$financial_type = $_POST["financial_type"];
$financial_date = $_POST["financial_date"];
$financial_filepath = basename($_FILES["financial_filepath"]["name"]); // This gets only the file name
$targetDir = "file_uploads/";
$targetFilePath = $targetDir . $financial_filepath;

// Move uploaded file to target directory
if (move_uploaded_file($_FILES["financial_filepath"]["tmp_name"], $targetFilePath)) {
    
    $sql = "INSERT INTO `tb_financial` (`financial_type`,`financial_date`,`financial_filepath`) 
            VALUES ('$financial_type', '$financial_date', '$financial_filepath')";
    $query = mysqli_query($con, $sql);
    $lastId = mysqli_insert_id($con);
    
    if ($query == true) {
        $data = array(
            'status' => 'true',
        );
        echo json_encode($data);
    } else {
        $data = array(
            'status' => 'false',
        );
        echo json_encode($data);
    } 
} else {
    $data = array(
        'status' => 'false',
        'error' => 'Failed to upload file.'
    );
    echo json_encode($data);
}
?>
