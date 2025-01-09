<?php 
include('../../connection.php');

$output = array();
$columns = array(
    0 => 'rao_fe_id',
    1 => 'period_covered',
    2 => 'chairman',
    3 => 'brgy_captain'
);

// Query to get total number of records before filtering
$sql = "SELECT * FROM tb_rao_fe WHERE isDisplayed = 1"; 
$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

// Modify query for filtering and searching
$sql = "SELECT * FROM tb_rao_fe WHERE isDisplayed = 1"; // Reset base query for filtered data

if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (period_covered LIKE '%".$search_value."%' 
                OR chairman LIKE '%".$search_value."%' 
                OR brgy_captain LIKE '%".$search_value."%')";
}

// Ordering logic
if (isset($_POST['order'])) {
    $column_index = $_POST['order'][0]['column']; // Get the index of the column to order by
    $order = $_POST['order'][0]['dir']; // ASC or DESC
    $sql .= " ORDER BY ".$columns[$column_index]." ".$order."";
} else {
    $sql .= " ORDER BY period_covered DESC"; // Default ordering
}

// Pagination logic
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT ".$start.", ".$length;
}

// Query to fetch filtered data
$query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($query); // Number of filtered rows

$data = array();
while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['rao_fe_id'];

    $formatted_date = date("F Y", strtotime($row['period_covered']));
    $sub_array[] = $formatted_date;
    
    $sub_array[] = $row['chairman'];
    $sub_array[] = $row['brgy_captain'];
    $sub_array[] = '
   <div class="buttons">
				 <a href="javascript:void(0);" data-item-id="' . $row['rao_fe_id'] . '" class="dropdown-item view-btn infoBtn"><i class="bx bx-info-circle"></i></a>
			</div>';
    $data[] = $sub_array;
}

// Prepare output for DataTables
$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $total_all_rows, // Total records before filtering
    'recordsFiltered' => $count_rows,  // Total records after filtering
    'data' => $data, // Data to display
);

echo json_encode($output);
?>
