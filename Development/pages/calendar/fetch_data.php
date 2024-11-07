<?php include('../../connection.php');

$output = array();
$sql = "SELECT * FROM tb_event WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1

	$totalQuery = mysqli_query($con,$sql);
	$total_all_rows = mysqli_num_rows($totalQuery);

	$columns = array(
		0 => 'event_id',
		1 => 'event_name',
		2 => 'event_location',
		3 => 'event_type',
		4 => 'event_start',
		5 => 'event_end',	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " AND (event_name LIKE '%" . $search_value . "%'";
	$sql .= " OR event_location like '%".$search_value."%'";
	$sql .= " OR event_type like '%".$search_value."%'";
	$sql .= " OR event_start like '%".$search_value."%'";
	$sql .= " OR event_end like '%".$search_value."%')";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['event_id'];
	//$sub_array[] = '<input type="checkbox" class="row-checkbox" value="'.$row['event_id'].'">';
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
	'draw'=> intval($_POST['draw']),
	'recordsTotal' => $total_all_rows,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
