<?php 
include('../../connection.php');

// Initialize output array
$output = array();
$sql = "SELECT * FROM tb_user WHERE isApproved = 0";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'user_id',
    1 => 'firstname',
    2 => 'middlename',
    3 => 'lastname',
    4 => 'sex',    
    5 => 'birthdate',    
    6 => 'barangayposition',    
    7 => 'username',
    8 => 'suffix', 
);

if (isset($_POST['search']['value'])) {
    $search_value = mysqli_real_escape_string($con, $_POST['search']['value']); // Sanitize input
    $sql .= " AND (firstname LIKE '%" . $search_value . "%'";
    $sql .= " OR middlename LIKE '%" . $search_value . "%'";
    $sql .= " OR lastname LIKE '%" . $search_value . "%'";
    $sql .= " OR sex LIKE '%" . $search_value . "%'";
    $sql .= " OR birthdate LIKE '%" . $search_value . "%'";
    $sql .= " OR barangayposition LIKE '%" . $search_value . "%'";
    $sql .= " OR username LIKE '%" . $search_value . "%')";
}

if ($_POST['length'] != -1) {
    $start = intval($_POST['start']); // Ensure input is an integer
    $length = intval($_POST['length']); // Ensure input is an integer
    $sql .= " LIMIT " . $start . ", " . $length;
}

$query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($query); // Use the filtered query count
$data = array();

while ($row = mysqli_fetch_assoc($query)) {
    $firstname = ucwords(strtolower($row['firstname']));
    $lastname = ucwords(strtolower($row['lastname']));
    $middle_initial = $row['middlename'] 
        ? strtoupper(substr($row['middlename'], 0, 1)) . '.' 
        : '';
    $suffix = $row['suffix'] // Corrected field name
        ? ' ' . ucwords(strtolower($row['suffix'])) 
        : '';

    $full_name = $firstname . ' ' . $middle_initial . ' ' . $lastname . $suffix;

    $sub_array = array();
    $sub_array[] = $row['user_id']; // Output as-is
    $sub_array[] = $full_name;      // Full name
    $sub_array[] = $row['sex'];     // Sex
    $sub_array[] = $row['birthdate']; // Birthdate
    $sub_array[] = $row['barangayposition']; // Position
    $sub_array[] = $row['username']; // Username
    $sub_array[] = '
    <div class="button-column">
        <button class="btn-approve custom-approve-btn" data-id="' . htmlspecialchars($row['user_id']) . '">Approve</button>
        <button class="btn-disapprove custom-disapprove-btn" data-id="' . htmlspecialchars($row['user_id']) . '">Disapprove</button>
    </div>
';
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $count_rows, // Corrected to filtered query count
    'data' => $data,
);

echo json_encode($output);
?>
