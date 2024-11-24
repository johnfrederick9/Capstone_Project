<?php
include('../../connection.php');

$output = array();
$sql = "SELECT * FROM tb_blotter WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1


$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'blotter_id',
    1 => 'blotter_complainant',
    2 => 'blotter_complainant_no',
    3 => 'blotter_complainant_add',
    4 => 'blotter_complainee',
    5 => 'blotter_complainee_no',
    6 => 'blotter_complainee_add',
    7 => 'blotter_complaint',
    8 => 'blotter_status',
    9 => 'blotter_action',
    10 => 'blotter_incidence',
    11 => 'blotter_date_recorded',
    12 => 'blotter_date_settled',
    13 => 'blotter_recorded_by',
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
	$sql .= " AND (blotter_complainant LIKE '%" . $search_value . "%'";
    $sql .= " OR blotter_complainant_no like '%".$search_value."%'";
    $sql .= " OR blotter_complainant_add like '%".$search_value."%'";
    $sql .= " OR blotter_complainee like '%".$search_value."%'";
    $sql .= " OR blotter_complainee_no like '%".$search_value."%'";
    $sql .= " OR blotter_complainee_add like '%".$search_value."%'";
    $sql .= " OR blotter_complaint like '%".$search_value."%'";
    $sql .= " OR blotter_status like '%".$search_value."%'";
    $sql .= " OR blotter_action like '%".$search_value."%'";
    $sql .= " OR blotter_incidence like '%".$search_value."%'";
    $sql .= " OR blotter_date_recorded like '%".$search_value."%'";
    $sql .= " OR blotter_date_settled like '%".$search_value."%'";
    $sql .= " OR blotter_recorded_by like '%".$search_value."%')";
    
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
    $sub_array[] = $row['blotter_id'];
    $sub_array[] = '<input type="checkbox" class="row-checkbox" value="'.$row['blotter_id'].'">';
    $sub_array[] = $row['blotter_complainant'];
    $sub_array[] = $row['blotter_complainant_no'];
    $sub_array[] = $row['blotter_complainant_add'];
    $sub_array[] = $row['blotter_complainee'];
    $sub_array[] = $row['blotter_complainee_no'];
    $sub_array[] = $row['blotter_complainee_add'];
    $sub_array[] = $row['blotter_complaint'];
    $sub_array[] = $row['blotter_status'];
    $sub_array[] = $row['blotter_action'];
    $sub_array[] = $row['blotter_incidence'];
    $sub_array[] = $row['blotter_date_recorded'];
    $sub_array[] = $row['blotter_date_settled'];
    $sub_array[] = $row['blotter_recorded_by'];
    $sub_array[] = '<div class="dropdown">
                    <button class="action-btn" onclick="toggleDropdown(this)">
                        ACTIONS <i class="bx bx-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="javascript:void(0);" data-id="' . $row['blotter_id'] . '" class="dropdown-item view-btn viewbtn">
                            <i class="bx bx-show"></i>
                        </a>
                        <a href="javascript:void(0);" data-id="' . $row['blotter_id'] . '" class="dropdown-item update-btn editbtn">
                            <i class="bx bx-edit"></i>
                        </a>
                        <a href="javascript:void(0);" data-id="' . $row['blotter_id'] . '" class="dropdown-item delete-btn deleteBtn">
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
