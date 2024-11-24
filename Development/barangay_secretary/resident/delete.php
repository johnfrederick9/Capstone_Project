<?php 
include('../../connection.php');

if (isset($_POST['resident_id'])) {
    $resident_id = mysqli_real_escape_string($con, $_POST['resident_id']);
    $sql = "UPDATE tb_resident SET isDisplayed = 0 WHERE resident_id='$resident_id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No resident ID provided'));
}
?>
