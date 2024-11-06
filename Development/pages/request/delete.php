<?php 
include('../../connection.php');

if (isset($_POST['request_id'])) {
    $request_id = mysqli_real_escape_string($con, $_POST['request_id']);
    $sql = "UPDATE tb_request SET isDisplayed = 0 WHERE request_id='$request_id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No request ID provided'));
}
?>
