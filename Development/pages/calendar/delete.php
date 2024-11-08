<?php 
include('../../connection.php');

if (isset($_POST['event_id'])) {
    $event_id = mysqli_real_escape_string($con, $_POST['event_id']);
    $sql = "UPDATE tb_event SET isDisplayed = 0 WHERE event_id='$event_id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No event ID provided'));
}
?>
