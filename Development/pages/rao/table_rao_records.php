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
                                    <li><a href="../../pages/rao/table_rao_records.php">RAO-PS</a></li>
                                    <li><a href="../../pages/rao-cont/table_rao_cont_records.php">RAO-CONT</a></li>
                                    <li><a href="../../pages/rao-fe/table_rao_fe_records.php">RAO-FE</a></li>
                                    <li><a href="../../pages/rao-mooe/table_rao_mooe_records.php">RAO-MOOE</a></li>
                                    <li><a href="../../pages/rao-bdrrmf/table_rao_bdrrmf_records.php">RAO-BDRRMF</a></li>
                                    <li><a href="../../pages/rao-dev/table_rao_dev_records.php">RAO-DEV</a></li>
                                    <li><a href="../../pages/rao-sk/table_rao_sk_records.php">RAO-SK</a></li>
                                    <li><a href="../../pages/rao-co/table_rao_co_cont_records.php">RAO-CO</a></li>
                                    <li><a href="../../pages/co-cont/table_rao_cocont_records.php">RAO-CO-CONT</a></li>
                                </ul>
                            </div>  
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn">+ Add Table</button>
                        
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
            </div>
        </section>
                </div><!-- .table-container-->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            window.apCounterUpdate = 1;
                            window.obCounterUpdate = 1;

                            $('#example').DataTable({
                                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                                    $(nRow).attr('id', aData[0]);
                                    $(nRow).find('.deleteBtn').attr('data-rao_ps_id', aData[0]);
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

                        //FOR ADD
                        $(document).on('submit', '#addUser', function (e) {
                            e.preventDefault();

                            let formData = {
                                period_covered: $('#addUserModal #periodcovered').val(),
                                chairman: $('#addUserModal #chairmanname').val(),
                                brgy_captain: $('#addUserModal #brgycaptain').val(),
                                ap_data: [],
                                ob_data: [],
                                ap_totals: [],
                                ob_totals: []
                            };

                            // Capture AP rows data
                            $('#addUserModal .inp-group-ap-data-row .ap-data-row').each(function () {
                                let apRowData = {
                                    date: $(this).find('input[name="ap_date_data[]"]').val(),
                                    reference_no: $(this).find('input[name="ap_reference_no[]"]').val(),
                                    particulars: $(this).find('input[name="ap_particulars[]"]').val(),
                                    total: $(this).find('input[name="ap_total[]"]').val()
                                };

                                // Dynamically capture all known fields (salary, cash_gift, etc.)
                                ['salary', 'cash_gift', 'year_end', 'mid_year', 'sri', 'others'].forEach(field => {
                                    apRowData[field] = $(this).find(`input[name="ap_${field}[]"]`).val()|| "";
                                });

                                formData.ap_data.push(apRowData);

                            });

                            // Capture OB rows data
                            $('#addUserModal .inp-group-ob-data-row .ob-data-row').each(function () {
                                let obRowData = {
                                    date: $(this).find('input[name="ob_date_data[]"]').val(),
                                    reference_no: $(this).find('input[name="ob_reference_no[]"]').val(),
                                    particulars: $(this).find('input[name="ob_particulars[]"]').val(),
                                    total: $(this).find('input[name="ob_total[]"]').val()
                                };

                                // Dynamically capture all known fields (salary, cash_gift, etc.)
                                ['salary', 'cash_gift', 'year_end', 'mid_year', 'sri', 'others'].forEach(field => {
                                    obRowData[field] = $(this).find(`input[name="ob_${field}[]"]`).val()|| "";
                                });

                                formData.ob_data.push(obRowData);
                            });

                         // Capture AP total rows
                        $('#addUserModal .inp-group-ap-totals .totals-row').each(function () {
                            // Extract the category identifier (e.g., "TA") from the class or name attributes
                            let category = $(this).closest('tbody').attr('class').split(' ').find(cls => cls !== 'inp-group-ap-totals');

                            if (!category) return; // Skip if no category found

                            let totalRow = {
                                category: category, // Store the category (e.g., TA)
                            };

                            // Capture the "total" field
                            totalRow.total = $(this).find('input[name^="ap_total_"]').val();

                            // Capture predefined attribute fields
                            ['salary', 'cash_gift', 'year_end', 'mid_year', 'sri', 'others'].forEach(field => {
                                let fieldValue = $(this).find(`input[name="ap_attr_${category}_${field}"]`).val();
                                if (fieldValue !== undefined) {
                                    totalRow[field] = fieldValue;
                                }
                            });

                            // Add the captured totals row to the formData.ap_totals array
                            formData.ap_totals.push(totalRow);
                        });

                        // Capture OB total rows
                        $('#addUserModal .inp-group-ob-totals .totals-row').each(function () {
                            // Extract the category identifier (e.g., "TA") from the class or name attributes
                            let category = $(this).closest('tbody').attr('class').split(' ').find(cls => cls !== 'inp-group-ob-totals');

                            if (!category) return; // Skip if no category found

                            let totalRow = {
                                category: category, // Store the category (e.g., TA)
                            };

                            // Capture the "total" field
                            totalRow.total = $(this).find('input[name^="ob_total_"]').val();

                            // Capture predefined attribute fields
                            ['salary', 'cash_gift', 'year_end', 'mid_year', 'sri', 'others'].forEach(field => {
                                let fieldValue = $(this).find(`input[name="ob_attr_${category}_${field}"]`).val();
                                if (fieldValue !== undefined) {
                                    totalRow[field] = fieldValue;
                                }
                            });

                            // Add the captured totals row to the formData.ob_totals array
                            formData.ob_totals.push(totalRow);
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
                                rao_ps_id: $('#exampleModal #rao_ps_id').val(),
                                period_covered: $('#exampleModal #period_covered').val(),
                                chairman: $('#exampleModal #chairman_name').val(),
                                brgy_captain: $('#exampleModal #brgy_captain').val(),
                                ap_data: [],
                                ob_data: [],
                                ap_totals: [],
                                ob_totals: [],
                                trid: $('#exampleModal #trid').val()
                            };

                             // Capture AP rows data
                             $('#exampleModal .inp-group-ap-data-row .ap-data-row').each(function () {
                                let apRowData = {
                                    rao_ps_ap_id: $(this).find('input[name="rao_ps_ap_id"]').val(),
                                    date: $(this).find('input[name="ap_date_data[]"]').val(),
                                    reference_no: $(this).find('input[name="ap_reference_no[]"]').val(),
                                    particulars: $(this).find('input[name="ap_particulars[]"]').val(),
                                    total: $(this).find('input[name="ap_total[]"]').val()
                                };

                                // Dynamically capture all known fields (salary, cash_gift, etc.)
                                ['salary', 'cash_gift', 'year_end', 'mid_year', 'sri', 'others'].forEach(field => {
                                    apRowData[field] = $(this).find(`input[name="ap_${field}[]"]`).val()|| "";
                                });

                                formData.ap_data.push(apRowData);

                            });

                            // Capture OB rows data
                            $('#exampleModal .inp-group-ob-data-row .ob-data-row').each(function () {
                                let obRowData = {
                                    rao_ps_ob_id: $(this).find('input[name="rao_ps_ob_id"]').val(),
                                    date: $(this).find('input[name="ob_date_data[]"]').val(),
                                    reference_no: $(this).find('input[name="ob_reference_no[]"]').val(),
                                    particulars: $(this).find('input[name="ob_particulars[]"]').val(),
                                    total: $(this).find('input[name="ob_total[]"]').val()
                                };

                                // Dynamically capture all known fields (salary, cash_gift, etc.)
                                ['salary', 'cash_gift', 'year_end', 'mid_year', 'sri', 'others'].forEach(field => {
                                    obRowData[field] = $(this).find(`input[name="ob_${field}[]"]`).val()|| "";
                                });

                                formData.ob_data.push(obRowData);
                            });

                             // Capture AP total rows
                            $('#exampleModal .inp-group-ap-totals .totals-row').each(function () {
                                // Extract the category identifier (e.g., "TA") from the class or name attributes
                                let category = $(this).closest('tbody').attr('class').split(' ').find(cls => cls !== 'inp-group-ap-totals');

                                if (!category) return; // Skip if no category found

                                let totalRow = {
                                    category: category, // Store the category (e.g., TA)
                                };

                                // Capture the "total" field
                                totalRow.total = $(this).find('input[name^="ap_total_"]').val();

                                // Capture predefined attribute fields
                                ['salary', 'cash_gift', 'year_end', 'mid_year', 'sri', 'others'].forEach(field => {
                                    let fieldValue = $(this).find(`input[name="ap_attr_${category}_${field}"]`).val();
                                    if (fieldValue !== undefined) {
                                        totalRow[field] = fieldValue;
                                    }
                                });

                                // Add the captured totals row to the formData.ap_totals array
                                formData.ap_totals.push(totalRow);
                            });

                            // Capture OB total rows
                            $('#exampleModal .inp-group-ob-totals .totals-row').each(function () {
                                // Extract the category identifier (e.g., "TA") from the class or name attributes
                                let category = $(this).closest('tbody').attr('class').split(' ').find(cls => cls !== 'inp-group-ob-totals');

                                if (!category) return; // Skip if no category found

                                let totalRow = {
                                    category: category, // Store the category (e.g., TA)
                                };

                                // Capture the "total" field
                                totalRow.total = $(this).find('input[name^="ob_total_"]').val();

                                // Capture predefined attribute fields
                                ['salary', 'cash_gift', 'year_end', 'mid_year', 'sri', 'others'].forEach(field => {
                                    let fieldValue = $(this).find(`input[name="ob_attr_${category}_${field}"]`).val();
                                    if (fieldValue !== undefined) {
                                        totalRow[field] = fieldValue;
                                    }
                                });

                                // Add the captured totals row to the formData.ob_totals array
                                formData.ob_totals.push(totalRow);
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
                                                        <a href="javascript:void(0);" data-id="${rao_ps_id}" class="update-btn btn-sm editbtn">
                                                            <i class="bx bx-sync"></i>
                                                        </a>  
                                                        <a href="!#;" data-rao_id="${rao_ps_id}" class="delete-btn btn-sm deleteBtn">
                                                            <i class="bx bxs-trash"></i>
                                                        </a>
                                                        <a href="!#;" data-item-id="${rao_ps_id}" class="update-btn btn-sm infoBtn">
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

                        $(document).ready(function() {
                            // Event listener for the print button
                            $(document).on('click', '.print-btn', function() {
                                var rao_ps_id = $(this).data('id'); // Get the indigency_id

                                // Make an AJAX request to fetch the certificate content
                                $.ajax({
                                    url: 'fetch_financial.php', // URL to fetch the certificate HTML
                                    type: 'POST',
                                    data: { id: rao_ps_id },
                                    success: function(response) {
                                        // Create a new window to print the content
                                        var printWindow = window.open('', '', 'height=600,width=800');
                                        printWindow.document.write(response);
                                        printWindow.document.close();

                                        // Wait for all images in the new window to load
                                        var images = printWindow.document.images;
                                        var totalImages = images.length;
                                        var loadedImages = 0;

                                        if (totalImages === 0) {
                                            // If there are no images, proceed to print
                                            printWindow.focus();
                                            printWindow.print();
                                            printWindow.close();
                                        } else {
                                            // Check each image for load completion
                                            for (var i = 0; i < totalImages; i++) {
                                                images[i].onload = images[i].onerror = function() {
                                                    loadedImages++;
                                                    if (loadedImages === totalImages) {
                                                        // All images have loaded, proceed to print
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
                        });

                        //FOR EDIT
                        $('#example').on('click', '.editbtn', function (event) {
                            var table = $('#example').DataTable();
                            var trid = $(this).closest('tr').attr('id');
                            var rao_ps_id = $(this).data('id');
                            console.log(trid);

                            // Store data in modal for reference
                            $('#updateUser').data('rao_ps_id', rao_ps_id);
                            $('#updateUser').data('trid', trid);

                            // Show modal and set rao_cont_id value
                            $('#exampleModal').modal('show');
                            console.log("Rao Cont ID:", rao_ps_id);
                            $('#exampleModal #rao_ps_id').val(rao_ps_id);
                            $('#exampleModal #trid').val(trid);

                            $('#exampleModal .inp-group-ap-data-row').empty(); 
                            $('#exampleModal .inp-group-ob-data-row').empty(); // Empty previous rows

                            // AJAX request to fetch data
                            $.ajax({
                                url: "get_single_data.php",
                                data: { rao_ps_id: rao_ps_id },
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


                                            $('#exampleModal #chairman_name').val(chairman);
                                            $('#exampleModal #period_covered').val(period_covered);
                                            $('#exampleModal #brgy_captain').val(brgy_captain);


                                        function createDynamicRow(type, dataKey, dataContainerKey, dataPrefix) {
                                            if (json[dataKey] && Array.isArray(json[dataKey]) && json[dataKey].length > 0) {
                                                json[dataKey].forEach(function (item) {
                                                    let row = `
                                                    <tr class="${type}-data-row">

                                                        <td><input type="date" name="${type}_date_data[]" value="${item[`${dataPrefix}_ref_date`] || ''}" required></td>
                                                        <td><input type="text" name="${type}_reference_no[]" value="${item[`${dataPrefix}_ref_no`] || ''}"></td>
                                                        <td><input type="text" name="${type}_particulars[]" value="${item[`${dataPrefix}_particulars`] || ''}"></td>
                                                        <td class="total-data"><input type="number" name="${type}_total[]" value="${item[`${dataPrefix}_total`] || ''}"></td>
                                                        <td class="hidden"><input type="hidden" name="rao_ps_${type}_id" value="${item[`rao_ps_${type}_id`] || ''}"></td>
                                                        <td><input type="number" name="${type}_salary[]" value="${item[`${dataPrefix}_salary`] || ''}"></td>
                                                        <td><input type="number" name="${type}_cash_gift[]" value="${item[`${dataPrefix}_cash_gift`] || ''}"></td>
                                                        <td><input type="number" name="${type}_year_end[]" value="${item[`${dataPrefix}_year_end`] || ''}"></td>
                                                        <td><input type="number" name="${type}_mid_year[]" value="${item[`${dataPrefix}_mid_year`] || ''}"></td>
                                                        <td><input type="number" name="${type}_sri[]" value="${item[`${dataPrefix}_sri`] || ''}"></td>
                                                        <td><input type="number" name="${type}_others[]" value="${item[`${dataPrefix}_others`] || ''}"></td>
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
                                        createDynamicRow('ap', 'rao_ps_ap', 'inp-group-ap-data-row', 'ap');

                                        // Call the function for OB data
                                        createDynamicRow('ob', 'rao_ps_ob', 'inp-group-ob-data-row', 'ob');

                                
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

                        //FOR VIEW
                        $('#example').on('click', '.infoBtn', function (event) {
                            var table = $('#example').DataTable();
                            var trid = $(this).closest('tr').attr('id');
                            var rao_ps_id = $(this).data('id');
                            console.log(trid);

                            // Store data in modal for reference
                            $('#updateUser').data('rao_ps_id', rao_ps_id);
                            $('#updateUser').data('trid', trid);

                            // Show modal and set rao_cont_id value
                            $('#viewDataModal').modal('show');
                            console.log("Rao Cont ID:", rao_ps_id);
                            $('#viewDataModal #rao_ps_id').val(rao_ps_id);
                            $('#viewDataModal #trid').val(trid);

                            $('#viewDataModal .inp-group-ap-data-row').empty(); 
                            $('#viewDataModal .inp-group-ob-data-row').empty(); // Empty previous rows

                            // AJAX request to fetch data
                            $.ajax({
                                url: "get_single_data.php",
                                data: { rao_ps_id: rao_ps_id },
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
                                                        <td class="hidden"><input type="hidden" name="rao_ps_${type}_id" value="${item[`rao_ps_${type}_id`] || ''}" disabled ></td>
                                                        <td><input type="number" name="${type}_salary[]" value="${item[`${dataPrefix}_salary`] || ''}" disabled ></td>
                                                        <td><input type="number" name="${type}_cash_gift[]" value="${item[`${dataPrefix}_cash_gift`] || ''}" disabled ></td>
                                                        <td><input type="number" name="${type}_year_end[]" value="${item[`${dataPrefix}_year_end`] || ''}" disabled ></td>
                                                        <td><input type="number" name="${type}_mid_year[]" value="${item[`${dataPrefix}_mid_year`] || ''}" disabled ></td>
                                                        <td><input type="number" name="${type}_sri[]" value="${item[`${dataPrefix}_sri`] || ''}" disabled ></td>
                                                        <td><input type="number" name="${type}_others[]" value="${item[`${dataPrefix}_others`] || ''}" disabled ></td>
                                                    </tr>
                                                    `;

                                                    $(`#viewDataModal .${dataContainerKey}`).append(row);
                                                });
                                            }
                                        
                                        }
                                         // Call the function for AP data
                                         createDynamicRow('ap', 'rao_ps_ap', 'inp-group-ap-data-row', 'ap');

                                        // Call the function for OB data
                                        createDynamicRow('ob', 'rao_ps_ob', 'inp-group-ob-data-row', 'ob');

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
                                                const fields = ['total', 'salary', 'cash_gift', 'year_end', 'mid_year', 'sri', 'others'];

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
                                        createTotalsRow('rao_ps_TA_totals', '#viewDataModal .inp-group-ap-totals', 'ap', labelMapping);
                                        createTotalsRow('rao_ps_BF_totals', '#viewDataModal .inp-group-ap-totals', 'ap', labelMapping);
                                        createTotalsRow('rao_ps_TO_totals', '#viewDataModal .inp-group-ob-totals', 'ob', labelMapping);
                                        createTotalsRow('rao_ps_OB_totals', '#viewDataModal .inp-group-ob-totals', 'ob', labelMapping);
                                        createTotalsRow('rao_ps_AB_totals', '#viewDataModal .inp-group-ob-totals', 'ob', labelMapping);

                                
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
                            var rao_ps_id = $(this).data('id'); // Get project ID from data attribute
                            var table = $('#example').DataTable();

                            // Open the modal
                            $('#deleteConfirmationModal').modal('show');

                            // Handle the confirmation
                            $('#confirmDeleteBtn').off('click').on('click', function() {
                            $.ajax({
                                url: "delete.php",
                                type: "POST",
                                data: { rao_ps_id: rao_ps_id },
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

        
                        
                    
                    </script>
                </section><!-- .home-->
                <!-- Modal -->

                <!-- View Rao -->
                <section class="rao">
                <div class="modal fade" id="viewDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Report of Appropriations and Obligations (RAO)</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="rao-container">
                            <div class="rao-header">
                                    <h1>Report of Appropriations and Obligations (RA-PS)</h1>
                                    <input type="hidden" id="rao_ps_id" name="rao_ps_id">
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
                                            <label>Fund Source:</label> <input type="text" value="General Fund (Personal Services)"  disabled />
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
                                            <th colspan="5" class="dynamic-stick-head">Personal Services</th><!-- Dynamic Heads max 5 -->
                                            
                                        </tr>
                                        <tr id="dynamic-heads">
                                            <th class="stick-head">Date</th>
                                            <th class="stick-head">Reference No</th>
                                            <th class="dynamic-head">Salaries & Wages</th>
                                            <th class="dynamic-head">Cash Gift P.E.I</th>
                                            <th class="dynamic-head">Year End Bonus</th>
                                            <th class="dynamic-head">Mid Year Pay</th>
                                            <th class="dynamic-head">S.R.I</th>
                                            <th class="dynamic-head">Other Personnel Benefits</th>
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
                                            <th colspan="5" class="dynamic-stick-head">Capital Outlay</th>

                                        </tr>
                                        
                                        <tr id="dynamic-heads">
                                            <th class="stick-head">Date</th>
                                            <th class="stick-head">Reference No</th>
                                            <th class="dynamic-head">Salaries & Wages</th>
                                            <th class="dynamic-head">Cash Gift P.E.I</th>
                                            <th class="dynamic-head">Year End Bonus</th>
                                            <th class="dynamic-head">Mid Year Pay</th>
                                            <th class="dynamic-head">S.R.I</th>
                                            <th class="dynamic-head">Other Personnel Benefits</th>
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
                                
                                    <a href="#" class="btn" id="print-btn">Print</a>
                                </div>

                                <script>
                                    document.getElementById('print-btn').addEventListener('click', function (e) {
                                        e.preventDefault(); // Prevent default behavior of the anchor tag

                                        const rao_ps_id = 7; // Replace with dynamic fetching logic if needed

                                        // Construct the dynamic URL with the parameter
                                        const url = `fetch_financial.php?id_rao_ps=${rao_ps_id}`;

                                        // Redirect the user to the constructed URL
                                        window.location.href = url;
                                    });
                                </script>

                                <style>
                                    .btn {
                                        display: block; /* Make the button behave like a block element */
                                        margin: 0 auto; /* Center the button horizontally */
                                        padding: 10px 20px; /* Add some padding for better appearance */
                                        font-size: 16px; /* Adjust font size for readability */
                                        text-align: center; /* Center the text within the button */
                                        background-color: #007bff; /* Set a background color */
                                        color: #fff; /* Text color */
                                        text-decoration: none; /* Remove underline */
                                        border: none; /* Remove border */
                                        border-radius: 5px; /* Rounded corners */
                                        cursor: pointer; /* Pointer cursor on hover */
                                    }
                                    .btn:hover {
                                        background-color: #0056b3; /* Darken the background on hover */
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Update Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Report of Appropriations and Obligations (RAO)</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                            <input type="hidden" id="rao_ps_id" name="rao_ps_id">
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
                                    <thead  class="appropriations-head">
                                        <tr>
                                            <th class="hidden">Counter</th>
                                            <th class="hidden">ID</th>
                                            <th colspan="2" class="stick-head">Reference For Appropriations</th><!-- Date and Ref No -->
                                            <th rowspan="2" class="stick-head">Particulars</th> 
                                            <th rowspan="2" class="stick-head">Totals</th>
                                            <th colspan="5" class="dynamic-stick-head">Personal Services</th><!-- Dynamic Heads max 5 -->
                                            
                                        </tr>
                                        <tr id="dynamic-heads">
                                            <th class="stick-head">Date</th>
                                            <th class="stick-head">Reference No</th>
                                            <th class="dynamic-head">Salaries & Wages</th>
                                            <th class="dynamic-head">Cash Gift P.E.I</th>
                                            <th class="dynamic-head">Year End Bonus</th>
                                            <th class="dynamic-head">Mid Year Pay</th>
                                            <th class="dynamic-head">S.R.I</th>
                                            <th class="dynamic-head">Other Personnel Benefits</th>
                                            <th rowspan="2" class="action-head">Actions</th>
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
                                            <th colspan="5" class="dynamic-stick-head">Capital Outlay</th>

                                        </tr>
                                        
                                        <tr id="dynamic-heads">
                                            <th class="stick-head">Date</th>
                                            <th class="stick-head">Reference No</th>
                                            <th class="dynamic-head">Salaries & Wages</th>
                                            <th class="dynamic-head">Cash Gift P.E.I</th>
                                            <th class="dynamic-head">Year End Bonus</th>
                                            <th class="dynamic-head">Mid Year Pay</th>
                                            <th class="dynamic-head">S.R.I</th>
                                            <th class="dynamic-head">Other Personnel Benefits</th>
                                            <th rowspan="2" class="action-head">Actions</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Report of Appropriations and Obligations (RAO)</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">

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
                                            <th colspan="5" class="dynamic-stick-head">Personal Services</th><!-- Dynamic Heads max 5 -->
                                            
                                        </tr>
                                        <tr id="dynamic-heads">
                                            <th class="stick-head">Date</th>
                                            <th class="stick-head">Reference No</th>
                                            <th class="dynamic-head">Salaries & Wages</th>
                                            <th class="dynamic-head">Cash Gift P.E.I</th>
                                            <th class="dynamic-head">Year End Bonus</th>
                                            <th class="dynamic-head">Mid Year Pay</th>
                                            <th class="dynamic-head">S.R.I</th>
                                            <th class="dynamic-head">Other Personnel Benefits</th>
                                            <th rowspan="2" class="action-head">Actions</th>
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
                                            <th colspan="5" class="dynamic-stick-head">Capital Outlay</th>

                                        </tr>
                                        
                                        <tr id="dynamic-heads">
                                            <th class="stick-head">Date</th>
                                            <th class="stick-head">Reference No</th>
                                            <th class="dynamic-head">Salaries & Wages</th>
                                            <th class="dynamic-head">Cash Gift P.E.I</th>
                                            <th class="dynamic-head">Year End Bonus</th>
                                            <th class="dynamic-head">Mid Year Pay</th>
                                            <th class="dynamic-head">S.R.I</th>
                                            <th class="dynamic-head">Other Personnel Benefits</th>
                                            <th rowspan="2" class="action-head">Actions</th>
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
    </body> 
    <script>
        //Today's Date Script
        // Set today's date to the input field with id="todayDate"
        document.getElementById('todayDate').value = new Date().toISOString().split('T')[0];
    </script>


<!--FOR SWITCHING Appropriation AND obligations-->
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
        $('#exampleModal').on('shown.bs.modal', function(){
            // Delay the behavior application slightly
            setTimeout(() => applyModalBehavior(exampleModal), 10);
        });
    }

    if (addUserModal) {
        $('#addUserModal').on('shown.bs.modal', function(){
            // Delay the behavior application slightly
            setTimeout(() => applyModalBehavior(addUserModal), 10);
        });
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
    if (selected == "appropriations") {
        appropriationsSections.forEach((section) => (section.style.display = ""));
    } else if (selected == "obligations") {
        obligationsSections.forEach((section) => (section.style.display = ""));
    }

    // Ensure the Appropriations Balance is always visible
    if (appropriationsBalance) {
        appropriationsBalance.style.display = "";
    }
}
</script>


<!--FOR ADD USER MODAL-->
<script>
document.addEventListener('DOMContentLoaded', function () {
    let modal1Initialized = false;
    let apCounter = 1;
    let obCounter = 1;
    let apTotalsInitialized = false;
    let obTotalsInitialized = false;
    const modal1 = document.getElementById('addUserModal');
    

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


        const attributes = ['salary', 'cash_gift', 'year_end', 'mid_year', 'sri', 'others'];
        console.log("Attributes: ",attributes);
        console.log("Period Covered:", periodCoveredInput);
        const task = "insert";

        periodCoveredInput.addEventListener('change', function() {
            const selectedDate = this.value;

            console.log("Period Covered:", selectedDate);
            fetch(`get_monthly.php?task=${task}&date=${selectedDate}`)
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

    if (textContent) {
        element.textContent = textContent;
    }

    Object.entries(attributes).forEach(([key, value]) => {
        element.setAttribute(key, value);
    });

    cell.appendChild(element);
    return cell;
}


        

    function createTotalRows(attributes) {
    if (apTotalsInitialized && obTotalsInitialized) {
        return;
    }

    const types = ['ap', 'ob'];
    types.forEach(type => {
        // // Create the total input first
        // const totalInputTd = document.createElement('td');
        // totalInputTd.classList.add('total-data');
        // const totalInput = document.createElement('input');
        // totalInput.value = 'Total';
        // totalInput.disabled = true;
        // totalInput.name = `${type}_total`;
        // totalInputTd.appendChild(totalInput);

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
                const td = document.createElement('td');
                const input = document.createElement('input');
                input.type = 'number';
                input.name = `${type}_attr_${config.identifier}_${attr}`; // Include identifier in name
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

createTotalRows(attributes);
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
        function addRow(type, afterElement = null) {
    const container = type === 'ap' ? apDataRowContainer : obDataRowContainer;
    const newRow = document.createElement('tr');
    newRow.classList.add(`${type}-data-row`);

    // Base cells for the row
    const baseCells = [
        createCell('input', '', { type: 'date', name: `${type}_date_data[]`, required: true }),
        createCell('input', '', { type: 'text', name: `${type}_reference_no[]`, required: false }),
        createCell('input', '', { type: 'text', name: `${type}_particulars[]`, required: false }),
        createCell('input', '', { type: 'number', name: `${type}_total[]`, step: 0.01 }, 'total-data'),
        createCell('input', '', { type: 'number', name: `${type}_salary[]`, step: 0.01 }),
        createCell('input', '', { type: 'number', name: `${type}_cash_gift[]`, step: 0.01 }),
        createCell('input', '', { type: 'number', name: `${type}_year_end[]`, step: 0.01 }),
        createCell('input', '', { type: 'number', name: `${type}_mid_year[]`, step: 0.01 }),
        createCell('input', '', { type: 'number', name: `${type}_sri[]`, step: 0.01 }),
        createCell('input', '', { type: 'number', name: `${type}_others[]`, step: 0.01 })
    ];

    baseCells.forEach(cell => newRow.appendChild(cell));

    // Add hidden counter input
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'hidden';
    hiddenInput.value = type === 'ap' ? apCounter++ : obCounter++;
    newRow.appendChild(hiddenInput);

    // Action cell
    const actionCell = document.createElement('td');
    actionCell.classList.add('action-data');
    actionCell.innerHTML = `
        <a href="#" class="add-row-${type}">+</a>
        <a href="#" class="delete">X</a>
    `;
    newRow.appendChild(actionCell);

    // Append to container
    if (afterElement) {
        afterElement.insertAdjacentElement('afterend', newRow);
    } else {
        container.appendChild(newRow);
    }

    // Delete row functionality
    actionCell.querySelector('.delete').addEventListener('click', (e) => removeRow(e, type));
}


function removeRow(event, type) {
    event.preventDefault();
    if (confirm("Are you sure you want to remove this row?")) {
        const row = event.target.closest('tr');
        if (row) {
            row.remove();
            updateCounters(type);
        }
    }
}

        document.querySelector('#addUserModal').addEventListener('click', function (event) {
        if (event.target.classList.contains('add-row-ap')) {
            event.preventDefault();
            const currentRow = event.target.closest('tr');
            addRow('ap', currentRow);
        } else if (event.target.classList.contains('add-row-ob')) {
            event.preventDefault();
            const currentRow = event.target.closest('tr');
            addRow('ob', currentRow);
        }
    });

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


<!--FOR EXAMPLE MODAL-->
<script>
document.addEventListener('DOMContentLoaded', function () {
    let modal1Initialized = false;
    let apCounter = 1;
    let obCounter = 1;
    let apTotalsInitialized = false;
    let obTotalsInitialized = false;
    const modal1 = document.getElementById('exampleModal');
    

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
        console.log('Example Modal is initialized');

        const periodCoveredInput = document.querySelector('#exampleModal #period_covered');
        const apDataRowContainer = document.querySelector('#exampleModal .inp-group-ap-data-row');
        const obDataRowContainer = document.querySelector('#exampleModal .inp-group-ob-data-row');
        const addApButton = document.querySelector('#exampleModal .modal-footer .add-row-ap');
        const addObButton = document.querySelector('#exampleModal .modal-footer .add-row-ob');
        const raoPsId = document.querySelector('#exampleModal #rao_ps_id');

        const attributes = ['salary', 'cash_gift', 'year_end', 'mid_year', 'sri', 'others'];
        const task = "update";
        
        periodCoveredInput.addEventListener('change', function() {
            const selectedDate = this.value;

            console.log("Period Covered:", selectedDate);
            console.log("raoPsId get monthly:", raoPsId.value);
            fetch(`get_monthly.php?task=${task}&date=${selectedDate}&id=${raoPsId.value}`)
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

        function createCell(elementType, textContent = '', attributes = {}, cellClass = '') {
    const cell = document.createElement('td');
    const element = document.createElement(elementType);

    if (cellClass) {
        cell.classList.add(cellClass);
    }

    if (textContent) {
        element.textContent = textContent;
    }

    Object.entries(attributes).forEach(([key, value]) => {
        element.setAttribute(key, value);
    });

    cell.appendChild(element);
    return cell;
}


        

    function createTotalRows(attributes) {
    if (apTotalsInitialized && obTotalsInitialized) {
        return;
    }

    const types = ['ap', 'ob'];
    types.forEach(type => {
        // // Create the total input first
        // const totalInputTd = document.createElement('td');
        // totalInputTd.classList.add('total-data');
        // const totalInput = document.createElement('input');
        // totalInput.value = 'Total';
        // totalInput.disabled = true;
        // totalInput.name = `${type}_total`;
        // totalInputTd.appendChild(totalInput);

        const rowConfigs = {
            ap: [
                {
                    selector: `#exampleModal .inp-group-${type}-totals.TA .totals-row`,
                    label: 'Total Appropriations',
                    identifier: 'TA',
                    includeTotal: true
                },
                {
                    selector: `#exampleModal .inp-group-${type}-totals.BF .totals-row`,
                    label: 'Balance Forwarded',
                    identifier: 'BF',
                    includeTotal: true
                }
            ],
            ob: [
                {
                    selector: `#exampleModal .inp-group-${type}-totals.TO .totals-row`,
                    label: 'Total Obligations',
                    identifier: 'TO',
                    includeTotal: true
                },
                {
                    selector: `#exampleModal .inp-group-${type}-totals.OB .totals-row`,
                    label: 'Obligations Balance To Date',
                    identifier: 'OB',
                    includeTotal: true
                },
                {
                    selector: `#exampleModal .inp-group-${type}-totals.AB .totals-row`,
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
                const td = document.createElement('td');
                const input = document.createElement('input');
                input.type = 'number';
                input.name = `${type}_attr_${config.identifier}_${attr}`; // Include identifier in name
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

createTotalRows(attributes);
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

        updateDateInputs();
        //Dynamic Rows
        function addRow(type, afterElement = null) {
    const container = type === 'ap' ? apDataRowContainer : obDataRowContainer;
    const newRow = document.createElement('tr');
    newRow.classList.add(`${type}-data-row`);

    // Base cells for the row
    const baseCells = [
        createCell('input', '', { type: 'date', name: `${type}_date_data[]`, required: true }),
        createCell('input', '', { type: 'text', name: `${type}_reference_no[]`, required: false }),
        createCell('input', '', { type: 'text', name: `${type}_particulars[]`, required: false }),
        createCell('input', '', { type: 'number', name: `${type}_total[]`, step: 0.01 }, 'total-data'),
        createCell('input', '', { type: 'number', name: `${type}_salary[]`, step: 0.01 }),
        createCell('input', '', { type: 'number', name: `${type}_cash_gift[]`, step: 0.01 }),
        createCell('input', '', { type: 'number', name: `${type}_year_end[]`, step: 0.01 }),
        createCell('input', '', { type: 'number', name: `${type}_mid_year[]`, step: 0.01 }),
        createCell('input', '', { type: 'number', name: `${type}_sri[]`, step: 0.01 }),
        createCell('input', '', { type: 'number', name: `${type}_others[]`, step: 0.01 })
    ];

    baseCells.forEach(cell => newRow.appendChild(cell));

    // Add hidden counter input
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'hidden';
    hiddenInput.value = type === 'ap' ? apCounter++ : obCounter++;
    newRow.appendChild(hiddenInput);

    // Action cell
    const actionCell = document.createElement('td');
    actionCell.classList.add('action-data');
    actionCell.innerHTML = `
        <a href="#" class="add-row-${type}">+</a>
        <a href="#" class="delete">X</a>
    `;
    newRow.appendChild(actionCell);

    // Append to container
    if (afterElement) {
        afterElement.insertAdjacentElement('afterend', newRow);
    } else {
        container.appendChild(newRow);
    }

    // Delete row functionality
    actionCell.querySelector('.delete').addEventListener('click', (e) => removeRow(e, type));
}


function removeRow(event, type) {
    event.preventDefault();
    if (confirm("Are you sure you want to remove this row?")) {
        const row = event.target.closest('tr');
        if (row) {
            row.remove();
            updateCounters(type);
        }
    }
}

        document.querySelector('#exampleModal').addEventListener('click', function (event) {
        if (event.target.classList.contains('add-row-ap')) {
            event.preventDefault();
            const currentRow = event.target.closest('tr');
            addRow('ap', currentRow);
        } else if (event.target.classList.contains('add-row-ob')) {
            event.preventDefault();
            const currentRow = event.target.closest('tr');
            addRow('ob', currentRow);
        }
    });

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



<script>
           // Function to show alert
    function showAlert(message, alertClass) {
        var alertDiv = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' + message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        alertDiv.css({
            "position": "fixed",
            "top": "10px",
            "right": "10px",
            "z-index": "9999",
            "background-color": alertClass === "alert-danger" ? "#f8d7da" : "#d4edda",
            "border-color": alertClass === "alert-danger" ? "#f5c6cb" : "#c3e6cb"
        });
        $("body").append(alertDiv);
        setTimeout(function() { alertDiv.alert('close'); }, 900);
    }
    </script>
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
