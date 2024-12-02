<?php
include('../../connection.php');

mysqli_begin_transaction($con);  // Start transaction
try {
    // Fetch rao_id from POST request
    $rao_mooe_id = isset($_POST['rao_mooe_id']) ? intval($_POST['rao_mooe_id']) : '';

    // Validate rao_id
    if ($rao_mooe_id <= 0) {
        echo json_encode(['status' => 'false', 'error' => 'Invalid rao_mooe_id']);
        exit();
    }

    // Prepare and execute SQL query
    $sql_fetch_attr_name = "SELECT rao_mooe_att_id, attribute_name FROM tb_rao_mooe_attributes WHERE rao_mooe_id = ? AND isDisplayed = 1";
    $stmt_fetch_attr_name = mysqli_prepare($con, $sql_fetch_attr_name);
    mysqli_stmt_bind_param($stmt_fetch_attr_name, "i", $rao_mooe_id);
    if (!mysqli_stmt_execute($stmt_fetch_attr_name)) {
        throw new Exception("Error executing fetch attribute query: " . mysqli_error($con));
    }
    // Bind and fetch results
    $result = mysqli_stmt_get_result($stmt_fetch_attr_name);
    $attribute_names = [];
    $attribute_ids = [];  // To store the rao_mooe_att_id
    
    // Fetch all rows and collect attribute names and ids
    while ($row = mysqli_fetch_assoc($result)) {
        $attribute_names[] = $row['attribute_name'];
        $attribute_ids[] = $row['rao_mooe_att_id'];  // Store the rao_mooe_att_id
    }
    
    // Close the statement
    mysqli_stmt_close($stmt_fetch_attr_name);

    $sql_fetch_rao_mooe = "SELECT chairman, period_covered, brgy_captain FROM tb_rao_mooe WHERE rao_mooe_id = ? AND isDisplayed = 1 ";
    $stmt_fetch_rao_mooe = mysqli_prepare($con, $sql_fetch_rao_mooe);
    mysqli_stmt_bind_param($stmt_fetch_rao_mooe, "i", $rao_mooe_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_mooe)) {
        throw new Exception("Error executing fetch rao_mooe query: " . mysqli_error($con));
    }

    // Fetch the result
    $result_fetch_rao_mooe = mysqli_stmt_get_result($stmt_fetch_rao_mooe);

    if ($row = mysqli_fetch_assoc($result_fetch_rao_mooe)) {
        $chairman = $row['chairman'];
        $period_covered = $row['period_covered'];
        $brgy_captain = $row['brgy_captain'];
    } else {
        throw new Exception("No data found for rao_mooe_id: " . $rao_mooe_id . " in tb_rao_mooe");
    }

    // Close the statement to free resources
    mysqli_stmt_close($stmt_fetch_rao_mooe);

    /////////////////////////////// AP

    $rao_mooe_ap = []; // Initialize the array for storing fetched rao_mooe_ap data
    $rao_mooe_ap_data = []; // Initialize the array for storing fetched rao_mooe_ap_data

    // Fetch data from tb_rao_mooe_ap
    $sql_fetch_rao_mooe_ap = "SELECT * FROM tb_rao_mooe_ap WHERE rao_mooe_id = ?";
    $stmt_fetch_rao_mooe_ap = mysqli_prepare($con, $sql_fetch_rao_mooe_ap);
    mysqli_stmt_bind_param($stmt_fetch_rao_mooe_ap, "i", $rao_mooe_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_mooe_ap)) {
        throw new Exception("Error executing fetch rao_mooe_ap query: " . mysqli_error($con));
    }
    $rao_mooe_ap_result = mysqli_stmt_get_result($stmt_fetch_rao_mooe_ap);

    // Fetch rows into $rao_mooe_ap
    while ($row = $rao_mooe_ap_result->fetch_assoc()) {
        $rao_mooe_ap[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_mooe_ap);

    // Fetch data from tb_rao_mooe_ap_data for each rao_mooe_ap_id
    foreach ($rao_mooe_ap as $apItem) {
        $rao_mooe_ap_id = $apItem['rao_mooe_ap_id']; // Get rao_mooe_ap_id from the row

        $sql_fetch_rao_mooe_ap_data = "SELECT * FROM tb_rao_mooe_ap_data WHERE rao_mooe_ap_id = ? AND isDisplayed = 1 ORDER BY rao_mooe_att_id ASC";
        $stmt_fetch_rao_mooe_ap_data = mysqli_prepare($con, $sql_fetch_rao_mooe_ap_data);
        mysqli_stmt_bind_param($stmt_fetch_rao_mooe_ap_data, "i", $rao_mooe_ap_id);
        if (!mysqli_stmt_execute($stmt_fetch_rao_mooe_ap_data)) {
            throw new Exception("Error executing fetch rao_mooe_ap_data query: " . mysqli_error($con));
        }
        $rao_mooe_ap_result_data = mysqli_stmt_get_result($stmt_fetch_rao_mooe_ap_data);

        // Fetch rows into $rao_mooe_ap_data
        while ($row = $rao_mooe_ap_result_data->fetch_assoc()) {
            $rao_mooe_ap_data[] = $row; // Append each row to the array
        }

        mysqli_stmt_close($stmt_fetch_rao_mooe_ap_data);
    }

    //Fetch from tb_rao_mooe_ap_totals
    $rao_mooe_ap_BF_totals = [];
    $rao_mooe_ap_TA_totals = [];
    $rao_mooe_ap_grand_totals = [];

    // Fetch data from tb_rao_mooe_ap_totals
    $sql_fetch_rao_mooe_ap_totals = "SELECT * FROM tb_rao_mooe_ap_totals WHERE rao_mooe_id = ? AND isDisplayed = 1 ORDER BY rao_mooe_att_id ASC";
    $stmt_fetch_rao_mooe_ap_totals = mysqli_prepare($con, $sql_fetch_rao_mooe_ap_totals);
    mysqli_stmt_bind_param($stmt_fetch_rao_mooe_ap_totals, "i", $rao_mooe_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_mooe_ap_totals)) {
        throw new Exception("Error executing fetch rao_mooe_ap query: " . mysqli_error($con));
    }

    $rao_mooe_ap_totals_result = mysqli_stmt_get_result($stmt_fetch_rao_mooe_ap_totals);

    // Fetch rows and separate by total_type
    while ($row = $rao_mooe_ap_totals_result->fetch_assoc()) {
        if ($row['total_type'] == 'BF') {
            $rao_mooe_ap_BF_totals[] = $row;
        } elseif ($row['total_type'] == 'TA') {
            $rao_mooe_ap_TA_totals[] = $row;
        }else {
            $rao_mooe_ap_grand_totals[] = $row;
        }
    }

    // Close the statement
    mysqli_stmt_close($stmt_fetch_rao_mooe_ap_totals);


    //////////////////////////////////// OB

    $rao_mooe_ob = []; // Initialize the array for storing fetched rao_mooe_ob data
    $rao_mooe_ob_data = []; // Initialize the array for storing fetched rao_mooe_ob_data

    // Fetch data from tb_rao_mooe_ob
    $sql_fetch_rao_mooe_ob = "SELECT * FROM tb_rao_mooe_ob WHERE rao_mooe_id = ?";
    $stmt_fetch_rao_mooe_ob = mysqli_prepare($con, $sql_fetch_rao_mooe_ob);
    mysqli_stmt_bind_param($stmt_fetch_rao_mooe_ob, "i", $rao_mooe_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_mooe_ob)) {
        throw new Exception("Error executing fetch rao_mooe_ob query: " . mysqli_error($con));
    }
    $rao_mooe_ob_result = mysqli_stmt_get_result($stmt_fetch_rao_mooe_ob);

    // Fetch rows into $rao_mooe_ob
    while ($row = $rao_mooe_ob_result->fetch_assoc()) {
        $rao_mooe_ob[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_mooe_ob);

    // Fetch data from tb_rao_mooe_ob_data for each rao_mooe_ob_id
    foreach ($rao_mooe_ob as $obItem) {
        $rao_mooe_ob_id = $obItem['rao_mooe_ob_id']; // Get rao_mooe_ob_id from the row

        $sql_fetch_rao_mooe_ob_data = "SELECT * FROM tb_rao_mooe_ob_data WHERE rao_mooe_ob_id = ? AND isDisplayed = 1 ORDER BY rao_mooe_att_id ASC";
        $stmt_fetch_rao_mooe_ob_data = mysqli_prepare($con, $sql_fetch_rao_mooe_ob_data);
        mysqli_stmt_bind_param($stmt_fetch_rao_mooe_ob_data, "i", $rao_mooe_ob_id);
        if (!mysqli_stmt_execute($stmt_fetch_rao_mooe_ob_data)) {
            throw new Exception("Error executing fetch rao_mooe_ob_data query: " . mysqli_error($con));
        }
        $rao_mooe_ob_result_data = mysqli_stmt_get_result($stmt_fetch_rao_mooe_ob_data);

        // Fetch rows into $rao_mooe_ob_data
        while ($row = $rao_mooe_ob_result_data->fetch_assoc()) {
            $rao_mooe_ob_data[] = $row; // Append each row to the array
        }

        mysqli_stmt_close($stmt_fetch_rao_mooe_ob_data);
    }

    //Fetch from tb_rao_mooe_ob_totals
    $rao_mooe_ob_TO_totals = [];
    $rao_mooe_ob_OB_totals = [];
    $rao_mooe_ob_AB_totals = [];
    $rao_mooe_ob_grand_totals = [];

    // Fetch data from tb_rao_mooe_ob_totals
    $sql_fetch_rao_mooe_ob_totals = "SELECT * FROM tb_rao_mooe_ob_totals WHERE rao_mooe_id = ? AND isDisplayed = 1 ORDER BY rao_mooe_att_id ASC";
    $stmt_fetch_rao_mooe_ob_totals = mysqli_prepare($con, $sql_fetch_rao_mooe_ob_totals);
    mysqli_stmt_bind_param($stmt_fetch_rao_mooe_ob_totals, "i", $rao_mooe_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_mooe_ob_totals)) {
        throw new Exception("Error executing fetch rao_mooe_ob query: " . mysqli_error($con));
    }

    $rao_mooe_ob_totals_result = mysqli_stmt_get_result($stmt_fetch_rao_mooe_ob_totals);

    // Fetch rows and separate by total_type
    while ($row = $rao_mooe_ob_totals_result->fetch_assoc()) {
        if ($row['total_type'] == 'TO') {
            $rao_mooe_ob_TO_totals[] = $row;
        } elseif ($row['total_type'] == 'OB') {
            $rao_mooe_ob_OB_totals[] = $row;
        }elseif($row['total_type'] == 'AB'){
            $rao_mooe_ob_AB_totals[] = $row;
        }else{
            $rao_mooe_ob_grand_totals[] = $row;
        }
    }

    // Close the statement
    mysqli_stmt_close($stmt_fetch_rao_mooe_ob_totals);



     // Commit transaction
     mysqli_commit($con);

     // Prepare response
    $response = [
        'status' => 'true',
        'rao_mooe_id' => $rao_mooe_id,
        'attribute_name' => $attribute_names,
        'attribute_ids' => $attribute_ids,  // Include the attribute IDs
        'chairman' => $chairman,
        'period_covered' => $period_covered,
        'brgy_captain' => $brgy_captain,
        'rao_mooe_ap' => $rao_mooe_ap,
        'rao_mooe_ap_data' => $rao_mooe_ap_data,
        'rao_mooe_ap_BF_totals' =>  $rao_mooe_ap_BF_totals,
        'rao_mooe_ap_TA_totals' =>  $rao_mooe_ap_TA_totals,
        'rao_mooe_ob' => $rao_mooe_ob,
        'rao_mooe_ob_data' => $rao_mooe_ob_data,
        'rao_mooe_ob_TO_totals' => $rao_mooe_ob_TO_totals,
        'rao_mooe_ob_OB_totals'  =>$rao_mooe_ob_OB_totals,
        'rao_mooe_ob_AB_totals' => $rao_mooe_ob_AB_totals,
        'rao_mooe_ap_grand_totals'=>$rao_mooe_ap_grand_totals,
        'rao_mooe_ob_grand_totals'=>$rao_mooe_ob_grand_totals

        ];
} catch (Exception $e) {

    // Rollback transaction in case of error
    mysqli_rollback($con);
    
    // Send error response
    $response = ['status' => 'false', 'error' => $e->getMessage()];
    error_log("Error processing data: " . $e->getMessage());
}finally {
    // Close the connection
    mysqli_close($con);
}
// Send response to client
$response_json = json_encode($response); 
?>

