<?php
include '../../head.php';
include '../../sidebar.php';
?>
<style>

.column-titles {
  display: grid;
  grid-template-columns: 20px repeat(9, 1fr) 50px; 
  gap: 10px; 
  align-items: center; 
  font-size: small;
}

.column-titles span {
  text-align: center; 
}
.inp-group-ap, .inp-group-ap-update{
    height: 110px;
    overflow: auto;
}
.inp-group-ob, .inp-group-ob-update{
    height: 110px;
    overflow: auto;
}
.wrap{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    margin-bottom: 10px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e4e1e1;
}
.add-row-ap, .add-row-ob, .add{
    text-decoration: none;
    display: inline-block;
    background: #8bc34a;
    color: #fff;
    font-size: 1.5rem;
    font-weight: bold;
    width: 30px;
    height: 30px;
    color: #fff;
    display: flex;
    justify-content:center;
    cursor: pointer;
}
.flex{
    display: grid;
    grid-template-columns: 20px repeat(9, 1fr) 50px;  
    gap: 5px; 
    margin-bottom: 10px; 
    align-items: center;
}
.delete{
    text-decoration: none;
    display: inline-block;
    background: #f44336;
    color: #fff;
    font-size: 1.5rem;
    font-weight: bold;
    width: 30px;
    height: 30px;
    color: #fff;
    display: flex;
    justify-content:center;
    cursor: pointer;
}

.delete-hidden{
    width: 30px;
    height: 30px;
    pointer-events: none;
    visibility: hidden;
}


.ap-data-row td.hidden{
    display: none;
}

.hidden {
    display: none;
}

.rao .modal-dialog{
    max-width: 85% !important;
    max-height: 95% !important;
    overflow-y:  auto!important;
}

/* #AttributeModal .modal-dialog{
    max-width: 0% !important;
    max-height: 80% !important;
    overflow-y:  auto!important;
} */


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
    grid-template-columns: auto 1fr auto 1fr; /* Two label-input pairs per row */
    gap: 10px 20px; /* Spacing between rows and columns */
}
.rao-header .info {
    display: contents; /* Prevent extra wrappers; the grid will handle alignment */
}

.rao-header label {
    font-weight: bold;
    white-space: nowrap; /* Prevent labels from breaking into multiple lines */
    align-self: center; /* Vertically align labels with inputs */
}

.rao-header input {
    width: 100%; /* Make input fields stretch to fit the grid */
    padding: 5px;
    border: none;      
    border-radius: 4px;
    background: none; /* Light background for disabled fields */
    color: #000;
    outline: none;
    box-sizing: border-box; /* Ensure padding doesn't affect width */
}

td.action-buttons{
   display: flex;
   justify-content: space-around;
}


.rao-table-container {
    max-width: 1305px;
    width: 100%;
    height: auto;
    overflow-x: auto;
    /* cursor: grab; */
    /*display: flex !important;
    align-items: center !important;
    justify-content: center !important; *//* Add this line */
    /* border: 2px solid #000; */
    /* box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000; */
}
.rao-table {
    max-width: 1305px;
    table-layout: fixed;
    width: max-content;
    border-collapse: collapse;
    table-layout: fixed;
    border: 3px solid #000;
    /* box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000; */
    margin-left: auto; /* Add this line */
    margin-right: auto; /* Add this line */
}
.rao-table thead th{
    background-color: #a0e7a0; /* Green background for each header cell */
   
}

.rao-table th,
.rao-table td {
    border: 1px solid #000;
    padding: 5px;
    width: 145px; /* Set width for all cells */
    min-width: 145px; /* Ensure minimum width */
    max-width: 145px; /* Ensure maximum width */
    height: 20px;
    text-align: center;
    box-sizing: border-box;
    box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000;
}
.rao-table th {
    background-color: #f0f0f0;
    padding: 10px;
}
/* For Reference and Date*/
.rao-table th.stick-head:nth-child(1),
.rao-table th.stick-head:nth-child(3),
.rao-table td:nth-child(1),
.rao-table td:nth-child(1){
    position: sticky;
    left: 0;
    z-index: 2;
    /* background-color: white; */
    box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000;
}
/* For Ref No*/
.rao-table th.stick-head:nth-child(2),
.rao-table td:nth-child(2) {
    position: sticky;
    left: 145px;
    z-index: 2;
    /* background-color: white; */
    box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000;
}

