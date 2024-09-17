<?php include('../../connection.php');

$output= array();
$sql = "SELECT * FROM tb_indigency ";

	$totalQuery = mysqli_query($con,$sql);
	$total_all_rows = mysqli_num_rows($totalQuery);

	$columns = array(
		0 => 'indigency_id',
		1 => 'indigency_cname',
	2 => 'indigency_mname',
	3 => 'indigency_fname',
	4 => 'indigency_date',	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE indigency_cname like '%".$search_value."%'";
	$sql .= " OR indigency_mname like '%".$search_value."%'";
	$sql .= " OR indigency_fname like '%".$search_value."%'";
	$sql .= " OR indigency_date like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY indigency_id desc";
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
	$sub_array[] = $row['indigency_id'];
	$sub_array[] = $row['indigency_cname'];
	$sub_array[] = $row['indigency_mname'];
	$sub_array[] = $row['indigency_fname'];
	$sub_array[] = $row['indigency_date'];
	$sub_array[] = '<div class= "buttons">
						<a href="javascript:void();" data-id="'.$row['indigency_id'].'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a> 
						<a href="javascript:void();"<button class="print-btn" onclick="printCertificate('.$row['indigency_id'].')"><i class="bx bx-printer"></i></button></a> 
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
