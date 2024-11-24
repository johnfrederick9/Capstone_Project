<?php 
include('../../connection.php');

if (isset($_POST['bemp_id'])) {
    $bemp_id = mysqli_real_escape_string($con, $_POST['bemp_id']);
    $sql = "UPDATE  tb_business_m SET isDisplayed = 0 WHERE bemp_id='$bemp_id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No bemp ID provided'));
}
?>
