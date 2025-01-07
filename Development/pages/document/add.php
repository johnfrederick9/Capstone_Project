<?php
include('../../connection.php');

$document_name = mysqli_real_escape_string($con, $_POST['document_name']);

// Check for duplicate document
$check_sql = "SELECT * FROM `tb_document` WHERE `document_name` = '$document_name' AND `isDisplayed` = 1";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // Document exists
    echo json_encode(array('status' => 'duplicate'));
    exit;
}

// Retrieve form data only if no duplicate
$document_date = mysqli_real_escape_string($con, $_POST['document_date']);
$document_info = mysqli_real_escape_string($con, $_POST['document_info']);
$document_type = mysqli_real_escape_string($con, $_POST['document_type']);

// File upload directory
$targetDir = "../../file_uploads/";
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

// Proceed only if there are valid image files and no non-image files
if (!empty($uploadedFiles) && empty($errorFiles)) {
    // Insert document data into the database
    $sql = "INSERT INTO `tb_document` (`document_name`, `document_date`, `document_info`, `document_type`, `isDisplayed`) 
            VALUES ('$document_name', '$document_date', '$document_info', '$document_type', 1)";
    $query = mysqli_query($con, $sql);

    if ($query) {
        $lastId = mysqli_insert_id($con);
        // Insert uploaded files into the database
        foreach ($uploadedFiles as $filePath) {
            $fileSql = "INSERT INTO `tb_document_files` (`document_id`, `filepath`) VALUES ('$lastId', '$filePath')";
            mysqli_query($con, $fileSql);
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

// Output the response
echo json_encode($data);
?>
