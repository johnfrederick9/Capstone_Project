<?php
include('../../connection.php');

// Retrieve document details from POST request
$document_name = $_POST['document_name'];
$document_date = $_POST['document_date'];
$document_info = $_POST['document_info'];
$document_type = $_POST['document_type'];
$document_id = $_POST['document_id'];

// Update document details in the tb_document table
$sql = "UPDATE `tb_document` 
        SET  `document_name` = '$document_name',
             `document_date` = '$document_date',
             `document_info` = '$document_info',
             `document_type` = '$document_type' 
        WHERE document_id = '$document_id'";
$query = mysqli_query($con, $sql);

if ($query == true) {
    // Check if there are files uploaded
    if (isset($_FILES['document_files']) && count($_FILES['document_files']['name']) > 0) {
        $fileCount = count($_FILES['document_files']['name']);
        
        // Loop through each uploaded file and handle the upload process
        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $_FILES['document_files']['name'][$i];
            $fileTmpName = $_FILES['document_files']['tmp_name'][$i];
            $fileError = $_FILES['document_files']['error'][$i];
            $fileSize = $_FILES['document_files']['size'][$i];
            
            // Check if the file was uploaded without error
            if ($fileError === 0) {
                // Set a unique file name and the upload directory
                $fileNewName = uniqid('', true) . "-" . basename($fileName);
                $fileDestination = '../../uploads/' . $fileNewName;
                
                // Move the uploaded file to the destination directory
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // Insert the image data into the tb_document_images table
                    $sqlImage = "INSERT INTO `tb_document_images` (`document_id`, `filepath`) 
                                 VALUES ('$document_id', '$fileDestination')";
                    $queryImage = mysqli_query($con, $sqlImage);
                    
                    if (!$queryImage) {
                        $data = array('status' => 'false', 'error' => 'Failed to upload image to the database.');
                        echo json_encode($data);
                        exit;
                    }
                } else {
                    $data = array('status' => 'false', 'error' => 'Failed to move uploaded file.');
                    echo json_encode($data);
                    exit;
                }
            } else {
                $data = array('status' => 'false', 'error' => 'File upload error: ' . $fileError);
                echo json_encode($data);
                exit;
            }
        }
    }
    if (isset($_FILES['document_files']) && count($_FILES['document_files']['name']) > 0) {
        $fileCount = count($_FILES['document_files']['name']);
        
        for ($i = 0; $i < $fileCount; $i++) {
            // Handle each file here
            // Log potential file errors for debugging
            if ($_FILES['document_files']['error'][$i] !== 0) {
                error_log("File Upload Error: " . $_FILES['document_files']['error'][$i]);
            }
        }
    }
    

    // If everything is successful
    $data = array('status' => 'true');
    echo json_encode($data);
} else {
    $data = array('status' => 'false', 'error' => 'Failed to update the document.');
    echo json_encode($data);
}
?>
