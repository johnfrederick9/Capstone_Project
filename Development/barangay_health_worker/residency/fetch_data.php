<?php
include('../../connection.php');

$output = array();
$sql = "SELECT * FROM tb_residency WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'residency_id',
    1 => 'residency_name',
    2 => 'residency_issued',
    3 => 'residency_date',
    4 => 'residency_paid',
    5 => 'residency_dst',
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (residency_name LIKE '%" . $search_value . "%'";
    $sql .= " OR residency_issued like '%".$search_value."%'";
    $sql .= " OR residency_date like '%".$search_value."%'";
    $sql .= " OR residency_paid like '%".$search_value."%'";
    $sql .= " OR residency_dst like '%".$search_value."%')";
}

if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT ".$start.", ".$length;
}

$query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($query);
$data = array();

while ($row = mysqli_fetch_assoc($query)) 
{
    $sub_array = array();
    $sub_array[] = $row['residency_id'];
    $sub_array[] = $row['residency_name'];
    $sub_array[] = $row['residency_issued'];
    $sub_array[] = $row['residency_date'];
    $sub_array[] = $row['residency_paid'];
    $sub_array[] = $row['residency_dst'];
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
	'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $total_all_rows,
    'data' => $data,
);
echo json_encode($output);
