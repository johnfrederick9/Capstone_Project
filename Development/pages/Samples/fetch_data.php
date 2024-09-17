<?php include('../../connection.php');

$output= array();
$sql = "SELECT * FROM tb_financial";

	$totalQuery = mysqli_query($con,$sql);
	$total_all_rows = mysqli_num_rows($totalQuery);

	$columns = array(
		0 => 'financial_id',
		1 => 'financial_type',
		2 => 'financial_date',
		3 => 'financial_filepath',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE financial_type like '%".$search_value."%'";
	$sql .= " OR financial_date like '%".$search_value."%'";
	$sql .= " OR financial_filepath like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY financial_id desc";
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
	$sub_array[] = $row['financial_id'];
	$sub_array[] = $row['financial_type'];
	$sub_array[] = $row['financial_date'];
	$sub_array[] = $row['financial_filepath'];
	$sub_array[] = '<div class= "buttons">
						<a href="javascript:void();" data-id="'.$row['financial_id'].'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a>
						<a href="javascript:void();" data-id="'.$row['financial_filepath'].'"  class="view-btn btn-sm viewbtn" ><i class="bx bx-show"></i></a>  
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
