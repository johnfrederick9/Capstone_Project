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
  width: 100%; /* Make the dropdown list the same width as the label */
  border: 1px solid #ccc;
  background-color: white;
  padding: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 10;
  box-sizing: border-box; /* Ensure padding doesn’t affect width */
  height: 500px;
  width: 300px;
  overflow-x: auto;
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
                            <h1>Records of Appropriations and Obligations (RAO-SK)</h1>
                        </div>
                        <div class="table-actions">    
                        <div class="dropdown table_dropdown">
                        <button class="dropdown-toggle">Other RAO Sources</button>
                            <ul class="dropdown-menu">
                                <li><a href="../../pages/rao/table_rao_records.php">RAO-PS</a></li>
                                <li><a href="../../pages/rao-cont/table_rao_cont_records.php">RAO-CONT</a></li>
                                <li><a href="../../pages/rao-fe/table_rao_fe_records.php">RAO-FE</a></li>
                                <li><a href="../../pages/rao-mooe/table_rao_mooe_records.php">RAO-MOOE</a></li>
                                <li><a href="../../pages/rao-bdrrmf/table_rao_bdrrmf_records.php">RAO-BDRRMF</a></li>
                                <li><a href="../../pages/rao-dev/table_rao_dev_records.php">RAO-DEV</a></li>
                                <li><a href="../../pages/rao-co/table_rao_co_cont_records.php">RAO-CO</a></li>
                                <li><a href="../../pages/co-cont/table_rao_cocont_records.php">RAO-CO-CONT</a></li>
                            </ul>
                        </div>  
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#AttributeModal" class="add-table-btn">+ Add Record</button>
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

                        //FOR EDIT
                        $('#example').on('click', '.editbtn', function (event) {
                            var table = $('#example').DataTable();
                            var trid = $(this).closest('tr').attr('id');
                            var rao_sk_id = $(this).data('id');
                            console.log(trid);

                            // Store data in modal for reference
                            $('#updateUser').data('rao_sk_id', rao_sk_id);
                            $('#updateUser').data('trid', trid);

                            // Show modal and set rao_sk_id value
                            $('#exampleModal').modal('show');
                            console.log("Rao sk ID:", rao_sk_id);
                            $('#exampleModal #rao_sk_id').val(rao_sk_id);
                            $('#exampleModal #trid').val(trid);

                            $('#exampleModal .inp-group-ap-data-row').empty(); 
                            $('#exampleModal .inp-group-ob-data-row').empty(); // Empty previous rows

                            // AJAX request to fetch data
                            $.ajax({
                                url: "get_single_data.php",
                                data: { rao_sk_id: rao_sk_id },
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

                                            // Check and set conditions for period_covered
                                            if (period_covered === "0000-00-00") {
                                                period_covered = ""; // Set to empty if it matches the placeholder value
                                            }


                                            $('#exampleModal #chairman_name').val(chairman);
                                            $('#exampleModal #period_covered').val(period_covered);
                                            $('#exampleModal #brgy_captain').val(brgy_captain);

                                            // Validate that attributeList is an array
                                            if (Array.isArray(attributeList)) {
                                                var dynamicHeadRow = $('#exampleModal #dynamic-heads');

                                                // Ensure the dynamic-heads element exists
                                                if (dynamicHeadRow.length) {
                                                    // Clear existing headers
                                                    dynamicHeadRow.empty();
                                                    dynamicHeadRow.append('<th class="stick-head">Date</th>');
                                                    dynamicHeadRow.append('<th class="stick-head">Reference No</th>');
                                                    attributeList.forEach(function (attr) {
                                                        dynamicHeadRow.append('<th class="dynamic-head">' + attr + '</th>');
                                                    });
                                                    dynamicHeadRow.append('<th rowspan="2" class="action-head">Actions</th>');
                                                } else {
                                                    console.error("#dynamic-heads element not found in the modal.");
                                                }
                                            } else {
                                                console.error("attribute_name is not an array:", attributeList);
                                            }

                                        function createDynamicRow(type, dataKey, dataContainerKey, dataPrefix) {
                                            if (json[dataKey] && Array.isArray(json[dataKey]) && json[dataKey].length > 0) {
                                                json[dataKey].forEach(function (item) {
                                                    let row = `
                                                    <tr class="${type}-data-row">
                                                        <td><input type="date" name="${type}_date_data[]" value="${item[`${type}_ref_date`] || ''}" required></td>
                                                        <td><input type="text" name="${type}_reference_no[]" value="${item[`${type}_ref_no`] || ''}"></td>
                                                        <td><input type="text" name="${type}_particulars[]" value="${item[`${type}_particulars`] || ''}"></td>
                                                        <td class="total-data"><input type="number" name="${type}_total[]" value="${item[`${type}_totals`] || ''}"></td>
                                                        <td class="hidden"><input type="hidden" name="rao_sk_${type}_id" value="${item[`rao_sk_${type}_id`] || ''}"></td>
                                                    `;

                                                    // Handle related data (like attributes) if present
                                                    if (json[`${dataKey}_data`] && Array.isArray(json[`${dataKey}_data`])) {
                                                        const relatedData = json[`${dataKey}_data`].filter(function (data) {
                                                            return data[`rao_sk_${type}_id`] === item[`rao_sk_${type}_id`];
                                                        });

                                                        relatedData.forEach(function (data) {
                                                            const attrId = data[`rao_sk_att_id`];
                                                            row += `<td><input type="number" name="${type}_attr_${attrId}[]" value="${data.attribute_value || ''}" step="0.01"></td>`;
                                                        });
                                                    }

                                                    row += `
                                                    <td class="action-data">
                                                        <!-- Optional: Add action buttons like delete -->
                                                    </td>
                                                    </tr>
                                                    `;
                                                    $(`#exampleModal .${dataContainerKey}`).append(row);
                                                });
                                            }
                                        }

                                        // Call the function for AP data
                                        createDynamicRow('ap', 'rao_sk_ap', 'inp-group-ap-data-row', 'ap');

                                        // Call the function for OB data
                                        createDynamicRow('ob', 'rao_sk_ob', 'inp-group-ob-data-row', 'ob');

                                            const rowConfigs = {
                                                ap: [
                                                    {
                                                        selector: `#exampleModal .inp-group-ap-totals.TA .totals-row`,
                                                        label: 'Total Appropriations',
                                                        identifier: 'TA',
                                                        includeTotal: true
                                                    },
                                                    {
                                                        selector: `#exampleModal .inp-group-ap-totals.BF .totals-row`,
                                                        label: 'Balance Forwarded',
                                                        identifier: 'BF',
                                                        includeTotal: true
                                                    }
                                                ],
                                                ob: [
                                                    {
                                                        selector: `#exampleModal .inp-group-ob-totals.TO .totals-row`,
                                                        label: 'Total Obligations',
                                                        identifier: 'TO',
                                                        includeTotal: true
                                                    },
                                                    {
                                                        selector: `#exampleModal .inp-group-ob-totals.OB .totals-row`,
                                                        label: 'Obligations Balance To Date',
                                                        identifier: 'OB',
                                                        includeTotal: true
                                                    },
                                                    {
                                                        selector: `#exampleModal .inp-group-ob-totals.AB .totals-row`,
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
                                                    let attrId = json.rao_sk_ap_data.find(apData => apData.attribute_name === attr)?.rao_sk_att_id;

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


                                                const actionTd = document.createElement('td');
                                                actionTd.classList.add('action-data');
                                                totalRow.appendChild(actionTd);
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
                                                    let attrId = json.rao_sk_ob_data.find(obData => obData.attribute_name === attr)?.rao_sk_att_id;

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

                                                const actionTd = document.createElement('td');
                                                actionTd.classList.add('action-data');
                                                totalRow.appendChild(actionTd);
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
                                    alert('Error fetching data. Please try again.');
                                }
                            });

                            // Optional: Reset counters or clear modal when it's hidden
                            $('#exampleModal').on('hidden.bs.modal', function () {
                                // Your reset logic here
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
                            var rao_sk_id = $(this).data('item_id');

                            // Store data in modal for reference
                            $('#updateUser').data('rao_sk_id', rao_sk_id);
                            $('#updateUser').data('trid', trid);

                            // Show modal and set rao_sk_id value
                            $('#viewDataModal').modal('show');
                            console.log("Rao sk ID:", rao_sk_id);
                            $('#viewDataModal #rao_sk_id').val(rao_sk_id);

                            $('#viewDataModal .inp-group-ap-data-row').empty(); 
                            $('#viewDataModal .inp-group-ob-data-row').empty(); // Empty previous rows

                            // AJAX request to fetch data
                            $.ajax({
                                url: "get_single_data.php",
                                data: { rao_sk_id: rao_sk_id },
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

                                           // Process dynamic data in rao_sk_ap
                                            if (json.rao_sk_ap && Array.isArray(json.rao_sk_ap) && json.rao_sk_ap.length > 0) {
                                                json.rao_sk_ap.forEach(function (apItem) {
                                                    let apRow = `
                                                    <tr class="ap-data-row">
                                                        <td><input type="date" name="ap_date_data[]" value="${apItem.ap_ref_date || ''}" disabled></td>
                                                        <td><input type="text" name="ap_reference_no[]" value="${apItem.ap_ref_no || ''}" disabled></td>
                                                        <td><input type="text" name="ap_particulars[]" value="${apItem.ap_particulars || ''}" disabled></td>
                                                        <td class="total-data"><input type="number" name="ap_total[]" value="${apItem.ap_totals || ''}" disabled></td>
                                                        <td class="hidden"><input type="hidden" name="rao_sk_ap_id" value="${apItem.rao_sk_ap_id || ''}" disabled></td>
                                                    `;

                                                    // Filter the associated ap_sk_ap_data based on rao_sk_ap_id
                                                    if (json.rao_sk_ap_data && Array.isArray(json.rao_sk_ap_data)) {
                                                        const relatedApData = json.rao_sk_ap_data.filter(function (apData) {
                                                            return apData.rao_sk_ap_id === apItem.rao_sk_ap_id;
                                                        });

                                                        if (relatedApData.length > 0) {
                                                            relatedApData.forEach(function (apData) {
                                                                const attrId = apData.rao_sk_att_id;  // Get the attribute ID

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
                                                    <td class="hidden"><input type="hidden" name="rao_sk_ap_id" value="" disabled></td>
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
                                             if (json.rao_sk_ob && Array.isArray(json.rao_sk_ob) && json.rao_sk_ob.length > 0) {
                                                json.rao_sk_ob.forEach(function (obItem) {
                                                    let obRow = `
                                                    <tr class="ob-data-row">
                                                        <td><input type="date" name="ob_date_data[]" value="${obItem.ob_ref_date || ''}" disabled></td>
                                                        <td><input type="text" name="ob_reference_no[]" value="${obItem.ob_ref_no || ''}" disabled></td>
                                                        <td><input type="text" name="ob_particulars[]" value="${obItem.ob_particulars || ''}" disabled></td>
                                                        <td class="total-data"><input type="number" name="ob_total[]" value="${obItem.ob_totals || ''}" disabled></td>
                                                        <td class="hidden"><input type="hidden" name="rao_sk_ob_id" value="${obItem.rao_sk_ob_id || ''}" disabled></td>
                                                    `;

                                                    // Filter the associated ob_sk_ob_data based on rao_sk_ob_id
                                                    if (json.rao_sk_ob_data && Array.isArray(json.rao_sk_ob_data)) {
                                                        const relatedObData = json.rao_sk_ob_data.filter(function (obData) {
                                                            return obData.rao_sk_ob_id === obItem.rao_sk_ob_id;
                                                        });

                                                        if (relatedObData.length > 0) {
                                                            relatedObData.forEach(function (obData) {
                                                                const attrId = obData.rao_sk_att_id;  // Get the attribute ID

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
                                                // If no `rao_sk_ob` data exists, create an empty row
                                                let emptyRow = `
                                                <tr class="ob-data-row">
                                                    <td><input type="date" name="ob_date_data[]" value="" disabled></td>
                                                    <td><input type="text" name="ob_reference_no[]" value="" disabled></td>
                                                    <td><input type="text" name="ob_particulars[]" value="" disabled></td>
                                                    <td class="total-data"><input type="number" name="ob_total[]" value="" disabled></td>
                                                    <td class="hidden"><input type="hidden" name="rao_sk_ob_id" value="" disabled></td>
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
                                                    let attrId = json.rao_sk_ap_data.find(apData => apData.attribute_name === attr)?.rao_sk_att_id;

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
                                                    let attrId = json.rao_sk_ob_data.find(obData => obData.attribute_name === attr)?.rao_sk_att_id;

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
                                    alert('Error fetching data. Please try again.');
                                }
                            });

                            // Optional: Reset counters or clear modal when it's hidden
                            $('#viewDataModal').on('hidden.bs.modal', function () {
                                // Your reset logic here
                            });
                        });

                        //FOR DELETE
                      $(document).on('click', '.deleteBtn', function(event) {
                        event.preventDefault();
                        var rao_sk_id = $(this).data('rao_id'); // Get ID from data attribute
                        var table = $('#example').DataTable();

                        // Open the modal
                        $('#deleteConfirmationModal').modal('show');

                        // Handle the confirmation
                        $('#confirmDeleteBtn').off('click').on('click', function() {
                        $.ajax({
                            url: "delete.php",
                            type: "POST",
                            data: { rao_sk_id: rao_sk_id },
                            success: function(response) {
                            var json = JSON.parse(response);
                            if (json.status === 'success') {
                                // Remove the row from DataTable
                                table.row($(event.target).closest('tr')).remove().draw();
                            } else {
                                alert('Deletion failed');
                            }
                            // Close the modal
                            $('#deleteConfirmationModal').modal('hide');
                            }
                        });
                        });
                    });
                       
                        /////Dynamic Attributes
                        $(document).on('submit', '#attributeForm', function(e) {
                            e.preventDefault();

                            // Collect attribute names and counters from the dynamic rows
                            var attr_counter = $('input[name="attr_counter[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var attribute_name = $('input[name="attribute_name[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            // Prepare the form data
                            var formData = new FormData();
                            
                            // Adding the arrays into FormData (you should replace with actual values if needed)
                            formData.append('attr_counter', JSON.stringify(attr_counter)); // Collect all attribute counters
                            formData.append('attribute_name', JSON.stringify(attribute_name)); // Collect all attribute names

                            // Validation check (optional)
                            if (attribute_name.length > 0 && !attribute_name.includes("")) {
                                $.ajax({
                                    url: "add_attribute.php",
                                    type: "POST",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        console.log("Raw response data:", data);
                                        var json = JSON.parse(data);
                                        console.log("Response:", json);
                                        
                                        var status = json.status;
                                        
                                        if (status == 'true') {
                                        // Fetch rao_sk_id from the response
                                        var rao_sk_id = json.rao_sk_id;

                                        // Hide the AttributeModal
                                        $('#AttributeModal').modal('hide');
                                        alert('Attributes added successfully!');

                                        // Set the rao_sk_id in the addUserModal's input field
                                        $('#addUserModal #rao_sk_id').val(rao_sk_id);

                                        // Update dynamic headers in the table
                                        var attributeList = json.attribute_name; // Assuming attribute_name is an array of attribute names
                                        var dynamicHeadRow = $('#addUserModal #dynamic-heads');

                                        // Clear any existing dynamic headers before appending
                                        dynamicHeadRow.empty();

                                        // Append static headers for Date and Reference No
                                        dynamicHeadRow.append('<th class="stick-head">Date</th>');
                                        dynamicHeadRow.append('<th class="stick-head">Reference No</th>');

                                        // Add new headers based on attributeList
                                        attributeList.forEach(function(attr) {
                                            dynamicHeadRow.append('<th class="dynamic-head">' + attr + '</th>');
                                        });

                                        // Add the fixed action column header
                                        dynamicHeadRow.append('<th rowspan="2" class="action-head">Actions</th>');

                                        // Show the addUserModal
                                        $('#addUserModal').modal('show');

                                        } else {
                                            alert('Update failed: ' + json.error || 'Unknown error');
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log("AJAX error:", textStatus, errorThrown);
                                        alert('An error occurred while submitting the data.');
                                    }
                                });
                            } else {
                                alert('Please fill in all the required fields.');
                            }
                        });

                        //FOR UPDATE Attribute
                        $(document).on('submit', '#updateAttributeForm', function (e) {
                            e.preventDefault();

                            const modal = $(this).closest('.modal');
                            const modalId = modal.attr('id');
                            const sourceModal = modal.data('source-modal');

                            let rao_sk_id = $('#UpdateAttributeModal #rao_sk_id').val();
                            let visibleModal = null;
                            
                            if (!rao_sk_id) {
                                ['#addUserModal', '#exampleModal'].forEach((modalSelector) => {
                                    if ($(modalSelector).is(':visible')) {
                                        rao_sk_id = $(`${modalSelector} #rao_sk_id`).val();
                                        visibleModal = modalSelector;
                                    }
                                });
                            }

                            if (visibleModal) {
                                console.log(`Visible Modal: ${visibleModal}`);
                            } else {
                                console.log('No modal is visible.');
                            }

                            console.log("rao_sk_id:", rao_sk_id);

                            if (!rao_sk_id) {
                                alert('Error: RAO sk ID is missing.');
                                return;
                            }

                            const rows = modal.find('.column-lists tr');
                            const formData = new FormData();
                            const attributeData = [];

                            rows.each(function() {
                                const row = $(this);
                                const rao_sk_att_id = row.find('input[name="rao_sk_att_id[]"]').val();
                                const column_name = row.find('input[name="column_name[]"]').val().trim();
                                
                                if (column_name === "") {
                                    alert('Error: Please fill in all the required fields.');
                                    return false;
                                }

                                attributeData.push({
                                    rao_sk_att_id: rao_sk_att_id || '',
                                    column_name: column_name
                                });
                            });

                            console.log("Attribute Data:", attributeData);

                            for (let pair of formData.entries()) {
                                console.log(pair[0] + ': ' + pair[1]);
                            }

                            console.log("Form Data Structure:", {
                                rao_sk_id: rao_sk_id,
                                rao_sk_att_id: attributeData.map(item => item.rao_sk_att_id),
                                column_name: attributeData.map(item => item.column_name)
                            });

                            formData.append('rao_sk_id', rao_sk_id);
                            formData.append('rao_sk_att_id', JSON.stringify(attributeData.map(item => item.rao_sk_att_id)));
                            formData.append('column_name', JSON.stringify(attributeData.map(item => item.column_name)));

                            $.ajax({
                                url: "update_attribute.php",
                                type: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (data) {
                                    console.log("Raw response data:", data);
                                    try {
                                        const json = JSON.parse(data);
                                        console.log("Response:", json);
                                        const att_ids_to_remove = json.att_ids_to_remove || [];
                                        const att_names_to_remove = json.att_names_to_remove || [];

                                        if (json.status === 'true') {
                                            modal.modal('hide');
                                            alert('Attributes updated successfully!');

                                            // Target all elements with id dynamic-heads
                                            const dynamicHeadRows = $('[id="dynamic-heads"]');


                                        ///////////////////////Renamed/////////////////////////////////
                                        if (json.updated_attributes && json.updated_attributes.length > 0) {
                                            console.log("Updated attributes:", json.updated_attributes);

                                            // Assuming dynamicHeadRows is the collection of header rows in your table
                                            dynamicHeadRows.each(function() {
                                                const currentRow = $(this);
                                                const dynamicHeads = currentRow.find('th.dynamic-head');

                                                // Loop through each dynamic head and update its text
                                                dynamicHeads.each(function(index) {
                                                    // Update the text of the dynamic-head th element based on the updated_attributes array
                                                    if (json.updated_attributes[index]) {
                                                        $(this).text(json.updated_attributes[index]);
                                                    }
                                                });

                                                // Add an "Actions" column header if it doesn't already exist
                                                if (currentRow.find('th.action-head').length === 0) {
                                                    currentRow.append('<th rowspan="2" class="action-head">Actions</th>');
                                                }
                                            });
                                        }



                                        ///////////////////////////Restoration////////////////////////#
                                        if (json.restored_attributes && json.restored_attributes.length > 0) {
                                            console.log("restored:", json.restored_attributes);
                                                // Handle headers
                                                dynamicHeadRows.each(function() {
                                                    const currentRow = $(this);
                                                    const actionHead = currentRow.find('th.action-head');

                                                    json.restored_attributes.forEach(function (attr) {
                                                        if (actionHead.length > 0) {
                                                            actionHead.before('<th class="dynamic-head">' + attr.attribute_name + '</th>');
                                                        } else {
                                                            currentRow.append('<th class="dynamic-head">' + attr.attribute_name + '</th>');
                                                        }
                                                    });

                                                    if (currentRow.find('th.action-head').length === 0) {
                                                        currentRow.append('<th rowspan="2" class="action-head">Actions</th>');
                                                    }
                                                });

                                                // Handle ap data rows
                                                $('.inp-group-ap-data-row tr.ap-data-row').each(function() {
                                                    const dataRow = $(this);
                                                    const actionCell = dataRow.find('td.action-data');

                                                    json.restored_attributes.forEach(function(attr) {
                                                        const newCell = `<td>
                                                            <input type="number" name="ap_attr_${attr.rao_sk_att_id}[]" value="" step="0.01">
                                                        </td>`;
                                                        
                                                        actionCell.before(newCell);
                                                    });
                                                });

                                                // Handle ob data rows
                                                $('.inp-group-ob-data-row tr.ob-data-row').each(function() {
                                                    const dataRow = $(this);
                                                    const actionCell = dataRow.find('td.action-data');

                                                    json.restored_attributes.forEach(function(attr) {
                                                        const newCell = `<td>
                                                            <input type="number" name="ob_attr_${attr.rao_sk_att_id}[]" value="" step="0.01">
                                                        </td>`;
                                                        
                                                        actionCell.before(newCell);
                                                    });
                                                });

                                                // Handle all total rows
                                                const totalRowsConfig = [
                                                    { selector: '.inp-group-ap-totals.TA tr.totals-row', type: 'TA', prefix:'ap' },
                                                    { selector: '.inp-group-ap-totals.BF tr.totals-row', type: 'BF', prefix:'ap' },
                                                    { selector: '.inp-group-ob-totals.TO tr.totals-row', type: 'TO', prefix:'ob' },
                                                    { selector: '.inp-group-ob-totals.OB tr.totals-row', type: 'OB', prefix:'ob' },
                                                    { selector: '.inp-group-ob-totals.AB tr.totals-row', type: 'AB', prefix:'ob' }
                                                ];

                                                totalRowsConfig.forEach(config => {
                                                    $(config.selector).each(function() {
                                                        const totalRow = $(this);
                                                        const actionCell = totalRow.find('td.action-data');

                                                        json.restored_attributes.forEach(function(attr) {
                                                            const newCell = `<td>
                                                                <input type="number" name="${config.prefix}_attr_${config.type}_${attr.rao_sk_att_id}" disabled="">
                                                            </td>`;
                                                            actionCell.before(newCell);
                                                        });
                                                    });
                                                });

                                            }
                                             ////////////// New Attributes /////////////////
                                        if (json.new_attributes && json.new_attributes.length > 0) {
                                                // Handle headers
                                                dynamicHeadRows.each(function() {
                                                    const currentRow = $(this);
                                                    const actionHead = currentRow.find('th.action-head');

                                                    json.new_attributes.forEach(function (attr) {
                                                        if (actionHead.length > 0) {
                                                            actionHead.before('<th class="dynamic-head">' + attr.attribute_name + '</th>');
                                                        } else {
                                                            currentRow.append('<th class="dynamic-head">' + attr.attribute_name + '</th>');
                                                        }
                                                    });

                                                    if (currentRow.find('th.action-head').length === 0) {
                                                        currentRow.append('<th rowspan="2" class="action-head">Actions</th>');
                                                    }
                                                });

                                                // Handle ap data rows
                                                $('.inp-group-ap-data-row tr.ap-data-row').each(function() {
                                                    const dataRow = $(this);
                                                    const actionCell = dataRow.find('td.action-data');

                                                    json.new_attributes.forEach(function(attr) {
                                                        const newCell = `<td>
                                                            <input type="number" name="ap_attr_${attr.rao_sk_att_id}[]" value="" step="0.01">
                                                        </td>`;
                                                        
                                                        actionCell.before(newCell);
                                                    });
                                                });

                                                // Handle ob data rows
                                                $('.inp-group-ob-data-row tr.ob-data-row').each(function() {
                                                    const dataRow = $(this);
                                                    const actionCell = dataRow.find('td.action-data');

                                                    json.new_attributes.forEach(function(attr) {
                                                        const newCell = `<td>
                                                            <input type="number" name="ob_attr_${attr.rao_sk_att_id}[]" value="" step="0.01">
                                                        </td>`;
                                                        
                                                        actionCell.before(newCell);
                                                    });
                                                });

                                                // Handle all total rows
                                                const totalRowsConfig = [
                                                    { selector: '.inp-group-ap-totals.TA tr.totals-row', type: 'TA', prefix:'ap' },
                                                    { selector: '.inp-group-ap-totals.BF tr.totals-row', type: 'BF', prefix:'ap' },
                                                    { selector: '.inp-group-ob-totals.TO tr.totals-row', type: 'TO', prefix:'ob' },
                                                    { selector: '.inp-group-ob-totals.OB tr.totals-row', type: 'OB', prefix:'ob' },
                                                    { selector: '.inp-group-ob-totals.AB tr.totals-row', type: 'AB', prefix:'ob' }
                                                ];

                                                totalRowsConfig.forEach(config => {
                                                    $(config.selector).each(function() {
                                                        const totalRow = $(this);
                                                        const actionCell = totalRow.find('td.action-data');

                                                        json.new_attributes.forEach(function(attr) {
                                                            const newCell = `<td>
                                                                <input type="number" name="${config.prefix}_attr_${config.type}_${attr.rao_sk_att_id}" disabled="">
                                                            </td>`;
                                                            actionCell.before(newCell);
                                                        });
                                                    });
                                                });

                                            }
                                          ///////////////////////////Remove////////////////////////

                                            // Remove dynamic headers based on attribute names to be removed
                                            if (att_names_to_remove && att_names_to_remove.length > 0) {
                                                    dynamicHeadRows.each(function() {
                                                    const currentRow = $(this);

                                                    // Loop through the names to remove
                                                    att_names_to_remove.forEach(function(attrName) {
                                                        console.log("Processing Attribute to Remove:", attrName);  // Debug: Show the name you're looking to remove
                                                        
                                                        // Find all <th> elements with class "dynamic-head" in the current row
                                                        currentRow.find('th.dynamic-head').each(function() {
                                                            const th = $(this);
                                                            const headerText = th.text().trim();  // Trim to remove extra spaces
                                                            
                                                            console.log("Checking <th> with text:", headerText);  // Debug: Show the current <th> text

                                                            if (headerText === attrName) {
                                                                console.log("Removing <th> with text:", headerText);  // Debug: Confirm match
                                                                th.remove();  // Remove the matching <th> element
                                                            }
                                                        });
                                                    });
                                                });

                                                // Handle ap data rows
                                            $('.inp-group-ap-data-row tr.ap-data-row').each(function() {
                                                console.log("In AP data loop");
                                                const dataRow = $(this);

                                                // Loop through the attribute IDs to remove and check if any match the row's attribute ID
                                                att_ids_to_remove.forEach(function(attr_id_to_remove) {
                                                    console.log("Checking AP data row with attr ID:", attr_id_to_remove);

                                                    // Check if the row contains a matching input field inside a td
                                                    dataRow.find(`td input[name^="ap_attr_${attr_id_to_remove}[]"]`).each(function() {
                                                        // If found, remove the td that contains the input
                                                        $(this).closest('td').remove();
                                                        console.log(`Removed td containing ap_attr_${attr_id_to_remove}[]`);
                                                    });
                                                });
                                            });

                                            // Handle ob data rows
                                            $('.inp-group-ob-data-row tr.ob-data-row').each(function() {
                                                console.log("In OB data loop");
                                                const dataRow = $(this);

                                                // Loop through the attribute IDs to remove and check if any match the row's attribute ID
                                                att_ids_to_remove.forEach(function(attr_id_to_remove) {
                                                    console.log("Checking OB data row with attr ID:", attr_id_to_remove);

                                                    // Check if the row contains a matching input field inside a td
                                                    dataRow.find(`td input[name^="ob_attr_${attr_id_to_remove}[]"]`).each(function() {
                                                        // If found, remove the td that contains the input
                                                        $(this).closest('td').remove();
                                                        console.log(`Removed td containing ob_attr_${attr_id_to_remove}[]`);
                                                    });
                                                });
                                            });


                                            // Handle all total rows
                                            const totalRowsConfig = [
                                                { selector: '.inp-group-ap-totals.TA tr.totals-row', type: 'TA', prefix: 'ap' },
                                                { selector: '.inp-group-ap-totals.BF tr.totals-row', type: 'BF', prefix: 'ap' },
                                                { selector: '.inp-group-ob-totals.TO tr.totals-row', type: 'TO', prefix: 'ob' },
                                                { selector: '.inp-group-ob-totals.OB tr.totals-row', type: 'OB', prefix: 'ob' },
                                                { selector: '.inp-group-ob-totals.AB tr.totals-row', type: 'AB', prefix: 'ob' }
                                            ];

                                            totalRowsConfig.forEach(config => {
                                                $(config.selector).each(function() {
                                                    const totalRow = $(this);

                                                    // Iterate over each attribute and check if it matches the IDs to remove
                                                    att_ids_to_remove.forEach(function(attr_id_to_remove) {
                                                        console.log("Checking total row with attr ID:", attr_id_to_remove);

                                                        // Check if the row contains a matching input field inside a td
                                                        totalRow.find(`td input[name^="${config.prefix}_attr_${config.type}_${attr_id_to_remove}"]`).each(function() {
                                                            // If found, remove the td that contains the input
                                                            $(this).closest('td').remove();
                                                            console.log(`Removed td containing ${config.prefix}_attr_${config.type}_${attr_id_to_remove}`);
                                                        });
                                                    });
                                                });
                                            });

                                            }

                                            

                                            $('#UpdateAttributeModal').modal('hide');
                                        } else {
                                            alert('Update failed: ' + (json.error || 'Unknown error'));
                                        }
                                    } catch (error) {
                                        console.error("Error parsing response:", error);
                                        alert('An error occurred while updating the attributes.');
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log("AJAX error:", textStatus, errorThrown);
                                    alert('An error occurred while updating the attributes.');
                                }
                            });
                        });

                        //FOR ADD
                        $(document).on('submit', '#addUser', function (e) {
                            e.preventDefault();

                            let formData = {
                                rao_sk_id: $('#addUserModal #rao_sk_id').val(),
                                period_covered: $('#addUserModal #periodcovered').val(),
                                chairman: $('#addUserModal #chairmanname').val(),
                                brgy_captain: $('#addUserModal #brgycaptain').val(),
                                ap_data: [],
                                ob_data: [],
                                ap_totals: {},
                                ob_totals: {}
                            };

                            // Capture AP rows data
                            $('#addUserModal .inp-group-ap-data-row .ap-data-row').each(function () {
                                let apRowData = {
                                    date: $(this).find('input[name="ap_date_data[]"]').val(),
                                    reference_no: $(this).find('input[name="ap_reference_no[]"]').val(),
                                    particulars: $(this).find('input[name="ap_particulars[]"]').val(),
                                    total: $(this).find('input[name="ap_total[]"]').val(),
                                    attributes: {}
                                };

                                // Capture dynamic cells for AP
                                $(this).find('input[name^="ap_attr_"]').each(function () {
                                    let attributeName = $(this).attr('name');
                                    let attributeId = attributeName.match(/ap_attr_(\d+)/)?.[1];
                                    let attributeValue = $(this).val();
                                    
                                    if (attributeId) {
                                        apRowData.attributes[attributeId] = attributeValue;
                                    }
                                });

                                formData.ap_data.push(apRowData);
                            });

                            // Capture OB rows data
                            $('#addUserModal .inp-group-ob-data-row .ob-data-row').each(function () {
                                let obRowData = {
                                    date: $(this).find('input[name="ob_date_data[]"]').val(),
                                    reference_no: $(this).find('input[name="ob_reference_no[]"]').val(),
                                    particulars: $(this).find('input[name="ob_particulars[]"]').val(),
                                    total: $(this).find('input[name="ob_total[]"]').val(),
                                    attributes: {}
                                };

                                // Capture dynamic cells for OB
                                $(this).find('input[name^="ob_attr_"]').each(function () {
                                    let attributeName = $(this).attr('name');
                                    let attributeId = attributeName.match(/ob_attr_(\d+)/)?.[1];
                                    let attributeValue = $(this).val();
                                    
                                    if (attributeId) {
                                        obRowData.attributes[attributeId] = attributeValue;
                                    }
                                });

                                formData.ob_data.push(obRowData);
                            });

                            // Capture AP total rows
                            $('#addUserModal .inp-group-ap-totals .totals-row').each(function () {
                                let totalName = $(this).find('input[name^="ap_total_"]').attr('name');
                                let totalValue = $(this).find('input[name^="ap_total_"]').val();
                                
                                if (totalName) {
                                    formData.ap_totals[totalName] = totalValue;
                                }

                                // Capture dynamic attribute cells for totals
                                $(this).find('input[name^="ap_attr_"]').each(function () {
                                    let attributeName = $(this).attr('name');
                                    let match = attributeName.match(/ap_attr_([A-Z]+)_(\d+)/);
                                    
                                    if (match) {
                                        let identifier = match[1];
                                        let attrId = match[2];
                                        let attributeValue = $(this).val();
                                        
                                        if (!formData.ap_totals[identifier]) {
                                            formData.ap_totals[identifier] = {};
                                        }
                                        formData.ap_totals[identifier][attrId] = attributeValue;
                                    }
                                });
                            });

                            // Capture OB total rows
                            $('#addUserModal .inp-group-ob-totals .totals-row').each(function () {
                                let totalName = $(this).find('input[name^="ob_total_"]').attr('name');
                                let totalValue = $(this).find('input[name^="ob_total_"]').val();
                                
                                if (totalName) {
                                    formData.ob_totals[totalName] = totalValue;
                                }

                                // Capture dynamic attribute cells for totals
                                $(this).find('input[name^="ob_attr_"]').each(function () {
                                    let attributeName = $(this).attr('name');
                                    let match = attributeName.match(/ob_attr_([A-Z]+)_(\d+)/);
                                    
                                    if (match) {
                                        let identifier = match[1];
                                        let attrId = match[2];
                                        let attributeValue = $(this).val();
                                        
                                        if (!formData.ob_totals[identifier]) {
                                            formData.ob_totals[identifier] = {};
                                        }
                                        formData.ob_totals[identifier][attrId] = attributeValue;
                                    }
                                });
                            });

                            console.log("Form data being sent:", formData);

                            // Send the data to the server
                            $.ajax({
                                url: 'add.php',
                                type: 'POST',
                                data: formData,
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status === 'true') {
                                        alert('Data saved successfully!');
                                        $('#addUserModal').modal('hide');
                                    } else {
                                        alert('Error saving data: ' + response.error);
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.error('AJAX Error: ' + textStatus, errorThrown);
                                    console.error('Response: ' + jqXHR.responseText);
                                    alert('Error: ' + errorThrown);
                                }
                            });
                        });

                        //FOR UPDATE
                        $(document).on('submit', '#updateUser', function(e) {
                            e.preventDefault();

                            var trid =  $('#exampleModal #trid').val()

                            let formData = {
                                rao_sk_id: $('#exampleModal #rao_sk_id').val(),
                                period_covered: $('#exampleModal #period_covered').val(),
                                chairman: $('#exampleModal #chairman_name').val(),
                                brgy_captain: $('#exampleModal #brgy_captain').val(),
                                ap_data: [],
                                ob_data: [],
                                ap_totals: {},
                                ob_totals: {},
                                trid: $('#exampleModal #trid').val()
                            };

                            // AP rows with row IDs
                            $('#exampleModal .inp-group-ap-data-row .ap-data-row').each(function () {
                                let apRowData = {
                                    rao_sk_ap_id: $(this).find('input[name="rao_sk_ap_id"]').val(),
                                    date: $(this).find('input[name="ap_date_data[]"]').val(),
                                    reference_no: $(this).find('input[name="ap_reference_no[]"]').val(),
                                    particulars: $(this).find('input[name="ap_particulars[]"]').val(),
                                    total: $(this).find('input[name="ap_total[]"]').val(),
                                    attributes: {}
                                };

                                $(this).find('input[name^="ap_attr_"]').each(function () {
                                    let attributeName = $(this).attr('name');
                                    let attributeId = attributeName.match(/ap_attr_(\d+)/)?.[1];
                                    let attributeValue = $(this).val();
                                    
                                    if (attributeId) {
                                        apRowData.attributes[attributeId] = attributeValue;
                                    }
                                });

                                formData.ap_data.push(apRowData);
                            });

                            // OB rows with row IDs
                            $('#exampleModal .inp-group-ob-data-row .ob-data-row').each(function () {
                                let obRowData = {
                                    rao_sk_ob_id: $(this).find('input[name="rao_sk_ob_id"]').val(),
                                    date: $(this).find('input[name="ob_date_data[]"]').val(),
                                    reference_no: $(this).find('input[name="ob_reference_no[]"]').val(),
                                    particulars: $(this).find('input[name="ob_particulars[]"]').val(),
                                    total: $(this).find('input[name="ob_total[]"]').val(),
                                    attributes: {}
                                };

                                $(this).find('input[name^="ob_attr_"]').each(function () {
                                    let attributeName = $(this).attr('name');
                                    let attributeId = attributeName.match(/ob_attr_(\d+)/)?.[1];
                                    let attributeValue = $(this).val();
                                    
                                    if (attributeId) {
                                        obRowData.attributes[attributeId] = attributeValue;
                                    }
                                });

                                formData.ob_data.push(obRowData);
                            });

                            // AP totals using rao_sk_id
                            $('#exampleModal .inp-group-ap-totals .totals-row').each(function () {
                                let totalName = $(this).find('input[name^="ap_total_"]').attr('name');
                                let totalValue = $(this).find('input[name^="ap_total_"]').val();
                                
                                if (totalName) {
                                    formData.ap_totals[totalName] = totalValue;
                                }

                                $(this).find('input[name^="ap_attr_"]').each(function () {
                                    let attributeName = $(this).attr('name');
                                    let match = attributeName.match(/ap_attr_([A-Z]+)_(\d+)/);
                                    
                                    if (match) {
                                        let identifier = match[1];
                                        let attrId = match[2];
                                        let attributeValue = $(this).val();
                                        
                                        if (!formData.ap_totals[identifier]) {
                                            formData.ap_totals[identifier] = {};
                                        }
                                        formData.ap_totals[identifier][attrId] = attributeValue;
                                    }
                                });
                            });

                            // OB totals using rao_sk_id
                            $('#exampleModal .inp-group-ob-totals .totals-row').each(function () {
                                let totalName = $(this).find('input[name^="ob_total_"]').attr('name');
                                let totalValue = $(this).find('input[name^="ob_total_"]').val();
                                
                                if (totalName) {
                                    formData.ob_totals[totalName] = totalValue;
                                }

                                $(this).find('input[name^="ob_attr_"]').each(function () {
                                    let attributeName = $(this).attr('name');
                                    let match = attributeName.match(/ob_attr_([A-Z]+)_(\d+)/);
                                    
                                    if (match) {
                                        let identifier = match[1];
                                        let attrId = match[2];
                                        let attributeValue = $(this).val();
                                        
                                        if (!formData.ob_totals[identifier]) {
                                            formData.ob_totals[identifier] = {};
                                        }
                                        formData.ob_totals[identifier][attrId] = attributeValue;
                                    }
                                });
                            });

                            console.log("Form data being sent:", formData);

                            $.ajax({
                                url: 'update.php',
                                type: 'POST',
                                data: formData,
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status === 'true') {

                                        var period_covered = response.period_covered;
                                        var chairman = response.chairman;
                                        var brgy_captain = response.brgy_captain;
                                        
                                        console.log("TRID:",trid );

                                        var table = $('#example').DataTable();
                                        var button = `
                                                <td>
                                                    <div class="buttons">
                                                        <a href="javascript:void(0);" data-id="${rao_sk_id}" class="update-btn btn-sm editbtn">
                                                            <i class="bx bx-sync"></i>
                                                        </a>  
                                                        <a href="!#;" data-rao_id="${rao_sk_id}" class="delete-btn btn-sm deleteBtn">
                                                            <i class="bx bxs-trash"></i>
                                                        </a>
                                                        <a href="!#;" data-item-id="${rao_sk_id}" class="update-btn btn-sm infoBtn">
                                                            <i class="bx bx-info-circle"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            `;


                                            var row = table.row("[id='" + trid + "']");
                                            row.data([trid,period_covered, chairman, brgy_captain, button]).draw();

                                            // Close the modal
                                            $('#exampleModal').modal('hide');
                                    } else {
                                        alert('Error saving data: ' + response.error);
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.error('AJAX Error:', textStatus, errorThrown);
                                    console.error('Response:', jqXHR.responseText);
                                    alert('Error: ' + errorThrown);
                                }
                            });
                        });

                        $(document).on('click', '#print-btn', function() {
                        var rao_sk_id = $('#viewDataModal #rao_sk_id').val(); // Get the ID from hidden input
                        console.log("Print", rao_sk_id); //

                        $.ajax({
                            url: 'print-handler.php',
                            type: 'POST',
                            data: { rao_sk_id: rao_sk_id },
                            success: function(response) {
                                var printWindow = window.open('', '', 'height=600,width=800');
                                printWindow.document.write(response);
                                printWindow.document.close();

                                var images = printWindow.document.images;
                                var totalImages = images.length;
                                var loadedImages = 0;

                                if (totalImages === 0) {
                                    printWindow.focus();
                                    printWindow.print();
                                    //printWindow.close();
                                } else {
                                    for (var i = 0; i < totalImages; i++) {
                                        images[i].onload = images[i].onerror = function() {
                                            loadedImages++;
                                            if (loadedImages === totalImages) {
                                                printWindow.focus();
                                                printWindow.print();
                                                printWindow.close();
                                            }
                                        };
                                    }
                                }
                            }
                        });
                    });


                    </script>
                </section><!-- .home-->
                <!-- Modal -->
                <!--ADD ATTRIBUTES-->
                <div class="modal fade" id="AttributeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Column for Report of Appropriations and Obligations (RAO-SK)</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-header">
                            <div class="dropdown" data-control="checkbox-dropdown">
                                <label>List of SK FUNDS: </label>
                                <label class="dropdown-label">Select</label>

                                <div class="dropdown-list">
                                    <a href="#" data-toggle="check-all" class="dropdown-option" id="checkAll">
                                        Check All
                                    </a>
                                    <!-- Container for dynamically populated options -->
                                    <div id="dynamic-options" class="dynamic-options"></div>
                                </div>
                            </div>
                        </div>


                        <div class="modal-body">
                            <form id="attributeForm">
                                <div class="attribute-container">
                                <table id="viewDataTable" class="table-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Column Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="column-lists">
                                        <!--Dynamic Rows For Columns Here-->
                                    </tbody>
                                </table>
                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary add-row">Add Columns</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!--UPDATE ATTRIBUTES-->
            <div class="modal fade" id="UpdateAttributeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Column for Report of Appropriations and Obligations (RAO-SK)</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-header">
                            <div class="dropdown" data-control="checkbox-dropdown">
                                <label>List of SK FUNDS: </label>
                                <label class="dropdown-label" id = "dropdown-label">Select</label>

                                <div class="dropdown-list">
                                    <a href="#" data-toggle="check-all" class="dropdown-option" id="checkAll">
                                        Check All
                                    </a>
                                    <!-- Container for dynamically populated options -->
                                    <div id="dynamic-options"></div>
                                </div>
                            </div>
                        </div>


                        <div class="modal-body">
                            <form id="updateAttributeForm">
                            <input type="hidden" id="rao_sk_id" name="rao_sk_id">
                                <div class="attribute-container">
                                <table id="viewDataTable" class="table-table attribute">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="hidden">ID</th>
                                            <th>Column Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="column-lists">
                                        <!--Dynamic Rows For Columns Here-->
                                    </tbody>
                                </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary add-row">Add Columns</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                <section class="rao">
                <!-- View RAO -->
                <div class="modal fade" id="viewDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Report of Appropriations and Obligations (RAO-SK)</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="rao-container">
                                <!-- Header Section -->
                                <div class="rao-header">
                                    <h1>Report of Appropriations and Obligations (RAO-SK)</h1>
                                    <p id="period_covered" style="text-align: center;"></p>
                                    <input type="hidden" id="rao_sk_id" name="rao_sk_id">
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
                                            <label>Fund Source:</label> <input type="text" value="10% Sangguniang Kabataan Fund"  disabled />
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
                                            <th colspan="5" class="dynamic-stick-head">10% SK FUND</th><!-- Dynamic Heads max 5 -->
                                            
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
                                            <th colspan="5" class="dynamic-stick-head">10% SK FUND</th>

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
                                
                                <div class="cashbook-actions">
                                    <button id="print-btn">Print</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Update RAO -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Report of Appropriations and Obligations (RAO-SK)</h5>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#UpdateAttributeModal" class="add-table-btn">Update Columns</button>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                            <input type="hidden" id="rao_sk_id" name="rao_sk_id">
                            <input type="hidden" id="trid" name="trid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="period_covered">Period Covered:</label>
                                        <input type="date" id="period_covered" name="period_covered" required>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="chairman_name">Chairman on Committee on Appropriations:</label>
                                         <input type="text" id="chairman_name" name="chairman_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brgy_captain">Barangay Captain:</label>
                                            <input type="text" id="brgy_captain" name="brgy_captain" required>
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
                                            <th colspan="5" class="dynamic-stick-head">10% SK FUND</th><!-- Dynamic Heads max 5 -->
                                            
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
                                    <thead class="obligations-head">
                                        <tr>
                                            <th rowspan="2" class="hidden">Counter</th>
                                            <th rowspan="2" class="hidden">ID</th>
                                            <th colspan="2" class="stick-head">Reference For Obligations</th><!-- Date and Ref No -->
                                            <th rowspan="2" class="stick-head">Particulars</th> 
                                            <th rowspan="2" class="stick-head">Totals</th>
                                            <th colspan="5" class="dynamic-stick-head">10% SK FUND</th>

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
                            
                            <div class="modal-footer">
                                <label for="sectionSelector">Select Section:</label>
                                <select id="sectionSelector">
                                    <option value="appropriations">Appropriations</option>
                                    <option value="obligations">Obligations</option>
                                </select>

                                <button class="add-row-ap">+</button>
                                <button class="add-row-ob">+</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add RAO Record -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Report of Appropriations and Obligations (RAO-SK)</h5>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#UpdateAttributeModal" class="add-table-btn">Change Columns</button>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                                <input type="hidden" id="rao_sk_id" name="rao_sk_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="periodcovered">Period Covered:</label>
                                        <input type="date" id="periodcovered" name="period_covered" required>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="chairmanname">Chairman on Committee on Appropriations:</label>
                                         <input type="text" id="chairmanname" name="chairman_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brgycaptain">Barangay Captain:</label>
                                            <input type="text" id="brgycaptain" name="brgy_captain" required>
                                    </div>
                                </div>
                            </div>

                            <div class="rao-table-container">
                                <table id = "viewDataTable" class="rao-table">
                                    <!--Appropriations--->
                                    <thead  class="appropriations-head">
                                        <tr>
                                            <th class="hidden">Counter</th>
                                            <th class="hidden">ID</th>
                                            <th colspan="2" class="stick-head">Reference For Appropriations</th><!-- Date and Ref No -->
                                            <th rowspan="2" class="stick-head">Particulars</th> 
                                            <th rowspan="2" class="stick-head">Totals</th>
                                            <th colspan="5" class="dynamic-stick-head">10% SK FUND</th><!-- Dynamic Heads max 5 -->
                                            
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
                                    <thead class="obligations-head">
                                        <tr>
                                            <th rowspan="2" class="hidden">Counter</th>
                                            <th rowspan="2" class="hidden">ID</th>
                                            <th colspan="2" class="stick-head">Reference For Obligations</th><!-- Date and Ref No -->
                                            <th rowspan="2" class="stick-head">Particulars</th> 
                                            <th rowspan="2" class="stick-head">Totals</th>
                                            <th colspan="5" class="dynamic-stick-head">10% SK FUND</th>

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
                            
                            <div class="modal-footer">
                            <label for="sectionSelector">Select Section:</label>
                                <select id="sectionSelector">
                                    <option value="appropriations">Appropriations</option>
                                    <option value="obligations">Obligations</option>
                                </select>

                                <button class="add-row-ap">+</button>
                                <button class="add-row-ob">+</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </section>
    </body> 


    <script>
document.addEventListener("DOMContentLoaded", () => {
    // Function to apply the behavior only inside modals with IDs #exampleModal and #addUserModal
    const applyModalBehavior = (modal) => {
        // Dropdown to control visibility
        const sectionSelector = modal.querySelector("#sectionSelector");

        // Sections in the table
        const allSections = modal.querySelectorAll(".rao-table thead, .rao-table tbody:not(.inp-group-ob-totals.AB)"); // Exclude AB balance
        const appropriationsSections = modal.querySelectorAll(
            ".rao-table thead.appropriations-head, .rao-table tbody.inp-group-ap-data-row, .rao-table tbody.inp-group-ap-totals"
        );
        const obligationsSections = modal.querySelectorAll(
            ".rao-table thead.obligations-head, .rao-table tbody.inp-group-ob-data-row, .rao-table tbody.inp-group-ob-totals:not(.AB)"
        );
        const appropriationsBalance = modal.querySelector("tbody.inp-group-ob-totals.AB"); // Balance section (always visible)

        // Buttons
        const addRowApButton = modal.querySelector(".add-row-ap");
        const addRowObButton = modal.querySelector(".add-row-ob");

        // Helper function to show/hide sections based on selected option
        const updateVisibility = (selected) => {
            // Hide all sections initially, except for the balance section
            allSections.forEach((section) => (section.style.display = "none"));

            // Hide all buttons initially
            addRowApButton.style.display = "none";
            addRowObButton.style.display = "none";

            // Show the relevant sections and buttons based on selection
            if (selected === "appropriations") {
                appropriationsSections.forEach((section) => (section.style.display = ""));
                addRowApButton.style.display = "inline-block"; // Show add appropriations button
            } else if (selected === "obligations") {
                obligationsSections.forEach((section) => (section.style.display = ""));
                addRowObButton.style.display = "inline-block"; // Show add obligations button
            }

            // Ensure the Appropriations Balance is always visible
            if (appropriationsBalance) {
                appropriationsBalance.style.display = "";
            }

            // Perform validation when the section is changed
            handleValidation(modal);
        };

        // Event listener for dropdown change
        sectionSelector.addEventListener("change", (e) => {
            // Perform validation before switching
            const hasErrors = handleValidation(modal);

            if (!hasErrors) {
                // Only update visibility if no errors are found
                updateVisibility(e.target.value);
            } else {
                // Reset the dropdown to the previous valid state
                e.target.value = e.target.dataset.previousValue || "appropriations";
            }

            // Save the current valid state in a data attribute for reference
            e.target.dataset.previousValue = e.target.value;
        });

        // Initialize with "Appropriations" selected by default
        updateVisibility("appropriations");
    };

    // Apply behavior to specific modals
    const exampleModal = document.querySelector("#exampleModal");
    const addUserModal = document.querySelector("#addUserModal");

    if (exampleModal) {
        applyModalBehavior(exampleModal); // Apply the behavior to #exampleModal
    }

    if (addUserModal) {
        applyModalBehavior(addUserModal); // Apply the behavior to #addUserModal
    }
});

// Example validation function (modified to handle visibility changes)
function handleValidation(modal) {
    // Create flags to track if there are missing fields in appropriations or obligations
    let missingApFields = false;
    let missingObFields = false;

    // Loop through all required fields and categorize them based on the section
    const requiredFields = modal.querySelectorAll("[required]");
    requiredFields.forEach((field) => {
        if (!field.value.trim()) {
            // Check if the field belongs to appropriations or obligations
            const isApField = field.closest(".inp-group-ap-data-row");
            const isObField = field.closest(".inp-group-ob-data-row");

            if (isApField) {
                missingApFields = true; // Set flag if an appropriations field is missing
                console.log("Missing field in Appropriations Row:", field.closest(".ap-data-row"));
            } else if (isObField) {
                missingObFields = true; // Set flag if an obligations field is missing
                console.log("Missing field in Obligations Row:", field.closest(".ob-data-row"));
            }
        }
    });

    // Build the simplified alert message based on missing fields
    let alertMessage = "";

    if (missingApFields) {
        alertMessage += "Missing inputs in Appropriations.\n";
    }

    if (missingObFields) {
        alertMessage += "Missing inputs in Obligations.\n";
    }

    // Display the alert message if there are any missing inputs
    if (alertMessage) {
        alert(alertMessage);
        return true; // Indicate there are errors
    }

    return false; // No errors found
}

// Modified updateVisibility to accept modal as an argument
function updateVisibility(selected, modal) {
    const allSections = modal.querySelectorAll(".rao-table thead, .rao-table tbody:not(.inp-group-ob-totals.AB)");
    const appropriationsSections = modal.querySelectorAll(
        ".rao-table thead.appropriations-head, .rao-table tbody.inp-group-ap-data-row, .rao-table tbody.inp-group-ap-totals"
    );
    const obligationsSections = modal.querySelectorAll(
        ".rao-table thead.obligations-head, .rao-table tbody.inp-group-ob-data-row, .rao-table tbody.inp-group-ob-totals:not(.AB)"
    );
    const appropriationsBalance = modal.querySelector("tbody.inp-group-ob-totals.AB");

    // Hide all sections initially
    allSections.forEach((section) => (section.style.display = "none"));

    // Show the relevant sections based on selection
    if (selected === "appropriations") {
        appropriationsSections.forEach((section) => (section.style.display = ""));
    } else if (selected === "obligations") {
        obligationsSections.forEach((section) => (section.style.display = ""));
    }

    // Ensure the Appropriations Balance is always visible
    if (appropriationsBalance) {
        appropriationsBalance.style.display = "";
    }
}
</script>



    <script>
        //Today's Date Script
        // Set today's date to the input field with id="todayDate"
        document.getElementById('todayDate').value = new Date().toISOString().split('T')[0];
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    let openModals = 0;
    
    // Generic modal stacking logic
    const modals = ['#addUserModal', '#UpdateAttributeModal', '#exampleModal'];
    
    modals.forEach((modalId) => {
        $(modalId).on('show.bs.modal', function () {
            openModals++;
            const zIndex = 1040 + (10 * openModals);
            this.style.zIndex = zIndex;

            setTimeout(() => {
                const backdrop = document.querySelector('.modal-backdrop:last-child');
                if (backdrop) {
                    backdrop.style.zIndex = zIndex - 1;
                }
            });
        });

        $(modalId).on('hidden.bs.modal', function () {
            openModals--;
            if (openModals > 0) {
                document.body.classList.add('modal-open');
            } else {
                document.body.classList.remove('modal-open');
            }
        });
    });
});

</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const updateAttributeModal = document.getElementById('UpdateAttributeModal');
    let modalInitialized = false;
    let attrCounter = 1;

    $('#UpdateAttributeModal').on('show.bs.modal', function () {
        if (!modalInitialized) {
            initializeUpdateAttributeModal();
            modalInitialized = true;
        }
        
    });

    function initializeUpdateAttributeModal() {
        console.log('UpdateAttributeModal initialized');
        attrCounter = document.querySelectorAll("#UpdateAttributeModal .column-lists tr").length + 1;

        const addButton = document.querySelector('#UpdateAttributeModal .modal-footer .add-row');
        if (addButton) {
            addButton.addEventListener('click', addRowHandler);
        }

        fetchData();
    }

    function fetchData() {
        let raoSkId = null;
        ['#addUserModal', '#exampleModal', '#UpdateAttributeModal'].forEach((modalId) => {
            if ($(modalId).is(':visible')) {
                raoSkId = $(`${modalId} #rao_sk_id`).val();
            }
        });

        if (!raoSkId) {
            console.error('No active modal or rao_sk_id not found');
            alert('Unable to fetch the ID. Please ensure the modal is active.');
            return;
        }

        console.log("raoSkId: ", raoSkId);
        
        $(`#UpdateAttributeModal #rao_sk_id`).val(raoSkId);
        const columnLists = document.querySelector("#UpdateAttributeModal .column-lists");

        $.ajax({
            url: "fetch_table_columns.php",
            data: { rao_sk_id: raoSkId},
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // columnLists.innerHTML = '';
                if (response.attributes && response.attributes.length > 0) {
                    response.attributes.forEach((attribute, index) => {
                        addRow({
                            counter: index + 1,
                            rao_sk_att_id: attribute.rao_sk_att_id,
                            name: attribute.attribute_name,
                            has_ap_value: attribute.has_ap_value, // Pass this to addRow
                            has_ob_value: attribute.has_ob_value  // Pass this to addRow
                        });
                    });
                    
                }
                populateDropdown();

            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
                alert('Failed to fetch data. Please try again.');
            }
        });
    }


    function addRowHandler(event) {
        event.preventDefault();
        addRow();
    }

    function addRow(data = null, afterElement = null) {
    const columnLists = document.querySelector("#UpdateAttributeModal .column-lists");
    if (!columnLists) {
        console.error("Column list container not found");
        return;
    }

    const newRow = document.createElement("tr");

    // Determine if the row is created by pressing "Add Row" or from existing data
    const isAddedByUser = data === null;

    const rowData = data || {
        counter: attrCounter,
        name: '',
        rao_sk_att_id: '',
        has_ap_value: false, // Default
        has_ob_value: false  // Default
    };

    // Determine whether to show the delete button
    const showDeleteButton = isAddedByUser || !(rowData.has_ap_value || rowData.has_ob_value);

    newRow.innerHTML = `
        <td>
            <label>${rowData.counter}</label>
            <input type="hidden" name="attr_counter[]" value="${rowData.counter}">
        </td>
        <td class="hidden">
            <input type="hidden" name="rao_sk_att_id[]" value="${rowData.rao_sk_att_id}">
        </td>
        <td>
            <input type="text" name="column_name[]" value="${rowData.name}" required>
        </td>
        <td class="action-buttons">
            ${showDeleteButton ? `<a href="#" class="delete"><i class="bx bx-x"></i></a>` : '<a href="#" class="delete-hidden"><i class="bx bx-x"></i></a>'}
        </td>
    `;

    if (afterElement) {
        afterElement.insertAdjacentElement('afterend', newRow);
    } else {
        columnLists.appendChild(newRow);
    }

    attachRowListeners(newRow);
    attrCounter++;
    updateCounters();
}

    function attachRowListeners(row) {
    const deleteButton = row.querySelector('.delete');
    //const addButton = row.querySelector('.add-row');

    if (deleteButton) {
        deleteButton.onclick = function (event) {
            event.preventDefault();
            if (confirm("Are you sure you want to remove this row?")) {
                row.remove();
                updateCounters();
            }
        };
    }

    // addButton.onclick = function (event) {
    //     event.preventDefault();
    //     addRow(null, row);
    // };
}

    function updateCounters() {
        const rows = document.querySelectorAll("#UpdateAttributeModal #viewDataTable .column-lists tr");
        let counter = 1;

        rows.forEach(row => {
            const label = row.querySelector('label');
            const hiddenInput = row.querySelector('input[name="attr_counter[]"]');

            if (label) label.textContent = counter;
            if (hiddenInput) hiddenInput.value = counter;

            counter++;
        });

        attrCounter = counter;
    }

    function getExistingAttributes() {
        const existingInputs = document.querySelectorAll('#UpdateAttributeModal #viewDataTable .column-lists input[name="column_name[]"]');
        return Array.from(existingInputs).map(input => normalizeAttribute(input.value));
    }


    // Fetch and populate the dropdown with checkboxes
    function populateDropdown() {
    console.log("populateDropdown() is called");

    $.ajax({
        url: 'get_all_attributes.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log("Response received:", response); 
            console.log("get_all_attributes: ",response.attributes);

            const dropdownOptions = $('#UpdateAttributeModal .modal-header #dynamic-options');
            dropdownOptions.empty(); // Clear existing options

            if (response.status === 'true' && Array.isArray(response.attributes)) {
                // Get existing attributes in the modal
                const existingAttributes = getExistingAttributes();

                // Filter out attributes that are already in the modal
                const filteredAttributes = response.attributes.filter(item => {
                    const normalizedItem = normalizeAttribute(item.label);
                    return !existingAttributes.includes(normalizedItem);
                });

                console.log("Existing: ", existingAttributes);
                console.log("Filtered: ", filteredAttributes);

                // Add filtered attributes to the dropdown
                filteredAttributes.forEach(function (item) {
                    dropdownOptions.append(`
                        <label class="dropdown-option">
                            <input type="checkbox" name="dropdown-group" value="${item.value}" class="checkbox-item" />
                            ${item.label}
                        </label>
                    `);
                });
            } else {
                console.error("Invalid response format or no attributes available.");
            }
        },
        error: function (xhr, status, error) {
            console.error('Error fetching attributes:', error);
        }
    });

    // Add listener to append selected checkboxes to the column list when checked
    $('#UpdateAttributeModal').off('change', '#dynamic-options input[type="checkbox"]').on('change', '#dynamic-options input[type="checkbox"]', function () {
        appendCheckedAttributes();
    });
}


    function normalizeAttribute(attribute) {
        return attribute
            .toLowerCase()      // Convert to lowercase
            .replace(/\s+/g, '') // Remove spaces
            .replace(/_/g, '');  // Remove underscores
    }

    function appendCheckedAttributes() {
    const checkboxes = document.querySelectorAll('#dynamic-options input[type="checkbox"]');
    const columnList = document.querySelector('#UpdateAttributeModal .column-lists');

    checkboxes.forEach(function (checkbox) {
        // Check if the attribute is already added (check against attribute_name[] to ensure no duplicates)
        const existingRow = Array.from(columnList.querySelectorAll('input[name="column_name[]"]')).find(
            (input) => normalizeAttribute(input.value) === normalizeAttribute(checkbox.value)
        );

        if (checkbox.checked) {
            if (existingRow) return; // Skip if already appended

            // Create a new row for the checked attribute
            const newRow = document.createElement("tr");

            // Column 1: Label with counter
            const labelCell = document.createElement('td');
            const label = document.createElement('label');
            label.setAttribute('name', 'attr_counter[]');
            label.textContent = ""; // Placeholder, will be updated
            labelCell.appendChild(label);

            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'attr_counter[]');
            hiddenInput.setAttribute('value', attrCounter); // Set value to the checkbox value
            labelCell.appendChild(hiddenInput);
            
            newRow.appendChild(labelCell);

             // Hidden Column 2: Input for attribute name
            const hiddenId = document.createElement('td');
            hiddenId.classList.add('hidden');
            const IdInput = document.createElement('input');
            IdInput.setAttribute('type', 'hidden');
            IdInput.setAttribute('name', 'rao_sk_att_id[]');
            IdInput.setAttribute('required', 'false');
            IdInput.value = ""; //no value 
            hiddenId.appendChild(IdInput);
            newRow.appendChild(hiddenId);

            // Column 2: Input for attribute name
            const inputCell = document.createElement('td');
            const input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'column_name[]');
            input.setAttribute('required', 'true');
            input.value = checkbox.value; // Set the input value to the checkbox value
            inputCell.appendChild(input);
            newRow.appendChild(inputCell);
           

            // Column 3: Action buttons
            const actionCell = document.createElement('td');
            actionCell.classList.add('action-buttons');
            actionCell.innerHTML = `
                <a href="#" class="delete"><i class="bx bx-x"></i></a>
            `;
            newRow.appendChild(actionCell);

            // Attach event listeners for action buttons
            actionCell.querySelector('.delete').addEventListener('click', function (event) {
                event.preventDefault();
                if (confirm("Are you sure you want to remove this row?")) {
                    newRow.remove();
                    update_attr_Counter();
                }
            });

            // Append the new row to the column list
            columnList.appendChild(newRow);
        } else {
            // If the checkbox is unchecked, remove the corresponding row
            const rowToRemove = existingRow?.closest('tr');
            if (rowToRemove) {
                rowToRemove.remove();
            }
        }
    });

    // Update the row counters
    updateCounters();
}


const checkAllLink = document.querySelector('#UpdateAttributeModal #checkAll');
const dropdownLabel = document.querySelector('#UpdateAttributeModal .dropdown-label');

// "Check All" functionality
checkAllLink.addEventListener('click', function (event) {
    event.preventDefault();

    const checkboxes = document.querySelectorAll('#dynamic-options input[type="checkbox"]');
    const allChecked = Array.from(checkboxes).every((checkbox) => checkbox.checked);

    // Toggle all checkboxes
    checkboxes.forEach((checkbox) => {
        checkbox.checked = !allChecked;
    });

    // Update "Check All" link text
    checkAllLink.textContent = allChecked ? 'Check All' : 'Uncheck All';

    // Update rows and dropdown label
    appendCheckedAttributes(); // Rebuild rows
    updateSelectedCount();     // Update dropdown label
});

// Function to update the selected count in the dropdown label
function updateSelectedCount() {
    const checkboxes = document.querySelectorAll('#dynamic-options input[type="checkbox"]');
    const selectedCount = Array.from(checkboxes).filter((checkbox) => checkbox.checked).length;
    console.log("checkboxes.length: ",checkboxes.length);
    console.log("selectedCount: ",selectedCount);


    if (selectedCount === 0) {
        dropdownLabel.textContent = 'Select';
    } else if (selectedCount === checkboxes.length) {
        dropdownLabel.textContent = 'All are Selected';
    } else {
        dropdownLabel.textContent = `${selectedCount} are Selected`;
    }

}

// Handle individual checkbox change (if dynamically added)
document.querySelector('#UpdateAttributeModal #dynamic-options').addEventListener('change', function (event) {
    if (event.target.matches('input[type="checkbox"]')) {
        updateSelectedCount();
    }
});


    // Initialize selected count on page load
    updateSelectedCount();
    updateCounters();


    $('#UpdateAttributeModal').on('hidden.bs.modal', function () {
        const columnLists = document.querySelector("#UpdateAttributeModal .column-lists");
        columnLists.innerHTML = '';
        modalInitialized = false;
        attrCounter = 1;
    });



});
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal1 = document.getElementById('AttributeModal');
    let modal1Initialized = false;
    let attrCounter = 1; // Start counter at 1

    // Handle modal open event
    $('#AttributeModal').on('show.bs.modal', function () {
        if (!modal1Initialized) {
            initializeModal1();
            modal1Initialized = true;
            updateSelectedCount();
        }
        populateDropdown(); // Populate the dropdown when the modal is opened
    });

    // Initialize the modal and handle dynamic row additions
    function initializeModal1() {
        console.log('Attribute Modal is initialized');

        // Initialize the counter based on the current number of rows
        attrCounter = document.querySelectorAll("#AttributeModal .column-lists tr").length + 1;

        // Add event listener for adding new input groups
        const addButton = document.querySelector('#AttributeModal .modal-footer .add-row');
        addButton.removeEventListener('click', addInputHandler); // Remove previous listener to prevent duplicates
        addButton.addEventListener('click', addInputHandler);

        // Form submission handler
        document.querySelector('#updateUser').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            console.log('Form submitted', Object.fromEntries(formData));
        });

        function addInputHandler(event) {
            event.preventDefault();
            addInput();
        }

        function removeInput(event) {
            event.preventDefault();
            if (confirm("Are you sure you want to remove this row?")) {
                const inputGroup = event.target.closest('#AttributeModal tr');
                if (inputGroup) {
                    inputGroup.remove();
                    update_attr_Counter();
                }
            }
        }

        function update_attr_Counter() {
            const rows = document.querySelectorAll("#AttributeModal .column-lists tr");
            let updatedCounter = 1;

            rows.forEach(function (row) {
                const label = row.querySelector("label[name='counter[]']");
                const hiddenInput = row.querySelector("input[name='attr_counter[]']");

                if (label) {
                    label.textContent = updatedCounter; // Update label text
                }
                if (hiddenInput) {
                    hiddenInput.value = updatedCounter; // Update hidden input value
                }
                updatedCounter++;
            });

            attrCounter = updatedCounter; // Synchronize the global counter
        }


        function addInput(afterElement = null) {
            const newRow = document.createElement("tr");

            const labelCell = document.createElement('td');
            const label = document.createElement('label');
            label.textContent = attrCounter;
            label.setAttribute('name', 'counter[]');
            label.setAttribute('value', attrCounter);
            labelCell.appendChild(label);
            newRow.appendChild(labelCell);

            const inputCell = document.createElement('td');
            const input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'attribute_name[]');
            input.setAttribute('required', 'true');
            inputCell.appendChild(input);
            newRow.appendChild(inputCell);

            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'attr_counter[]');
            hiddenInput.setAttribute('value', attrCounter);
            newRow.appendChild(hiddenInput);

            const actionCell = document.createElement('td');
            actionCell.classList.add('action-buttons');
            actionCell.innerHTML = `
                
                <a href="#" class="delete"><i class="bx bx-x"></i></a>
            `;
            newRow.appendChild(actionCell);

            // <a href="#" class="add"><i class="bx bx-plus"></i> </a>
            actionCell.querySelector('.delete').addEventListener('click', function(event) {
                event.preventDefault();
                if (confirm("Are you sure you want to remove this row?")) {
                    newRow.remove();
                    update_attr_Counter();
                }
            });

            // actionCell.querySelector('.add').addEventListener('click', function(event) {
            //     event.preventDefault();
            //     addInput(newRow);
            // });

            if (afterElement) {
                afterElement.insertAdjacentElement('afterend', newRow);
            } else {
                document.querySelector("#AttributeModal .column-lists").appendChild(newRow);
            }

            attrCounter++; // Increment the counter after adding a new row
            update_attr_Counter();
            console.log("New Row Added");
        }
    }

    // Handle modal close event to clean up
    $('#AttributeModal').on('hidden.bs.modal', function () {
        // Clear existing table rows
        document.querySelector("#AttributeModal .column-lists").innerHTML = '';
        
        const addButton = document.querySelector('#AttributeModal .modal-footer .add-row');
        const form = document.querySelector('#updateUser');
        
        // Clean up event listeners
        addButton.replaceWith(addButton.cloneNode(true));
        form.replaceWith(form.cloneNode(true));
        modal1Initialized = false;
    });

    function update_attr_Counter() {
            const rows = document.querySelectorAll("#AttributeModal .column-lists tr");
            let updatedCounter = 1;

            rows.forEach(function (row) {
                const label = row.querySelector("label[name='counter[]']");
                const hiddenInput = row.querySelector("input[name='attr_counter[]']");

                if (label) {
                    label.textContent = updatedCounter; // Update label text
                }
                if (hiddenInput) {
                    hiddenInput.value = updatedCounter; // Update hidden input value
                }
                updatedCounter++;
            });

            attrCounter = updatedCounter; // Synchronize the global counter
        }

    // Fetch and populate the dropdown with checkboxes
    function populateDropdown() {
        console.log("populateDropdown() is called");
        $.ajax({
            url: 'get_all_attributes.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log("Response received:", response); 
                const dropdownOptions = $('#AttributeModal .modal-header #dynamic-options');
                dropdownOptions.empty(); // Clear existing options

                if (response.status === 'true' && Array.isArray(response.attributes)) {
                    response.attributes.forEach(function (item) {
                        dropdownOptions.append(`
                            <label class="dropdown-option">
                                <input type="checkbox" name="dropdown-group" value="${item.value}" class="checkbox-item" />
                                ${item.label}
                            </label>
                        `);
                    });
                } else {
                    console.error("Invalid response format or no attributes available.");
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching attributes:', error);
            }
        });

        // Add listener to append selected checkboxes to the column list when checked
        $('#AttributeModal').on('change', '#dynamic-options input[type="checkbox"]', function () {
            appendCheckedAttributes();
        });
    }
    function normalizeAttribute(attribute) {
        return attribute
            .toLowerCase()      // Convert to lowercase
            .replace(/\s+/g, '') // Remove spaces
            .replace(/_/g, '');  // Remove underscores
    }

    function appendCheckedAttributes() {
    const checkboxes = document.querySelectorAll('#dynamic-options input[type="checkbox"]');
    const columnList = document.querySelector('#AttributeModal .column-lists');

    checkboxes.forEach(function (checkbox) {
        // Check if the attribute is already added (check against attribute_name[] to ensure no duplicates)
        const existingRow = Array.from(columnList.querySelectorAll('input[name="attribute_name[]"]')).find(
            (input) => normalizeAttribute(input.value) === normalizeAttribute(checkbox.value)
        );

        if (checkbox.checked) {
            if (existingRow) return; // Skip if already appended

            // Create a new row for the checked attribute
            const newRow = document.createElement("tr");

            // Column 1: Label with counter
            const labelCell = document.createElement('td');
            const label = document.createElement('label');
            label.setAttribute('name', 'counter[]');
            label.textContent = ""; // Placeholder, will be updated
            labelCell.appendChild(label);
            
            newRow.appendChild(labelCell);

            // Column 2: Input for attribute name
            const inputCell = document.createElement('td');
            const input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'attribute_name[]');
            input.setAttribute('required', 'true');
            input.value = checkbox.value; // Set the input value to the checkbox value
            inputCell.appendChild(input);
            newRow.appendChild(inputCell);

            // Hidden input: Attribute counter
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'attr_counter[]');
            hiddenInput.setAttribute('value', checkbox.value); // Set value to the checkbox value
            newRow.appendChild(hiddenInput);

            // Column 3: Action buttons
            const actionCell = document.createElement('td');
            actionCell.classList.add('action-buttons');
            actionCell.innerHTML = `
                <a href="#" class="delete"><i class="bx bx-x"></i></a>
            `;
            newRow.appendChild(actionCell);

            // Attach event listeners for action buttons
            actionCell.querySelector('.delete').addEventListener('click', function (event) {
                event.preventDefault();
                if (confirm("Are you sure you want to remove this row?")) {
                    newRow.remove();
                    update_attr_Counter();
                }
            });

            // Append the new row to the column list
            columnList.appendChild(newRow);
        } else {
            // If the checkbox is unchecked, remove the corresponding row
            const rowToRemove = existingRow?.closest('tr');
            if (rowToRemove) {
                rowToRemove.remove();
            }
        }
    });

    // Update the row counters
    update_attr_Counter();
}

const checkAllLink = document.getElementById('checkAll');
const dropdownLabel = document.querySelector('.dropdown-label');

// "Check All" functionality
checkAllLink.addEventListener('click', function (event) {
    event.preventDefault();

    const checkboxes = document.querySelectorAll('#dynamic-options input[type="checkbox"]');
    const allChecked = Array.from(checkboxes).every((checkbox) => checkbox.checked);

    // Toggle all checkboxes
    checkboxes.forEach((checkbox) => {
        checkbox.checked = !allChecked;
    });

    // Update "Check All" link text
    checkAllLink.textContent = allChecked ? 'Check All' : 'Uncheck All';

    // Update rows and dropdown label
    appendCheckedAttributes(); // Rebuild rows
    updateSelectedCount();     // Update dropdown label
});

// Function to update the selected count in the dropdown label
function updateSelectedCount() {
    const checkboxes = document.querySelectorAll('#dynamic-options input[type="checkbox"]');
    const selectedCount = Array.from(checkboxes).filter((checkbox) => checkbox.checked).length;
    console.log("checkboxes.length: ",checkboxes.length);
    console.log("selectedCount: ",selectedCount);


    if (selectedCount === 0) {
        dropdownLabel.textContent = 'Select';
    } else if (selectedCount === checkboxes.length) {
        dropdownLabel.textContent = 'All are Selected';
    } else {
        dropdownLabel.textContent = `${selectedCount} are Selected`;
    }

}

// Handle individual checkbox change (if dynamically added)
document.querySelector('#dynamic-options').addEventListener('change', function (event) {
    if (event.target.matches('input[type="checkbox"]')) {
        updateSelectedCount();
    }
});


    // Initialize selected count on page load
    updateSelectedCount();
    update_attr_Counter();
    
});
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    let modal1Initialized = false;
    let apCounter = 1;
    let obCounter = 1;
    let apTotalsInitialized = false;
    let obTotalsInitialized = false;
    const modal1 = document.getElementById('addUserModal');
    let addRowListenerInitialized = false; 
    

    $('#addUserModal').on('show.bs.modal', function () {
        if (!modal1Initialized) {
            initializeModal1();
            modal1Initialized = true;
        }
    });

    $('#addUserModal').on('hidden.bs.modal', function () {
        resetModal();
    });

    function initializeModal1() {
        console.log('Add Modal is initialized');

        const periodCoveredInput = document.querySelector('#addUserModal #periodcovered');
        const apDataRowContainer = document.querySelector('#addUserModal .inp-group-ap-data-row');
        const obDataRowContainer = document.querySelector('#addUserModal .inp-group-ob-data-row');
        const addApButton = document.querySelector('#addUserModal .modal-footer .add-row-ap');
        const addObButton = document.querySelector('#addUserModal .modal-footer .add-row-ob');
        const raoSkId = document.querySelector('#addUserModal #rao_sk_id');

        if (raoSkId) {
            console.log('rao_sk_id found:', raoSkId.value);
        } else {
            console.error('rao_sk_id not found');
        }

        console.log("Period Covered:", periodCoveredInput);
        const task = "insert";

        periodCoveredInput.addEventListener('change', function() {
            const selectedDate = this.value;

            console.log("Period Covered:", selectedDate);
            fetch(`get_monthly.php?task=${task}&date=${selectedDate}&id=${raoSkId.value}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'true') {
                        console.log('Valid Date');
                    } else {
                        
                        $('#addUserModal #periodcovered').val('');
                        if (data.error.includes("record already exists")) {
                            // Error for duplicate record
                            alert("A record for this month already exists. Please choose a different month.");
                        } else {
                            // General error handling
                            alert("An error occurred: " + data.error);
                        }

                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert("An unexpected error occurred. Please try again.");
                });
        });



        if ((addApButton || addObButton) && periodCoveredInput) {
            function formatDate(date) {
                return date.toISOString().split('T')[0];
            }

            function getLastDayOfMonth(year, month) {
                return new Date(year, month + 1, 0).getDate();
            }

            function updateDateInputs() {
                const selectedDate = new Date(periodCoveredInput.value);
                if (isNaN(selectedDate.getTime())) return;

                const month = selectedDate.getMonth();
                const year = selectedDate.getFullYear();
                const startOfMonth = new Date(year, month, 2);
                const lastDay = getLastDayOfMonth(year, month);
                const endOfMonth = new Date(year, month, lastDay + 1);

                const minDate = formatDate(startOfMonth);
                const maxDate = formatDate(endOfMonth);

                const dateInputs = document.querySelectorAll('#addUserModal input[name*="date_data[]"]');
                dateInputs.forEach(input => {
                    const currentDate = new Date(input.value);
                    const currentTime = currentDate.getTime();

                    // Update min and max attributes
                    input.setAttribute('min', minDate);
                    input.setAttribute('max', maxDate);

                    // Automatically adjust the input value if it falls outside the new range
                    if (isNaN(currentTime) || currentTime < startOfMonth.getTime() || currentTime > endOfMonth.getTime()) {
                        // Set the input's value to the start of the new range
                        input.value = minDate;
                    }
                });
                        }

            periodCoveredInput.addEventListener('change', updateDateInputs);
        }

        function createCell(elementType, textContent = '', attributes = {}, cellClass = '') {
            const cell = document.createElement('td');
            const element = document.createElement(elementType);

            if (cellClass) {
                cell.classList.add(cellClass);
            }

            if (textContent) element.textContent = textContent;

            for (const [key, value] of Object.entries(attributes)) {
                element.setAttribute(key, value);
            }

            cell.appendChild(element);
            return cell;
        }

        

    function createTotalRows(attributes) {
    if (apTotalsInitialized && obTotalsInitialized) {
        return;
    }

    const types = ['ap', 'ob'];
    types.forEach(type => {
        // Create the total input first
        const totalInputTd = document.createElement('td');
        totalInputTd.classList.add('total-data');
        const totalInput = document.createElement('input');
        totalInput.value = 'Total';
        totalInput.disabled = true;
        totalInput.name = `${type}_total`;
        totalInputTd.appendChild(totalInput);

        const rowConfigs = {
            ap: [
                {
                    selector: `#addUserModal .inp-group-${type}-totals.TA .totals-row`,
                    label: 'Total Appropriations',
                    identifier: 'TA',
                    includeTotal: true
                },
                {
                    selector: `#addUserModal .inp-group-${type}-totals.BF .totals-row`,
                    label: 'Balance Forwarded',
                    identifier: 'BF',
                    includeTotal: true
                }
            ],
            ob: [
                {
                    selector: `#addUserModal .inp-group-${type}-totals.TO .totals-row`,
                    label: 'Total Obligations',
                    identifier: 'TO',
                    includeTotal: true
                },
                {
                    selector: `#addUserModal .inp-group-${type}-totals.OB .totals-row`,
                    label: 'Obligations Balance To Date',
                    identifier: 'OB',
                    includeTotal: true
                },
                {
                    selector: `#addUserModal .inp-group-${type}-totals.AB .totals-row`,
                    label: 'Appropriations Balance To Date',
                    identifier: 'AB',
                    includeTotal: true
                }
            ]
        };

        rowConfigs[type].forEach(config => {
            const totalRow = document.querySelector(config.selector);
            if (!totalRow) return;

            totalRow.innerHTML = ''; // Clear existing row content

            const labelCell = document.createElement('td');
            labelCell.setAttribute('colspan', '3');
            labelCell.classList.add('stick-body');
            labelCell.textContent = config.label;
            totalRow.appendChild(labelCell);

            // Add the total input with identification
            if (config.includeTotal) {
                const totalInputCell = document.createElement('td');
                totalInputCell.classList.add('total-data');
                const totalInput = document.createElement('input');
                totalInput.value = 'Total';
                totalInput.disabled = true;
                totalInput.name = `${type}_total_${config.identifier}`; // Include identifier in name
                totalInputCell.appendChild(totalInput);
                totalRow.appendChild(totalInputCell);
            }

            // Add attribute inputs with identification
            attributes.forEach(attr => {
                const attrId = attr.rao_sk_att_id;
                const td = document.createElement('td');
                const input = document.createElement('input');
                input.type = 'number';
                input.name = `${type}_attr_${config.identifier}_${attrId}`; // Include identifier in name
                input.value = '0.00';
                input.disabled = true;
                td.appendChild(input);
                totalRow.appendChild(td);
            });

            const actionTd = document.createElement('td');
            actionTd.classList.add('action-data');
            totalRow.appendChild(actionTd);
        });
    });

    // Set both flags to true after creation
    apTotalsInitialized = true;
    obTotalsInitialized = true;
}
        function updateCounters(type) {
            const selector = type === 'ap' ? '#addUserModal .ap-data-row' : '#addUserModal .ob-data-row';
            const rows = document.querySelectorAll(selector);
            rows.forEach((row, index) => {
                const hiddenInput = row.querySelector('input[name="hidden"]');
                if (hiddenInput) {
                    hiddenInput.value = index + 1;
                }
            });
            if (type === 'ap') {
                apCounter = rows.length + 1;
            } else {
                obCounter = rows.length + 1;
            }
        }

        updateDateInputs();
        //Dynamic Rows
        function addRow(type, afterElement = null, raoSkIdValue) {
            const container = type === 'ap' ? apDataRowContainer : obDataRowContainer;
            const newRow = document.createElement("tr");
            newRow.classList.add(type === 'ap' ? "ap-data-row" : "ob-data-row");

            const baseCells = [
                createCell('input', '', {type: 'date', name: `${type}_date_data[]`, required: true}),
                createCell('input', '', {type: 'text', name: `${type}_reference_no[]`, required: false}),
                createCell('input', '', {type: 'text', name: `${type}_particulars[]`, required: false}),
                createCell('input', '', {type: 'number', name: `${type}_total[]`, step: 0.01}, 'total-data')
            ];

            baseCells.forEach(cell => newRow.appendChild(cell));

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'hidden';
            hiddenInput.value = type === 'ap' ? apCounter++ : obCounter++;

            console.log(hiddenInput.value);

            newRow.appendChild(hiddenInput);

            const actionCell = document.createElement('td');
            actionCell.classList.add('action-data');
            actionCell.innerHTML = `
                <a href="#" class="add-row-${type}">+</a>
                <a href="#" class="delete">X</a>
            `;

            $.ajax({
                url: 'fetch_table_columns.php',
                type: 'GET',
                data: { rao_sk_id: raoSkIdValue },
                dataType: 'json',
                success: function(response) {
                    if (response && response.attributes) {
                        response.attributes.forEach(attr => {
                            const attrId = attr.rao_sk_att_id;
                            // Add a prefix (ap_ or ob_) based on the type
                            const dynamicCell = createCell('input', '', {
                                type: 'number',
                                name: `${type}_attr_${attrId}[]`,  // Prefix with type (e.g., ap_attr_66[])
                                step: 0.01
                            });
                            newRow.appendChild(dynamicCell);
                        });

                        createTotalRows(response.attributes);
                        
                        newRow.appendChild(actionCell);

                        if (afterElement) {
                            afterElement.insertAdjacentElement('afterend', newRow);
                        } else {
                            container.appendChild(newRow);
                        }

                        updateDateInputs();
                    }
                },
                error: function(jqXHR) {
                    console.error('Error fetching attributes:', jqXHR.responseText);
                }
            });


            actionCell.querySelector('.delete').addEventListener('click', (e) => removeInput(e, type));
        }

        function removeInput(event, type) {
            event.preventDefault();
            if (confirm("Are you sure you want to remove this row?")) {
                const inputGroup = event.target.closest('tr');
                if (inputGroup) {
                    inputGroup.remove();
                    updateCounters(type);
                }
            }
        }

        if (!addRowListenerInitialized) {
            document.querySelector('#addUserModal').addEventListener('click', function(event) {
                if (event.target.classList.contains('add-row-ap')) {
                    event.preventDefault();
                    const currentRow = event.target.closest('tr');
                    addRow('ap', currentRow, raoSkId.value);
                    updateDateInputs();
                } else if (event.target.classList.contains('add-row-ob')) {
                    event.preventDefault();
                    const currentRow = event.target.closest('tr');
                    addRow('ob', currentRow, raoSkId.value);
                    updateDateInputs();
                }
            });
            addRowListenerInitialized = true; // Mark the listener as initialized
        }

    }

    function resetModal() {
    const apDataRowContainer = document.querySelector('#addUserModal .inp-group-ap-data-row');
    const obDataRowContainer = document.querySelector('#addUserModal .inp-group-ob-data-row');
    apDataRowContainer.innerHTML = '';
    obDataRowContainer.innerHTML = '';
    apCounter = 1;
    obCounter = 1;
    modal1Initialized = false;
    // Reset the totals flags
    apTotalsInitialized = false;
    obTotalsInitialized = false;
}
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    let modal1Initialized = false;
    let apCounter = 1;
    let obCounter = 1;
    let apTotalsInitialized = false;
    let obTotalsInitialized = false;
    const modal1 = document.getElementById('exampleModal');
    let modalFooterEventListenerAdded = false;

    $('#exampleModal').on('show.bs.modal', function () {
        if (!modal1Initialized) {
            initializeModal1();
            modal1Initialized = true;
            
        }
    });

    $('#exampleModal').on('hidden.bs.modal', function () {
        resetModal();
    });


    function initializeModal1() {
        console.log('Update Modal is initialized');

        const periodCoveredInput = document.querySelector('#exampleModal #period_covered');
        const apDataRowContainer = document.querySelector('#exampleModal .inp-group-ap-data-row');
        const obDataRowContainer = document.querySelector('#exampleModal .inp-group-ob-data-row');
        const addApButton = document.querySelector('#exampleModal .modal-footer .add-row-ap');
        const addObButton = document.querySelector('#exampleModal .modal-footer .add-row-ob');
        const raoSkId = document.querySelector('#exampleModal #rao_sk_id');

        const task = "update";

        console.log("Period Covered:", periodCoveredInput);

        periodCoveredInput.addEventListener('change', function() {
            const selectedDate = this.value;

            console.log("Period Covered:", selectedDate);
            console.log("raoSkId get monthly:", raoSkId.value);
            fetch(`get_monthly.php?task=${task}&date=${selectedDate}&id=${raoSkId.value}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'true') {
                        console.log('Valid Date');
                    } else {
                        
                        $('#exampleModal #period_covered').val('');
                        if (data.error.includes("record already exists")) {
                            // Error for duplicate record
                            alert("A record for this month already exists. Please choose a different month.");
                        } else {
                            // General error handling
                            alert("An error occurred: " + data.error);
                        }

                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert("An unexpected error occurred. Please try again.");
                });
        });



        if (raoSkId) {
            console.log('rao_sk_id found:', raoSkId.value);
        } else {
            console.error('rao_sk_id not found');
        }

        if ((addApButton || addObButton) && periodCoveredInput) {
            function formatDate(date) {
                return date.toISOString().split('T')[0];
            }

            function getLastDayOfMonth(year, month) {
                return new Date(year, month + 1, 0).getDate();
            }

            function updateDateInputs() {
                const selectedDate = new Date(periodCoveredInput.value);
                if (isNaN(selectedDate.getTime())) return;

                const month = selectedDate.getMonth();
                const year = selectedDate.getFullYear();
                const startOfMonth = new Date(year, month, 2);
                const lastDay = getLastDayOfMonth(year, month);
                const endOfMonth = new Date(year, month, lastDay + 1);

                const minDate = formatDate(startOfMonth);
                const maxDate = formatDate(endOfMonth);

                const dateInputs = document.querySelectorAll('#exampleModal input[name*="date_data[]"]');
                dateInputs.forEach(input => {
                    const currentDate = new Date(input.value);
                    const currentTime = currentDate.getTime();

                    // Update min and max attributes
                    input.setAttribute('min', minDate);
                    input.setAttribute('max', maxDate);

                    // Automatically adjust the input value if it falls outside the new range
                    if (isNaN(currentTime) || currentTime < startOfMonth.getTime() || currentTime > endOfMonth.getTime()) {
                        // Set the input's value to the start of the new range
                        input.value = minDate;
                    }
                });
            }

            periodCoveredInput.addEventListener('change', updateDateInputs);
        }

        updateDateInputs();
        

        function createCell(elementType, textContent = '', attributes = {}, cellClass = '') {
            const cell = document.createElement('td');
            const element = document.createElement(elementType);

            if (cellClass) {
                cell.classList.add(cellClass);
            }

            if (textContent) element.textContent = textContent;

            for (const [key, value] of Object.entries(attributes)) {
                element.setAttribute(key, value);
            }

            cell.appendChild(element);
            return cell;
        }

        function updateCounters(type) {
            const selector = type === 'ap' ? '#exampleModal .ap-data-row' : '#exampleModal .ob-data-row';
            const rows = document.querySelectorAll(selector);
            rows.forEach((row, index) => {
                const hiddenInput = row.querySelector('input[name="hidden"]');
                if (hiddenInput) {
                    hiddenInput.value = index + 1;
                }
            });
            if (type === 'ap') {
                apCounter = rows.length + 1;
            } else {
                obCounter = rows.length + 1;
            }
        }

        //Dynamic Rows
        function addRow(type, afterElement = null, raoSkIdValue) { 
            const container = type === 'ap' ? apDataRowContainer : obDataRowContainer;
            const newRow = document.createElement("tr");
            newRow.classList.add(type === 'ap' ? "ap-data-row" : "ob-data-row");

            const baseCells = [
                createCell('input', '', {type: 'date', name: `${type}_date_data[]`, required: true}),
                createCell('input', '', {type: 'text', name: `${type}_reference_no[]`,  required: false}),
                createCell('input', '', {type: 'text', name: `${type}_particulars[]`,  required: false}),
                createCell('input', '', {type: 'number', name: `${type}_total[]`,  step: 0.01}, 'total-data'),
                createCell('input', '', {type: 'hidden', name: `rao_sk_${type}_id`}, 'hidden'),
            ];
            
            baseCells.forEach(cell => newRow.appendChild(cell));

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'hidden';
            hiddenInput.value = type === 'ap' ? apCounter++ : obCounter++;

            newRow.appendChild(hiddenInput);

            const actionCell = document.createElement('td');
            actionCell.classList.add('action-data');
            actionCell.innerHTML = `
                <a href="#" class="add-row-${type}">+</a>
                <a href="#" class="delete">X</a>
            `;

            $.ajax({
                url: 'fetch_table_columns.php',
                type: 'GET',
                data: { rao_sk_id: raoSkIdValue },
                dataType: 'json',
                success: function(response) {
                    if (response && response.attributes) {
                        response.attributes.forEach(attr => {
                            const attrId = attr.rao_sk_att_id;
                            // Add a prefix (ap_ or ob_) based on the type
                            const dynamicCell = createCell('input', '', {
                                type: 'number',
                                name: `${type}_attr_${attrId}[]`,  // Prefix with type (e.g., ap_attr_66[])
                                step: 0.01
                            });
                            newRow.appendChild(dynamicCell);
                        });

                        // createTotalRows(type, response.attributes);
                        newRow.appendChild(actionCell);
                        updateDateInputs();
                        if (afterElement) {
                            afterElement.insertAdjacentElement('afterend', newRow);
                        } else {
                            container.appendChild(newRow);
                        }
                        updateDateInputs();
                    }
                },
                error: function(jqXHR) {
                    console.error('Error fetching attributes:', jqXHR.responseText);
                }
            });

            
            actionCell.querySelector('.delete').addEventListener('click', (e) => removeInput(e, type));
        }


        function removeInput(event, type) {
            event.preventDefault();
            if (confirm("Are you sure you want to remove this row?")) {
                const inputGroup = event.target.closest('tr');
                if (inputGroup) {
                    inputGroup.remove();
                    updateCounters(type);
                }
            }
        }

        console.log(modalFooterEventListenerAdded);
        if (!modalFooterEventListenerAdded) {
            document.querySelector('#exampleModal').addEventListener('click', function (event) {
                if (event.target.classList.contains('add-row-ap')) {
                    event.preventDefault();
                    const currentRow = event.target.closest('tr');
                    addRow('ap', currentRow, raoSkId.value);
                    updateDateInputs();
                } else if (event.target.classList.contains('add-row-ob')) {
                    event.preventDefault();
                    const currentRow = event.target.closest('tr');
                    addRow('ob', currentRow, raoSkId.value);
                    updateDateInputs();
                }
            });
            modalFooterEventListenerAdded = true; // Prevent reattaching event listener
        }
        updateDateInputs();
    }

    function resetModal() {
        const apDataRowContainer = document.querySelector('#exampleModal .inp-group-ap-data-row');
        const obDataRowContainer = document.querySelector('#exampleModal .inp-group-ob-data-row');
        apDataRowContainer.innerHTML = '';
        obDataRowContainer.innerHTML = '';
        apCounter = 1;
        obCounter = 1;
        modal1Initialized = false;
        // Reset the totals flags
        apTotalsInitialized = false;
        obTotalsInitialized = false;

    }
});
</script>

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
<section class="delete-modal">
                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-body text-center">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Remove for you</h5>
                        <p>This data will be removed, Would you like to remove it ?</p>
                        <button type="button" class="btn btn-primary" id="confirmDeleteBtn">Remove</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        </section>
<script>
 function toggleDropdown(button) {
    // Get the dropdown menu associated with the button
    var dropdownMenu = button.nextElementSibling;
    
    // Get the icon element in the button
    var icon = button.querySelector('i');

    // Toggle the display of the dropdown menu
    if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
        dropdownMenu.style.display = "flex"; // Show the menu as flex (horizontal layout)
        icon.classList.remove('bx-chevron-down');
        icon.classList.add('bx-chevron-up');
    } else {
        dropdownMenu.style.display = "none"; // Hide the menu
        icon.classList.remove('bx-chevron-up');
        icon.classList.add('bx-chevron-down');
    }
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.action-btn') && !event.target.closest('.dropdown')) {
        var dropdowns = document.getElementsByClassName("dropdown-menu");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "flex") {
                openDropdown.style.display = "none";

                // Reset the icon to down-arrow for each open button
                var icon = openDropdown.previousElementSibling.querySelector('i');
                icon.classList.remove('bx-chevron-up');
                icon.classList.add('bx-chevron-down');
            }
        }
    }
}
</script>
<script>
    // Add event listener for the Enter key when the modal is open
document.addEventListener('keydown', function(event) {
    const modalOpen = document.getElementById('deleteConfirmationModal').classList.contains('show');
    if (modalOpen && event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('confirmDeleteBtn').click();
    }
});
</script>


</html>
