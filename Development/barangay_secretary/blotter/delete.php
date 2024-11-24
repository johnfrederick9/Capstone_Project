<?php 
include('../../connection.php');

if (isset($_POST['blotter_id'])) {
    $blotter_id = mysqli_real_escape_string($con, $_POST['blotter_id']);
    $sql = "UPDATE tb_blotter SET isDisplayed = 0 WHERE blotter_id='$blotter_id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No blotter ID provided'));
}
?>
