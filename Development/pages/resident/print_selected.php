<?php
include('../../connection.php');

$ids = $_GET['ids'];
$idArray = explode(',', $ids);

$sql = "SELECT * FROM tb_resident WHERE resident_id IN (".implode(',', $idArray).")";
$query = mysqli_query($con, $sql);

echo '<html>
<head>
    <title>Print Selected Residents</title>
    <style>
        @page {
            size: A4 portrait; /* Keeps the default portrait size */
            margin: 5mm; /* Slight margin to prevent content from touching the edges */
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0; /* Removed padding to fit content better */
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
            page-break-inside: avoid; /* Prevents page break within table rows */
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin: 0; /* Removed margin */
            padding: 10px 0; /* Added padding */
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
                height: auto; /* Adjusted to avoid unnecessary space */
                overflow: visible; /* Allow content to render properly */
            }
            .header, table {
                page-break-after: avoid; /* Avoid page break after the header and table */
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Resident Data Report</h1>
        <p>Barangay Information System</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Maiden Name</th>
                <th>Address</th>
                <th>Educational Attainment</th>
                <th>Birth Date</th>
                <th>Age</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>';

// Output the selected resident data
while ($row = mysqli_fetch_assoc($query)) {
    echo '<tr>
            <td>'.$row['resident_firstname'].'</td>
            <td>'.$row['resident_middlename'].'</td>
            <td>'.$row['resident_lastname'].'</td>
            <td>'.$row['resident_maidenname'].'</td>
            <td>'.$row['resident_address'].'</td>
            <td>'.$row['resident_educationalattainment'].'</td>
            <td>'.$row['resident_birthdate'].'</td>
            <td>'.$row['resident_age'].'</td>
            <td>'.$row['resident_status'].'</td>
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
