<?php include('../../connection.php');

$output= array();
$sql = "SELECT * FROM tb_employee ";

	$totalQuery = mysqli_query($con,$sql);
	$total_all_rows = mysqli_num_rows($totalQuery);

	$columns = array(
		0 => 'employee_firstname',
	1 => 'employee_middlename',
	2 => 'employee_lastname',
	3 => 'employee_maidenname',	
	4 => 'employee_address',	
	5 => 'employee_educationalattainment',	
	6 => 'employee_birthdate',	
	7 => 'employee_age',
	8 => 'employee_status',	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE employee_firstname like '%".$search_value."%'";
	$sql .= " OR employee_middlename like '%".$search_value."%'";
	$sql .= " OR employee_lastname like '%".$search_value."%'";
	$sql .= " OR employee_maidenname like '%".$search_value."%'";
	$sql .= " OR employee_address like '%".$search_value."%'";
	$sql .= " OR employee_educationalattainment like '%".$search_value."%'";
	$sql .= " OR employee_birthdate like '%".$search_value."%'";
	$sql .= " OR employee_age like '%".$search_value."%'";
	$sql .= " OR employee_status like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY employee_id desc";
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
	$sub_array[] = $row['employee_firstname'];
	$sub_array[] = $row['employee_middlename'];
	$sub_array[] = $row['employee_lastname'];
	$sub_array[] = $row['employee_maidenname'];
	$sub_array[] = $row['employee_address'];
	$sub_array[] = $row['employee_educationalattainment'];
	$sub_array[] = $row['employee_birthdate'];
	$sub_array[] = $row['employee_age'];
	$sub_array[] = $row['employee_status'];
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
