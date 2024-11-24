<?php 
include('../../connection.php');

if (isset($_POST['employee_id'])) {
    $employee_id = mysqli_real_escape_string($con, $_POST['employee_id']);
    $sql = "UPDATE tb_employee SET isDisplayed = 0 WHERE employee_id='$employee_id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No Employee ID provided'));
}
?>
