<?php
include('../../connection.php');


$sql = "SELECT * FROM tb_employee WHERE isDisplayed=1";
$query = mysqli_query($con, $sql);

echo '<html>
<head>
    <title>Employees Data</title>
    <style>
        @page {
            size: 8.5in 11in; /* Short bond paper size */
            margin: 10mm 15mm 20mm 17mm; /* Top: 15mm Right: 15mm Bottom: 20mm Left: 15mm */
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
        <h1>Employee Data Report</h1>
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


while ($row = mysqli_fetch_assoc($query)) {
    echo '<tr>
            <td>'.$row['employee_firstname'].'</td>
            <td>'.$row['employee_middlename'].'</td>
            <td>'.$row['employee_lastname'].'</td>
            <td>'.$row['employee_maidenname'].'</td>
            <td>'.$row['employee_address'].'</td>
            <td>'.$row['employee_educationalattainment'].'</td>
            <td>'.$row['employee_birthdate'].'</td>
            <td>'.$row['employee_age'].'</td>
            <td>'.$row['employee_status'].'</td>
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
