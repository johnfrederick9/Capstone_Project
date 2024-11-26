<?php
include('../../connection.php');

$output = array();
$sql = "SELECT * FROM tb_business_m WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'bemp_id',
    1 => 'bemp_name',
    2 => 'bemp_employed',
    3 => 'bemp_address',
    4 => 'bemp_locate',
    5 => 'bemp_date',
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (bemp_name LIKE '%" . $search_value . "%'";
    $sql .= " OR bemp_employed like '%".$search_value."%'";
    $sql .= " OR bemp_address like '%".$search_value."%'";
    $sql .= " OR bemp_locate like '%".$search_value."%'";
    $sql .= " OR bemp_date like '%".$search_value."%')";
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
    $sub_array[] = $row['bemp_id'];
    $sub_array[] = $row['bemp_name'];
    $sub_array[] = $row['bemp_employed'];
    $sub_array[] = $row['bemp_address'];
    $sub_array[] = $row['bemp_locate'];
    $sub_array[] = $row['bemp_date'];
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
	'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $total_all_rows,
    'data' => $data,
);
echo json_encode($output);
