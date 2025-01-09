<?php 
include('../../connection.php');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$cashbook_id = isset($_POST['cashbook_id']) ? $con->real_escape_string($_POST['cashbook_id']) : '';

// Validate cashbook_id
if (empty($cashbook_id)) {
    echo json_encode(array('error' => 'Invalid cashbook_id'));
    exit();
}

// Fetch the cashbook record
$sql_details = "SELECT * FROM tb_cashbook WHERE cashbook_id = ?";
$stmt_details = mysqli_prepare($con, $sql_details);
mysqli_stmt_bind_param($stmt_details,"i", $cashbook_id);
mysqli_stmt_execute($stmt_details);
$record_result = mysqli_stmt_get_result($stmt_details)->fetch_assoc();

$cashbook_data = [];

// Fetch the associated records from tb_cashbook_data
$sql_assoc = "SELECT * FROM tb_cashbook_data WHERE cashbook_id = ?";
$stmt_assoc = mysqli_prepare($con, $sql_assoc);
mysqli_stmt_bind_param($stmt_assoc, "i", $cashbook_id);
mysqli_stmt_execute($stmt_assoc);
$cashbook_result= mysqli_stmt_get_result($stmt_assoc);

// Populate $cashbook_data array
while ($row = $cashbook_result->fetch_assoc()) {
    $cashbook_data[] = $row; 
}

// Close the prepared statements
mysqli_stmt_close($stmt_details);
mysqli_stmt_close($stmt_assoc);
mysqli_close($con);

// Prepare response data
$response = [
    'status' => 'true',
    'record' => $record_result,
    'cashbook_data' => $cashbook_data,
];

$response_json = json_encode($response); 
?>


<html>
<head>
    <title>Employees Data</title>
   <style>
    
@page {
    size: 8.5in 11in; /* Explicitly define width and height in landscape */
    margin: 0.5cm; /* Set consistent margins */
}

.cashbook-header {
    text-align: center;
    margin-bottom: 5px;
    
}

.cashbook-header .details {
    display: grid;
    grid-template-columns: auto 1fr auto 1fr; 
    gap: 10px 20px;
    
}
.cashbook-header .info {
    display: contents;
    color: #000; 
}

.cashbook-table{
	border-collapse: collapse;
	border: 1px solid #000;
    height: auto;
    text-align: center;
    box-sizing: border-box;
    word-wrap: break-word;
    word-break: break-word;
    white-space: normal; 
    overflow-wrap: break-word;
}


.cashbook-table thead{
    top: 0; /* Keeps the header at the top */
    z-index: 1; /* Ensures header is above table rows */
    border-bottom: 2px solid #000;
    box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1);
}


.cashbook-table th, .cashbook-table td {
    border: 1px solid #000;
    text-align: center;
    box-sizing: border-box;
    width: 60px;
}

.cashbook-table .inp-group-view td,
.cashbook-table .initial-value td,
.cashbook-table .ending-value td{
    border: 1px solid #000;
    text-align: center;
    width: 60px;
}


.cashbook-table th {
    background-color: #9ddfad; /* Background color for headers */
    text-align: center; /* Center text in headers */
    padding: 3px; /* Padding for header cells */
    z-index: 1;
}

.details input[type="text"], 
.details input[type="date"] {
    width: 100%;           /* Full width */
    padding: 3px;         /* Padding for better spacing */
    border: none;         /* Remove borders */
    background: none;     /* Ensure background is transparent (if needed) */
    outline: none;        
    font-size: 15px;
    text-align: center;
}

.cashbook-table thead tr:nth-of-type(2) th:nth-child(1),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(2),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(3),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(4),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(5),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(6),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(7),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(8),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(9),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(10),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(11),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(12),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(13),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(14),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(15),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(16) {
    font-size: clamp(10px, 1vw, 12px); 
    word-wrap: break-word;
    overflow-wrap: break-word;
    resize: vertical;
    height: auto;
}


