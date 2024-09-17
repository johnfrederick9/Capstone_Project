<?php include('../../connection.php');

$output= array();
$sql = "SELECT * FROM tb_inventory ";

	$totalQuery = mysqli_query($con,$sql);
	$total_all_rows = mysqli_num_rows($totalQuery);

	$columns = array(
		0 => 'item_name',
		1 => 'item_description',
		2 => 'item_count',
		3 => 'item_status',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE item_name like '%".$search_value."%'";
	$sql .= " OR item_description like '%".$search_value."%'";
	$sql .= " OR item_count like '%".$search_value."%'";
	$sql .= " OR item_status like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY item_id desc";
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
	$sub_array[] = $row['item_name'];
	$sub_array[] = $row['item_description'];
	$sub_array[] = $row['item_count'];
	$sub_array[] = $row['item_status'];
	$sub_array[] = '<div class= "buttons">
						<a href="javascript:void();" data-id="'.$row['item_id'].'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a>  
						<a href="javascript:void();" data-item_id="'.$row['item_id'].'"  class="delete-btn btn-sm deleteBtn" ><i class="bx bxs-trash"></i></a>
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
