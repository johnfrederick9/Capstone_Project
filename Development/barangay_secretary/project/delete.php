<?php 
include('../../connection.php');

if (isset($_POST['project_id'])) {
    $project_id = mysqli_real_escape_string($con, $_POST['project_id']);
    $sql = "UPDATE tb_project SET isDisplayed = 0 WHERE project_id='$project_id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No project ID provided'));
}
?>
