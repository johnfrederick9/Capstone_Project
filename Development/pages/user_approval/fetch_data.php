<?php 
include('../../connection.php');

// Initialize output array
$output = array();

// Base SQL query
$sql = "SELECT *, 
        CASE 
            WHEN isApproved = 1 THEN 'Approved' 
            WHEN isApproved = 3 THEN 'Disapproved' 
            ELSE 'Pending' 
        END as approval_status 
        FROM tb_user 
        WHERE barangayposition != 'Barangay Captain'"; // Exclude rows with position as 'captain'

// Get the total number of rows (before applying filters)
$totalQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM tb_user WHERE barangayposition != 'captain'");
$total_all_rows = mysqli_fetch_assoc($totalQuery)['total'];

// Search filter
if (isset($_POST['search']['value']) && $_POST['search']['value'] !== '') {
    $search_value = mysqli_real_escape_string($con, $_POST['search']['value']);
    $sql .= " AND (firstname LIKE '%$search_value%' 
                OR middlename LIKE '%$search_value%' 
                OR lastname LIKE '%$search_value%' 
                OR sex LIKE '%$search_value%' 
                OR barangayposition LIKE '%$search_value%' 
                OR username LIKE '%$search_value%')";
}

// Pagination
if (isset($_POST['length']) && $_POST['length'] != -1) {
    $start = intval($_POST['start']);
    $length = intval($_POST['length']);
    $sql .= " LIMIT $start, $length";
}

// Execute the query
$query = mysqli_query($con, $sql);
if (!$query) {
    die(json_encode(array("error" => mysqli_error($con))));
}
$count_rows = mysqli_num_rows($query);

// Prepare data for output
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
    $full_name = ucwords(strtolower($row['firstname'])) . ' ' . 
                 ($row['middlename'] ? strtoupper(substr($row['middlename'], 0, 1)) . '. ' : '') . 
                 ucwords(strtolower($row['lastname'])) . 
                 ($row['suffix'] ? ' ' . ucwords(strtolower($row['suffix'])) : '');

    $sub_array = array();
    $sub_array[] = $row['user_id'];
    $sub_array[] = $full_name;
    $sub_array[] = $row['sex'];
    $sub_array[] = $row['birthdate'];
    $sub_array[] = $row['barangayposition'];
    $sub_array[] = $row['username'];

    if ($row['approval_status'] === 'Pending') {
        $sub_array[] = '
        <div class="button-column">
            <button class="btn-approve custom-approve-btn" data-id="' . htmlspecialchars($row['user_id']) . '">Approve</button>
            <button class="btn-disapprove custom-disapprove-btn" data-id="' . htmlspecialchars($row['user_id']) . '">Disapprove</button>
        </div>';
    } else {
        $sub_array[] = '<span class="approval-status">' . htmlspecialchars($row['approval_status']) . '</span>';
    }

    $data[] = $sub_array;
}

// Output final JSON data
$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $count_rows,
    'data' => $data,
);

echo json_encode($output);
?>
