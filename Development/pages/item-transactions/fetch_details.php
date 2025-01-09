<?php
// include('../../connection.php'); // Ensure correct database connection


// if (isset($_POST['transaction_id'])) {
//     $transaction_id = $_POST['transaction_id'];

//     $transaction_id = $_POST['transaction_id'];
//     $sql = "SELECT * FROM tb_item_transaction WHERE transaction_id='$transaction_id' LIMIT 1";
//     $query = mysqli_query($con,$sql);
//     $row = mysqli_fetch_assoc($query);
//     echo json_encode($row);    
    
// } else {
//     echo json_encode(['error' => 'transaction ID not provided']);
// }

include('../../connection.php'); // Ensure correct database connection

if (isset($_POST['transaction_id'])) {
    $transaction_id = $_POST['transaction_id'];

    // Query to fetch data along with CONCAT for borrowed items and borrowed quantities
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
            WHERE t.transaction_id = '$transaction_id' 
            GROUP BY t.transaction_id LIMIT 1"; // Limiting to 1 to fetch specific transaction data

    // Execute the query
    $query = mysqli_query($con, $sql);

    // Fetch the result as an associative array
    if ($query) {
        $row = mysqli_fetch_assoc($query);
        // Format date_borrowed and return_date if needed
        if ($row) {
            $row['date_borrowed'] = !empty($row['date_borrowed']) ? date("F j, Y", strtotime($row['date_borrowed'])): 'N/A';
            $row['reserved_on'] = !empty($row['reserved_on']) ? date("F j, Y", strtotime($row['reserved_on'])) : 'N/A';
            $row['return_date'] = !empty($row['return_date']) ? date("F j, Y", strtotime($row['return_date'])) : 'N/A';
            $row['date_returned'] = !empty($row['date_returned']) ? date("F j, Y", strtotime($row['date_returned'])) : 'N/A';
        }
        // Return the data as JSON
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Transaction ID not found']);
    }
} else {
    echo json_encode(['error' => 'Transaction ID not provided']);
}


?>