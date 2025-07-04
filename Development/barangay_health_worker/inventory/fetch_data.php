<?php
include('../../connection.php');

$output = array();
$columns = array(
    0 => 'item_id',
    1 => 'item_name',
    2 => 'item_serialNo',
    3 => 'item_custodian',
    4 => 'item_count',
    5 => 'item_price',
    6 => 'item_year',
    8 => 'item_status',
    9 => 'lendable_count',
    10 => 'available_count'
);

// Base query to get inventory data
$sql = "SELECT * FROM tb_inventory WHERE isDisplayed = 1";

// Capture search value
if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];

    // Use AND to extend the existing WHERE clause
    $sql .= " AND (item_name LIKE '%".$search_value."%' ";
    $sql .= " OR item_description LIKE '%".$search_value."%' ";
    $sql .= " OR item_brand LIKE '%".$search_value."%' ";
    $sql .= " OR item_serialNo LIKE '%".$search_value."%' ";
    $sql .= " OR item_custodian LIKE '%".$search_value."%' ";
    $sql .= " OR item_count LIKE '%".$search_value."%' ";
    $sql .= " OR item_price LIKE '%".$search_value."%' ";
    $sql .= " OR item_year LIKE '%".$search_value."%' ";
    $sql .= " OR item_status LIKE '%".$search_value."%' ";
    $sql .= " OR lendable_count LIKE '%".$search_value."%' ";
    $sql .= " OR available_count LIKE '%".$search_value."%')";
}

// Order by clause
if (isset($_POST['order'])) {
    $column_name = $columns[$_POST['order'][0]['column']];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY ".$column_name." ".$order."";
} else {
    $sql .= " ORDER BY item_id DESC";
}

// Pagination
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT ".$start.", ".$length;
}

// Execute query
$query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($query);

// Fetch total rows for DataTables pagination
$totalQuery = mysqli_query($con, "SELECT * FROM tb_inventory WHERE isDisplayed = 1");
$total_all_rows = mysqli_num_rows($totalQuery);

// Prepare data for DataTable
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['item_id'];
    $sub_array[] = $row['item_name'];
    $sub_array[] = $row['item_serialNo'];
    $sub_array[] = $row['item_custodian'];
    $sub_array[] = $row['item_count'];
    $sub_array[] = $row['item_price'];
    $sub_array[] = $row['item_year'];
    $sub_array[] = $row['item_status'];
    $sub_array[] = $row['lendable_count'];
    $sub_array[] = $row['available_count'];
    $data[] = $sub_array;
}

// Output response
$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $total_all_rows,
    'data' => $data,
);

echo json_encode($output);
