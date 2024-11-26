<?php
include('../../connection.php');

$output = array();
$sql = "SELECT * FROM tb_permit WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'permit_id',
    1 => 'permit_name',
    2 => 'permit_business',
    3 => 'permit_locate',
    4 => 'permit_date',
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (permit_name LIKE '%" . $search_value . "%'";
    $sql .= " OR permit_business like '%".$search_value."%'";
    $sql .= " OR permit_locate like '%".$search_value."%'";
    $sql .= " OR permit_date like '%".$search_value."%')";
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
    $sub_array[] = $row['permit_id'];
    $sub_array[] = $row['permit_name'];
    $sub_array[] = $row['permit_business'];
    $sub_array[] = $row['permit_locate'];
    $sub_array[] = $row['permit_date'];
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
	'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $total_all_rows,
    'data' => $data,
);
echo json_encode($output);
