<?php include('../../connection.php');

$output= array();
$sql = "SELECT * FROM tb_rao"; 

	$totalQuery = mysqli_query($con,$sql);
	$total_all_rows = mysqli_num_rows($totalQuery);

	$columns = array(
		0 => 'rao_id',
		1 => 'period_covered',
		2 => 'ap_total',
		3 => 'ob_total',
		4 => 'apbd_total',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE period_covered like '%".$search_value."%'";
	$sql .= " OR ap_total like '%".$search_value."%'";
	$sql .= " OR ob_total like '%".$search_value."%'";
	$sql .= " OR apbd_total like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY rao_id desc";
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
	$sub_array[] = $row['rao_id'];
	$sub_array[] = $row['period_covered'];
	$sub_array[] = $row['ap_total'];
	$sub_array[] = $row['ob_total'];
	$sub_array[] = $row['apbd_total'];
	$sub_array[] = '<div class= "buttons">
						<a href="javascript:void();" data-id="'.$row['rao_id'].'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a>
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
