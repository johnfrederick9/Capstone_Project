<?php
include('../../connection.php');

// Fetch all request data from the database where isDisplayed is 1
$sql = "SELECT * FROM tb_request WHERE isDisplayed=1";
$query = mysqli_query($con, $sql);

echo '<html>
<head>
    <title>Print Selected Request</title>
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
        <h1>Request Data Report</h1>
        <p>Barangay Information System</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Requester Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>';

// Output the selected resident data
while ($row = mysqli_fetch_assoc($query)) {
    echo '<tr>
            <td>'.$row['requester_name'].'</td>
            <td>'.$row['request_type'].'</td>
            <td>'.$row['request_description'].'</td>
            <td>'.$row['request_date'].'</td>
            <td>'.$row['request_status'].'</td>
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
