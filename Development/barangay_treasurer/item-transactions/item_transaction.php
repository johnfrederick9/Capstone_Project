<?php
include "../../sidebar_officials.php";
include '../../head.php';
require '../../database.php';

include('../../connection.php');

//Fetch available items open for lending from the tb_inventory table
$item_query = "
    SELECT 
        item_id, 
        item_name,
        available_count
    FROM 
        tb_inventory 
    WHERE 
        lendability = 1 AND available_count > 0 AND isDisplayed = 1
";
$item_result = $con->query($item_query);

// Fetch and output the items as JSON
$items = [];
while ($row = $item_result->fetch_assoc()) {
    $items[] = $row;
}
$items_json = json_encode($items);


// Fetch the items borrowed in the current transaction
$borrowed_items_query = "
    SELECT
        i.item_id,
        i.item_name,
        i.available_count,
        i.lendability,
        t.borrow_quantity,
        t.return_quantity,
        t.item_status
    FROM
        tb_transaction_items t
    INNER JOIN tb_inventory i ON i.item_id = t.item_id
    WHERE
        t.transaction_id = ? AND
        t.item_status = 'Borrowed'
";
$stmt = $conn->prepare($borrowed_items_query);
$stmt->bind_param("i", $transaction_id);
$stmt->execute();
$borrowed_items_result = $stmt->get_result();

// Store borrowed items
$borrowedItems = [];
while ($row = $borrowed_items_result->fetch_assoc()) {
    $borrowedItems[] = $row;
}

// Fetch all items from tb_inventory and determine available items
$available_items_query = "
    SELECT
        i.item_id,
        i.item_name,
        i.available_count
    FROM
        tb_inventory i
    WHERE
        lendability = 1 AND available_count > 0 
";
$available_items_result = $conn->query($available_items_query);

// Store available items and filter out borrowed items
$availableItems = [];
$borrowedItemIds = array_column($borrowedItems, 'item_id');
while ($row = $available_items_result->fetch_assoc()) {
    // Exclude items that are already borrowed in the current transaction
    if (!in_array($row['item_id'], $borrowedItemIds)) {
        $availableItems[] = $row;
    }
}

// Combine borrowed items with available items
$combinedItems = array_merge($borrowedItems, $availableItems);

// Encode data for JavaScript
$items_json_2 = json_encode($combinedItems);
$borrowedItems_json = json_encode($borrowedItems);
?>
<style>
    .head{
        margin-top: 10px;
    }
    .inventory{
        margin-top: 20px;
    }
    .inventory .print-btn, .add-popup{
        display: none;
    }
    .dataTables_filter{
      margin-left: 800px;
    }
</style>
<body>
    <section class="home">  
        <div class="inventory">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Item Transaction Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Item</button>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Items</th>
                        <th>Quantity</th>
                        <th>Reserved Date</th>
                        <th>Borrowed Date</th>
                        <th>Return Date</th>
                        <th>Approved By</th>
                        <th>Released By</th>
                        <th>Date Returned</th>
                        <th>Return Quantity</th>
                        <th>Transaction Status</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                <script type="text/javascript">
             $(document).ready(function() {
                $('#example').DataTable({
                    "fnCreatedRow": function(nRow, aData, iDataIndex) {
                        // Set row ID and data attribute for delete button
                        $(nRow).attr('id', aData[0]);
                        $(nRow).find('.deleteBtn').attr('data-transaction_id', aData[0]);
                    },
                    'serverSide': true, // Boolean value without quotes
                    'processing': true,
                    'paging': true,
                    'order': [], // Empty array means no initial ordering
                    'ajax': {
                        'url': 'fetch_data.php',
                        'type': 'POST',
                    },
                    "columnDefs": [
                        {
                            "targets": [0, 2, 4, 11],  // Target specific columns
                            "visible": false, // Hide those columns
                            "searchable": false // Disable search for those columns
                        },
                        {
                            "targets": [10], // Target column 10
                            "orderable": false // Disable sorting for column 10
                        }
                    ]
                });
            });
                    </script>
                </section><!-- .home-->
</body>
</html>