/* Additional styling for borders and spacing */
.cashbook-table th {
    border: none; /* Border for all header cells */
}

.cashbook-table thead tr:nth-of-type(1) th:nth-child(1),
.cashbook-table thead tr:nth-of-type(1) th:nth-child(2),
.cashbook-table thead tr:nth-of-type(1) th:nth-child(3),
.cashbook-table thead tr:nth-of-type(1) th:nth-child(4),
.cashbook-table thead tr:nth-of-type(1) th:nth-child(5),
.cashbook-table thead tr:nth-of-type(1) th:nth-child(6),
.cashbook-table thead tr:nth-of-type(1) th:nth-child(7),
.cashbook-table thead tr:nth-of-type(1) th:nth-child(8),
.cashbook-table thead tr:nth-of-type(1) th:nth-child(9),

.cashbook-table thead tr:nth-of-type(2) th:nth-child(1),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(3),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(5),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(6),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(7),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(8),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(9),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(10),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(11),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(12),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(13),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(14),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(15),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(16) {
    border: 1px solid black;
}
/* Remove borders between Particulars % Reference 1 and 2 */
.cashbook-table thead tr:nth-of-type(2) th:nth-child(1) {
    border-right: none; /* Removes border between Particulars 1 and 2 */
}
.cashbook-table thead tr:nth-of-type(2) th:nth-child(3){
    border-right: none; /* Removes border between Particulars 1 and 2 */
}

/* Add visible border between Particulars 1 and References */
.cashbook-table thead tr:nth-of-type(2) th:nth-child(2) {
    border-right: 1px solid #000; /* Adds a border between Particulars 2 and Reference 1 */
}

/* Remove the bottom border from the Particulars and References headers */
.cashbook-table thead tr:nth-of-type(1) th:nth-child(2),
.cashbook-table thead tr:nth-of-type(1) th:nth-child(3), /* For Particulars */
.cashbook-table thead tr:nth-of-type(1) th:nth-child(4),
.cashbook-table thead tr:nth-of-type(1) th:nth-child(5) { /* For References */
    border-bottom: none; /* Remove the bottom border */
}

/* Remove the bottom border from the Particulars and References headers */
.cashbook-table thead tr:nth-of-type(2) th:nth-child(1),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(2),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(3), /* For Particulars */
.cashbook-table thead tr:nth-of-type(2) th:nth-child(4),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(5) { /* For References */
    border-bottom: 1px solid #000; /* Remove the bottom border */
}

/* Hide text for Particulars 1, 2, and Reference 1, 2 */
.cashbook-table thead tr:nth-of-type(2) th:nth-child(1),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(2),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(3),
.cashbook-table thead tr:nth-of-type(2) th:nth-child(4) {
    border-top: none; /* Removes border between Particulars 1 and 2 */
    color: transparent; /* Hides text */
}

.hidden{
    display: none;
}
.certification {
    text-align: center;
    margin-top: 50px;
}

.certification p {
    margin: 0;
    font-size: 15px;
    line-height: 1.5;
}

.signature-section {
    margin-top: 30px;
    text-align: center;
}

.signature-section .name {
    font-weight: bold;
    text-decoration: underline;
    margin-bottom: 5px;
}

.signature-section .title {
    font-style: italic;
}

    </style>
</head>
<script src="../../assets/js/jquery-3.6.0.min.js"></script>

