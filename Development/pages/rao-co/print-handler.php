<?php
include('../../connection.php');


// Helper functions
function formatPeriodCovered($dateString) {
    if (!$dateString || $dateString === "0000-00-00") {
        return "";
    }
    $date = new DateTime($dateString);
    $month = strtoupper($date->format('F'));
    $year = $date->format('Y');
    $lastDay = date('t', strtotime($dateString));
    return "{$month} 1-{$lastDay}, {$year}";
}

function formatValue($value) {
    if ($value == 0 || $value == '0') {
        return ' ';
    }
    
    if (is_numeric($value)) {
        // Format with 2 decimal places
        return number_format((float)$value, 2);
    }
    
    return $value ?: ' ';
}

    // Fetch rao_id from POST request
    $rao_co_id = isset($_POST['rao_co_id']) ? intval($_POST['rao_co_id']) : '7';

    // Validate rao_id
    if ($rao_co_id <= 0) {
        echo json_encode(['status' => 'false', 'error' => 'Invalid rao_co_id']);
        exit();
    }

    // Prepare and execute SQL query
    $sql_fetch_attr_name = "SELECT rao_co_att_id, attribute_name FROM tb_rao_co_attributes WHERE rao_co_id = ? AND isDisplayed = 1";
    $stmt_fetch_attr_name = mysqli_prepare($con, $sql_fetch_attr_name);
    mysqli_stmt_bind_param($stmt_fetch_attr_name, "i", $rao_co_id);
    if (!mysqli_stmt_execute($stmt_fetch_attr_name)) {
        throw new Exception("Error executing fetch attribute query: " . mysqli_error($con));
    }
    // Bind and fetch results
    $result = mysqli_stmt_get_result($stmt_fetch_attr_name);
    $attribute_names = [];
    $attribute_ids = [];  // To store the rao_co_att_id
    
    // Fetch all rows and collect attribute names and ids
    while ($row = mysqli_fetch_assoc($result)) {
        $attribute_names[] = $row['attribute_name'];
        $attribute_ids[] = $row['rao_co_att_id'];  // Store the rao_co_att_id
    }
    
    // Close the statement
    mysqli_stmt_close($stmt_fetch_attr_name);

    $sql_fetch_rao_co = "SELECT chairman, period_covered, brgy_captain FROM tb_rao_co WHERE rao_co_id = ? AND isDisplayed = 1 ";
    $stmt_fetch_rao_co = mysqli_prepare($con, $sql_fetch_rao_co);
    mysqli_stmt_bind_param($stmt_fetch_rao_co, "i", $rao_co_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_co)) {
        throw new Exception("Error executing fetch rao_co query: " . mysqli_error($con));
    }

    // Fetch the result
    $result_fetch_rao_co = mysqli_stmt_get_result($stmt_fetch_rao_co);

    if ($row = mysqli_fetch_assoc($result_fetch_rao_co)) {
        $chairman = $row['chairman'];
        $period_covered = $row['period_covered'];
        $brgy_captain = $row['brgy_captain'];
    } else {
        throw new Exception("No data found for rao_co_id: " . $rao_co_id . " in tb_rao_co");
    }

    // Close the statement to free resources
    mysqli_stmt_close($stmt_fetch_rao_co);

    /////////////////////////////// AP

    $rao_co_ap = []; // Initialize the array for storing fetched rao_co_ap data
    $rao_co_ap_data = []; // Initialize the array for storing fetched rao_co_ap_data

    // Fetch data from tb_rao_co_ap
    $sql_fetch_rao_co_ap = "SELECT * FROM tb_rao_co_ap WHERE rao_co_id = ?";
    $stmt_fetch_rao_co_ap = mysqli_prepare($con, $sql_fetch_rao_co_ap);
    mysqli_stmt_bind_param($stmt_fetch_rao_co_ap, "i", $rao_co_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_co_ap)) {
        throw new Exception("Error executing fetch rao_co_ap query: " . mysqli_error($con));
    }
    $rao_co_ap_result = mysqli_stmt_get_result($stmt_fetch_rao_co_ap);

    // Fetch rows into $rao_co_ap
    while ($row = $rao_co_ap_result->fetch_assoc()) {
        $rao_co_ap[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_co_ap);

    // Fetch data from tb_rao_co_ap_data for each rao_co_ap_id
    foreach ($rao_co_ap as $apItem) {
        $rao_co_ap_id = $apItem['rao_co_ap_id']; // Get rao_co_ap_id from the row

        $sql_fetch_rao_co_ap_data = "SELECT * FROM tb_rao_co_ap_data WHERE rao_co_ap_id = ? AND isDisplayed = 1 ORDER BY rao_co_att_id ASC";
        $stmt_fetch_rao_co_ap_data = mysqli_prepare($con, $sql_fetch_rao_co_ap_data);
        mysqli_stmt_bind_param($stmt_fetch_rao_co_ap_data, "i", $rao_co_ap_id);
        if (!mysqli_stmt_execute($stmt_fetch_rao_co_ap_data)) {
            throw new Exception("Error executing fetch rao_co_ap_data query: " . mysqli_error($con));
        }
        $rao_co_ap_result_data = mysqli_stmt_get_result($stmt_fetch_rao_co_ap_data);

        // Fetch rows into $rao_co_ap_data
        while ($row = $rao_co_ap_result_data->fetch_assoc()) {
            $rao_co_ap_data[] = $row; // Append each row to the array
        }

        mysqli_stmt_close($stmt_fetch_rao_co_ap_data);
    }

    //Fetch from tb_rao_co_ap_totals
    $rao_co_ap_BF_totals = [];
    $rao_co_ap_TA_totals = [];
    $rao_co_ap_grand_totals = [];

    // Fetch data from tb_rao_co_ap_totals
    $sql_fetch_rao_co_ap_totals = "SELECT * FROM tb_rao_co_ap_totals WHERE rao_co_id = ? AND isDisplayed = 1 ORDER BY rao_co_att_id ASC";
    $stmt_fetch_rao_co_ap_totals = mysqli_prepare($con, $sql_fetch_rao_co_ap_totals);
    mysqli_stmt_bind_param($stmt_fetch_rao_co_ap_totals, "i", $rao_co_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_co_ap_totals)) {
        throw new Exception("Error executing fetch rao_co_ap query: " . mysqli_error($con));
    }

    $rao_co_ap_totals_result = mysqli_stmt_get_result($stmt_fetch_rao_co_ap_totals);

    // Fetch rows and separate by total_type
    while ($row = $rao_co_ap_totals_result->fetch_assoc()) {
        if ($row['total_type'] == 'BF') {
            $rao_co_ap_BF_totals[] = $row;
        } elseif ($row['total_type'] == 'TA') {
            $rao_co_ap_TA_totals[] = $row;
        }else {
            $rao_co_ap_grand_totals[] = $row;
        }
    }

    // Close the statement
    mysqli_stmt_close($stmt_fetch_rao_co_ap_totals);


    //////////////////////////////////// OB

    $rao_co_ob = []; // Initialize the array for storing fetched rao_co_ob data
    $rao_co_ob_data = []; // Initialize the array for storing fetched rao_co_ob_data

    // Fetch data from tb_rao_co_ob
    $sql_fetch_rao_co_ob = "SELECT * FROM tb_rao_co_ob WHERE rao_co_id = ?";
    $stmt_fetch_rao_co_ob = mysqli_prepare($con, $sql_fetch_rao_co_ob);
    mysqli_stmt_bind_param($stmt_fetch_rao_co_ob, "i", $rao_co_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_co_ob)) {
        throw new Exception("Error executing fetch rao_co_ob query: " . mysqli_error($con));
    }
    $rao_co_ob_result = mysqli_stmt_get_result($stmt_fetch_rao_co_ob);

    // Fetch rows into $rao_co_ob
    while ($row = $rao_co_ob_result->fetch_assoc()) {
        $rao_co_ob[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_co_ob);

    // Fetch data from tb_rao_co_ob_data for each rao_co_ob_id
    foreach ($rao_co_ob as $obItem) {
        $rao_co_ob_id = $obItem['rao_co_ob_id']; // Get rao_co_ob_id from the row

        $sql_fetch_rao_co_ob_data = "SELECT * FROM tb_rao_co_ob_data WHERE rao_co_ob_id = ? AND isDisplayed = 1 ORDER BY rao_co_att_id ASC";
        $stmt_fetch_rao_co_ob_data = mysqli_prepare($con, $sql_fetch_rao_co_ob_data);
        mysqli_stmt_bind_param($stmt_fetch_rao_co_ob_data, "i", $rao_co_ob_id);
        if (!mysqli_stmt_execute($stmt_fetch_rao_co_ob_data)) {
            throw new Exception("Error executing fetch rao_co_ob_data query: " . mysqli_error($con));
        }
        $rao_co_ob_result_data = mysqli_stmt_get_result($stmt_fetch_rao_co_ob_data);

        // Fetch rows into $rao_co_ob_data
        while ($row = $rao_co_ob_result_data->fetch_assoc()) {
            $rao_co_ob_data[] = $row; // Append each row to the array
        }

        mysqli_stmt_close($stmt_fetch_rao_co_ob_data);
    }

    //Fetch from tb_rao_co_ob_totals
    $rao_co_ob_TO_totals = [];
    $rao_co_ob_OB_totals = [];
    $rao_co_ob_AB_totals = [];
    $rao_co_ob_grand_totals = [];

    // Fetch data from tb_rao_co_ob_totals
    $sql_fetch_rao_co_ob_totals = "SELECT * FROM tb_rao_co_ob_totals WHERE rao_co_id = ? AND isDisplayed = 1 ORDER BY rao_co_att_id ASC";
    $stmt_fetch_rao_co_ob_totals = mysqli_prepare($con, $sql_fetch_rao_co_ob_totals);
    mysqli_stmt_bind_param($stmt_fetch_rao_co_ob_totals, "i", $rao_co_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_co_ob_totals)) {
        throw new Exception("Error executing fetch rao_co_ob query: " . mysqli_error($con));
    }

    $rao_co_ob_totals_result = mysqli_stmt_get_result($stmt_fetch_rao_co_ob_totals);

    // Fetch rows and separate by total_type
    while ($row = $rao_co_ob_totals_result->fetch_assoc()) {
        if ($row['total_type'] == 'TO') {
            $rao_co_ob_TO_totals[] = $row;
        } elseif ($row['total_type'] == 'OB') {
            $rao_co_ob_OB_totals[] = $row;
        }elseif($row['total_type'] == 'AB'){
            $rao_co_ob_AB_totals[] = $row;
        }else{
            $rao_co_ob_grand_totals[] = $row;
        }
    }

