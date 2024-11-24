<?php 
include('../../connection.php');

if (isset($_POST['permit_id'])) {
    $permit_id = mysqli_real_escape_string($con, $_POST['permit_id']);
    $sql = "UPDATE  tb_permit SET isDisplayed = 0 WHERE permit_id='$permit_id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No permit ID provided'));
}
?>