/* For Particulars*/
.rao-table th.stick-head:nth-child(4),
.rao-table td:nth-child(3) {
    position: sticky;
    left: 290px;
    z-index: 1;
    /* background-color: white; */
    box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000;
}



/* For Totals*/
.rao-table th.stick-head:nth-child(5){
    position: sticky;
    left:435px;
    z-index: 2;
    /* background-color: white; */
    box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000;
}

/* For Total Data*/
.rao-table td.total-data{
    position: sticky;
    left:435px;
    z-index: 2;
    /* background-color: white; */
    box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000;
}
/* td with span of 3 cols*/
.rao-table td.stick-body[colspan="3"] {
    position: sticky;
    left: 0;
    z-index: 3;
    /* background-color: white; */
    width: 435px;
    box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000;
}

/* Capital Outlay*/
.rao-table th.dynamic-stick-head{
    position: sticky;
    left:580px;
    z-index: 2;
    box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000;
    width: calc(100% - 590px); /* Set width to 100% minus 580px */
}


/* For Dynamic Heads*/
.rao-table th.dynamic-head{
    position: static;
    z-index: 1;
    background-color: #E2F8E2;
    box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000;
}

/* For OB Cont Heads*/
.rao-table th.ob-stick-head{
    position: static;
    z-index: 2;
    background-color: white;
    box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000;
}

/* Action cols to adjust*/
.rao-table th.action-head,
.rao-table td.action-data {
    position: sticky;
    right: 0;
    z-index: 3;
    box-shadow: inset 1px 0 #000, inset 0 1px #000, inset 0 -1px #000;
}

.rao-table td.action-data {
    background-color: white;
}
.rao-table td.action-data a{
    margin: 0 10px; /* Space between the links */
    text-decoration: none; /* Optional: removes underline from links */
    display: inline-block; 
}

.rao-table input{
    width: 100%;
    box-sizing: border-box;
    border: none;
    color: #000;
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
    font-size: 0.9em; /* Adjusts font size relative to parent */
    line-height: 1.2;
    padding: 2px 4px;
}
.attribute-container{
    min-height: 500px;
    max-height: 500px;
    width: auto;
    overflow-y: auto;
}

/* tbody.inp-group-ap-totals .totals-row td{
    background-color: yellow;
} */
.rao-table tr.ap-data-row td:nth-child(1),
.rao-table tr.ap-data-row td:nth-child(2),
.rao-table tr.ap-data-row td:nth-child(3),
.rao-table tr.ap-data-row td:nth-child(4),

.rao-table tr.ob-data-row td:nth-child(1),
.rao-table tr.ob-data-row td:nth-child(2),
.rao-table tr.ob-data-row td:nth-child(3),
.rao-table tr.ob-data-row td:nth-child(4){
    background-color: #C4E7A0;
}

.rao-table tr.totals-row td:nth-child(1),
.rao-table tr.totals-row td:nth-child(2) {
    background-color: #8BDD77;
}

.rao-table tr.ap-data-row td input,
.rao-table tr.totals-row td input,
.rao-table tr.ob-data-row td input{
    background-color:inherit; /* This ensures the input inherits the background color from the parent cell */
}
/* Container for the entire section */
.certification-section {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Two equal columns */
    gap: 20px; /* Spacing between the two columns */
    margin-top: 20px;
}

/* Section styling for Certified and Noted columns */
.certified, .noted {
    display: flex;
    flex-direction: column;
    justify-content: center; /* Center vertically */
    align-items: center; /* Center horizontally */
    text-align: center; /* Ensure text is center-aligned */
}

/* Headings ("Certified True & Correct" and "Noted by:") */
.certified p:first-child,
.noted p:first-child {
    font-weight: bold;
    margin-bottom: 10px;
}


/* Names styling */
.certified-info p:first-child,
.noted-info p:first-child {
    font-weight: bold;
    text-transform: uppercase; /* Matches style in your image */
    margin-bottom: 5px;
    text-decoration: underline;
}

/* Titles styling */
.certified-info p:last-child,
.noted-info p:last-child {
    font-style: italic;
    font-size: 14px;
    color: #333; /* Optional, for differentiation */
}


/* Parent dropdown container: make it a flexbox for easy alignment */
.dropdown {
  position: relative;
  display: inline-flex; /* Use inline-flex to align items horizontally */
  z-index: 1000;
  align-items: center; /* Ensure the label and dropdown align properly */
}

