<?php 
include('../../connection.php');

$output = array();
$sql = "SELECT * FROM tb_resident WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'resident_id',
    1 => 'resident_firstname',
    2 => 'resident_middlename',
    3 => 'resident_lastname',
    4 => 'resident_age',
    5 => 'resident_height',
    6 => 'resident_weight',
    7 => 'resident_heightstat',    
    8 => 'resident_weightstat',    
    9 => 'resident_BMIstat', 
    10 => 'resident_medical',    
    11 => 'resident_lactating',
    12 => 'resident_pregnant', 
    13 => 'resident_PWD',
    14 => 'resident_SY',    
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (resident_firstname LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_middlename LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_lastname LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_age LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_height LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_weight LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_heightstat LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_weightstat LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_BMIstat LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_medical LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_lactating LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_pregnant LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_PWD LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_SY LIKE '%" . $search_value . "%')";
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
    // Calculate the age based on resident_birthdate
    $birthdate = new DateTime($row['resident_birthdate']);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate)->y;

       // Format first name, middle initial, last name, and suffix with proper capitalization
       $firstname = ucwords(strtolower($row['resident_firstname']));
       $lastname = ucwords(strtolower($row['resident_lastname']));
       $middle_initial = $row['resident_middlename'] 
           ? strtoupper(substr($row['resident_middlename'], 0, 1)) . '.' 
           : '';
       $suffix = $row['resident_suffixes'] 
           ? ' ' . ucwords(strtolower($row['resident_suffixes'])) 
           : '';
   
       // Combine the formatted names into a full name
       $full_name = $firstname . ' ' . $middle_initial . ' ' . $lastname . $suffix;

    $sub_array = array();
    $sub_array[] = $row['resident_id'];
    $sub_array[] = '<input type="checkbox" class="row-checkbox" value="' . $row['resident_id'] . '">';
    $sub_array[] = $full_name; // Combined full name
    $sub_array[] = $age; // Use the computed age
    $sub_array[] = $row['resident_height'];
    $sub_array[] = $row['resident_weight'];
    $sub_array[] = $row['resident_BMIstat'];
    $sub_array[] = $row['resident_heightstat'];
    $sub_array[] = $row['resident_weightstat'];
    $sub_array[] = $row['resident_medical'];
    $sub_array[] = '
    <div class="dropdown">
        <button class="action-btn" onclick="toggleDropdown(this)">
            ACTIONS <i class="bx bx-chevron-down"></i>
        </button>
        <div class="dropdown-menu">
            <a href="javascript:void(0);" data-id="' . $row['resident_id'] . '" class="dropdown-item view-btn viewbtn">
                <i class="bx bx-show"></i>
            </a>
            <a href="javascript:void(0);" data-id="' . $row['resident_id'] . '" class="dropdown-item update-btn editbtn">
                <i class="bx bx-edit"></i>
            </a>
            <a href="javascript:void(0);" data-id="' . $row['resident_id'] . '" class="dropdown-item delete-btn deleteBtn">
                <i class="bx bx-trash"></i>
            </a>
        </div>
    </div>';
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
