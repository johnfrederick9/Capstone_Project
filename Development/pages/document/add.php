<?php
include('../../connection.php');

// Retrieve form data
$document_name = $_POST['document_name'];
$document_date = $_POST['document_date'];
$document_info = $_POST['document_info'];
$document_type = $_POST['document_type'];

// File upload directory
$targetDir = "file_uploads/";
$uploadedFiles = array();
$errorFiles = array();  // Array to hold non-image files

if (!empty($_FILES['document_files']['name'][0])) {
    foreach ($_FILES['document_files']['name'] as $key => $fileName) {
        $targetFilePath = $targetDir . basename($fileName);
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allow only image file types
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
        if (in_array($fileType, $allowedTypes)) {
            // Upload file to the server
            if (move_uploaded_file($_FILES['document_files']['tmp_name'][$key], $targetFilePath)) {
                $uploadedFiles[] = $targetFilePath; // Store file path in an array
            }
        } else {
            $errorFiles[] = $fileName; // Collect non-image file names
        }
    }
}

// Proceed only if no non-image files were uploaded
if (!empty($uploadedFiles) && empty($errorFiles)) {
    // Insert document data into the database
    $sql = "INSERT INTO `tb_document` (`document_name`, `document_date`, `document_info`, `document_type`) 
            VALUES ('$document_name', '$document_date', '$document_info', '$document_type')";
    $query = mysqli_query($con, $sql);
    $lastId = mysqli_insert_id($con);

    if ($query == true) {
        // Insert uploaded files into the database
        foreach ($uploadedFiles as $filePath) {
            $sql = "INSERT INTO `tb_document_files` (`document_id`, `filepath`) VALUES ('$lastId', '$filePath')";
            mysqli_query($con, $sql);
        }
        $data = array('status' => 'true');
    } else {
        $data = array('status' => 'false', 'error' => 'Database insert failed.');
    }
} elseif (!empty($errorFiles)) {
    // If there are non-image files, return an error message
    $data = array('status' => 'false', 'error' => 'Only image files are allowed. Invalid files: ' . implode(', ', $errorFiles));
} else {
    $data = array('status' => 'false', 'error' => 'Please upload at least one valid image file.');
}

echo json_encode($data);
?>
