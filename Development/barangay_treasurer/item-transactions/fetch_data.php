<?php
include('../../connection.php');

$output = array();
$columns = array(
    0 => 'transaction_id',
    1 => 'borrower_name',
    2 => 'borrower_address',
    3 => 'borrowed_items',
    4 => 'borrowed_quantities',
    5 => 'reserved_on',
    6 => 'date_borrowed',
    7 => 'return_date',
    8 => 'approved_by',
    9 => 'released_by',
    10 => 'returned_by',
    11 => 'date_returned',
    12 => 'return_quantities',
    13 => 'transaction_status',
);

// Base query to get transaction data
$sql = "SELECT 
        t.transaction_id,
        t.borrower_name, 
        t.borrower_address, 
        GROUP_CONCAT(i.item_name SEPARATOR ', ') AS borrowed_items,
        GROUP_CONCAT(i.borrow_quantity SEPARATOR ', ') AS borrowed_quantities,
        t.reserved_on, 
        t.date_borrowed,
        t.return_date, 
        t.approved_by, 
        t.released_by, 
        t.returned_by, 
        t.date_returned,
        GROUP_CONCAT(i.return_quantity SEPARATOR ', ') AS returned_quantities,
        t.transaction_status
    FROM 
        tb_item_transaction t
    LEFT JOIN 
        tb_transaction_items i 
    ON 
        t.transaction_id = i.transaction_id
    WHERE 1 = 1 AND isDisplayed = 1";  // Add a placeholder to simplify appending conditions later

// Capture search value
if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    // Append search conditions
    $sql .= " AND (t.borrower_name LIKE '%" . $search_value . "%' ";
    $sql .= " OR t.borrower_address LIKE '%" . $search_value . "%' ";
    $sql .= " OR GROUP_CONCAT(i.item_name SEPARATOR ', ') LIKE '%" . $search_value . "%' ";
    $sql .= " OR GROUP_CONCAT(i.borrow_quantity SEPARATOR ', ') LIKE '%" . $search_value . "%' ";
    $sql .= " OR t.reserved_on LIKE '%" . $search_value . "%' ";
    $sql .= " OR t.date_borrowed LIKE '%" . $search_value . "%' ";
    $sql .= " OR t.return_date LIKE '%" . $search_value . "%' ";
    $sql .= " OR t.approved_by LIKE '%" . $search_value . "%' ";
    $sql .= " OR t.released_by LIKE '%" . $search_value . "%' ";
    $sql .= " OR t.date_returned LIKE '%" . $search_value . "%' ";
    $sql .= " OR GROUP_CONCAT(i.return_quantity SEPARATOR ', ') LIKE '%" . $search_value . "%' ";
    $sql .= " OR t.transaction_status LIKE '%" . $search_value . "%')";
}

// Add GROUP BY clause
$sql .= " GROUP BY t.transaction_id";

// Order by clause
if (isset($_POST['order'])) {
    $column_name = $columns[$_POST['order'][0]['column']];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY " . $column_name . " " . $order;
} else {
    $sql .= " ORDER BY t.transaction_id DESC";
}

// Pagination
if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT " . $start . ", " . $length;
}

// Execute query
$query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($query);

// Fetch total rows for DataTables pagination
$totalQuery = mysqli_query($con, "SELECT COUNT(DISTINCT transaction_id) AS total FROM tb_item_transaction");
$totalRow = mysqli_fetch_assoc($totalQuery);
$total_all_rows = $totalRow['total'];

// Prepare data for DataTable
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['transaction_id'];
    $sub_array[] = $row['borrower_name'];
    $sub_array[] = $row['borrower_address'];
    $sub_array[] = $row['borrowed_items'];  // Use alias
    $sub_array[] = $row['borrowed_quantities'];  // Use alias
    $sub_array[] = $row['reserved_on'];
    $sub_array[] = $row['date_borrowed'];
    $sub_array[] = $row['return_date'];
    $sub_array[] = $row['approved_by'];
    $sub_array[] = $row['released_by'];
    $sub_array[] = $row['date_returned'];
    $sub_array[] = $row['returned_quantities'];
    $sub_array[] = $row['transaction_status'];
    $data[] = $sub_array;
}

// Output response
$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $total_all_rows,
    'data' => $data,
);

echo json_encode($output);
?>
