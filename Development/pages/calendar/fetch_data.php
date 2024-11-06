<?php include('../../connection.php');

$output= array();
$sql = "SELECT * FROM tb_event ";

	$totalQuery = mysqli_query($con,$sql);
	$total_all_rows = mysqli_num_rows($totalQuery);

	$columns = array(
		0 => 'event_name',
		1 => 'event_location',
		2 => 'event_type',
		3 => 'event_start',
		4 => 'event_end',	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE event_name like '%".$search_value."%'";
	$sql .= " OR event_location like '%".$search_value."%'";
	$sql .= " OR event_type like '%".$search_value."%'";
	$sql .= " OR event_start like '%".$search_value."%'";
	$sql .= " OR event_end like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY event_id desc";
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
	//$sub_array[] = '<input type="checkbox" class="row-checkbox" value="'.$row['event_id'].'">';
	$sub_array[] = $row['event_name'];
	$sub_array[] = $row['event_location'];
	$sub_array[] = $row['event_type'];
	$sub_array[] = $row['event_start'];
	$sub_array[] = $row['event_end'];
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
