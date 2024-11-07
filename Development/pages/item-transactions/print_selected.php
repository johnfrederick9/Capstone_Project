<?php
include('../../connection.php');

$ids = $_GET['ids'];
$idArray = explode(',', $ids);

$sql = "SELECT * FROM tb_item_transaction WHERE transaction_id IN (".implode(',', $idArray).")";
$query = mysqli_query($con, $sql);

echo '<html>
<head>
    <title>Print Selected Item Transaction</title>
    <style>
        @page {
            size: 8.5in 11in; /* Short bond paper size */
            margin: 15mm 10mm; /* Standard margins: 15mm top/bottom, 10mm sides */
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

// Output the selected resident data
while ($row = mysqli_fetch_assoc($query)) {
    echo '<tr>
            <td>'.$row['borrower_name'].'</td>
            <td>'.$row['reserved_on'].'</td>
            <td>'.$row['date_borrowed'].'</td>
            <td>'.$row['return_date'].'</td>
            <td>'.$row['approved_by'].'</td>
            <td>'.$row['released_by'].'</td>
            <td>'.$row['date_returned'].'</td>
            <td>'.$row['transaction_status'].'</td>
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
