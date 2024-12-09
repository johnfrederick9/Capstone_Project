<?php
include('../../connection.php');
header('Content-Type: text/html');

mysqli_begin_transaction($con);

try {
    // Fetch rao_id from POST request
    $rao_ps_id = isset($_POST['rao_ps_id']) ? intval($_POST['rao_ps_id']) : '';

    // Validate rao_id
    if ($rao_ps_id <= 0) {
        echo json_encode(['status' => 'false', 'error' => 'Invalid rao_ps_id']);
        exit();
    }

    $sql_fetch_rao_ps = "SELECT chairman, period_covered, brgy_captain FROM tb_rao_ps WHERE rao_ps_id = ? AND isDisplayed = 1 ";
    $stmt_fetch_rao_ps = mysqli_prepare($con, $sql_fetch_rao_ps);
    mysqli_stmt_bind_param($stmt_fetch_rao_ps, "i", $rao_ps_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_ps)) {
        throw new Exception("Error executing fetch rao_ps query: " . mysqli_error($con));
    }

    // Fetch the result
    $result_fetch_rao_ps = mysqli_stmt_get_result($stmt_fetch_rao_ps);

    if ($row = mysqli_fetch_assoc($result_fetch_rao_ps)) {
        $chairman = $row['chairman'];
        $period_covered = $row['period_covered'];
        $brgy_captain = $row['brgy_captain'];
    } else {
        throw new Exception("No data found for rao_ps_id: " . $rao_ps_id . " in tb_rao_ps");
    }

    // Close the statement to free resources
    mysqli_stmt_close($stmt_fetch_rao_ps);

    /////////////////////////////// AP

    $rao_ps_ap = []; // Initialize the array for storing fetched rao_ps_ap data

    // Fetch data from tb_rao_ps_ap
    $sql_fetch_rao_ps_ap = "SELECT * FROM tb_rao_ps_ap WHERE rao_ps_id = ?";
    $stmt_fetch_rao_ps_ap = mysqli_prepare($con, $sql_fetch_rao_ps_ap);
    mysqli_stmt_bind_param($stmt_fetch_rao_ps_ap, "i", $rao_ps_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_ps_ap)) {
        throw new Exception("Error executing fetch rao_ps_ap query: " . mysqli_error($con));
    }
    $rao_ps_ap_result = mysqli_stmt_get_result($stmt_fetch_rao_ps_ap);

    // Fetch rows into $rao_ps_ap
    while ($row = $rao_ps_ap_result->fetch_assoc()) {
        $rao_ps_ap[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_ps_ap);

    ///////////////////////////// OB
    $rao_ps_ob = []; // Initialize the array for storing fetched rao_ps_ob data

    // Fetch data from tb_rao_ps_ob
    $sql_fetch_rao_ps_ob = "SELECT * FROM tb_rao_ps_ob WHERE rao_ps_id = ?";
    $stmt_fetch_rao_ps_ob = mysqli_prepare($con, $sql_fetch_rao_ps_ob);
    mysqli_stmt_bind_param($stmt_fetch_rao_ps_ob, "i", $rao_ps_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_ps_ob)) {
        throw new Exception("Error executing fetch rao_ps_ob query: " . mysqli_error($con));
    }
    $rao_ps_ob_result = mysqli_stmt_get_result($stmt_fetch_rao_ps_ob);

    // Fetch rows into $rao_ps_ob
    while ($row = $rao_ps_ob_result->fetch_assoc()) {
        $rao_ps_ob[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_ps_ob);

    //////////////////////////// TOTALS

    //Fetch from tb_rao_ps_ap_totals
    $rao_ps_BF_totals = [];
    $rao_ps_TA_totals = [];
    $rao_ps_TO_totals = [];
    $rao_ps_OB_totals = [];
    $rao_ps_AB_totals = [];

    // Fetch data from tb_rao_ps_ap_totals
    $sql_fetch_rao_ps_totals = "SELECT * FROM tb_rao_ps_totals WHERE rao_ps_id = ? AND isDisplayed = 1";
    $stmt_fetch_rao_ps_totals = mysqli_prepare($con, $sql_fetch_rao_ps_totals);
    mysqli_stmt_bind_param($stmt_fetch_rao_ps_totals, "i", $rao_ps_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_ps_totals)) {
        throw new Exception("Error executing fetch rao_ps_ap query: " . mysqli_error($con));
    }

    $rao_ps_totals_result = mysqli_stmt_get_result($stmt_fetch_rao_ps_totals);

    // Fetch rows and separate by total_type
    while ($row = $rao_ps_totals_result->fetch_assoc()) {
        if ($row['total_type'] == 'BF') {
            $rao_ps_BF_totals[] = $row;
        } elseif ($row['total_type'] == 'TA') {
            $rao_ps_TA_totals[] = $row;
        }elseif ($row['total_type'] == 'TO') {
            $rao_ps_TO_totals[] = $row;
        } elseif ($row['total_type'] == 'OB') {
            $rao_ps_OB_totals[] = $row;
        }elseif($row['total_type'] == 'AB'){
            $rao_ps_AB_totals[] = $row;
        }
    }

    // Function to format period covered
    function formatPeriodCovered($dateString) {
        if (!$dateString || $dateString === "0000-00-00") {
            return "";
        }
        $date = new DateTime($dateString);
        $month = strtoupper($date->format('F'));
        $year = $date->format('Y');
        $lastDay = $date->format('t');
        return "{$month} 1-{$lastDay}, {$year}";
    }

    // Start HTML output
    echo '<!DOCTYPE html>
