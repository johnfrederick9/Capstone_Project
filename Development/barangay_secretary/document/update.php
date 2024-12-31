<?php
include('../../connection.php');

$document_name = $_POST["document_name"];
$response = [];

// Check for duplicate document
$check_sql = "SELECT * FROM `tb_document` WHERE `document_name` = '$document_name'";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    $existing_document = mysqli_fetch_assoc($check_query);
    if (!isset($_POST['document_id']) || $existing_document['document_id'] != $_POST['document_id']) {
        $response['status'] = 'duplicate';
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['document_id'])) {
    $document_id = $_POST['document_id'];
    $document_date = $_POST['document_date'];
    $document_info = $_POST['document_info'];
    $document_type = $_POST['document_type'];

    // Update document details
    $sql = "UPDATE `tb_document` 
            SET  `document_name` = '$document_name',
                 `document_date` = '$document_date',
                 `document_info` = '$document_info',
                 `document_type` = '$document_type' 
            WHERE document_id = '$document_id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        // Handle file uploads if any files are provided
        if (isset($_FILES['document_files'])) {
            $fileCount = count($_FILES['document_files']['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = $_FILES['document_files']['name'][$i];
                $fileTmpName = $_FILES['document_files']['tmp_name'][$i];
                $fileError = $_FILES['document_files']['error'][$i];

                if ($fileError === 0) {
                    $fileNewName = uniqid('', true) . "-" . basename($fileName);
                    $fileDestination = '../../file_uploads/' . $fileNewName;

                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $sqlImage = "INSERT INTO `tb_document_files` (`document_id`, `filepath`) 
                                     VALUES ('$document_id', '$fileDestination')";
                        $queryImage = mysqli_query($con, $sqlImage);

                        if (!$queryImage) {
                            echo json_encode(['status' => 'false', 'error' => 'Failed to insert image data.']);
                            exit;
                        }
                    } else {
                        echo json_encode(['status' => 'false', 'error' => 'Failed to move uploaded file.']);
                        exit;
                    }
                } else {
                    echo json_encode(['status' => 'false', 'error' => 'File upload error.']);
                    exit;
                }
            }
        }

        // Success response
        echo json_encode(['status' => 'true']);
    } else {
        echo json_encode(['status' => 'false', 'error' => 'Failed to update the document.']);
    }
}
?>
