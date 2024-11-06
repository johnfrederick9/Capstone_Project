<?php include('../../connection.php');

$output= array();
$sql = "SELECT * FROM tb_resident ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'resident_firstname',
    1 => 'resident_middlename',
    2 => 'resident_lastname',
    3 => 'resident_maidenname',    
    4 => 'resident_address',    
    5 => 'resident_educationalattainment',    
    6 => 'resident_birthdate',    
    7 => 'resident_age',
    8 => 'resident_status',    
);

if(isset($_POST['search']['value']))
{
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE resident_firstname like '%".$search_value."%'";
    $sql .= " OR resident_middlename like '%".$search_value."%'";
    $sql .= " OR resident_lastname like '%".$search_value."%'";
    $sql .= " OR resident_maidenname like '%".$search_value."%'";
    $sql .= " OR resident_address like '%".$search_value."%'";
    $sql .= " OR resident_educationalattainment like '%".$search_value."%'";
    $sql .= " OR resident_birthdate like '%".$search_value."%'";
    $sql .= " OR resident_age like '%".$search_value."%'";
    $sql .= " OR resident_status like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
    $sql .= " ORDER BY resident_id desc";
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
    $sub_array[] = $row['resident_firstname'];
    $sub_array[] = $row['resident_middlename'];
    $sub_array[] = $row['resident_lastname'];
    $sub_array[] = $row['resident_maidenname'];
    $sub_array[] = $row['resident_address'];
    $sub_array[] = $row['resident_educationalattainment'];
    $sub_array[] = $row['resident_birthdate'];
    $sub_array[] = $row['resident_age'];
    $sub_array[] = $row['resident_status'];
    $data[] = $sub_array;
}

$output = array(
    'draw'=> intval($_POST['draw']),
    'recordsTotal' =>$count_rows ,
    'recordsFiltered'=>   $total_all_rows,
    'data'=>$data,
);
echo json_encode($output);
