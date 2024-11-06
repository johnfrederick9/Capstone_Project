<?php
include('../../connection.php');

$output = array();
$sql = "SELECT * FROM tb_request WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'request_id',
    1 => 'requester_name',
    2 => 'request_type',
    3 => 'request_description',
    4 => 'request_date',
    5 => 'request_status',
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (requester_name LIKE '%" . $search_value . "%'";
    $sql .= " OR request_type like '%".$search_value."%'";
    $sql .= " OR request_description like '%".$search_value."%'";
    $sql .= " OR request_date like '%".$search_value."%'";
    $sql .= " OR request_status like '%".$search_value."%')";    
}

if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT ".$start.", ".$length;
}

$query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['request_id'];
    $sub_array[] = '<input type="checkbox" class="row-checkbox" value="'.$row['request_id'].'">';
    $sub_array[] = $row['requester_name'];
    $sub_array[] = $row['request_type'];
    $sub_array[] = $row['request_description'];
    $sub_array[] = $row['request_date'];
    $sub_array[] = $row['request_status'];
    $sub_array[] = '<div class="dropdown">
                    <button class="action-btn" onclick="toggleDropdown(this)">
                        ACTIONS <i class="bx bx-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="javascript:void(0);" data-id="' . $row['request_id'] . '" class="dropdown-item update-btn editbtn">
                            <i class="bx bx-edit"></i>
                        </a>
                        <a href="javascript:void(0);" data-id="' . $row['request_id'] . '" class="dropdown-item delete-btn deleteBtn">
                            <i class="bx bx-trash"></i>
                        </a>
                    </div>
                </div>';
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $total_all_rows,
    'data' => $data,
);
echo json_encode($output);
