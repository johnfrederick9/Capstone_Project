<?php 
include('../../connection.php');

$document_id = $_POST['document_id'];
$sql = "
    SELECT 
        d.document_name, 
        d.document_date, 
        d.document_info, 
        d.document_type, 
        f.filepath 
    FROM 
        tb_document AS d 
    LEFT JOIN 
        tb_document_files AS f 
    ON 
        d.document_id = f.document_id 
    WHERE 
        d.document_id = '$document_id' 
    LIMIT 1";

$query = mysqli_query($con, $sql);

if ($query) {
    $row = mysqli_fetch_assoc($query);
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Failed to fetch document data']);
}
?>