// Start HTML output
echo '<!DOCTYPE html>
<html>
<head>
    <title>RAO CO Report</title>
       <style>
     @page {
        size: 10in 8.5in; /* Explicitly define width and height in landscape */
        margin: 0.5cm; /* Set consistent margins */
    }

    body {
        width: 100%;
        align-items: center;
        font-family: Arial, sans-serif; 
    }
    .hidden {
        display: none;
    }
    .rao-table-container {
    width: 100%;
    height: auto;
    overflow-x: auto;
}
.rao-table {
	font-size: calc(16px - 0.1vw);
    max-width: 100%; 
    border-collapse: collapse;
    table-layout: fixed;
    margin-left: auto; 
    margin-right: auto; 
    border:  1px solid #000;
}

.rao-table th,
.rao-table td {
    border: 1px solid #000;
    height: auto;
    text-align: center;
    box-sizing: border-box;
    word-wrap: break-word;
    word-break: break-word;
    white-space: normal; 
    overflow-wrap: break-word;

}
.rao-table th {
    background-color: #a0e7a0;
    padding: 2px;
}

/* For Reference and Date*/
.rao-table th.stick-head:nth-child(1),
.rao-table th.stick-head:nth-child(3),
.rao-table td:nth-child(1),
.rao-table td:nth-child(1){
    position: relative;
}
/* For Ref No*/
.rao-table th.stick-head:nth-child(2),
.rao-table td:nth-child(2) {
    position: relative;
}

