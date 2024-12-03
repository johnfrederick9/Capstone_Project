<?php 
include('../../connection.php');

$output = array();
$sql = "SELECT id, household_id, household_name, household_head, household_address, household_contact FROM tb_household WHERE isDisplayed = 1"; // Added `household_id` to the query

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'id',
    1 => 'household_id',
    2 => 'household_name',
    3 => 'household_head',
    4 => 'household_address',
    5 => 'household_contact',       
);

$search_value = '';
if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (household_id LIKE '%" . $search_value . "%'";
    $sql .= " OR household_name LIKE '%" . $search_value . "%'";
    $sql .= " OR household_head LIKE '%" . $search_value . "%'";
    $sql .= " OR household_address LIKE '%" . $search_value . "%'";
    $sql .= " OR household_contact LIKE '%" . $search_value . "%')"; // Closed parentheses here
}

// Calculate filtered records count
$filterQuery = mysqli_query($con, $sql);
$recordsFiltered = mysqli_num_rows($filterQuery);

if (isset($_POST['length']) && $_POST['length'] != -1) {
    $start = intval($_POST['start']);
    $length = intval($_POST['length']);
    $sql .= " LIMIT " . $start . ", " . $length;
}

$query = mysqli_query($con, $sql);
$data = array();

while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['id'];
    $sub_array[] = $row['household_id'];
    $sub_array[] = $row['household_name'];
    $sub_array[] = $row['household_head'];
    $sub_array[] = $row['household_address'];
    $sub_array[] = $row['household_contact'];


    $data[] = $sub_array;
}

$output = array(
    'draw' => isset($_POST['draw']) ? intval($_POST['draw']) : 0, // Ensure `draw` is set
    'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $recordsFiltered, // Use filtered count
    'data' => $data,
);

echo json_encode($output);
?>
