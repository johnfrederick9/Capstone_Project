<?php include('../../connection.php');

$output= array();
$sql = "SELECT * FROM tb_project";

	$totalQuery = mysqli_query($con,$sql);
	$total_all_rows = mysqli_num_rows($totalQuery);

	$columns = array(
		0 => 'project_name',
		1 => 'project_start',
		2 => 'project_end',
		3 => 'project_budget',	
		4 => 'project_source',	
		5 => 'project_location',	
		6 => 'project_managers',	
		7 => 'project_stakeholders',
		8 => 'project_status',	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE project_name like '%".$search_value."%'";
	$sql .= " OR project_start like '%".$search_value."%'";
	$sql .= " OR project_end like '%".$search_value."%'";
	$sql .= " OR project_budget like '%".$search_value."%'";
	$sql .= " OR project_source like '%".$search_value."%'";
	$sql .= " OR project_location like '%".$search_value."%'";
	$sql .= " OR project_managers like '%".$search_value."%'";
	$sql .= " OR project_stakeholders like '%".$search_value."%'";
	$sql .= " OR project_status like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY project_id desc";
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
	$sub_array[] = '<div class= "buttons">
						<a href="javascript:void();" data-id="'.$row['project_id'].'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a>  
					</div>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
