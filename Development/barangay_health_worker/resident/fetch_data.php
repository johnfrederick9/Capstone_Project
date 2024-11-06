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
    4 => 'resident_maidenname',    
    5 => 'resident_address',    
    6 => 'resident_educationalattainment',    
    7 => 'resident_birthdate',
    8 => 'resident_age', // Age will be computed dynamically
    8 => 'resident_contact',
    9 => 'resident_status',    
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (resident_firstname LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_middlename LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_lastname LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_maidenname LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_address LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_educationalattainment LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_birthdate LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_age LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_contact LIKE '%" . $search_value . "%'";
    $sql .= " OR resident_status LIKE '%" . $search_value . "%')";
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

    $sub_array = array();
    $sub_array[] = $row['resident_id'];
    $sub_array[] = '<input type="checkbox" class="row-checkbox" value="' . $row['resident_id'] . '">';
    $sub_array[] = $row['resident_firstname'];
    $sub_array[] = $row['resident_middlename'];
    $sub_array[] = $row['resident_lastname'];
    $sub_array[] = $row['resident_maidenname'];
    $sub_array[] = $row['resident_address'];
    $sub_array[] = $row['resident_educationalattainment'];
    $sub_array[] = $row['resident_birthdate'];
    $sub_array[] = $age; // Use the computed age
    $sub_array[] = $row['resident_contact'];
    $sub_array[] = $row['resident_status'];
    $sub_array[] = '
    <div class="dropdown">
        <button class="action-btn" onclick="toggleDropdown(this)">
            ACTIONS <i class="bx bx-chevron-down"></i>
        </button>
        <div class="dropdown-menu">
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