/* For Particulars*/
.rao-table th.stick-head:nth-child(4),
.rao-table td:nth-child(3) {
    position: relative;
}


/* For Totals*/
.rao-table th.stick-head:nth-child(5){
	position: relative;;
}

/* For Total Data*/
.rao-table td.total-data{
    position: relative;
}
/* td with span of 3 cols*/
.rao-table td.stick-body[colspan="3"] {
	position: relative;
}

/* Capital Outlay*/
.rao-table th.dynamic-stick-head{
    position: relative;
}


/* For Dynamic Heads*/
.rao-table th.dynamic-head{
    position: relative;
    background-color: #E2F8E2;
}

/* For OB Cont Heads*/
.rao-table th.ob-stick-head{
    position: static;
    background-color: white;
}

.rao-table input{
    width: 100%;
    box-sizing: border-box;
    border: none;
    color: #000;
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
    line-height: 1.2;
    padding: 2px 4px;
}

.rao-header {
    text-align: center;
    margin-bottom: 20px;
    text-align: left;
}
.rao-header h1 {
    text-align: center;
    font-size: 20px;
    margin-bottom: 5px;
}

.rao-header .details {
    display: grid;
    grid-template-columns: auto 1fr auto 1fr; 
    gap: 10px 20px;
}
.rao-header .info {
    display: contents; 
}

