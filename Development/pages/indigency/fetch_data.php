<?php
include('../../connection.php');

$output = array();
$sql = "SELECT * FROM tb_indigency WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'indigency_id',
    1 => 'indigency_cname',
    2 => 'indigency_mname',
    3 => 'indigency_fname',
    4 => 'indigency_date',
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (indigency_cname LIKE '%" . $search_value . "%'";
    $sql .= " OR indigency_mname like '%".$search_value."%'";
    $sql .= " OR indigency_fname like '%".$search_value."%'";
    $sql .= " OR indigency_date like '%".$search_value."%')";
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
    $sub_array[] = $row['indigency_id'];
    $sub_array[] = $row['indigency_cname'];
    $sub_array[] = $row['indigency_mname'];
    $sub_array[] = $row['indigency_fname'];
    $sub_array[] = $row['indigency_date'];
    $sub_array[] = '
    <div class="dropdown">
			<button class="action-btn" onclick="toggleDropdown(this)">
				ACTIONS <i class="bx bx-chevron-down"></i>
			</button>
			<div class="dropdown-menu">
              <a href="javascript:void(0);" data-id="' . $row['indigency_id'] . '" class="dropdown-item print-btn" 
                data-toggle="modal" 
                data-target="#printModal">
        <i class="bx bx-printer"></i></a>

				<a href="javascript:void(0);" data-id="' . $row['indigency_id'] . '" class="dropdown-item update-btn editbtn">
					<i class="bx bx-edit"></i>
				</a>
				<a href="javascript:void(0);" data-id="' . $row['indigency_id'] . '" class="dropdown-item delete-btn deleteBtn">
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