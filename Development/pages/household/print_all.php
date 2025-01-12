<?php 
include('../../connection.php');

// Fetch only household data where isDisplayed = 1
$sql = "SELECT household_id FROM tb_household WHERE isDisplayed = 1";
$query = mysqli_query($con, $sql);

echo '<html>
<head>
    <title>Household Data</title>
    <style>
        @page {
            size: 8.5in 11in;
            margin: 10mm 15mm 20mm 15mm;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>Household Data Report</h1>
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

while ($row = mysqli_fetch_assoc($query)) {
    // Fetch members of the current household
    $household_id = $row['household_id'];
    $member_query = "SELECT CONCAT(resident_firstname, ' ', resident_middlename, ' ', resident_lastname) AS full_name, resident_householdrole 
                     FROM tb_resident 
                     WHERE household_id = $household_id AND isDisplayed = 1";
    $member_result = mysqli_query($con, $member_query);

    // Output each member for the household
    while ($member = mysqli_fetch_assoc($member_result)) {
        echo '<tr>
                <td>' . $household_id . '</td>
                <td>' . $member['full_name'] . '</td>
                <td>' . $member['resident_householdrole'] . '</td>
              </tr>';
    }
}

echo '</tbody>
    </table>
    <script>
        window.onload = function() {
            window.print(); // Automatically open the print dialog
            window.onafterprint = function() {
                window.close(); // Close the window after printing
            };
        };
    </script>
</body>
</html>';
?>
