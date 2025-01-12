<?php
include('../../connection.php');

// Retrieve selected household IDs
$ids = $_GET['ids'];
$idArray = explode(',', $ids);

// Fetch members linked to the selected households
$sql = "SELECT * FROM tb_resident WHERE household_id IN (".implode(',', array_map('intval', $idArray)).")";
$query = mysqli_query($con, $sql);

echo '<html>
<head>
    <title>Household Members Report</title>
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
        <h1>Household Members Report</h1>
        <p>Barangay Information System</p>
    </div>
    <table>
        <thead>
            <tr>
                 <th>Household Number</th>
                <th>Member Name</th>
                <th>Role</th>           
            </tr>
        </thead>
        <tbody>';

// Output the selected member data
while ($row = mysqli_fetch_assoc($query)) {
    $fullName = $row['resident_firstname'] . ' ' . $row['resident_middlename'] . ' ' . $row['resident_lastname'];
    echo '<tr>
            <td>' . $row['household_id'] . '</td>
            <td>' . $fullName . '</td>
            <td>' . $row['resident_householdrole'] . '</td>
            
          </tr>';
}

echo '</tbody>
    </table>
</body>
<script>
    // Automatically open the print dialog and close the window after printing
    window.onload = function() {
        window.print();
        window.onafterprint = function() {
            window.close();
        };
    };
</script>
</html>';
?>
