<?php
include '../../head.php';
include '../../sidebar_mainofficials.php';
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
                    <h1>Records of Appropriations and Obligations</h1>
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
                            <!-- <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn">+ Add Table</button> -->
                        
                        </div>
                    </div>
                    <table id="example" class="table-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Period Covered</th>
                                <th>Chairman</th>
                                <th>Barangay Captain</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                </div><!-- .table-container-->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            window.apCounterUpdate = 1;
                            window.obCounterUpdate = 1;

                            $('#example').DataTable({
                                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                                    $(nRow).attr('id', aData[0]);
                                    $(nRow).find('.deleteBtn').attr('data-rao_bd_id', aData[0]);
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

                        //FOR VIEW
                        $('#example').on('click', '.infoBtn', function (event) {
                            var table = $('#example').DataTable();
                            var trid = $(this).closest('tr').attr('id');
                            var rao_bd_id = $(this).data('id');
                            console.log(trid);

                            // Store data in modal for reference
                            $('#updateUser').data('rao_bd_id', rao_bd_id);
                            $('#updateUser').data('trid', trid);

                            // Show modal and set rao_cont_id value
                            $('#viewDataModal').modal('show');
                            console.log("Rao Cont ID:", rao_bd_id);
                            $('#viewDataModal #rao_bd_id').val(rao_bd_id);
                            $('#viewDataModal #trid').val(trid);

                            $('#viewDataModal .inp-group-ap-data-row').empty(); 
                            $('#viewDataModal .inp-group-ob-data-row').empty(); // Empty previous rows

                            // AJAX request to fetch data
                            $.ajax({
                                url: "get_single_data.php",
                                data: { rao_bd_id: rao_bd_id },
                                type: 'post',
                                success: function (data) {
                                    try {
                                        // Parse the response data
                                        var json = JSON.parse(data);
                                        console.log("Response:", json);

                                        // Check if status is true
                                        if (json.status === 'true') {

                                            var chairman = json.chairman;
                                            var period_covered = json.period_covered;
                                            var brgy_captain = json.brgy_captain;

                                            let formattedPeriod = formatPeriodCovered(period_covered);


                                            $('#viewDataModal #chairman_name').text(chairman);
                                            $('#viewDataModal #period_covered').text('For '+formattedPeriod);
                                            $('#viewDataModal #brgy_captain').text(brgy_captain);


                                        function createDynamicRow(type, dataKey, dataContainerKey, dataPrefix) {
                                            if (json[dataKey] && Array.isArray(json[dataKey]) && json[dataKey].length > 0) {
                                                json[dataKey].forEach(function (item) {
                                                    let row = `
                                                    <tr class="${type}-data-row">

                                                        <td><input type="date" name="${type}_date_data[]" value="${item[`${dataPrefix}_ref_date`] || ''}" disabled></td>
                                                        <td><input type="text" name="${type}_reference_no[]" value="${item[`${dataPrefix}_ref_no`] || ''}" disabled ></td>
                                                        <td><input type="text" name="${type}_particulars[]" value="${item[`${dataPrefix}_particulars`] || ''}" disabled ></td>
                                                        <td class="total-data"><input type="number" name="${type}_total[]" value="${item[`${dataPrefix}_total`] || ''}" disabled ></td>
                                                        <td class="hidden"><input type="hidden" name="rao_bd_${type}_id" value="${item[`rao_bd_${type}_id`] || ''}" disabled ></td>
                                                        <td><input type="number" name="${type}_pre_disaster[]" value="${item[`${dataPrefix}_pre_disaster`] || ''}" disabled ></td>
                                                        <td><input type="number" name="${type}_quick_response[]" value="${item[`${dataPrefix}_quick_response`] || ''}" disabled ></td>
                                                    </tr>
                                                    `;

                                                    $(`#viewDataModal .${dataContainerKey}`).append(row);
                                                });
                                            }
                                        
                                        }
                                         // Call the function for AP data
                                         createDynamicRow('ap', 'rao_bd_ap', 'inp-group-ap-data-row', 'ap');

                                        // Call the function for OB data
                                        createDynamicRow('ob', 'rao_bd_ob', 'inp-group-ob-data-row', 'ob');

                                        // Dynamically handle totals
                                        function createTotalsRow(totalKey, containerSelector, prefix, labelMapping) {
                                            if (!json[totalKey] || !Array.isArray(json[totalKey]) || json[totalKey].length === 0) return;

                                            json[totalKey].forEach(total => {
                                                const totalRow = document.querySelector(`${containerSelector}.${total.total_type} .totals-row`);
                                                if (!totalRow) return;

                                                totalRow.innerHTML = ''; // Clear existing content

                                                // Create label cell with dynamic text from the labelMapping
                                                const labelCell = document.createElement('td');
                                                labelCell.setAttribute('colspan', '3');
                                                labelCell.classList.add('stick-body');
                                                labelCell.textContent = labelMapping[total.total_type] || `${total.total_type} Total`;
                                                totalRow.appendChild(labelCell);

                                            // Add total input fields dynamically
                                                const fields = ['total','pre_disaster', 'quick_response'];

                                                fields.forEach(field => {
                                                    const inputCell = document.createElement('td');
                                                    const input = document.createElement('input');
                                                    input.type = 'number';
                                                    input.name = `${prefix}_total_${total.total_type}_${field}`;
                                                    input.value = total[field] || ''; // Use field value or empty string
                                                    input.disabled = true;

                                                    if (field === 'total') {
                                                        inputCell.classList.add('total-data'); // Add the class to the "total" cell
                                                    }

                                                    inputCell.appendChild(input);
                                                    totalRow.appendChild(inputCell);
                                                });
                                            });
                                        }

                                        // Label mapping for total types
                                        const labelMapping = {
                                            TA: 'Total Appropriations',
                                            BF: 'Balance Forwarded',
                                            TO: 'Total Obligations',
                                            OB: 'Obligations Balance To Date',
                                            AB: 'Appropriations Balance To Date'
                                        };

                                        // Populate rows for appropriations and obligations
                                        createTotalsRow('rao_bd_TA_totals', '#viewDataModal .inp-group-ap-totals', 'ap', labelMapping);
                                        createTotalsRow('rao_bd_BF_totals', '#viewDataModal .inp-group-ap-totals', 'ap', labelMapping);
                                        createTotalsRow('rao_bd_TO_totals', '#viewDataModal .inp-group-ob-totals', 'ob', labelMapping);
                                        createTotalsRow('rao_bd_OB_totals', '#viewDataModal .inp-group-ob-totals', 'ob', labelMapping);
                                        createTotalsRow('rao_bd_AB_totals', '#viewDataModal .inp-group-ob-totals', 'ob', labelMapping);

                                
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
                </section><!-- .home-->
                <!-- Modal -->

                <!-- View Rao -->
                <section class="rao">
                <div class="modal fade" id="viewDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Report of Appropriations and Obligations (RAO-BDRMMF)</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="rao-container">
                            <div class="rao-header">
                                    <h1>Report of Appropriations and Obligations (RAO-BDRRMF)</h1>
                                    <input type="hidden" id="rao_bd_id" name="rao_bd_id">
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
                                            <label>Fund Source:</label> <input type="text" value="5% BDRRMF"  disabled />
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
                                            <th colspan="5" class="dynamic-stick-head">BDRRMF</th><!-- Dynamic Heads max 5 -->
                                            
                                        </tr>
                                        <tr id="dynamic-heads">
                                            <th class="stick-head">Date</th>
                                            <th class="stick-head">Reference No</th>
                                            <th class="dynamic-head">Pre Disaster Programs</th>
                                            <th class="dynamic-head">Quick Response</th>
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
                                            <th colspan="5" class="dynamic-stick-head">BDRRMF</th>

                                        </tr>
                                        
                                        <tr id="dynamic-heads">
                                            <th class="stick-head">Date</th>
                                            <th class="stick-head">Reference No</th>
                                            <th class="dynamic-head">Pre Disaster Programs</th>
                                            <th class="dynamic-head">Quick Response</th>
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
            </section><!--VIEW MODAL-->
        </body> 
        <!-- FOR CLIENT SIDE CALCULATION -->
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
                    inputPattern: /ap_(salary|cash_gift|year_end|mid_year|sri|others|total)/,  // Match the fields for 'ap'
                    totalSelectors: {
                        TA: 'ap_attr_TA_',
                        BF: 'ap_attr_BF_'
                    }
                });

                calculateTypeAttributeTotals('ob', {
                    rowSelector: `#${modalId} .ob-data-row`,
                    inputPattern: /ob_(salary|cash_gift|year_end|mid_year|sri|others|total)/,  // Match the fields for 'ob'
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

                // Reset total fields before calculating
                Object.values(config.totalSelectors).forEach(selector => {
                    $(`#${modalId} input[name^="${selector}"]`).val('0.00');
                });

                $(config.rowSelector).each(function() {
                    $(this).find('input[type="number"]').each(function() {
                        const match = this.name.match(config.inputPattern);
                        if (match) {
                            const attrName = match[1];  // Field name like 'salary', 'cash_gift', etc.
                            const value = parseFloat(this.value) || 0;

                            // Accumulate totals for each field
                            attributeTotals[attrName] = (attributeTotals[attrName] || 0) + value;
                        }
                    });
                });

                // Update total fields with calculated values
                Object.entries(attributeTotals).forEach(([attrName, total]) => {
                    Object.values(config.totalSelectors).forEach(selector => {
                        $(`#${modalId} input[name="${selector}${attrName}"]`).val(total.toFixed(2));
                    });
                });
            }

            function calculateAppropriationsBalance(modalId) {
                // Calculate Appropriations Balance (AB) for each "ob" row
                $(`#${modalId} .inp-group-ob-totals`).find('.totals-row').each(function () {
                    $(this).find('input[type="number"]').each(function () {
                        const match = this.name.match(/ob_attr_TO_(salary|cash_gift|year_end|mid_year|sri|others|total)/); 
                        if (match) {
                            const attrId = match[1];

                            // Get Balance Forward (BF) and Transfer Out (TO) values
                            const bfValue = parseFloat($(`#${modalId} input[name="ap_attr_BF_${attrId}"]`).val()) || 0;
                            const toValue = parseFloat($(`#${modalId} input[name="ob_attr_TO_${attrId}"]`).val()) || 0;

                            // Log the BF and TO values for debugging
                            console.log(`BF Value for ${attrId}: ${bfValue}, TO Value for ${attrId}: ${toValue}`);

                            // Calculate Appropriations Balance (AB)
                            const appropriationBalance = (bfValue - toValue).toFixed(2);

                            // Log the calculated appropriation balance
                            console.log(`Calculated Appropriation Balance for ${attrId}: ${appropriationBalance}`);

                            // Set calculated balance in the AB field
                            $(`#${modalId} input[name="ob_attr_AB_${attrId}"]`).val(appropriationBalance);
                        }
                    });
                });
            }


            function calculateRowTotals(modalId) {
                let apGrandTotal = 0;
                let obGrandTotal = 0;

                // Calculate the total for each "ap" row
                $(`#${modalId} .ap-data-row`).each(function() {
                    let rowTotal = 0;
                    $(this).find('input[type="number"]').not('[name="ap_total[]"]').each(function() {
                        rowTotal += parseFloat(this.value) || 0;
                    });
                    $(this).find('input[name="ap_total[]"]').val(rowTotal.toFixed(2));
                    apGrandTotal += rowTotal;
                });

                // Set total for "ap" overall
                $(`#${modalId} input[name="ap_total_TA"]`).val(apGrandTotal.toFixed(2));
                $(`#${modalId} input[name="ap_total_BF"]`).val(apGrandTotal.toFixed(2));

                // Calculate the total for each "ob" row
                $(`#${modalId} .ob-data-row`).each(function() {
                    let rowTotal = 0;
                    $(this).find('input[type="number"]').not('[name="ob_total[]"]').each(function() {
                        rowTotal += parseFloat(this.value) || 0;
                    });
                    $(this).find('input[name="ob_total[]"]').val(rowTotal.toFixed(2));
                    obGrandTotal += rowTotal;
                });

                // Set total for "ob" overall
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

    // Initialize modals
    initializeModal('exampleModal');
    initializeModal('addUserModal');
    initializeModal('viewDataModal');
})();
</script>


</html>
