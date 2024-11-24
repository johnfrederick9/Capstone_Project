<?php
include('../../connection.php');

if (isset($_POST['employee_id'])) {
    $employee_id = $_POST['employee_id'];
    $sql = "SELECT * FROM tb_employee WHERE employee_id = '$employee_id'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $employee = mysqli_fetch_assoc($result);
        echo json_encode($employee);
    } else {
        echo json_encode(array("status" => "false"));
    }
}
?>