.rao-header label {
    font-weight: bold;
    white-space: nowrap; 
    align-self: center; 
}

.rao-header input {
    width: 100%; 
    padding: 5px;
    border: none;      
    border-radius: 4px;
    background: none; 
    color: #000;
    outline: none;
    box-sizing: border-box; 
}


.certification-section {
    display: grid;
    grid-template-columns: 1fr 1fr; 
    gap: 20px; 
    margin-top: 20px;
}


.certified, .noted {
    display: flex;
    flex-direction: column;
    justify-content: center; 
    align-items: center; 
    text-align: center; 
}

.certified p:first-child,
.noted p:first-child {
    font-weight: bold;
    margin-bottom: 10px;
}



.certified-info p:first-child,
.noted-info p:first-child {
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 5px;
    text-decoration: underline;
}


.certified-info p:last-child,
.noted-info p:last-child {
    font-style: italic;
    font-size: 14px;
    color: #333; 
}

        /* Hide print header and footer */
        @media print {
            .printable {
                max-width: 100%; 
                page-break-inside: avoid;
            }

            .hidden {
                display: none !important;
            }
            button, .toggle-btn {
            display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="rao-container">
        <div class="rao-header">
            <h1>Report of Appropriations and Obligations(RAO-CO)</h1>
            <p style="text-align: center;">For ' . formatPeriodCovered($period_covered) . '</p>
            <div class="details">
                <div class="info">
                    <label>Barangay:</label> <input type="text" value="MANTALONGON" disabled/>
                </div>
                <div class="info">
                    <label>Municipality:</label> <input type="text" value="DALAGUETE" disabled />
                </div>
                <div class="info">
                    <label>Province:</label> <input type="text" value="CEBU" disabled />
                </div>
                <div class="info">
                    <label>Fund Source:</label> <input type="text" value="Continuing Appropriations" disabled />
                </div>
            </div>
        </div>

        <div class="rao-table-container">
            <table id="viewDataTable" class="rao-table">';

// Appropriations Section
echo '<thead class="appropriations-head">
    <tr>
        <th class="hidden">Counter</th>
        <th class="hidden">ID</th>
        <th colspan="2" class="stick-head">Reference For Appropriations</th>
        <th rowspan="2" class="stick-head">Particulars</th>
        <th rowspan="2" class="stick-head">Totals</th>
        <th colspan="' . count($attribute_names) . '" class="dynamic-stick-head">MAINTENANCE AND OTHER OPERATING EXPENSES</th>
    </tr>
    <tr class="dynamic-heads">
        <th class="stick-head">Date</th>
        <th class="stick-head">Reference No</th>';

foreach ($attribute_names as $attr) {
    echo '<th class="dynamic-head">' . htmlspecialchars($attr) . '</th>';
}

echo '</tr></thead>';

// AP Data Rows
echo '<tbody class="inp-group-ap-data-row">';
if (!empty($rao_co_ap)) {
    // Pre-process ap_data into a lookup array for better performance
    $apDataLookup = [];
    foreach ($rao_co_ap_data as $apData) {
        $key = $apData['rao_co_ap_id'] . '_' . $apData['rao_co_att_id'];
        $apDataLookup[$key] = $apData['attribute_value'];
    }

    foreach ($rao_co_ap as $apItem) {
        echo '<tr class="ap-data-row">
            <td>' . htmlspecialchars($apItem['ap_ref_date'] ?? '') . '</td>
            <td>' . htmlspecialchars($apItem['ap_ref_no'] ?? '') . '</td>
            <td>' . htmlspecialchars($apItem['ap_particulars'] ?? '') . '</td>
            <td class="total-data">' . htmlspecialchars(formatValue($apItem['ap_totals'] ?? '')) . '</td>
            <td class="hidden">' . htmlspecialchars($apItem['rao_co_ap_id'] ?? '') . '</td>';

        // Output attribute values using lookup array
        foreach ($attribute_ids as $attrId) {
            $key = $apItem['rao_co_ap_id'] . '_' . $attrId;
            $value = $apDataLookup[$key] ?? '';
            echo '<td>' . htmlspecialchars(formatValue($value)) . '</td>';
        }
        
        echo '</tr>';
    }
}
echo '</tbody>';
// AP Totals
echo '<tbody class="inp-group-ap-totals TA">
    <tr class="totals-row">
        <td colspan="3" class="stick-body">Total Appropriations</td>
        <td class="total-data">' . htmlspecialchars(formatValue($rao_co_ap_grand_totals[0]['attribute_value'] ?? '')) . '</td>';

// Add AP total values for each attribute column
foreach ($attribute_ids as $attrId) {
    $value = '';
    foreach ($rao_co_ap_TA_totals as $total) {
        if ($total['rao_co_att_id'] == $attrId) {
            $value = $total['attribute_value'];
            break;
        }
    }
    echo '<td>' . htmlspecialchars(formatValue($value)) . '</td>';
}
echo '</tr></tbody>';

// Balance Forwarded
echo '<tbody class="inp-group-ap-totals BF">
    <tr class="totals-row">
        <td colspan="3" class="stick-body">Balance Forwarded</td>
        <td class="total-data">' . htmlspecialchars(formatValue($rao_co_ap_grand_totals[1]['attribute_value'] ?? '')) . '</td>';

foreach ($attribute_ids as $attrId) {
    $value = '';
    foreach ($rao_co_ap_BF_totals as $total) {
        if ($total['rao_co_att_id'] == $attrId) {
            $value = $total['attribute_value'];
            break;
        }
    }
    echo '<td>' . htmlspecialchars(formatValue($value)) . '</td>';
}
echo '</tr></tbody>';

// Obligations Section
echo '<thead class="obligations-head">
    <tr>
        <th class="hidden">Counter</th>
        <th class="hidden">ID</th>
        <th colspan="2" class="stick-head">Reference For Appropriations</th>
        <th rowspan="2" class="stick-head">Particulars</th>
        <th rowspan="2" class="stick-head">Totals</th>
        <th colspan="' . count($attribute_names) . '" class="dynamic-stick-head">MAINTENANCE AND OTHER OPERATING EXPENSES</th>
    </tr>
    <tr class="dynamic-heads">
        <th class="stick-head">Date</th>
        <th class="stick-head">Reference No</th>';

foreach ($attribute_names as $attr) {
    echo '<th class="dynamic-head">' . htmlspecialchars($attr) . '</th>';
}

echo '</tr></thead>';

// OB Data Rows
echo '<tbody class="inp-group-ob-data-row">';
if (!empty($rao_co_ob)) {
    foreach ($rao_co_ob as $obItem) {
        echo '<tr class="ob-data-row">
            <td>' . htmlspecialchars($obItem['ob_ref_date'] ?? '') . '</td>
            <td>' . htmlspecialchars($obItem['ob_ref_no'] ?? '') . '</td>
            <td>' . htmlspecialchars($obItem['ob_particulars'] ?? '') . '</td>
            <td class="total-data">' . formatValue($obItem['ob_totals'] ?? '') . '</td>
            <td class="hidden">' . htmlspecialchars($obItem['rao_co_ob_id'] ?? '') . '</td>';

        foreach ($attribute_ids as $attrId) {
            $value = '';
            foreach ($rao_co_ob_data as $obData) {
                if ($obData['rao_co_ob_id'] === $obItem['rao_co_ob_id'] && 
                    $obData['rao_co_att_id'] === $attrId) {
                    $value = formatValue($obData['attribute_value']);
                    break;
                }
            }
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }
}
echo '</tbody>';

// OB Totals Sections
$totalTypes = [
    [
        'class' => 'TO', 
        'label' => 'Total Obligations', 
        'data' => $rao_co_ob_TO_totals,
        'grand_total' => $rao_co_ob_grand_totals[0]['attribute_value'] ?? ''
    ],
    [
        'class' => 'OB', 
        'label' => 'Obligations Balance To Date', 
        'data' => $rao_co_ob_OB_totals,
        'grand_total' => $rao_co_ob_grand_totals[1]['attribute_value'] ?? ''
    ],
    [
        'class' => 'AB', 
        'label' => 'Appropriations Balance To Date', 
        'data' => $rao_co_ob_AB_totals,
        'grand_total' => $rao_co_ob_grand_totals[2]['attribute_value'] ?? ''
    ]
];

foreach ($totalTypes as $type) {
    echo '<tbody class="inp-group-ob-totals ' . htmlspecialchars($type['class']) . '">
        <tr class="totals-row">
            <td colspan="3" class="stick-body">' . htmlspecialchars($type['label']) . '</td>
            <td class="total-data">' . htmlspecialchars(formatValue($type['grand_total'])) . '</td>';
    
    // Output values for each attribute column
    foreach ($attribute_ids as $attrId) {
        $value = '';
        foreach ($type['data'] as $total) {
            if ($total['rao_co_att_id'] == $attrId) {
                $value = $total['attribute_value'];
                break;
            }
        }
        echo '<td>' . htmlspecialchars(formatValue($value)) . '</td>';
    }
    echo '</tr></tbody>';
}

// Close table and add certification section
echo '</table>
    </div>

    <div class="certification-section">
        <div class="certified">
            <p>Certified True & Correct:</p>
            <div class="signature-section">
                <p id="chairman_name">' . htmlspecialchars($chairman) . '</p>
                <p>Chairman, Committee on Appropriations</p>
            </div>
        </div>
        <div class="noted">
            <p>Noted by:</p>
            <div class="noted-info">
                <p id="brgy_captain">' . htmlspecialchars($brgy_captain) . '</p>
                <p>Punong Barangay</p>
            </div>
        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const tableWidth = 1056; // Fixed table width in pixels
    const table = document.getElementById("viewDataTable");
    const dynamicHeads = table.querySelectorAll("th.dynamic-head");
    const totalColumns = table.querySelectorAll("th").length; // Total number of columns
    const baseFontSize = 12; // Base font size in pixels
    const minFontSize = 8; // Minimum font size
    const maxCharLimit = 50; // Maximum characters before scaling down font
    const staticHeads = table.querySelectorAll("th:not(.dynamic-head)");

    // Dynamically adjust font size for the entire table based on the number of columns
    let tableFontSize = baseFontSize;
    if (totalColumns > 10) {
        tableFontSize = Math.max(minFontSize, baseFontSize - (totalColumns - 10) * 0.5); // Reduce size for > 10 columns
    }
    table.style.fontSize = tableFontSize + "px"; // Apply font size globally

    // Dynamically adjust individual font size for cells based on content length
    function adjustFontSizeForCell(cell) {
        const contentLength = cell.innerText.length;
        let fontSize = tableFontSize; // Start with the global table font size
        if (contentLength > maxCharLimit) {
            fontSize = Math.max(
                minFontSize,
                tableFontSize - (contentLength - maxCharLimit) * 0.2 // Adjust by 0.2px per extra character
            );
        }
        cell.style.fontSize = fontSize + "px";
    }

    // Apply dynamic font resizing to all header and data cells
    table.querySelectorAll("th, td").forEach(cell => adjustFontSizeForCell(cell));

    // Dynamically adjust column widths
    const totalDynamicHeads = dynamicHeads.length;

    // Calculate widths for static and dynamic columns
    const staticWidth = staticHeads.length * 100; // Assume 100px per static column
    const remainingWidth = tableWidth - staticWidth;

    if (totalDynamicHeads > 0 && remainingWidth > 0) {
        const dynamicColumnWidth = remainingWidth / totalDynamicHeads;

        // Set widths for dynamic headers
        dynamicHeads.forEach(head => {
            head.style.width = dynamicColumnWidth + "px";
        });

        // Set widths for corresponding data cells
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(row => {
            const dynamicCells = row.querySelectorAll(`td:nth-child(n+${staticHeads.length + 1})`);
            dynamicCells.forEach(cell => {
                cell.style.width = dynamicColumnWidth + "px";
            });
        });
    }

    // Fallback styles for table overflow
    table.style.tableLayout = "fixed";
    table.style.width = tableWidth + "px";
    table.style.overflow = "hidden"; // Prevent horizontal overflow
});
</script>


<script>
    function adjustColspan() {
        // Select dynamic headers within appropriations and obligations sections
        const dynamicHeadersAppropriations = document.querySelectorAll(".appropriations-head .dynamic-head");
        const dynamicHeadersObligations = document.querySelectorAll(".obligations-head .dynamic-head");
        const dynamicStickHeadAppropriations = document.querySelector(".appropriations-head .dynamic-stick-head");
        const dynamicStickHeadObligations = document.querySelector(".obligations-head .dynamic-stick-head");

        // Get the count of dynamic headers
        const dynamicCount = dynamicHeadersAppropriations.length;
        const dynamicCountob = dynamicHeadersObligations.length;

        // Update colspan for the appropriations stick header
        if (dynamicStickHeadAppropriations) {
            dynamicStickHeadAppropriations.setAttribute("colspan", dynamicCount);
        } else {
            console.warn("No dynamic stick head found for appropriations.");
        }

        // Update colspan for the obligations stick header
        if (dynamicStickHeadObligations) {
            dynamicStickHeadObligations.setAttribute("colspan", dynamicCount);
        } else {
            console.warn("No dynamic stick head found for obligations.");
        }

        console.log(`Updated colspan to: ${dynamicCount}`);
        console.log(`Updated colspan to: ${dynamicCountob}`);
    }

    // Call the function initially when DOM is fully loaded
    document.addEventListener("DOMContentLoaded", adjustColspan);
</script>
<script>
    window.onload = function() {
        window.print();
        window.onafterprint = function() {
            window.close();
        };
    };
</script>

</body>
</html>';
?>