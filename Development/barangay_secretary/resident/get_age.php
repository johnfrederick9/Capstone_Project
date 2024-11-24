<?php
include('../../connection.php');

if (isset($_POST['resident_id'])) {
    $resident_id = $_POST['resident_id'];
    $sql = "SELECT * FROM tb_resident WHERE resident_id = '$resident_id'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $resident = mysqli_fetch_assoc($result);
        echo json_encode($resident);
    } else {
        echo json_encode(array("status" => "false"));
    }
}
?>
