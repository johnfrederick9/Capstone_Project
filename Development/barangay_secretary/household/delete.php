<?php 
include('../../connection.php');

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $sql = "UPDATE tb_household SET isDisplayed = 0 WHERE id='$id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No indigency ID provided'));
}
?>