<body>
<div class="cashbook-container">
        <!-- Header Section -->
        <div class="cashbook-header">
            <h1>Cashbook Record</h1>
            <div class="details">
                <div class="info">
                    <label>Barangay:</label> <label  style="text-decoration: underline;">MANTALONGON</label>
                </div>
                <div class="info">
                    <label>Municipality:</label> <label  style="text-decoration: underline;">DALAGUETE</label>
                </div>
                <div class="info">
                    <label>Barangay Treasurer:</label> <label id="treasurernameView" name="treasurer_name"  style="text-decoration: underline;">
                </div>
                <div class="info">
                    <label>Province:</label> <label  style="text-decoration: underline;">CEBU</label>   
                </div>
                <div class="info">
                    <label>Period Covered:</label> <label id = "periodcoveredView"  style="text-decoration: underline;" >
                </div>
            </div>
        </div>

            <!-- Cashbook Table -->
        <table id = "viewDataTable" class="cashbook-table">
            <thead>
                <tr>
                    <th rowspan="2" class="hidden">Counter</th>
                    <th rowspan="2" class="hidden">ID</th>
                    <th rowspan="2">Date</th>
                    <th colspan="2">Particulars</th> <!-- Combined Particulars -->
                    <th colspan="2">References</th>  <!-- Combined References -->
                    <th colspan="3">Cash in Local Treasury</th>
                    <th colspan="3">Cash in Bank</th>
                    <th colspan="3">Cash Advances</th>
                    <th colspan="3">Petty Cash Fund</th>
                </tr>
                <tr>
                    <!-- Sub-columns for Particulars and References -->
                    <th >Particular 1</th>
                    <th >Particular 2</th>
                    <th>Reference 1</th>
                    <th>Reference 2</th>
                    <th>Collection</th>
                    <th>Deposit</th>
                    <th>Balance</th>

                    <th>Deposit</th>
                    <th>Check Issued</th>
                    <th>Balance</th>

                    <th>Receipt</th>
                    <th>Disbursement</th>
                    <th>Balance</th>

                    <th>Receipt Replenishment</th>
                    <th>Payments</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody class = "initial-value">

            </tbody>
            <tbody class = "inp-group-view">
                    <!-- Dynamic rows go here -->
            </tbody>
            <tbody class = "ending-value">

            </tbody>
            
        </table>
        <div class="certification">
            <p>Certification:</p>
            <p>
                I hereby certify that the foregoing is a correct and complete record of all my collections, deposits, 
                remittances, and balances of my accounts, in the Cash-In Local Treasury, Cash in Bank, Cash Advances, 
                and Petty Cash as of <strong id="periodcoveredCertView"></strong>.
            </p>
        </div>

        <div class="signature-section">
            <p class="name" id="treasurernameCertView"></p>
            <p class="title">Barangay Treasurer</p>
        </div>
    </div>
</body>