<html>
<head>
    <title>Employees Data</title>
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

<script src="../../assets/js/jquery-3.6.0.min.js"></script>

<body>
<div class="rao-container">
            <!-- Header Section -->
            <div class="rao-header">
                <h1>Report of Appropriations and Obligations(RAO-MOOE)</h1>
                <p id="period_covered" style="text-align: center;"></p>
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
                        <label>Fund Source:</label> <input type="text" value="Continuing Appropriations"  disabled />
                    </div>
                </div>
            </div>

        <div class="rao-table-container">
            <table id = "viewDataTable" class="rao-table">
                <!--Appropriations--->
                <thead class="appropriations-head">
                    <tr>
                        <th class="hidden">Counter</th>
                        <th class="hidden">ID</th>
                        <th colspan="2" class="stick-head">Reference For Appropriations</th><!-- Date and Ref No -->
                        <th rowspan="2" class="stick-head">Particulars</th> 
                        <th rowspan="2" class="stick-head">Totals</th>
                        <th colspan="5" class="dynamic-stick-head">MAINTENANCE AND OTHER OPERATING EXPENSES</th><!-- Dynamic Heads max 5 -->
                        
                    </tr>
                    <tr class="dynamic-heads">
                        <!-- Dynamic headers will be inserted here by JavaScript -->
                    </tr>

                </thead>

                <tbody class = "inp-group-ap-data-row">
                    <!-- Dynamic rows go here -->

                </tbody>

                <tbody class = "inp-group-ap-totals TA">
                    <tr class="totals-row">
                        <td colspan="3"class="stick-body">Total Appropriations</td>
                        <!-- td for each attributes-->

                        </td>
                    </tr>
                </tbody>

                <tbody class = "inp-group-ap-totals BF">
                    <tr class="totals-row">
                        <td colspan="3"class="stick-body">Balance Forwarded</td>
                        <!-- td for each attributes-->

                    </tr>
                </tbody>
                        <!--Obligations--->
                <thead class="obligations-head">
                    <tr>
                        <th rowspan="2" class="hidden">Counter</th>
                        <th rowspan="2" class="hidden">ID</th>
                        <th colspan="2" class="stick-head">Reference For Obligations</th><!-- Date and Ref No -->
                        <th rowspan="2" class="stick-head">Particulars</th> 
                        <th rowspan="2" class="stick-head">Totals</th>
                        <th colspan="5" class="dynamic-stick-head">MAINTENANCE AND OTHER OPERATING EXPENSES</th>

                    </tr>
                    
                    <tr class="dynamic-heads">
                        <!-- Dynamic headers will be inserted here by JavaScript -->
                    </tr>
                </thead>

                <tbody class = "inp-group-ob-data-row">
                    <!-- Dynamic rows go here -->
                </tbody>

                <tbody class = "inp-group-ob-totals TO">
                        <!-- Row for the total obligations -->
                    <tr class="totals-row">
                        <td colspan="3"class="stick-body">Total Obligations</td>

                        <!-- td for each dynamic-head-->

                    </tr>
                </tbody>

                <tbody class = "inp-group-ob-totals OB">
                    <!-- Row for the Obligations Balance To Date -->
                    <tr class="totals-row">
                        <td colspan="3"class="stick-body">Obligations Balance To Date</td>
                        <!-- td for each dynamic-head-->
                    </tr>
                </tbody>

                <tbody class = "inp-group-ob-totals AB">
                            <!-- Row for the Appropriations Balance To Date -->
                    <tr class="totals-row">
                        <td colspan="3"class="stick-body">Appropriations Balance To Date</td>

                        <!-- td for each dynamic-head-->
                    </tr>
                </tbody>

            </table>
            </div>

            <div class="certification-section">
                <div class="certified">
                    <p>Certified True & Correct:</p>
                    <div class="certified-info">
                        <p id="chairman_name"></p>
                        <p>Chairman, Committee on Appropriations</p>
                    </div>
                </div>
                <div class="noted">
                    <p>Noted by:</p>
                    <div class="noted-info">
                        <p id="brgy_captain"></p>
                        <p>Punong Barangay</p>
                    </div>
                </div>
            </div>

        </div>

