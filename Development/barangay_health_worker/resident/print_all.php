<?php
include('../../connection.php');

// Fetch only resident data where isDisplayed = 1
$sql = "SELECT * FROM tb_resident WHERE isDisplayed = 1";
$query = mysqli_query($con, $sql);

echo '<html>
<head>
    <title>Residents Data</title>
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
        <h1>Resident Data Report</h1>
        <p>Barangay Information System</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Address</th>
                <th>Birth Date</th>
                <th>Age</th>
                <th>Height</th>
                <th>Weight</th>
                <th>Height Status</th>
                <th>Weight Status</th>
                <th>BMI Status</th>
                <th>Medical History</th>
                <th>Lactating</th>
                <th>Pregnant</th>
                <th>PWD</th>
                <th>Out Of SY</th>
            </tr>
        </thead>
        <tbody>';

// Output the selected resident data
while ($row = mysqli_fetch_assoc($query)) {
    // Combine name fields and create middle initial
    $middle_initial = !empty($row['resident_middlename']) ? strtoupper(substr($row['resident_middlename'], 0, 1)) . '.' : '';
    $full_name = $row['resident_firstname'] . ' ' . $middle_initial . ' ' . $row['resident_lastname'];

    echo '<tr>
            <td>'.$full_name.'</td>
            <td>'.$row['resident_address'].'</td>
            <td>'.$row['resident_birthdate'].'</td>
            <td>'.$row['resident_age'].'</td>
            <td>'.$row['resident_height'].'</td>
            <td>'.$row['resident_weight'].'</td>
            <td>'.$row['resident_heightstat'].'</td>
            <td>'.$row['resident_weightstat'].'</td>
            <td>'.$row['resident_BMIstat'].'</td>
            <td>'.$row['resident_medical'].'</td>
            <td>'.$row['resident_lactating'].'</td>
            <td>'.$row['resident_pregnant'].'</td>
            <td>'.$row['resident_PWD'].'</td>
            <td>'.$row['resident_SY'].'</td>
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