<script>
 // Function to format the period covered
 function formatPeriodCovered(dateString) {
    const date = new Date(dateString);
    const month = date.toLocaleString('default', { month: 'long' }).toUpperCase();
    const year = date.getFullYear();
    const lastDay = new Date(year, date.getMonth() + 1, 0).getDate();
    return `${month} 1-${lastDay}, ${year}`;
}
const json = <?php echo $response_json; ?>;
console.log("JSON:",json);
if (json.status === 'true') {
    let record = json.record;
    let cashbookData = json.cashbook_data;
    console.log("cashbook data: ",cashbookData);

    let formattedPeriod = formatPeriodCovered(record.period_covered);

    // Populate main record data directly into elements
    $('#periodcoveredView').text(formattedPeriod);
    $('#treasurernameView').text(record.treasurer_name);
    $('#cltinitbalanceView').text(record.clt_init_balance);
    $('#cbinitbalanceView').text(record.cb_init_balance);

    $('#treasurernameCertView').text(record.treasurer_name);
    $('#periodcoveredCertView').text(formattedPeriod);

    // Append initial values for "Initial" and "Balances"
    const initialRow = `
        <tr>
            <td></td>
            <td colspan="2"></td>
            <td colspan="2">Initial Balances</td>
            <td colspan="2"></td>
            <td>${record.clt_init_balance}</td>
            <td colspan="2"></td>
            <td>${record.cb_init_balance}</td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="2"></td>
            <td></td>
        </tr>`;
    $('#viewDataTable tbody.initial-value').append(initialRow);

    const endingRow = `
        <tr>
            <td></td>
            <td colspan="2"></td>
            <td colspan="2">Totals</td>
            <td>${record.clt_end_in}</td>
            <td>${record.clt_end_out}</td>
            <td>${record.clt_end_balance}</td>
            <td>${record.cb_end_in}</td>
            <td>${record.cb_end_out}</td>
            <td>${record.cb_end_balance}</td>
            <td>${record.ca_end_receipt}</td>
            <td>${record.ca_end_disbursement}</td>
            <td>${record.ca_end_balance}</td>
            <td>${record.pcf_end_receipt}</td>
            <td>${record.pcf_end_payments}</td>
            <td>${record.pcf_end_balance}</td>
        </tr>`;
    $('#viewDataTable tbody.ending-value').append(endingRow);

   // Helper function to replace 0 with a space
  function formatValue(value) {
    if (value === 0) {
        return ' '; // Replace 0 with an empty space
    }
    if (typeof value === 'number') {
        return value.toLocaleString(); // Format numbers with commas
    }
    return value || ' '; // Return the value or an empty space if falsy
}
    // Check if cashbookData exists and is not empty
    if (Array.isArray(cashbookData) && cashbookData.length > 0) {
        cashbookData.forEach(function (cData, index) {
            console.log(`Row ${index}`, cData); // Log each row's data

            const inputGroupRow = `
                <tr>
                    <td class="hidden">${formatValue(cData.cashbook_data_id)}</td>
                    <td>${formatValue(cData.date_data)}</td>
                    <td>${formatValue(cData.particulars_1)}</td>
                    <td>${formatValue(cData.particulars_2)}</td>
                    <td>${formatValue(cData.reference_1)}</td>
                    <td>${formatValue(cData.reference_2)}</td>
                    <td>${formatValue(cData.clt_in)}</td>
                    <td>${formatValue(cData.clt_out)}</td>
                    <td>${formatValue(cData.clt_balance)}</td>
                    <td>${formatValue(cData.cb_in)}</td>
                    <td>${formatValue(cData.cb_out)}</td>
                    <td>${formatValue(cData.cb_balance)}</td>
                    <td>${formatValue(cData.ca_receipt)}</td>
                    <td>${formatValue(cData.ca_disbursement)}</td>
                    <td>${formatValue(cData.ca_balance)}</td>
                    <td>${formatValue(cData.pcf_receipt)}</td>
                    <td>${formatValue(cData.pcf_payments)}</td>
                    <td>${formatValue(cData.pcf_balance)}</td>
                </tr>`;
            $('#viewDataTable tbody.inp-group-view').append(inputGroupRow); // Append row
        });
    } else {
        console.error('Cashbook Data is empty or invalid.');
    }

} else {
    console.error('Error in JSON response:', json.message);
    alert("Error: " + json.message); // Alert user if there's an error message
}

       
</script>

<script type="text/javascript">
	document.querySelectorAll('td').forEach(cell => {
    const content = cell.innerText || cell.textContent;  // Get the content text
    const maxWidth = cell.clientWidth;  // Visible width of the cell
    
    // Estimate the text width using the content and font size
    const estimatedTextWidth = getTextWidth(content, window.getComputedStyle(cell).font);

    let fontSize = parseInt(window.getComputedStyle(cell).fontSize);  // Current font size of the cell

    // If text is too wide for the cell, reduce font size
    if (estimatedTextWidth > maxWidth) {
        // Calculate the scale based on the overflow ratio
        const overflowRatio = estimatedTextWidth / maxWidth;
        fontSize = Math.max(8, fontSize / overflowRatio);  // Shrink font size based on overflow
    }

    // Apply the calculated font size to the cell
    cell.style.fontSize = `${fontSize}px`;
});

// Helper function to estimate text width using canvas
function getTextWidth(text, font) {
    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");
    context.font = font;
    return context.measureText(text).width;  // Returns the width of the text
}

</script>


<script>
    // Print only once and prevent multiple print dialogs
    window.onload = function() {
        window.print(); // Automatically open print dialog
        window.onafterprint = function() {
            window.close(); // Close the window after printing is done
        };
    };
</script>


</html>