<html>
<head>
    <title>Report of Appropriations and Obligations (RA-PS)</title>
      <style>
     @page {
        size: 11in 8.5in; /* Explicitly define width and height in landscape */
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
            <h1>Report of Appropriations and Obligations (RAO-PS)</h1>
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
                    <label>Fund Source:</label> <input type="text" value="General Fund (Personal Services)" disabled />
                </div>
            </div>
        </div>

        <div class="rao-table-container">
            <table id="viewDataTable" class="rao-table">
                <!-- Appropriations Header -->
                <thead class="appropriations-head">
                    <tr>
                        <th class="hidden">Counter</th>
                        <th class="hidden">ID</th>
                        <th colspan="2" class="stick-head">Reference For Appropriations</th>
                        <th rowspan="2" class="stick-head">Particulars</th>
                        <th rowspan="2" class="stick-head">Totals</th>
                        <th colspan="6" class="dynamic-stick-head">Personal Services</th>
                    </tr>
                    <tr>
                        <th class="stick-head">Date</th>
                        <th class="stick-head">Reference No</th>
                        <th class="dynamic-head">Salaries & Wages</th>
                        <th class="dynamic-head">Cash Gift P.E.I</th>
                        <th class="dynamic-head">Year End Bonus</th>
                        <th class="dynamic-head">Mid Year Pay</th>
                        <th class="dynamic-head">S.R.I</th>
                        <th class="dynamic-head">Other Personnel Benefits</th>
                    </tr>
                </thead>';

    // Output Appropriations Data
    echo '<tbody class="inp-group-ap-data-row">';
    foreach ($rao_ps_ap as $ap) {
        echo '<tr class="ap-data-row">
                <td>' . htmlspecialchars($ap['ap_ref_date']) . '</td>
                <td>' . htmlspecialchars($ap['ap_ref_no']) . '</td>
                <td>' . htmlspecialchars($ap['ap_particulars']) . '</td>
                <td class="total-data">' . ($ap['ap_total'] != 0 ? htmlspecialchars($ap['ap_total']) : '') . '</td>
                <td>' . ($ap['ap_salary'] != 0 ? htmlspecialchars($ap['ap_salary']) : '') . '</td>
                <td>' . ($ap['ap_cash_gift'] != 0 ? htmlspecialchars($ap['ap_cash_gift']) : '') . '</td>
                <td>' . ($ap['ap_year_end'] != 0 ? htmlspecialchars($ap['ap_year_end']) : '') . '</td>
                <td>' . ($ap['ap_mid_year'] != 0 ? htmlspecialchars($ap['ap_mid_year']) : '') . '</td>
                <td>' . ($ap['ap_sri'] != 0 ? htmlspecialchars($ap['ap_sri']) : '') . '</td>
                <td>' . ($ap['ap_others'] != 0 ? htmlspecialchars($ap['ap_others']) : '') . '</td>
            </tr>';
    }
    echo '</tbody>';

    // Output Total Appropriations
    foreach ($rao_ps_TA_totals as $total) {
        echo '<tbody class="inp-group-ap-totals TA">
                <tr class="totals-row">
                    <td colspan="3" class="stick-body">Total Appropriations</td>
                    <td class="total-data">' . ($total['total'] != 0 ? htmlspecialchars($total['total']) : '') . '</td>
                    <td>' . ($total['salary'] != 0 ? htmlspecialchars($total['salary']) : '') . '</td>
                    <td>' . ($total['cash_gift'] != 0 ? htmlspecialchars($total['cash_gift']) : '') . '</td>
                    <td>' . ($total['year_end'] != 0 ? htmlspecialchars($total['year_end']) : '') . '</td>
                    <td>' . ($total['mid_year'] != 0 ? htmlspecialchars($total['mid_year']) : '') . '</td>
                    <td>' . ($total['sri'] != 0 ? htmlspecialchars($total['sri']) : '') . '</td>
                    <td>' . ($total['others'] != 0 ? htmlspecialchars($total['others']) : '') . '</td>
                </tr>
            </tbody>';
    }

    // Output Balance Forwarded
    foreach ($rao_ps_BF_totals as $total) {
        echo '<tbody class="inp-group-ap-totals BF">
                <tr class="totals-row">
                    <td colspan="3" class="stick-body">Balance Forwarded</td>
                    <td class="total-data">' . ($total['total'] != 0 ? htmlspecialchars($total['total']) : '') . '</td>
                    <td>' . ($total['salary'] != 0 ? htmlspecialchars($total['salary']) : '') . '</td>
                    <td>' . ($total['cash_gift'] != 0 ? htmlspecialchars($total['cash_gift']) : '') . '</td>
                    <td>' . ($total['year_end'] != 0 ? htmlspecialchars($total['year_end']) : '') . '</td>
                    <td>' . ($total['mid_year'] != 0 ? htmlspecialchars($total['mid_year']) : '') . '</td>
                    <td>' . ($total['sri'] != 0 ? htmlspecialchars($total['sri']) : '') . '</td>
                    <td>' . ($total['others'] != 0 ? htmlspecialchars($total['others']) : '') . '</td>
                </tr>
            </tbody>';
    }

    // Output Obligations Header
    echo '<thead class="obligations-head">
            <tr>
                <th rowspan="2" class="hidden">Counter</th>
                <th rowspan="2" class="hidden">ID</th>
                <th colspan="2" class="stick-head">Reference For Obligations</th>
                <th rowspan="2" class="stick-head">Particulars</th>
                <th rowspan="2" class="stick-head">Totals</th>
                <th colspan="6" class="dynamic-stick-head">Personal Services</th>
            </tr>
            <tr>
                <th class="stick-head">Date</th>
                <th class="stick-head">Reference No</th>
                <th class="dynamic-head">Salaries & Wages</th>
                <th class="dynamic-head">Cash Gift P.E.I</th>
                <th class="dynamic-head">Year End Bonus</th>
                <th class="dynamic-head">Mid Year Pay</th>
                <th class="dynamic-head">S.R.I</th>
                <th class="dynamic-head">Other Personnel Benefits</th>
            </tr>
        </thead>';

    // Output Obligations Data
    echo '<tbody class="inp-group-ob-data-row">';
    foreach ($rao_ps_ob as $ob) {
        echo '<tr class="ob-data-row">
                <td>' . htmlspecialchars($ob['ob_ref_date']) . '</td>
                <td>' . htmlspecialchars($ob['ob_ref_no']) . '</td>
                <td>' . htmlspecialchars($ob['ob_particulars']) . '</td>
                <td class="total-data">' . ($ob['ob_total'] != 0 ? htmlspecialchars($ob['ob_total']) : '') . '</td>
                <td>' . ($ob['ob_salary'] != 0 ? htmlspecialchars($ob['ob_salary']) : '') . '</td>
                <td>' . ($ob['ob_cash_gift'] != 0 ? htmlspecialchars($ob['ob_cash_gift']) : '') . '</td>
                <td>' . ($ob['ob_year_end'] != 0 ? htmlspecialchars($ob['ob_year_end']) : '') . '</td>
                <td>' . ($ob['ob_mid_year'] != 0 ? htmlspecialchars($ob['ob_mid_year']) : '') . '</td>
                <td>' . ($ob['ob_sri'] != 0 ? htmlspecialchars($ob['ob_sri']) : '') . '</td>
                <td>' . ($ob['ob_others'] != 0 ? htmlspecialchars($ob['ob_others']) : '') . '</td>
            </tr>';
    }
    echo '</tbody>';

    // Total Obligations (TO)
foreach ($rao_ps_TO_totals as $total) {
    echo '<tbody class="inp-group-ob-totals TO">
            <tr class="totals-row">
                <td colspan="3" class="stick-body">Total Obligations</td>
                <td class="total-data">' . ($total['total'] != 0 ? htmlspecialchars($total['total']) : '') . '</td>
                <td>' . ($total['salary'] != 0 ? htmlspecialchars($total['salary']) : '') . '</td>
                <td>' . ($total['cash_gift'] != 0 ? htmlspecialchars($total['cash_gift']) : '') . '</td>
                <td>' . ($total['year_end'] != 0 ? htmlspecialchars($total['year_end']) : '') . '</td>
                <td>' . ($total['mid_year'] != 0 ? htmlspecialchars($total['mid_year']) : '') . '</td>
                <td>' . ($total['sri'] != 0 ? htmlspecialchars($total['sri']) : '') . '</td>
                <td>' . ($total['others'] != 0 ? htmlspecialchars($total['others']) : '') . '</td>
            </tr>
        </tbody>';
}

// Obligations Balance To Date (OB)
foreach ($rao_ps_OB_totals as $total) {
    echo '<tbody class="inp-group-ob-totals OB">
            <tr class="totals-row">
                <td colspan="3" class="stick-body">Obligations Balance To Date</td>
                <td class="total-data">' . ($total['total'] != 0 ? htmlspecialchars($total['total']) : '') . '</td>
                <td>' . ($total['salary'] != 0 ? htmlspecialchars($total['salary']) : '') . '</td>
                <td>' . ($total['cash_gift'] != 0 ? htmlspecialchars($total['cash_gift']) : '') . '</td>
                <td>' . ($total['year_end'] != 0 ? htmlspecialchars($total['year_end']) : '') . '</td>
                <td>' . ($total['mid_year'] != 0 ? htmlspecialchars($total['mid_year']) : '') . '</td>
                <td>' . ($total['sri'] != 0 ? htmlspecialchars($total['sri']) : '') . '</td>
                <td>' . ($total['others'] != 0 ? htmlspecialchars($total['others']) : '') . '</td>
            </tr>
        </tbody>';
}

// Appropriations Balance To Date (AB)
foreach ($rao_ps_AB_totals as $total) {
    echo '<tbody class="inp-group-ob-totals AB">
            <tr class="totals-row">
                <td colspan="3" class="stick-body">Appropriations Balance To Date</td>
                <td class="total-data">' . ($total['total'] != 0 ? htmlspecialchars($total['total']) : '') . '</td>
                <td>' . ($total['salary'] != 0 ? htmlspecialchars($total['salary']) : '') . '</td>
                <td>' . ($total['cash_gift'] != 0 ? htmlspecialchars($total['cash_gift']) : '') . '</td>
                <td>' . ($total['year_end'] != 0 ? htmlspecialchars($total['year_end']) : '') . '</td>
                <td>' . ($total['mid_year'] != 0 ? htmlspecialchars($total['mid_year']) : '') . '</td>
                <td>' . ($total['sri'] != 0 ? htmlspecialchars($total['sri']) : '') . '</td>
                <td>' . ($total['others'] != 0 ? htmlspecialchars($total['others']) : '') . '</td>
            </tr>
        </tbody>';
}

    // Output certification section
    echo '</table>
        </div>
        <div class="certification-section">
            <div class="certified">
                <p>Certified True & Correct:</p>
                <div class="certified-info">
                    <p>' . htmlspecialchars($chairman) . '</p>
                    <p>Chairman, Committee on Appropriations</p>
                </div>
            </div>
            <div class="noted">
                <p>Noted by:</p>
                <div class="noted-info">
                    <p>' . htmlspecialchars($brgy_captain) . '</p>
                    <p>Punong Barangay</p>
                </div>
            </div>
        </div>
    </div>
   
</body>';
?>
 <script>
    document.addEventListener("DOMContentLoaded", function () {
        const tableWidth = 1056; // Fixed table width in pixels
        const table = document.getElementById("viewDataTable");
        const dynamicHeads = table.querySelectorAll("th.dynamic-head");
        const totalColumns = table.querySelectorAll("th").length; // Total number of columns
        const baseFontSize = 12; // Base font size in pixels
        const minFontSize = 10; // Minimum font size
        const maxCharLimit = 30; // Maximum characters before scaling down font
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

<?php
} catch (Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
} finally {
    mysqli_close($con);
}
?>