<?php
include('../../connection.php');


$sql = "SELECT * FROM tb_project";
$query = mysqli_query($con, $sql);

echo '<html>
<head>
    <title>Barangay Information System</title>
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
        <h1>Project Data Report</h1>
        <p>Barangay Information System</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Project Start</th>
                <th>Project End</th>
                <th>Project Budget</th>
                <th>Project Source</th>
                <th>Project Status</th>
                <th>Project Description</th>
                <th>Project Location</th>
                <th>Project Managers</th>
                <th>Project Stakeholders</th>
            </tr>
        </thead>
        <tbody>';


while ($row = mysqli_fetch_assoc($query)) {
    echo '<tr>
            <td>'.$row['project_name'].'</td>
            <td>'.$row['project_start'].'</td>
            <td>'.$row['project_end'].'</td>
            <td>'.$row['project_budget'].'</td>
            <td>'.$row['project_source'].'</td>
            <td>'.$row['project_status'].'</td>
            <td>'.$row['project_description'].'</td>
            <td>'.$row['project_location'].'</td>
            <td>'.$row['project_managers'].'</td>
            <td>'.$row['project_stakeholders'].'</td>
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
