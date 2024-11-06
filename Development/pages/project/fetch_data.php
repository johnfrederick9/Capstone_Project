<?php include('../../connection.php');

$output = array();
$sql = "SELECT * FROM tb_project WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1


$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

	$columns = array(
		0 => 'project_id',
		1 => 'project_name',
		2 => 'project_start',
		3 => 'project_end',
		4 => 'project_budget',	
		5 => 'project_source',	
		6 => 'project_location',	
		7 => 'project_managers',	
		8 => 'project_stakeholders',
		9 => 'project_status',	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " AND (project_name LIKE '%" . $search_value . "%'";
	$sql .= " OR project_start like '%".$search_value."%'";
	$sql .= " OR project_end like '%".$search_value."%'";
	$sql .= " OR project_budget like '%".$search_value."%'";
	$sql .= " OR project_source like '%".$search_value."%'";
	$sql .= " OR project_location like '%".$search_value."%'";
	$sql .= " OR project_managers like '%".$search_value."%'";
	$sql .= " OR project_stakeholders like '%".$search_value."%'";
	$sql .= " OR project_status like '%".$search_value."%')";
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
	$sub_array[] = $row['project_id'];
	$sub_array[] = '<input type="checkbox" class="row-checkbox" value="'.$row['project_id'].'">';
	$sub_array[] = $row['project_name'];
	$sub_array[] = $row['project_start'];
	$sub_array[] = $row['project_end'];
	$sub_array[] = $row['project_budget'];
	$sub_array[] = $row['project_source'];
	$sub_array[] = $row['project_location'];
	$sub_array[] = $row['project_managers'];
	$sub_array[] = $row['project_stakeholders'];
	$sub_array[] = $row['project_status'];
	$sub_array[] = '
		<div class="dropdown">
			<button class="action-btn" onclick="toggleDropdown(this)">
				ACTIONS <i class="bx bx-chevron-down"></i>
			</button>
			<div class="dropdown-menu">
				<a href="javascript:void(0);" data-id="' . $row['project_id'] . '" class="dropdown-item update-btn editbtn">
					<i class="bx bx-edit"></i>
				</a>
				<a href="javascript:void(0);" data-id="' . $row['project_id'] . '" class="dropdown-item delete-btn deleteBtn">
					<i class="bx bx-trash"></i>
				</a>
			</div>
		</div>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' => $total_all_rows,
	'recordsFiltered' => $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