</body>



<script>
     // Function to format the period covered
     function formatPeriodCovered(dateString) {
        if (!dateString || dateString === "0000-00-00") {
            return "";
        }
        const date = new Date(dateString);
        const month = date.toLocaleString('default', { month: 'long' }).toUpperCase();
        const year = date.getFullYear();
        const lastDay = new Date(year, date.getMonth() + 1, 0).getDate();
        return `${month} 1-${lastDay}, ${year}`;
    }


        const json = <?php echo $response_json; ?>;
        console.log(json);
                // Check if status is true
                if (json.status === 'true') {
                    
                    var attributeList = json.attribute_name;
                    var chairman = json.chairman;
                    var period_covered = json.period_covered;
                    var brgy_captain = json.brgy_captain;
                    console.log("totals:",json.rao_mooe_ap_grand_totals)
                    console.log("totals:",json.rao_mooe_ob_grand_totals)

                    var attributeIds = json.attribute_ids;

                    console.log("Attribute Ids:", attributeIds);
                    console.log("Chairman: ", chairman);

                    // Check and set conditions for chairman
                    if (chairman && chairman.includes("Pending")) {
                        chairman = ""; // Set to empty if it contains "Pending"
                    }

                    // Check and set conditions for brgy_captain
                    if (brgy_captain && brgy_captain.includes("Pending")) {
                        brgy_captain = ""; // Set to empty if it contains "Pending"
                    }

                    let formattedPeriod = formatPeriodCovered(period_covered);

                    // Set the values in the modal
                    $('#chairman_name').text(chairman);
                    $('#period_covered').text('For '+formattedPeriod);
                    $('#brgy_captain').text(brgy_captain);

                    // Validate that attributeList is an array
                    if (Array.isArray(attributeList)) {
                        var dynamicHeadRow = $('.dynamic-heads');

                        // Ensure the dynamic-heads element exists
                        if (dynamicHeadRow.length) {
                            // Clear existing headers
                            dynamicHeadRow.empty();
                            dynamicHeadRow.append('<th class="stick-head">Date</th>');
                            dynamicHeadRow.append('<th class="stick-head">Reference No</th>');
                            attributeList.forEach(function (attr) {
                                dynamicHeadRow.append('<th class="dynamic-head">' + attr + '</th>');
                            });
                        } else {
                            console.error("#dynamic-heads element not found in the modal.");
                        }
                    } else {
                        console.error("attribute_name is not an array:", attributeList);
                    }

                    // Process dynamic data in rao_mooe_ap
if (json.rao_mooe_ap && Array.isArray(json.rao_mooe_ap) && json.rao_mooe_ap.length > 0) {
    json.rao_mooe_ap.forEach(function (apItem) {
        let apRow = `
        <tr class="ap-data-row">
            <td>${apItem.ap_ref_date || ''}</td>  <!-- Directly display date -->
            <td>${apItem.ap_ref_no || ''}</td>  <!-- Directly display reference number -->
            <td>${apItem.ap_particulars || ''}</td>  <!-- Directly display particulars -->
            <td class="total-data">${apItem.ap_totals || ''}</td>  <!-- Directly display totals -->
            <td class="hidden">${apItem.rao_mooe_ap_id || ''}</td>  <!-- Directly display rao_mooe_ap_id -->
        `;

        // Filter the associated ap_mooe_ap_data based on rao_mooe_ap_id
        if (json.rao_mooe_ap_data && Array.isArray(json.rao_mooe_ap_data)) {
            const relatedApData = json.rao_mooe_ap_data.filter(function (apData) {
                return apData.rao_mooe_ap_id === apItem.rao_mooe_ap_id;
            });

            if (relatedApData.length > 0) {
                relatedApData.forEach(function (apData) {
                    const attrId = apData.rao_mooe_att_id;  // Get the attribute ID

                    // Create a new <td> with the attribute value for each related apData
                    apRow += `
                    <td>${apData.attribute_value || ''}</td>  <!-- Directly display attribute value -->
                    `;
                });
            }
        }

        apRow += `
        </tr>
        `;
        $('.inp-group-ap-data-row').append(apRow);
    });
} else {
    let emptyRow = `
    <tr class="ap-data-row">
        <td><span style="visibility: hidden;">Invisible text</span>  </td>  <!-- Empty date column -->
        <td> </td>  <!-- Empty reference number column -->
        <td> </td>  <!-- Empty particulars column -->
        <td class="total-data"> </td>  <!-- Empty totals column -->
        <td class="hidden"> </td>  <!-- Empty hidden ID column -->
    `;

    attributeIds.forEach(function (attrId) {
        emptyRow += `
        <td> </td>  <!-- Empty attribute value column -->
        `;
    });

    emptyRow += `
    </tr>
    `;
    
    // Append the empty row to the table
    $('.inp-group-ap-data-row').append(emptyRow);
}

                    
                        // Create the total input first
if (json.rao_mooe_ob && Array.isArray(json.rao_mooe_ob) && json.rao_mooe_ob.length > 0) {
    json.rao_mooe_ob.forEach(function (obItem) {
        let obRow = `
        <tr class="ob-data-row">
            <td>${obItem.ob_ref_date || ''}</td>  <!-- Directly display the date -->
            <td>${obItem.ob_ref_no || ''}</td>  <!-- Directly display the reference number -->
            <td>${obItem.ob_particulars || ''}</td>  <!-- Directly display the particulars -->
            <td class="total-data">${obItem.ob_totals || ''}</td>  <!-- Directly display totals -->
            <td class="hidden">${obItem.rao_mooe_ob_id || ''}</td>  <!-- Directly display rao_mooe_ob_id -->
        `;

        // Filter the associated ob_mooe_ob_data based on rao_mooe_ob_id
        if (json.rao_mooe_ob_data && Array.isArray(json.rao_mooe_ob_data)) {
            const relatedObData = json.rao_mooe_ob_data.filter(function (obData) {
                return obData.rao_mooe_ob_id === obItem.rao_mooe_ob_id;
            });

            if (relatedObData.length > 0) {
                relatedObData.forEach(function (obData) {
                    const attrId = obData.rao_mooe_att_id;  // Get the attribute ID

                    // Create a new <td> with the attribute value for each related obData
                    obRow += `
                    <td>${obData.attribute_value || ''}</td>  <!-- Directly display attribute value -->
                    `;
                });
            }
        }

        obRow += `
        </tr>
        `;
        $('.inp-group-ob-data-row').append(obRow);
    });
} else {
    // If no `rao_mooe_ob` data exists, create an empty row
    let emptyRow = `
    <tr class="ob-data-row">
        <td><span style="visibility: hidden;">Invisible text</span> </td>  <!-- Empty date column -->
        <td> </td>  <!-- Empty reference number column -->
        <td> </td>  <!-- Empty particulars column -->
        <td class="total-data"></td>  <!-- Empty totals column -->
        <td class="hidden"> </td>  <!-- Empty hidden ID column -->
    `;

    // Add empty attribute value columns if needed
    const attributeIds = json.attribute_ids || [];  // Assuming attribute_ids are provided in json
    attributeIds.forEach(function (attrId) {
        emptyRow += `
        <td> </td>  <!-- Empty attribute value column -->
        `;
    });

    emptyRow += `
    </tr>
    `;

    // Append the empty row to the table
    $('.inp-group-ob-data-row').append(emptyRow);
}

const rowConfigs = {
    ap: [
        {
            selector: `.inp-group-ap-totals.TA .totals-row`,
            label: 'Total Appropriations',
            identifier: 'TA',
            includeTotal: true
        },
        {
            selector: `.inp-group-ap-totals.BF .totals-row`,
            label: 'Balance Forwarded',
            identifier: 'BF',
            includeTotal: true
        }
    ],
    ob: [
        {
            selector: `.inp-group-ob-totals.TO .totals-row`,
            label: 'Total Obligations',
            identifier: 'TO',
            includeTotal: true
        },
        {
            selector: `.inp-group-ob-totals.OB .totals-row`,
            label: 'Obligations Balance To Date',
            identifier: 'OB',
            includeTotal: true
        },
        {
            selector: `.inp-group-ob-totals.AB .totals-row`,
            label: 'Appropriations Balance To Date',
            identifier: 'AB',
            includeTotal: true
        }
    ]
};

rowConfigs.ap.forEach(config => {
    const totalRow = document.querySelector(config.selector);
    if (!totalRow) return;

    totalRow.innerHTML = ''; // Clear existing row content

    // Create label cell
    const labelCell = document.createElement('td');
    labelCell.setAttribute('colspan', '3');
    labelCell.classList.add('stick-body');
    labelCell.textContent = config.label;
    totalRow.appendChild(labelCell);

    // Add total value cell
    if (config.includeTotal) {
        const totalCell = document.createElement('td');
        totalCell.classList.add('total-data');
        
        // Retrieve the corresponding total entry based on total type and identifier
        const totalArray = json[`rao_mooe_ap_grand_totals`]; // Adjust based on your JSON structure
        const totalEntry = totalArray?.find(entry => entry.total_type === `ap_total_${config.identifier}`);
        
        // Check if totalEntry exists and set the totalCell's value accordingly
        if (totalEntry && totalEntry.attribute_value !== undefined) {
            const attributeValue = totalEntry.attribute_value;
            
            // Log for debugging the value
            console.log("Total Entry Value:", attributeValue);

            // Check if the value is 0 or any falsy value and display empty space
            if (attributeValue == 0 || attributeValue == '0') {
                totalCell.textContent = " ";  // Empty space if value is 0

            } else {
                totalCell.textContent = attributeValue;  // Otherwise, display the actual value
            }
        } else {
            totalCell.textContent = '';  // Fallback to an empty value if no totalEntry found
        }

        totalRow.appendChild(totalCell);
    }


    // Add attribute data cells (if any)
    attributeList.forEach((attr, index) => {
        let attrId = json.rao_mooe_ap_data.find(apData => apData.attribute_name === attr)?.rao_mooe_att_id;

        // Fallback to attributeIds if attrId is not found
        if (!attrId && attributeIds && attributeIds.length > index) {
            attrId = attributeIds[index];
        }

        console.log("Resolved Attribute AP ID:", attrId);

        if (attrId) {
            const td = document.createElement('td');

            // Access the appropriate totals array directly from the response object
            const totalsArray = json[`rao_mooe_ap_${config.identifier}_totals`];
            const totalEntry = totalsArray?.find(
                apTotal => apTotal.rao_mooe_att_id == attrId
            );
            console.log("attrId: ",attrId);
            console.log("Total Array: ",totalsArray);
            console.log("Total Entry: ",totalEntry);

            // Retrieve the attribute value
            const totalValue = totalEntry ? totalEntry.attribute_value : ''; // Use attribute_value or fallback to empty
           
            td.textContent = (totalValue == 0) ? " " : totalValue;

            totalRow.appendChild(td);
        }
    });
});

rowConfigs.ob.forEach(config => {
    const totalRow = document.querySelector(config.selector);
    if (!totalRow) {
        console.warn(`Selector not found: ${config.selector}`);
        return;
    }

    totalRow.innerHTML = ' '; // Clear existing row content

    // Create label cell
    const labelCell = document.createElement('td');
    labelCell.setAttribute('colspan', '3');
    labelCell.classList.add('stick-body');
    labelCell.textContent = config.label;
    totalRow.appendChild(labelCell);

    
   
    // Add total value cell
    if (config.includeTotal) {
        const totalCell = document.createElement('td');
        totalCell.classList.add('total-data');
        
        // Retrieve the corresponding total entry based on total type and identifier
        const totalArray = json[`rao_mooe_ob_grand_totals`]; // Adjust based on your JSON structure
        const totalEntry = totalArray?.find(entry => entry.total_type === `ob_total_${config.identifier}`);
        
        // Check if totalEntry exists and set the totalCell's value accordingly
        if (totalEntry && totalEntry.attribute_value !== undefined) {
            const attributeValue = totalEntry.attribute_value;
            
            // Log for debugging the value
            console.log("Total Entry Value:", attributeValue);

            // Check if the value is 0 or any falsy value and display empty space
            if (attributeValue == 0 || attributeValue == '0') {
                totalCell.textContent = " ";  // Empty space if value is 0

            } else {
                totalCell.textContent = attributeValue;  // Otherwise, display the actual value
            }
        } else {
            totalCell.textContent = '';  // Fallback to an empty value if no totalEntry found
        }

        totalRow.appendChild(totalCell);
    }

    // Add attribute data cells (if any)
    attributeList.forEach((attr, index) => {
        let attrId = json.rao_mooe_ob_data.find(obData => obData.attribute_name === attr)?.rao_mooe_att_id;

        // Fallback to attributeIds if attrId is not found
        if (!attrId && attributeIds && attributeIds.length > index) {
            attrId = attributeIds[index];
        }

        console.log("Resolved Attribute ID (OB):", attrId);

        if (attrId) {
            const td = document.createElement('td');

            // Access the appropriate totals array directly from the response object
            const totalsArray = json[`rao_mooe_ob_${config.identifier}_totals`];
            const totalEntry = totalsArray?.find(
                obTotal => obTotal.rao_mooe_att_id === attrId
            );
            console.log("Total Array: ",totalsArray);
            console.log("Total Entry: ",totalEntry);

            // Retrieve the attribute value
            const totalValue = totalEntry ? totalEntry.attribute_value : ' '; // Use attribute_value or fallback to empty
            console.log("attributevalue: ",totalEntry.attribute_value);
            td.textContent = (totalValue == 0) ? " " : totalValue;

            totalRow.appendChild(td);
        }
    });
});


} else {
    console.error("Response status is false:", json.error);
}
            
       
</script>

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
        const dynamicHeadersAppropriations = document.querySelectorAll('.appropriations-head .dynamic-head');
        const dynamicHeadersObligations = document.querySelectorAll('.obligations-head .dynamic-head');
        const dynamicStickHeadAppropriations = document.querySelector('.appropriations-head .dynamic-stick-head');
        const dynamicStickHeadObligations = document.querySelector('.obligations-head .dynamic-stick-head');

        // Get the count of dynamic headers
        const dynamicCount = dynamicHeadersAppropriations.length;
        const dynamicCountob = dynamicHeadersObligations.length;

        // Update colspan for the appropriations stick header
        if (dynamicStickHeadAppropriations) {
            dynamicStickHeadAppropriations.setAttribute('colspan', dynamicCount);
        } else {
            console.warn('No dynamic stick head found for appropriations.');
        }

        // Update colspan for the obligations stick header
        if (dynamicStickHeadObligations) {
            dynamicStickHeadObligations.setAttribute('colspan', dynamicCount);
        } else {
            console.warn('No dynamic stick head found for obligations.');
        }

        console.log(`Updated colspan to: ${dynamicCount}`);
        console.log(`Updated colspan to: ${dynamicCountob}`);
    }

    // Call the function initially when DOM is fully loaded
    document.addEventListener("DOMContentLoaded", adjustColspan);
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
