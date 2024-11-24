<?php 
include('../../connection.php');

if (isset($_POST['item_id'])) {
    $item_id = mysqli_real_escape_string($con, $_POST['item_id']);
    $sql = "UPDATE tb_inventory SET isDisplayed = 0 WHERE item_id='$item_id'";
    $delQuery = mysqli_query($con, $sql);

    if ($delQuery) {
        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'failed', 'message' => 'No item ID provided'));
}
?>
