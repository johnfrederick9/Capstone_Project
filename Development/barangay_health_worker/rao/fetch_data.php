<?php 
include('../../connection.php');

$output = array();
$columns = array(
    0 => 'rao_id',
    1 => 'period_covered',
    2 => 'ap_total',
    3 => 'ob_total',
    4 => 'apbd_total',
);

// Query to get total number of records before filtering
$sql = "SELECT * FROM tb_rao WHERE isDisplayed = 1"; 
$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

// Modify query for filtering and searching
$sql = "SELECT * FROM tb_rao WHERE isDisplayed = 1"; // Reset base query for filtered data

if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (period_covered LIKE '%".$search_value."%' 
                OR ap_total LIKE '%".$search_value."%' 
                OR ob_total LIKE '%".$search_value."%' 
                OR apbd_total LIKE '%".$search_value."%')";
}

// Ordering logic
if (isset($_POST['order'])) {
    $column_index = $_POST['order'][0]['column']; // Get the index of the column to order by
    $order = $_POST['order'][0]['dir']; // ASC or DESC
    $sql .= " ORDER BY ".$columns[$column_index]." ".$order."";
} else {
    $sql .= " ORDER BY rao_id DESC"; // Default ordering
}

// Pagination logic
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT ".$start.", ".$length;
}

// Query to fetch filtered data
$query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($query); // Number of filtered rows

$data = array();
while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['rao_id'];
    $sub_array[] = $row['period_covered'];
    $sub_array[] = $row['ap_total'];
    $sub_array[] = $row['ob_total'];
    $sub_array[] = $row['apbd_total'];
    $data[] = $sub_array;
}

// Prepare output for DataTables
$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $total_all_rows, // Total records before filtering
    'recordsFiltered' => $count_rows,  // Total records after filtering
    'data' => $data, // Data to display
);

echo json_encode($output);
?>
