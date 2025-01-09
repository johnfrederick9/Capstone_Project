<?php
include('../../connection.php');

$sql = "SELECT 
            t.borrower_name, 
            t.reserved_on, 
            t.date_borrowed, 
            t.return_date, 
            t.approved_by, 
            t.released_by, 
            t.date_returned, 
            t.transaction_status,
            GROUP_CONCAT(i.item_name SEPARATOR ', ') AS borrowed_items,
            GROUP_CONCAT(i.borrow_quantity SEPARATOR ', ') AS borrowed_quantities
        FROM 
            tb_item_transaction t
        LEFT JOIN 
            tb_transaction_items i ON t.transaction_id = i.transaction_id
        WHERE 
            t.isDisplayed = 1
        GROUP BY 
            t.transaction_id";

$query = mysqli_query($con, $sql);

echo '<html>
<head>
    <title>Print Selected Residents</title>
     <style>
        @page {
            size: 8.5in 11in; /* Short bond paper size */
            margin: 10mm 15mm 20mm 15mm; /* Top: 15mm Right: 15mm Bottom: 20mm Left: 15mm */
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            font-size: 12px;
            page-break-inside: avoid;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin: 0;
            padding: 10px 0;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
        }
        .header p {
            font-size: 12px;
            margin: 0;
        }

        /* Hide print header and footer */
        @media print {
            body {
                margin: 0;
            }
            html, body {
                height: auto;
                overflow: visible;
            }
            .header, table {
                page-break-after: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Item Transaction Data Report</h1>
        <p>Barangay Information System</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Borrowed Items</th>
                <th>Borrowed Quantities</th>
                <th>Reserved Date</th>
                <th>Borrowed Date</th>
                <th>Return Date</th>
                <th>Approved By</th>
                <th>Released By</th>
                <th>Date Returned</th>
                <th>Transaction Status</th>
            </tr>
        </thead>
        <tbody>';

        while ($row = mysqli_fetch_assoc($query)) {
            // Format dates before output
            $reserved_on = date('d M, Y', strtotime($row['reserved_on']));
            $date_borrowed = date('d M, Y', strtotime($row['date_borrowed']));
            $return_date = date('d M, Y', strtotime($row['return_date']));
            $date_returned = $row['date_returned'] ? date('d M, Y', strtotime($row['date_returned'])) : 'N/A';
        
            echo '<tr>
                    <td>'.$row['borrower_name'].'</td>
                    <td>'.$reserved_on.'</td>
                    <td>'.$date_borrowed.'</td>
                    <td>'.$return_date.'</td>
                    <td>'.$row['approved_by'].'</td>
                    <td>'.$row['released_by'].'</td>
                    <td>'.$date_returned.'</td>
                    <td>'.$row['transaction_status'].'</td>
                    <td>'.$row['borrowed_items'].'</td>
                    <td>'.$row['borrowed_quantities'].'</td>
                  </tr>';
        }

echo '</tbody></table>';
?>

<script>
    // Print only once and prevent multiple print dialogs
    window.onload = function() {
        window.print(); // Automatically open print dialog
        window.onafterprint = function() {
            window.close(); // Close the window after printing is done
        };
    };
</script>

</body>
</html>