/* Dropdown label styling */
.dropdown-label {
  border: 1px solid #000;
  padding: 5px;
  cursor: pointer;
  font-weight: bold;
  display: inline-block; /* Ensure the label is inline */
  width: auto; /* Let the label size adapt to content */
  margin-right: 10px; /* Optional: add space between the label and dropdown */
}

/* Dropdown list styling */
.dropdown-list {
  display: none;
  position: absolute;
  top: 100%; /* Directly below the label */
  left: 0; /* Align with the left of the parent dropdown */
  width: 500px; /* Make the dropdown list the same width as the label */
  border: 1px solid #ccc;
  background-color: white;
  padding: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 10;
  box-sizing: border-box; /* Ensure padding doesn’t affect width */
}

/* Show dropdown list when hovering over the parent */
.dropdown:hover .dropdown-list {
  display: block;
}

/* Dropdown option styling */
.dropdown-option {
  color: #000;
  display: block;
  padding: 5px 10px;
  cursor: pointer;
  background-color: #d8f6d594;
}

.dropdown-option:hover {
  background-color: #1ca500;
}


.dynamic-options {
    max-height: 300px; 
    overflow-y: auto; 
    border: 1px solid #ccc; 
    padding: 5px;
    box-sizing: border-box;
}

.checkbox-item {
  margin-right: 10px;
}


.cashbook-actions {
    text-align: right;
}

.cashbook-actions button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    margin-right: 10px;
}

.cashbook-actions button:hover {
    background-color: #45a049;
}



