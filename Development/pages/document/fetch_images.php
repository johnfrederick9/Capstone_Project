<?php
include('../../connection.php');

$document_id = $_POST['document_id'];

$sql = "SELECT filepath FROM tb_document_files WHERE document_id = '$document_id'";
$query = mysqli_query($con, $sql);

$images = array();

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $images[] = $row['filepath'];
    }
}

echo json_encode($images);
?>
