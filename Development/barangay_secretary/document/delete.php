<?php 
include('../../connection.php');

if (isset($_POST['document_id'])) {
    $document_id = mysqli_real_escape_string($con, $_POST['document_id']);
    $sql = "UPDATE tb_document SET isDisplayed = 0 WHERE document_id='$document_id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No document ID provided'));
}
?>
