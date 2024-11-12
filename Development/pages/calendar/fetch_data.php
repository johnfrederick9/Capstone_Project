<?php
include('../../connection.php');

$output = array();

// 1. Update `isDisplayed` for expired events
$updateSql = "UPDATE tb_event SET isDisplayed = 0 WHERE event_end < CURDATE()";
mysqli_query($con, $updateSql);

// 2. Only fetch records where `isDisplayed = 1`
$sql = "SELECT * FROM tb_event WHERE isDisplayed = 1";

// 3. Get total count of records with `isDisplayed = 1`
$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'event_id',
	1 => 'event_name',
	2 => 'event_location',
	3 => 'event_type',
	4 => 'event_start',
	5 => 'event_end'
);

if(isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (event_name LIKE '%" . $search_value . "%'";
	$sql .= " OR event_location LIKE '%" . $search_value . "%'";
	$sql .= " OR event_type LIKE '%" . $search_value . "%'";
	$sql .= " OR event_start LIKE '%" . $search_value . "%'";
	$sql .= " OR event_end LIKE '%" . $search_value . "%')";
}

if($_POST['length'] != -1) {
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  " . $start . ", " . $length;
}

$query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query)) {
	$sub_array = array();
	$sub_array[] = $row['event_id'];
	$sub_array[] = $row['event_name'];
	$sub_array[] = $row['event_location'];
	$sub_array[] = $row['event_type'];
	$sub_array[] = $row['event_start'];
	$sub_array[] = $row['event_end'];
	$sub_array[] = '<div class="dropdown">
                    <button class="action-btn" onclick="toggleDropdown(this)">
                        ACTIONS <i class="bx bx-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
					<a href="javascript:void(0);" data-id="' . $row['event_id'] . '" class="dropdown-item view-btn viewbtn">
                            <i class="bx bx-show"></i>
                        </a>
                        <a href="javascript:void(0);" data-id="' . $row['event_id'] . '" class="dropdown-item update-btn editbtn">
                            <i class="bx bx-edit"></i>
                        </a>
                        <a href="javascript:void(0);" data-id="' . $row['event_id'] . '" class="dropdown-item delete-btn deleteBtn">
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
?>
