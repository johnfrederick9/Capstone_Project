<?php
if (isset($_GET['file'])) {
    $filePath = urldecode($_GET['file']);

    // Check if the file exists
    if (file_exists($filePath)) {
        $fileType = mime_content_type($filePath);

        // Set headers
        header('Content-Type: ' . $fileType);
        header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        // Read the file
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>
