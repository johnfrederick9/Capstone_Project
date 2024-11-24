<?php 
include('../../connection.php');

if (isset($_POST['residency_id'])) {
    $residency_id = mysqli_real_escape_string($con, $_POST['residency_id']);
    $sql = "UPDATE tb_residency SET isDisplayed = 0 WHERE residency_id='$residency_id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No residency ID provided'));
}
?>