</style>
<body>
    <section class="home">  
        <div class="financial_rao">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Records of Appropriations and Obligations (CO-CONT)</h1>
                        </div>
                        <div class="table-actions">  
                        <div class="dropdown table_dropdown">
                        <button class="dropdown-toggle">Other RAO Sources</button>
                            <ul class="dropdown-menu">
                                <li><a href="../../barangay_secretary/rao/table_rao_records.php">RAO-PS</a></li>
                                <li><a href="../../barangay_secretary/rao-cont/table_rao_cont_records.php">RAO-CONT</a></li>
                                <li><a href="../../barangay_secretary/rao-fe/table_rao_fe_records.php">RAO-FE</a></li>
                                <li><a href="../../barangay_secretary/rao-mooe/table_rao_mooe_records.php">RAO-MOOE</a></li>
                                <li><a href="../../barangay_secretary/rao-bdrrmf/table_rao_bdrrmf_records.php">RAO-BDRRMF</a></li>
                                <li><a href="../../barangay_secretary/rao-dev/table_rao_dev_records.php">RAO-DEV</a></li>
                                <li><a href="../../barangay_secretary/rao-sk/table_rao_sk_records.php">RAO-SK</a></li>
                                <li><a href="../../barangay_secretary/rao-co/table_rao_co_cont_records.php">RAO-CO</a></li>
                            </ul>
                        </div>    
                            <!-- <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#AttributeModal" class="add-table-btn">+ Add Record</button> -->
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Period Covered</th>
                        <th>Chairman</th>
                        <th>Barangay Captain</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            window.apCounterUpdate = 1;
                            window.obCounterUpdate = 1;

                            $('#example').DataTable({
                                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                                    $(nRow).attr('id', aData[0]);
                                    $(nRow).find('.deleteBtn').attr('data-rao_id', aData[0]);
                                    $(nRow).find('.infoBtn').attr('data-item_id', aData[0]);
                                },
                                'serverSide': 'true',
                                'processing': 'true',
                                'paging': 'true',
                                'order': [],
                                'ajax': {
                                    
                                    'url': 'fetch_data.php',
                                    'type': 'post',
                                },
                                "columnDefs": [
                                    {
                                        "targets": [0],  // Target the first column (aData[0])
                                        "visible": false, // Hide the column
                                        "searchable": false // Disable search for this column if needed
                                    },
                                    {
                                        "bSortable": false,
                                        "aTargets": [4]
                                    }
                                ]
                            });
                        });

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

                        $('#example').on('click', '.infoBtn', function (event) {
                            var table = $('#example').DataTable();
                            var trid = $(this).closest('tr').attr('data-item_id');
                            var rao_cocont_id = $(this).data('item_id');

                            // Store data in modal for reference
                            $('#updateUser').data('rao_cocont_id', rao_cocont_id);
                            $('#updateUser').data('trid', trid);

                            // Show modal and set rao_cocont_id value
                            $('#viewDataModal').modal('show');
                            console.log("Rao cocont ID:", rao_cocont_id);
                            $('#viewDataModal #rao_cocont_id').val(rao_cocont_id);

                            $('#viewDataModal .inp-group-ap-data-row').empty(); 
                            $('#viewDataModal .inp-group-ob-data-row').empty(); // Empty previous rows

                            // AJAX request to fetch data
                            $.ajax({
                                url: "get_single_data.php",
                                data: { rao_cocont_id: rao_cocont_id },
                                type: 'post',
                                success: function (data) {
                                    try {
                                        // Parse the response data
                                        var json = JSON.parse(data);
                                        console.log("Response:", json);

                                        // Check if status is true
                                        if (json.status === 'true') {
                                            var attributeList = json.attribute_name;
                                            var chairman = json.chairman;
                                            var period_covered = json.period_covered;
                                            var brgy_captain = json.brgy_captain;

                                            var attributeIds = json.attribute_ids;

                                            console.log("Attribute Ids:", attributeIds);

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
                                            $('#viewDataModal #chairman_name').text(chairman);
                                            $('#viewDataModal #period_covered').text('For '+formattedPeriod);
                                            $('#viewDataModal #brgy_captain').text(brgy_captain);

                                            // Validate that attributeList is an array
                                            if (Array.isArray(attributeList)) {
                                                var dynamicHeadRow = $('#viewDataModal #dynamic-heads');

                                                // Ensure the dynamic-heads element exists
                                                if (dynamicHeadRow.length) {
                                                    // Clear existing headers
                                                    dynamicHeadRow.empty();
                                                    dynamicHeadRow.append('<th class="stick-head">Date</th>');
                                                    dynamicHeadRow.append('<th class="stick-head">Reference No</th>');
                                                    attributeList.forEach(function (attr) {
                                                        dynamicHeadRow.append('<th class="dynamic-head">' + attr + '</th>');
                                                    });
                                                    // dynamicHeadRow.append('<th rowspan="2" class="action-head">Actions</th>');
                                                } else {
                                                    console.error("#dynamic-heads element not found in the modal.");
                                                }
                                            } else {
                                                console.error("attribute_name is not an array:", attributeList);
                                            }

                                           // Process dynamic data in rao_cocont_ap
                                            if (json.rao_cocont_ap && Array.isArray(json.rao_cocont_ap) && json.rao_cocont_ap.length > 0) {
                                                json.rao_cocont_ap.forEach(function (apItem) {
                                                    let apRow = `
                                                    <tr class="ap-data-row">
                                                        <td><input type="date" name="ap_date_data[]" value="${apItem.ap_ref_date || ''}" disabled></td>
                                                        <td><input type="text" name="ap_reference_no[]" value="${apItem.ap_ref_no || ''}" disabled></td>
                                                        <td><input type="text" name="ap_particulars[]" value="${apItem.ap_particulars || ''}" disabled></td>
                                                        <td class="total-data"><input type="number" name="ap_total[]" value="${apItem.ap_totals || ''}" disabled></td>
                                                        <td class="hidden"><input type="hidden" name="rao_cocont_ap_id" value="${apItem.rao_cocont_ap_id || ''}" disabled></td>
                                                    `;

                                                    // Filter the associated ap_cocont_ap_data based on rao_cocont_ap_id
                                                    if (json.rao_cocont_ap_data && Array.isArray(json.rao_cocont_ap_data)) {
                                                        const relatedApData = json.rao_cocont_ap_data.filter(function (apData) {
                                                            return apData.rao_cocont_ap_id === apItem.rao_cocont_ap_id;
                                                        });

                                                        if (relatedApData.length > 0) {
                                                            relatedApData.forEach(function (apData) {
                                                                const attrId = apData.rao_cocont_att_id;  // Get the attribute ID

                                                                // Create a new <td> with an input for each attribute
                                                                apRow += `
                                                                <td>
                                                                    <input type="number" name="ap_attr_${attrId}[]" value="${apData.attribute_value || ''}" step="0.01" disabled>
                                                                </td>
                                                                `;
                                                            });
                                                        }
                                                    }

                                                    apRow += `

                                                    </tr>
                                                    `;
                                                    $('#viewDataModal .inp-group-ap-data-row').append(apRow);
                                                });
                                            } else {
                                                let emptyRow = `
                                                <tr class="ap-data-row">
                                                    <td><input type="date" name="ap_date_data[]" value="" disabled></td>
                                                    <td><input type="text" name="ap_reference_no[]" value="" disabled></td>
                                                    <td><input type="text" name="ap_particulars[]" value="" disabled></td>
                                                    <td class="total-data"><input type="number" name="ap_total[]" value="" disabled></td>
                                                    <td class="hidden"><input type="hidden" name="rao_cocont_ap_id" value="" disabled></td>
                                                `;

                                                attributeIds.forEach(function (attrId) {
                                                    emptyRow += `
                                                    <td>
                                                        <input type="number" name="ap_attr_${attrId}[]" value="" step="0.01" disabled>
                                                    </td>
                                                    `;
                                                });

                                                emptyRow += `
                                                </tr>
                                                `;

                                                // Append the empty row to the table
                                                $('#viewDataModal .inp-group-ap-data-row').append(emptyRow);
                                            }
                                            
                                             // Create the total input first
                                             if (json.rao_cocont_ob && Array.isArray(json.rao_cocont_ob) && json.rao_cocont_ob.length > 0) {
                                                json.rao_cocont_ob.forEach(function (obItem) {
                                                    let obRow = `
                                                    <tr class="ob-data-row">
                                                        <td><input type="date" name="ob_date_data[]" value="${obItem.ob_ref_date || ''}" disabled></td>
                                                        <td><input type="text" name="ob_reference_no[]" value="${obItem.ob_ref_no || ''}" disabled></td>
                                                        <td><input type="text" name="ob_particulars[]" value="${obItem.ob_particulars || ''}" disabled></td>
                                                        <td class="total-data"><input type="number" name="ob_total[]" value="${obItem.ob_totals || ''}" disabled></td>
                                                        <td class="hidden"><input type="hidden" name="rao_cocont_ob_id" value="${obItem.rao_cocont_ob_id || ''}" disabled></td>
                                                    `;

                                                    // Filter the associated ob_cocont_ob_data based on rao_cocont_ob_id
                                                    if (json.rao_cocont_ob_data && Array.isArray(json.rao_cocont_ob_data)) {
                                                        const relatedObData = json.rao_cocont_ob_data.filter(function (obData) {
                                                            return obData.rao_cocont_ob_id === obItem.rao_cocont_ob_id;
                                                        });

                                                        if (relatedObData.length > 0) {
                                                            relatedObData.forEach(function (obData) {
                                                                const attrId = obData.rao_cocont_att_id;  // Get the attribute ID

                                                                // Create a new <td> with an input for each attribute
                                                                obRow += `
                                                                <td>
                                                                    <input type="number" name="ob_attr_${attrId}[]" value="${obData.attribute_value || ''}" step="0.01" disabled>
                                                                </td>
                                                                `;
                                                            });
                                                        }
                                                    }

                                                    obRow += `
                                                    </tr>
                                                    `;
                                                    $('#viewDataModal .inp-group-ob-data-row').append(obRow);
                                                });
                                            } else {
                                                // If no `rao_cocont_ob` data exists, create an empty row
                                                let emptyRow = `
                                                <tr class="ob-data-row">
                                                    <td><input type="date" name="ob_date_data[]" value="" disabled></td>
                                                    <td><input type="text" name="ob_reference_no[]" value="" disabled></td>
                                                    <td><input type="text" name="ob_particulars[]" value="" disabled></td>
                                                    <td class="total-data"><input type="number" name="ob_total[]" value="" disabled></td>
                                                    <td class="hidden"><input type="hidden" name="rao_cocont_ob_id" value="" disabled></td>
                                                `;

                                                // Add attribute input fields (if needed)
                                                const attributeIds = json.attribute_ids || [];  // Assuming attribute_ids are provided in json
                                                attributeIds.forEach(function (attrId) {
                                                    emptyRow += `
                                                    <td>
                                                        <input type="number" name="ob_attr_${attrId}[]" value="" step="0.01" disabled>
                                                    </td>
                                                    `;
                                                });

                                                emptyRow += `
                                                </tr>
                                                `;

                                                // Append the empty row to the table
                                                $('#viewDataModal .inp-group-ob-data-row').append(emptyRow);
                                            }


                                            const rowConfigs = {
                                                ap: [
                                                    {
                                                        selector: `#viewDataModal .inp-group-ap-totals.TA .totals-row`,
                                                        label: 'Total Appropriations',
                                                        identifier: 'TA',
                                                        includeTotal: true
                                                    },
                                                    {
                                                        selector: `#viewDataModal .inp-group-ap-totals.BF .totals-row`,
                                                        label: 'Balance Forwarded',
                                                        identifier: 'BF',
                                                        includeTotal: true
                                                    }
                                                ],
                                                ob: [
                                                    {
                                                        selector: `#viewDataModal .inp-group-ob-totals.TO .totals-row`,
                                                        label: 'Total Obligations',
                                                        identifier: 'TO',
                                                        includeTotal: true
                                                    },
                                                    {
                                                        selector: `#viewDataModal .inp-group-ob-totals.OB .totals-row`,
                                                        label: 'Obligations Balance To Date',
                                                        identifier: 'OB',
                                                        includeTotal: true
                                                    },
                                                    {
                                                        selector: `#viewDataModal .inp-group-ob-totals.AB .totals-row`,
                                                        label: 'Appropriations Balance To Date',
                                                        identifier: 'AB',
                                                        includeTotal: true
                                                    }
                                                ]
                                            };

                                            rowConfigs.ap.forEach(config => {
                                                const totalRow = document.querySelector(config.selector);
                                                if (!totalRow) return;

                                                totalRow.innerHTML = '';

                                                const labelCell = document.createElement('td');
                                                labelCell.setAttribute('colspan', '3');
                                                labelCell.classList.add('stick-body');
                                                labelCell.textContent = config.label;
                                                totalRow.appendChild(labelCell);

                                                if (config.includeTotal) {
                                                    const totalInputCell = document.createElement('td');
                                                    totalInputCell.classList.add('total-data');
                                                    const totalInput = document.createElement('input');
                                                    totalInput.value = '';
                                                    totalInput.disabled = true;
                                                    totalInput.name = `ap_total_${config.identifier}`;
                                                    totalInputCell.appendChild(totalInput);
                                                    totalRow.appendChild(totalInputCell);
                                                }


                                                attributeList.forEach((attr, index) => {
                                                    let attrId = json.rao_cocont_ap_data.find(apData => apData.attribute_name === attr)?.rao_cocont_att_id;

                                                    // If attrId is empty or undefined, use the corresponding entry in attributeIds
                                                    if (!attrId && attributeIds && attributeIds.length > index) {
                                                        attrId = attributeIds[index];
                                                    }

                                                    console.log("Resolved Attribute ID:", attrId);

                                                    if (attrId) {
                                                        const td = document.createElement('td');
                                                        const input = document.createElement('input');
                                                        input.type = 'number';
                                                        input.name = `ap_attr_${config.identifier}_${attrId}`;
                                                        input.disabled = true;
                                                        input.value = '';
                                                        td.appendChild(input);
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

                                                totalRow.innerHTML = '';

                                                const labelCell = document.createElement('td');
                                                labelCell.setAttribute('colspan', '3');
                                                labelCell.classList.add('stick-body');
                                                labelCell.textContent = config.label;
                                                totalRow.appendChild(labelCell);

                                                if (config.includeTotal) {
                                                    const totalInputCell = document.createElement('td');
                                                    totalInputCell.classList.add('total-data');
                                                    const totalInput = document.createElement('input');
                                                    totalInput.value = '';
                                                    totalInput.disabled = true;
                                                    totalInput.name = `ob_total_${config.identifier}`;
                                                    totalInputCell.appendChild(totalInput);
                                                    totalRow.appendChild(totalInputCell);
                                                }

                                                attributeList.forEach((attr, index) => {
                                                    let attrId = json.rao_cocont_ob_data.find(obData => obData.attribute_name === attr)?.rao_cocont_att_id;

                                                    // Fallback to `attributeIds` if `attrId` is not found
                                                    if (!attrId && attributeIds && attributeIds.length > index) {
                                                        attrId = attributeIds[index];
                                                    }

                                                    console.log("Resolved Attribute ID (OB):", attrId);

                                                    if (attrId) {
                                                        const td = document.createElement('td');
                                                        const input = document.createElement('input');
                                                        input.type = 'number';
                                                        input.name = `ob_attr_${config.identifier}_${attrId}`;
                                                        input.disabled = true;
                                                        input.value = '';
                                                        td.appendChild(input);
                                                        totalRow.appendChild(td);
                                                    }
                                                });

                                            });

                                        } else {
                                            console.error("Response status is false:", json.error);
                                        }
                                    } catch (err) {
                                        console.error("Error parsing response JSON:", err);
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.error("AJAX error:", status, error);
                                    showAlert('Error fetching data. Please try again.',"alert-danger");
                                }
                            });

                            // Optional: Reset counters or clear modal when it's hidden
                            $('#viewDataModal').on('hidden.bs.modal', function () {
                                // Your reset logic here
                            });
                        });

                    </script>
                </section><!-- .home-->
                <!-- Modal -->
                <section class="rao">
                <!-- View RAO -->
                <div class="modal fade" id="viewDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Report of Appropriations and Obligations (CO-CONT)</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="rao-container">
                                <!-- Header Section -->
                                <div class="rao-header">
                                    <h1>Report of Appropriations and Obligations (RAO-COCONT)</h1>
                                    <input type="hidden" id="rao_cocont_id" name="rao_cocont_id">
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
                                            <label>Fund Source:</label> <input type="text" value=" General Fund (Capital Outlay)"  disabled />
                                        </div>
                                    </div>
                                </div>

                            <div class="rao-table-container">
                                <table id = "viewDataTable" class="rao-table">
                                    <!--Appropriations--->
                                    <thead>
                                        <tr>
                                            <th class="hidden">Counter</th>
                                            <th class="hidden">ID</th>
                                            <th colspan="2" class="stick-head">Reference For Appropriations</th><!-- Date and Ref No -->
                                            <th rowspan="2" class="stick-head">Particulars</th> 
                                            <th rowspan="2" class="stick-head">Totals</th>
                                            <th colspan="5" class="dynamic-stick-head">Capital Outlay</th><!-- Dynamic Heads max 5 -->
                                            
                                        </tr>
                                        <tr id="dynamic-heads">
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
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="hidden">Counter</th>
                                            <th rowspan="2" class="hidden">ID</th>
                                            <th colspan="2" class="stick-head">Reference For Obligations</th><!-- Date and Ref No -->
                                            <th rowspan="2" class="stick-head">Particulars</th> 
                                            <th rowspan="2" class="stick-head">Totals</th>
                                            <th colspan="5" class="dynamic-stick-head">Capital Outlay</th>

                                        </tr>
                                        
                                        <tr id="dynamic-heads">
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
                        </div>
                    </div>
                </div>
            </div>
            </section>
    </body> 

<script>
(function() {
    function initializeModal(modalId) {
        if (!document.getElementById(modalId)) return;

        $(document).ready(function() {
            let modalInitialized = false;
            let apCounter = 1;
            let obCounter = 1;
            let apTotalsInitialized = false;
            let obTotalsInitialized = false;

            $(`#${modalId}`).on('input', '.ap-data-row input[type="number"], .ob-data-row input[type="number"]', function() {
                clearAllTotals(modalId);
                calculateTotals(modalId);
            });

            function clearAllTotals(modalId) {
                $(`#${modalId} input[name^="ap_attr_TA_"]`).val('');
                $(`#${modalId} input[name^="ap_attr_BF_"]`).val('');
                $(`#${modalId} input[name^="ob_attr_TO_"]`).val('');
                $(`#${modalId} input[name^="ob_attr_OB_"]`).val('');
                $(`#${modalId} input[name^="ob_attr_AB_"]`).val('');
                $(`#${modalId} input[name="ap_total_TA"]`).val('');
                $(`#${modalId} input[name="ap_total_BF"]`).val('');
                $(`#${modalId} input[name="ob_total_TO"]`).val('');
                $(`#${modalId} input[name="ob_total_OB"]`).val('');
            }

            function calculateAttributeTotals(modalId) {
                calculateTypeAttributeTotals('ap', {
                    rowSelector: `#${modalId} .ap-data-row`,
                    inputPattern: /ap_attr_(\d+)/,
                    totalSelectors: {
                        TA: 'ap_attr_TA_',
                        BF: 'ap_attr_BF_'
                    }
                });

                calculateTypeAttributeTotals('ob', {
                    rowSelector: `#${modalId} .ob-data-row`,
                    inputPattern: /ob_attr_(\d+)/,
                    totalSelectors: {
                        TO: 'ob_attr_TO_',
                        OB: 'ob_attr_OB_',
                        AB: 'ob_attr_AB_'
                    }
                });

                calculateAppropriationsBalance(modalId);
            }

            function calculateTypeAttributeTotals(type, config) {
                const attributeTotals = {};
                
                Object.values(config.totalSelectors).forEach(selector => {
                    $(`#${modalId} input[name^="${selector}"]`).val('0.00');
                });

                $(config.rowSelector).each(function() {
                    $(this).find('input[type="number"]').each(function() {
                        const match = this.name.match(config.inputPattern);
                        if (match) {
                            const attrId = match[1];
                            const value = parseFloat(this.value) || 0;
                            attributeTotals[attrId] = (attributeTotals[attrId] || 0) + value;
                        }
                    });
                });

                Object.entries(attributeTotals).forEach(([attrId, total]) => {
                    Object.values(config.totalSelectors).forEach(selector => {
                        $(`#${modalId} input[name="${selector}${attrId}"]`).val(total.toFixed(2));
                    });
                });
            }

                function calculateAppropriationsBalance(modalId) {
        // Target the specific tbody where totals are located
        $(`#${modalId} .inp-group-ob-totals`).find('.totals-row').each(function () {
            // Iterate over each input field in the row
            $(this).find('input[type="number"]').each(function () {
                const match = this.name.match(/ob_attr_TO_(\d+)/); // Match attribute ID for TO
                if (match) {
                    const attrId = match[1];

                    // Get Balance Forward value (BF), default to 0 if missing
                    const bfValue = parseFloat($(`#${modalId} input[name="ap_attr_BF_${attrId}"]`).val()) || 0;

                    // Get Transfer Out value (TO), default to 0 if missing
                    const toValue = parseFloat($(`#${modalId} input[name="ob_attr_TO_${attrId}"]`).val()) || 0;

                    // Calculate Appropriations Balance (AB)
                    const appropriationBalance = (bfValue - toValue).toFixed(2);

                    // Set the calculated balance in the AB field
                    $(`#${modalId} input[name="ob_attr_AB_${attrId}"]`).val(appropriationBalance);
                }
            });
        });
    }



            function calculateRowTotals(modalId) {
                let apGrandTotal = 0;
                $(`#${modalId} .ap-data-row`).each(function() {
                    let rowTotal = 0;
                    $(this).find('input[type="number"]').not('[name="ap_total[]"]').each(function() {
                        rowTotal += parseFloat(this.value) || 0;
                    });
                    $(this).find('input[name="ap_total[]"]').val(rowTotal.toFixed(2));
                    apGrandTotal += rowTotal;
                });
                $(`#${modalId} input[name="ap_total_TA"]`).val(apGrandTotal.toFixed(2));
                $(`#${modalId} input[name="ap_total_BF"]`).val(apGrandTotal.toFixed(2));

                let obGrandTotal = 0;
                $(`#${modalId} .ob-data-row`).each(function() {
                    let rowTotal = 0;
                    $(this).find('input[type="number"]').not('[name="ob_total[]"]').each(function() {
                        rowTotal += parseFloat(this.value) || 0;
                    });
                    $(this).find('input[name="ob_total[]"]').val(rowTotal.toFixed(2));
                    obGrandTotal += rowTotal;
                });

                $(`#${modalId} input[name="ob_total_TO"]`).val(obGrandTotal.toFixed(2));
                $(`#${modalId} input[name="ob_total_OB"]`).val(obGrandTotal.toFixed(2));
            }

            function calculateGrandTotal(modalId) {
                const apTotal = parseFloat($(`#${modalId} input[name="ap_total_TA"]`).val()) || 0;
                const obTotal = parseFloat($(`#${modalId} input[name="ob_total_TO"]`).val()) || 0;
                $(`#${modalId} input[name="ob_total_AB"]`).val((apTotal - obTotal).toFixed(2));
            }

            function calculateTotals(modalId) {
                calculateRowTotals(modalId);
                calculateAttributeTotals(modalId);
                calculateGrandTotal(modalId);
            }

            function resetModal(modalId) {
                const apDataRowContainer = document.querySelector(`#${modalId} .inp-group-ap-data-row`);
                const obDataRowContainer = document.querySelector(`#${modalId} .inp-group-ob-data-row`);
                apDataRowContainer.innerHTML = '';
                obDataRowContainer.innerHTML = '';
                apCounter = 1;
                obCounter = 1;
                modalInitialized = false;
                apTotalsInitialized = false;
                obTotalsInitialized = false;
            }

            $(`#${modalId}`).on('click', '.add-row-ap, .add-row-ob', function() {
                requestAnimationFrame(() => calculateTotals(modalId));
            });

            $(`#${modalId}`).on('shown.bs.modal', () => calculateTotals(modalId));
            
            $(`#${modalId}`).on('show.bs.modal', function() {
                if (!modalInitialized) {
                    console.log(`${modalId} is initialized`);
                    modalInitialized = true;
                }
            });

            $(`#${modalId}`).on('hidden.bs.modal', () => resetModal(modalId));
        });
    }

    // Initialize both modals
    initializeModal('exampleModal');
    initializeModal('addUserModal');
    initializeModal('viewDataModal');
})();
</script>

</html>
