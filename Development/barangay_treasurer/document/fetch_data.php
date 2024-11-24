<?php
include('../../connection.php');

$output = array();

// Query to fetch all visible records from tb_document
$sql = "SELECT * FROM tb_document WHERE isDisplayed = 1";

// Apply search filter
$search_value = '';
if (isset($_POST['search']['value']) && $_POST['search']['value'] != '') {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (document_name LIKE '%" . $search_value . "%' 
              OR document_date LIKE '%" . $search_value . "%' 
              OR document_info LIKE '%" . $search_value . "%' 
              OR document_type LIKE '%" . $search_value . "%')";
}

// Get total unfiltered records
$totalQuery = mysqli_query($con, "SELECT * FROM tb_document WHERE isDisplayed = 1");
$total_all_rows = mysqli_num_rows($totalQuery);

// Get total filtered records
$filteredQuery = mysqli_query($con, $sql);
$total_filtered_rows = mysqli_num_rows($filteredQuery);

// Apply pagination
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT " . $start . ", " . $length;
}

// Execute the main query
$query = mysqli_query($con, $sql);
$data = array();

while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['document_id']; // Document ID
    $sub_array[] = $row['document_name']; // Document Name
    $sub_array[] = $row['document_date']; // Document Date
    $sub_array[] = $row['document_info']; // Document Info
    $sub_array[] = $row['document_type']; // Document Type

    // Fetch images for the document
    $document_id = $row['document_id'];
    $imageQuery = "SELECT filepath FROM tb_document_files WHERE document_id = '$document_id'";
    $imageResult = mysqli_query($con, $imageQuery);

    $images = array();
    while ($imageRow = mysqli_fetch_assoc($imageResult)) {
        $filepath = $imageRow['filepath'];
        if (file_exists($filepath)) {
            $images[] = '<img src="' . $filepath . '" class="img-thumbnail m-1" alt="Document Image" style="max-width: 70px; max-height: 70px;">';
        } else {
            $images[] = '<p class="text-danger">Image not found</p>';
        }
    }

    // Combine images into a single cell
    if (!empty($images)) {
        $sub_array[] = implode('', $images);
    } else {
        $sub_array[] = '<p>No images available</p>';
    }

    $data[] = $sub_array;
}

// Prepare the output
$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $total_filtered_rows,
    'data' => $data,
);

// Return the JSON response
echo json_encode($output);
?>
