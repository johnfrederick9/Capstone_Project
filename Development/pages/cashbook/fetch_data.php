<?php
include('../../connection.php');

$output = array();
$columns = array(
    0 => 'cashbook_id',
    1 => 'period_covered',
    2 => 'treasurer_name',
);

// Base query to get transaction data
$sql = "SELECT 
    cashbook_id,
    period_covered,
    treasurer_name
    FROM tb_cashbook
    WHERE isDisplayed = 1";  // No need for "1 = 1"

// Capture search value
$search_value = '';
if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    // Append search conditions
    $sql .= " AND (period_covered LIKE '%" . $search_value . "%' ";
    $sql .= " OR treasurer_name LIKE '%" . $search_value . "%')";
}

// Order by clause
if (isset($_POST['order'])) {
    $column_name = $columns[$_POST['order'][0]['column']];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY " . $column_name . " " . $order;
} else {
    $sql .= " ORDER BY period_covered DESC";
}

// Pagination
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT " . $start . ", " . $length;
}

// Execute query
$query = mysqli_query($con, $sql);
$count_filtered_rows = mysqli_num_rows($query); // Filtered rows

// Fetch total rows for DataTables pagination (no search applied)
$totalQuery = mysqli_query($con, "SELECT COUNT(cashbook_id) AS total FROM tb_cashbook WHERE isDisplayed = 1");
$totalRow = mysqli_fetch_assoc($totalQuery);
$total_all_rows = $totalRow['total'];

// Prepare data for DataTable
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['cashbook_id'];

    $formatted_date = date("F j, Y", strtotime($row['period_covered']));
    $sub_array[] = $formatted_date;
    
    $sub_array[] = $row['treasurer_name'];
    $sub_array[] = '<div class="dropdown">
                    <button class="action-btn" onclick="toggleDropdown(this)">
                        ACTIONS <i class="bx bx-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="javascript:void(0);" data-id="' . $row['cashbook_id'] . '" class="dropdown-item update-btn editbtn"><i class="bx bx-edit"></i></a>  
                       <a href="javascript:void(0);" data-item-id="' . $row['cashbook_id'] . '" class="dropdown-item view-btn infoBtn"><i class="bx bx-info-circle"></i></a>
                        <a href="javascript:void(0);" data-cashbook_id="' . $row['cashbook_id'] . '" class="dropdown-item delete-btn deleteBtn"><i class="bx bxs-trash"></i></a>
                    </div>
                </div>';
    $data[] = $sub_array;
}
//<a href="javascript:void(0);" data-item_id="' . $row['cashbook_id'] . '" class="update-btn btn-sm infoBtn"><i class="bx bx-info-circle"></i></a>
// Output response
$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $count_filtered_rows, // Corrected to show filtered records count
    'data' => $data,
);

echo json_encode($output);
?>
