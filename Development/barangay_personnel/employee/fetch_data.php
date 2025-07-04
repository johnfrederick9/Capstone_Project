<?php
include('../../connection.php');

$output = array();
$sql = "SELECT * FROM tb_employee WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'employee_id',
	1 => 'employee_firstname',
	2 => 'employee_middlename',
	3 => 'employee_lastname',	
	4 => 'employee_address',	
	5 => 'employee_educationalattainment',		
	6 => 'employee_position',
	7 => 'employee_birthdate',	
	8 => 'employee_age', // Age will be computed dynamically
	9 => 'employee_contact', 
	10 => 'employee_status'
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
	$sql .= " AND (employee_firstname LIKE '%" . $search_value . "%'";
	$sql .= " OR employee_middlename LIKE '%" . $search_value . "%'";
	$sql .= " OR employee_lastname LIKE '%" . $search_value . "%'";
	$sql .= " OR employee_address LIKE '%" . $search_value . "%'";
	$sql .= " OR employee_educationalattainment LIKE '%" . $search_value . "%'";
	$sql .= " OR employee_age LIKE '%" . $search_value . "%'";
	$sql .= " OR employee_position LIKE '%" . $search_value . "%'";
	$sql .= " OR employee_birthdate LIKE '%" . $search_value . "%'";
	$sql .= " OR employee_status LIKE '%" . $search_value . "%')";
}

if ($_POST['length'] != -1) {
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT " . $start . ", " . $length;
}

$query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($query);
$data = array();

while ($row = mysqli_fetch_assoc($query)) {
	// Calculate the age based on employee_birthdate
	$birthdate = new DateTime($row['employee_birthdate']);
	$currentDate = new DateTime();
	$age = $currentDate->diff($birthdate)->y;

	 // Format first name, middle initial, and last name with capitalized first letters
	 $firstname = ucwords(strtolower($row['employee_firstname']));
	 $lastname = ucwords(strtolower($row['employee_lastname']));
	 $middle_initial = $row['employee_middlename'] 
		 ? strtoupper(substr($row['employee_middlename'], 0, 1)) . '.' 
		 : '';
	 
	 // Combine the formatted names into a full name
	 $full_name = $firstname . ' ' . $middle_initial . ' ' . $lastname;

	$sub_array = array();
	$sub_array[] = $row['employee_id'];
    $sub_array[] = $full_name; // Combined full name
	$sub_array[] = $row['employee_address'];
	$sub_array[] = $row['employee_educationalattainment'];
	$sub_array[] = $row['employee_position'];
	$sub_array[] = $row['employee_birthdate'];
	$sub_array[] = $age; // Use dynamically calculated age
	$sub_array[] = $row['employee_contact'];
	$sub_array[] = $row['employee_status'];
	$data[] = $sub_array;
}

$output = array(
	'draw' => intval($_POST['draw']),
	'recordsTotal' => $total_all_rows,
	'recordsFiltered' => $total_all_rows,
	'data' => $data,
);

echo json_encode($output);
?>
