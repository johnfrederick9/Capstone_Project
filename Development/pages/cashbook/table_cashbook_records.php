<?php
include '../../sidebar.php';
include '../../head.php';
require '../../database.php';
?>


<style>
.column-titles {
  display: grid;
  grid-template-columns: auto repeat(14, 1fr);
  gap: 5px; 
  font-weight: bold;
  margin-bottom: 5px; 
  font-size: small;
}
span {
  text-align: center; 
}
.wrap{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    margin-bottom: 40px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e4e1e1;
}
.add{
  text-decoration: none;
  display: inline-block;
  width:30px;
  height: 30px;
  background: #8bc34a;
  font-size: 2rem;
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
}
.flex{
    display: grid;
    grid-template-columns: auto repeat(14, 1fr);
    gap:10px;
    margin-bottom: 15px;
}
.inp-group-add, .inp-group-up{
    height: 110px;
    overflow: auto;
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
    margin-left: auto;
    display: flex;
    justify-content:center;
    align-items: center;
    cursor: pointer;
}
.transaction .modal-dialog{
    max-width: 95% !important;
    max-height: 95% !important;
    overflow-y: auto;
}


.tb-cashbook-container{
    max-height: 440px;
    overflow-y: auto; /* Enables vertical scrolling if content overflows */
    border: 3px solid #000; /* Optional: adds border around the table container */
    border-radius: 8px; /* Optional: adds rounded corners */
    margin: 20px;
}

/* .cashbook-container {
    width: 100%;
    margin: 0 auto;
    padding: 5px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow-x: auto; /* Ensures table doesn't overflow horizontally
} */

.cashbook-header {
    text-align: center;
    margin-bottom: 20px;
}

.cashbook-header .details {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.details .info {
    margin: 0 10px;
}

.transaction .modal-dialog{
  max-width: 95% !important;
}

.cashbook-table {
    width: 100%; /* Ensures the table fills the width of the container */
    max-width: 100%; /* Prevents it from overflowing */
    border-collapse: collapse;
    table-layout: fixed;
    border: 3px solid #000;
    max-height: 100%;
}

.cashbook-table thead{
    position: sticky;
    top: 0; /* Keeps the header at the top */
    z-index: 1; /* Ensures header is above table rows */
    border-bottom: 2px solid #ddd;
    box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1);
}

/* #exampleModal .cashbook-table tbody{
    max-height: 375px;
    overflow-y: auto; 
    width: 100%;
    overflow-x: hidden;
}  */


.cashbook-table th, .cashbook-table td {
    border: 1px solid #000;
    padding: 5px;
    text-align: center;
    box-sizing: border-box; /* Ensures padding is included within the element width */
}

.cashbook-table th {
    background-color: #9ddfad; /* Background color for headers */
    text-align: center; /* Center text in headers */
    padding: 10px; /* Padding for header cells */
    position: sticky;
    z-index: 1;
}

.details input[type="text"], 
.details input[type="date"] {
    width: 100%;           /* Full width */
    padding: 5px;         /* Padding for better spacing */
    border: none;         /* Remove borders */
    background: none;     /* Ensure background is transparent (if needed) */
    outline: none;        /* Remove outline on focus */         /* Prevent resizing if desired */
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
    min-height: 20px;
    height: auto;/* Same for all cash category columns */
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
    border: 1px solid black; /* Same for all cash category columns */
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

/*
#exampleModal .cashbook-table thead {
    display: table;
    width: 100%;
}

#exampleModal .cashbook-table tbody{
    display: block;
    max-height: 300px;
    overflow-y: auto; 
    width: 100%;
    overflow-x: hidden;
} 

*/

/* Action button styles */
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

/* Disabled state styles */
.cashbook-table input {
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

/* For text inputs that might contain longer content */
.cashbook-table input[type="text"] {
    text-overflow: ellipsis;
    min-height: 20px;
    height: auto;
}

/* Optional: Add tooltip on hover for truncated text */
.cashbook-table input[type="text"]:hover {
    overflow: visible;
    white-space: normal;
    height: auto;
    z-index: 1;
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
.action-buttons {
    display: flex; /* Use flexbox for alignment */
    justify-content: center; /* Center the buttons horizontally */
    align-items: center; /* Center the buttons vertically */
}

.action-buttons .add a{
    margin: 0 5px; /* Add some spacing between buttons */
    padding: 5px 10px; /* Add padding to buttons */
    border: 1px solid #007bff; /* Add border for button */
    border-radius: 4px; /* Round the corners of the buttons */
    text-decoration: none; /* Remove underline from links */
    background-color: #f8f9fa; /* Background color */
    text-decoration: none;
    display: inline-block;
    background: #8bc34a;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background-color 0.2s; /* Smooth background change */
}

.action-buttons a:hover {
    background-color: #007bff; /* Change background color on hover */
    color: white; /* Change text color on hover */
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

/* Initially hide all group columns */
.hide-cash-treasury .cash-treasury,
.hide-cash-treasury input[name^="clt_"],

.hide-cash-bank .cash-bank,
.hide-cash-bank input[name^="cb_"],

.hide-cash-advance .cash-advance,
.hide-cash-advance input[name^="ca_"],

.hide-petty-cash .petty-cash,
.hide-petty-cash input[name^="pcf_"] {
    display: none;
}

/*Initially hide all group columns
.cash-treasury{
    background-color: #44dc83 !important;
}

.cash-bank {
    background-color: #1ca46b !important; 
}

.cash-advance {
    background-color: #808080; 
}

.petty-cash {
    background-color: #808080; 
}*/

/* Default button styles */
button[data-group] {
    transition: background-color 0.2s ease;
    padding: 8px 16px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
}

/* Active state (displayed) */
button[data-group].active {
    background-color: #4CAF50;  /* Green */
    color: white;
}

/* Inactive state (hidden) */
button[data-group]:not(.active) {
    background-color: #808080;  /* Gray */
    color: white;
}

.toggle-section select {
    min-width: 200px;
    padding: 8px;
}

.toggle-section option {
    padding: 8px;
}
.form-select{
    background-color: #9ddfad;
}
/* 
#viewDataTable tbody.inp-group-view tr:nth-child(odd) td {
    background-color: #05bc34;
}

#viewDataTable tbody.inp-group-view tr:nth-child(even) td {
    background-color: #C6E7CE; 
}*/

</style>
<body>
    <section class="home">  
        <div class="inventory">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Cashbook</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#initModal" class="add-table-btn">Beginning Balance</button>
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn">+ Add Item</button>
                            <!--<button class="print-btn" title="Print">
                                <i class="bx bx-printer"></i>
                            </button>-->
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Period Covered(YYYY-MM-DD)</th>
                        <th>Treasurer Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#example').DataTable({
                                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                                    $(nRow).attr('id', aData[0]);
                                    $(nRow).find('.deleteBtn').attr('data-cashbook-id', aData[0]);
                                    $(nRow).find('.infoBtn').attr('data-item-id', aData[0]);
                                },
                                'serverSide': 'true',
                                'processing': 'true',
                                'paging': 'true',
                                'order': [],
                                'ajax': {
                                    'url': 'fetch_data.php',
                                    'type': 'post',
                                },
                                "aoColumnDefs": [
                                {
                                    "targets": [0],  
                                    "visible": false, 
                                    "searchable": false, 
                                },
                                {
                                    "bSortable": false,
                                    "aTargets": [3]
                                },

                                ]
                            });
                        });
                        $(document).on('submit', '#addUser', function(e) {
                            e.preventDefault();

                            // Initialize FormData directly from the form
                            var formData = new FormData(this);

                            var period_covered = $('#periodcovered').val();
                            var treasurer_name = $('#treasurername').val();
                            var clt_init_balance = $('#cltinitbalance').val();
                            var cb_init_balance = $('#cbinitbalance').val();

                            // Collect ap array data
                            var add_counter = $('#addUserModal input[name="add_counter[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            var date_data = $('#addUserModal input[name="date_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var particulars_1 = $('#addUserModal input[name="particulars_1[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var particulars_2 = $('#addUserModal input[name="particulars_2[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            var reference_1 = $('#addUserModal input[name="reference_1[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var reference_2 = $('#addUserModal input[name="reference_2[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var clt_in_data = $('#addUserModal input[name="clt_in_data[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            var clt_out_data = $('#addUserModal input[name="clt_out_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var cb_in_data = $('#addUserModal input[name="cb_in_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var cb_out_data = $('#addUserModal input[name="cb_out_data[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            var ca_receipt_data = $('#addUserModal input[name="ca_receipt_data[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            var ca_disbursement_data = $('#addUserModal input[name="ca_disbursement_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var pcf_receipt_data = $('#addUserModal input[name="pcf_receipt_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var pcf_payments_data = $('#addUserModal input[name="pcf_payments_data[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            // Append additional data (data and period covered) as JSON strings
                            formData.append('period_covered', period_covered);
                            formData.append('treasurer_name', treasurer_name);
                            formData.append('clt_init_balance', clt_init_balance);
                            formData.append('cb_init_balance', cb_init_balance);

                            formData.append('add_counter', JSON.stringify(add_counter));
                            formData.append('date_data', JSON.stringify(date_data));
                            formData.append('particulars_1', JSON.stringify(particulars_1));
                            formData.append('particulars_2', JSON.stringify(particulars_2));
                            formData.append('reference_1', JSON.stringify(reference_1));
                            formData.append('reference_2', JSON.stringify(reference_2));
                            formData.append('clt_in_data', JSON.stringify(clt_in_data));
                            formData.append('clt_out_data', JSON.stringify(clt_out_data));
                            formData.append('cb_in_data', JSON.stringify(cb_in_data));
                            formData.append('cb_out_data', JSON.stringify(cb_out_data));
                            formData.append('ca_receipt_data', JSON.stringify(ca_receipt_data));
                            formData.append('ca_disbursement_data', JSON.stringify(ca_disbursement_data));
                            formData.append('pcf_receipt_data', JSON.stringify(pcf_receipt_data));
                            formData.append('pcf_payments_data', JSON.stringify(pcf_payments_data));

                            console.log("Period Covered: ", period_covered);
                            console.log("Treasurer Name: ", treasurer_name);
                            console.log("clt_init_balance: ", clt_init_balance);
                            console.log("cb_init_balance: ", cb_init_balance);


                            // Check if all required fields are filled
                            if (period_covered !== '' &&  treasurer_name !== '' && clt_init_balance !== '' && 
                                cb_init_balance !== '' ) {
                                
                                // Submit the form data using AJAX
                                $.ajax({
                                    url: "add.php",  // Server-side script to process form data
                                    type: "post",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        console.log(data);
                                        var json = JSON.parse(data);
                                        console.log(json);
                                        var status = json.status;
                                        var message = json.message;
                                        console.log("Status:", status);
                                        console.log("mESSAGE:", message);
                                        
                                        if (status == 'true') {
                                            mytable = $('#example').DataTable();
                                            mytable.draw();
                                            $('#addUserModal').modal('hide');
                                            $('#addUserModal input').val('');
                                            $('.inp-group-view').empty();

                                        } else {
                                            alert(message||'Failed to submit data');
                                        }
                                    }
                                });
                            } else {
                                alert('Please fill all the required fields');
                            }
                        });

                        $(document).on('submit', '#updateUser', function(e) {
                            e.preventDefault();

                            // Collect values from the form
                            // Initialize FormData directly from the form
                            var formData = new FormData(this);
                            var trid = $('#trid').val();
                            var cashbook_id = $('#cashbook_id').val();
                            console.log(trid);


                            var period_covered = $('#periodcoveredField').val();
                            var treasurer_name = $('#treasurernameField').val();
                            var clt_init_balance = $('#cltinitbalanceField').val();
                            var cb_init_balance = $('#cbinitbalanceField').val();

                            // Collect ap array data
                            var cashbook_data_id = $('#exampleModal input[name="cashbook_data_id[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            var up_counter = $('#exampleModal input[name="up_counter[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            var date_data = $('#exampleModal input[name="date_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var particulars_1 = $('#exampleModal input[name="particulars_1[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var particulars_2 = $('#exampleModal input[name="particulars_2[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            var reference_1 = $('#exampleModal input[name="reference_1[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var reference_2 = $('#exampleModal input[name="reference_2[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var clt_in_data = $('#exampleModal input[name="clt_in_data[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            var clt_out_data = $('#exampleModal input[name="clt_out_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var cb_in_data = $('#exampleModal input[name="cb_in_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var cb_out_data = $('#exampleModal input[name="cb_out_data[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            var ca_receipt_data = $('#exampleModal input[name="ca_receipt_data[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            var ca_disbursement_data = $('#exampleModal input[name="ca_disbursement_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var pcf_receipt_data = $('#exampleModal input[name="pcf_receipt_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var pcf_payments_data = $('#exampleModal input[name="pcf_payments_data[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            // Append additional data (data and period covered) as JSON strings
                            formData.append('period_covered', period_covered);
                            formData.append('treasurer_name', treasurer_name);
                            formData.append('clt_init_balance', clt_init_balance);
                            formData.append('cb_init_balance', cb_init_balance);
                            formData.append('trid', trid);


                            formData.append('cashbook_data_id', JSON.stringify(cashbook_data_id));
                            formData.append('up_counter', JSON.stringify(up_counter));
                            formData.append('date_data', JSON.stringify(date_data));
                            formData.append('particulars_1', JSON.stringify(particulars_1));
                            formData.append('particulars_2', JSON.stringify(particulars_2));
                            formData.append('reference_1', JSON.stringify(reference_1));
                            formData.append('reference_2', JSON.stringify(reference_2));
                            formData.append('clt_in_data', JSON.stringify(clt_in_data));
                            formData.append('clt_out_data', JSON.stringify(clt_out_data));
                            formData.append('cb_in_data', JSON.stringify(cb_in_data));
                            formData.append('cb_out_data', JSON.stringify(cb_out_data));
                            formData.append('ca_receipt_data', JSON.stringify(ca_receipt_data));
                            formData.append('ca_disbursement_data', JSON.stringify(ca_disbursement_data));
                            formData.append('pcf_receipt_data', JSON.stringify(pcf_receipt_data));
                            formData.append('pcf_payments_data', JSON.stringify(pcf_payments_data));

                            if (period_covered !== '' &&  treasurer_name !== '' && clt_init_balance !== '' && 
                                cb_init_balance !== '' ) {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;

                                        if (status == 'true') {
                                            var table = $('#example').DataTable();
                                            var button = `
                                                <td>
                                                    <div class="buttons">
                                                        <a href="javascript:void();" data-id="${cashbook_id}" class="update-btn btn-sm editbtn"><i class="bx bx-sync"></i></a>
                                                        <a href="!#" data-cashbook_id="${cashbook_id}" class="delete-btn btn-sm deleteBtn"><i class="bx bxs-trash"></i></a>
                                                    </div>
                                                </td>
                                            `;
                                            var row = table.row("[id='" + trid + "']");
                                            row.data([trid, period_covered, treasurer_name, button]).draw(); // Don't call row.row again

                                            // Close the modal
                                            $('#exampleModal').modal('hide');
                                        } else {
                                            alert('Update failed: ' + (json.error || 'Unknown error'));
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("AJAX Error: " + status + ": " + error);
                                        alert("An error occurred while updating data.");
                                    }
                                });
                            } else {
                                alert('Please fill all the required fields');
                            }
                        });

                        

                        $('#example').on('click', '.editbtn', function(event) {
                            var table = $('#example').DataTable();
                            var trid = $(this).closest('tr').attr('id');
                            var cashbook_id = $(this).data('id');

                            $('#cashbook_id').val(cashbook_id);
                            $('#trid').val(trid);
                            $('#exampleModal').modal('show');

                            $('.inp-group-view').empty();

                            // $('#clt_last_balance').val('');
                            // $('#cb_last_balance').val('');
                            // $('#ca_last_balance').val('');
                            // $('#pcf_last_balance').val('');
                            window.upCounter = 1; // Initialize the counter

                           $.ajax({
                                url: "get_single_data.php",
                                data: { cashbook_id: cashbook_id },
                                type: 'post',
                                success: function(data) {
                                    try {
                                        var json = JSON.parse(data);
                                        console.log("Full Data:", json); // Log the entire JSON response

                                        if (json.status === 'true') {
                                            var record = json.record; // Access the cashbook record
                                            var cashbookData = json.cashbook_data; // Access the associated data
                                            console.log(cashbookData); // Log the associated data

                                            $('#periodcoveredField').val(record.period_covered);
                                            $('#treasurernameField').val(record.treasurer_name);
                                            $('#cltinitbalanceField').val(record.clt_init_balance);
                                            $('#cbinitbalanceField').val(record.cb_init_balance);

                                        // Populate input fields with associated records
                                        cashbookData.forEach(function(cData) {
                                            const inputGroupRow = `
                                               <tr>
                                                    <td class="hidden"><input type="hidden" name="up_counter[]" value="${window.upCounter}"></td>
                                                    <td class="hidden"><input type="hidden" name="cashbook_data_id[]" value="${cData.cashbook_data_id}"></td>
                                                    <td><input type="date" name="date_data[]" value="${cData.date_data}"></td>
                                                    <td><input type="text" name="particulars_1[]" value="${cData.particulars_1}" ></td>
                                                    <td><input type="text" name="particulars_2[]" value="${cData.particulars_2}"></td>
                                                    <td><input type="text" name="reference_1[]" value="${cData.reference_1}"></td>
                                                    <td><input type="text" name="reference_2[]" value="${cData.reference_2}"></td>
                                                    <td><input type="number" name="clt_in_data[]" value="${cData.clt_in}" step="0.01"></td>
                                                    <td><input type="number" name="clt_out_data[]" value="${cData.clt_out}" step="0.01"></td>
                                                    <td><input type="number" name="clt_balance[]" value="${cData.clt_balance}" step="0.01" disabled ></td>
                                                    <td><input type="number" name="cb_in_data[]" value="${cData.cb_in}" step="0.01"></td>
                                                    <td><input type="number" name="cb_out_data[]" value="${cData.cb_out}" step="0.01"></td>
                                                    <td><input type="number" name="cb_balance[]" value="${cData.cb_balance}" step="0.01" disabled></td>
                                                    <td><input type="number" name="ca_receipt_data[]" value="${cData.ca_receipt}" step="0.01"></td>
                                                    <td><input type="number" name="ca_disbursement_data[]" value="${cData.ca_disbursement}" step="0.01"></td>
                                                    <td><input type="number" name="ca_balance[]" value="${cData.ca_balance}" step="0.01" disabled></td>
                                                    <td><input type="number" name="pcf_receipt_data[]" value="${cData.pcf_receipt}" step="0.01"></td>
                                                    <td><input type="number" name="pcf_payments_data[]" value="${cData.pcf_payments}" step="0.01"></td>
                                                    <td><input type="number" name="pcf_balance[]" value="${cData.pcf_balance}" step="0.01" disabled></td>
                                                </tr>`;
                                            $('#exampleModal #viewDataTable tbody.inp-group-view').append(inputGroupRow);
                                            window.upCounter++; // Increment the counter for the next row
                                        });
                                          // Apply visibility based on current toggle state
                                            const currentGroup = $('#sectionToggle2').val();
                                            $('#exampleModal #viewDataTable tbody.inp-group-view tr').each(function() {
                                                const row = $(this);
                                                row.find('td:has(input[name^="clt_"]), td:has(input[name^="cb_"]), td:has(input[name^="ca_"]), td:has(input[name^="pcf_"])').addClass('hidden');
                                                
                                                switch(currentGroup) {
                                                    case 'cashTreasury':
                                                        row.find('td:has(input[name^="clt_"])').removeClass('hidden');
                                                        break;
                                                    case 'cashBank':
                                                        row.find('td:has(input[name^="cb_"])').removeClass('hidden');
                                                        break;
                                                    case 'cashAdvance':
                                                        row.find('td:has(input[name^="ca_"])').removeClass('hidden');
                                                        break;
                                                    case 'pettyCash':
                                                        row.find('td:has(input[name^="pcf_"])').removeClass('hidden');
                                                        break;
                                                }
                                            });
                                        } else {
                                            console.error('Error in JSON response:', json.message);
                                        }
                                    } catch (e) {
                                        console.error("Failed to parse JSON:", e);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("AJAX Error: " + status + ": " + error);
                                    alert("An error occurred while fetching data.");
                                }
                            });
                        });

                        document.addEventListener('DOMContentLoaded', function () {
                            let modalInitialized = false;
                            let addInputHandler;
                            window.cashbookFunctions = {};

                            $('#exampleModal').on('shown.bs.modal', function () { 
                                if (!modalInitialized) {
                                    initializeModal();
                                    modalInitialized = true;
                                    
                                }
  
                            });

                            $('#exampleModal').on('hidden.bs.modal', function () {
                                modalInitialized = false;
                                // Clear input fields
                                $('#exampleModal input').val('');
                                // Remove dynamically added rows
                                $('#exampleModal .inp-group-view tr:not(:first)').remove();
                                if (addInputHandler) {
                                    const addButton = document.querySelector('#exampleModal .modal-footer .add');
                                    addButton.removeEventListener('click', addInputHandler);
                                }

                                //for individual bu
                                // // Set active state immediately
                                // const modalButtons = document.querySelectorAll('#exampleModal button[data-group][data-modal-id]');
                                // modalButtons.forEach(button => {
                                //     button.classList.add('active');
                                // });
                                
                                // // Clear all hiding classes immediately
                                // const table = document.querySelector('#exampleModal #viewDataTable');
                                // table.classList.remove('hide-cash-treasury', 'hide-cash-bank', 'hide-cash-advance', 'hide-petty-cash');


                            });

                            let FunctionForModal2;
                            function initializeModal() {
                                console.log('Modal 2 is triggered');

                                
                                if (!FunctionForModal2) {
                                FunctionForModal2 = function() {
                                    window.upCounter = document.querySelectorAll('#exampleModal #viewDataTable tbody.inp-group-view tr').length + 1;
                                    console.log("Window Upcounter value: ", window.upCounter);
                                    const periodCoveredInput = document.querySelector('#periodcoveredField');
                                    const inpGroup = document.querySelector('#exampleModal .inp-group-view');


                                    // Function to format date as YYYY-MM-DD
                                    function formatDate(date) {
                                        return date.toISOString().split('T')[0];
                                    }

                                    // Function to get the last day of a month
                                    function getLastDayOfMonth(year, month) {
                                        return new Date(year, month + 1, 0).getDate();
                                    }

                                    // Update min and max attributes for date inputs based on the selected period
                                    function updateDateInputs() {
                                        const selectedDate = new Date(periodCoveredInput.value);
                                        if (isNaN(selectedDate.getTime())) return; // No valid date selected

                                        const month = selectedDate.getMonth(); // 0-based month
                                        const year = selectedDate.getFullYear();

                                        const startOfMonth = new Date(year, month, 2);
                                        const lastDay = getLastDayOfMonth(year, month);
                                        const endOfMonth = new Date(year, month, lastDay+1);

                                        const minDate = formatDate(startOfMonth);
                                        const maxDate = formatDate(endOfMonth);

                                        const dateInputs = document.querySelectorAll('#exampleModal input[name="date_data[]"]');
                                        dateInputs.forEach(input => {
                                            input.setAttribute('min', minDate);
                                            input.setAttribute('max', maxDate);

                                            // Validate the input value
                                        // Validate the input value only if it exists
                                            if (input.value) {
                                                const currentDate = new Date(input.value);
                                                if (currentDate < startOfMonth || currentDate > endOfMonth) {
                                                    // You can choose to alert the user instead of clearing the value
                                                    console.log(`Date ${input.value} is outside the valid range.`);
                                                }
                                            }
                                        });
                                    }

                                    // Event listener for period covered input change
                                    periodCoveredInput.addEventListener('change', updateDateInputs);

                                    addInputHandler = function(event) {
                                            event.preventDefault();
                                            addInput();
                                            updateDateInputs();
                                            updateAllRowBalances();
                                        };

                                        // Add event listener for adding new input groups
                                        const addButton = document.querySelector('#exampleModal .modal-footer .add');
                                        addButton.addEventListener('click', addInputHandler);

                                    // // Add event listener for adding new input groups
                                    // document.querySelector('#exampleModal  .modal-footer .add').addEventListener('click', function(event) {
                                    //     event.preventDefault();
                                    //     addInput();
                                    //     updateDateInputs(); // Ensure new inputs are validated
                                    // });

                                    // Initial call to set the correct date range
                                    updateDateInputs();

                                    // Remove an input group
                                    function removeInput(event) {
                                        event.preventDefault(); // Prevent default link behavior
                                        if (confirm("Are you sure you want to remove this row?")) {
                                            // Remove the closest .flex (the group containing the inputs)
                                            const inputGroup = event.target.closest('#exampleModal tr');
                                            if (inputGroup) {
                                                inputGroup.remove();
                                                update_up_Counter();
                                            }
                                        }
                                    }

                                    // Function to update the counters after a row is removed
                                    function update_up_Counter() {
                                        const rows = document.querySelectorAll("#exampleModal .inp-group-view tr");
                                        let updatedCounter = 1;  // Start counter from 1

                                        rows.forEach(function(row) {
                                            const hiddenInput = row.querySelector("input[name='up_counter[]']");
                                            // Update the hidden input value to match the new counter
                                            if (hiddenInput) {
                                                hiddenInput.value = updatedCounter; // Update hidden input value
                                            }

                                            updatedCounter++;  // Increment counter for the next row
                                        });

                                        // Update global counter to match the number of rows
                                        window.upCounter = updatedCounter;
                                    }

                                    // Update all existing rows
                                    function updateExistingRows() {
                                        const existingRows = $('#exampleModal #viewDataTable tbody.inp-group-view tr');
                                        console.log(`Total existing rows: ${existingRows.length}`);
                                        existingRows.each((index, row) => {
                                            console.log(`Processing Row Number: ${index + 1}`);
                                            setupRowEventListeners(row);
                                        });
                                    }

                                    // Add event listeners to the initial balance fields
                                    $('#cltinitbalanceField, #cbinitbalanceField').on('input', function() {
                                        updateAllBalances();
                                        updateAllRowBalances();
                                    });

                                    // Function to set up event listeners for all rows
                                    function setupAllRowEventListeners() {
                                        const rows = $('#exampleModal #viewDataTable tbody.inp-group-view tr');
                                        console.log(`Setting up listeners for ${rows.length} rows`);
                                        rows.each((index, row) => setupRowEventListeners(row));
                                    }

                                    // Function to set up event listeners for a row
                                    function setupRowEventListeners(row) {
                                        const inputFields = [
                                            'clt_in_data[]', 'clt_out_data[]',
                                            'cb_in_data[]', 'cb_out_data[]',
                                            'ca_receipt_data[]', 'ca_disbursement_data[]',
                                            'pcf_receipt_data[]', 'pcf_payments_data[]'
                                        ];

                                        inputFields.forEach(fieldName => {
                                            const input = $(row).find(`input[name="${fieldName}"]`);
                                            input.off('input').on('input', function() {
                                                updateAllBalances(row);
                                            });
                                        });
                                    }

                                    const rows1 = $('#exampleModal #viewDataTable tbody.inp-group-view tr');
                                    console.log("Fixedrows to process:", rows1.length);

                                    // Function to update all balances
                                    function updateAllBalances(startRow = null) {
                                        let initial_clt_balance = parseFloat($('#cltinitbalanceField').val()) || 0;
                                        let initial_cb_balance = parseFloat($('#cbinitbalanceField').val()) || 0;

                                        let previous_clt_balance = initial_clt_balance;
                                        let previous_cb_balance = initial_cb_balance;
                                        let previous_ca_balance = 0;
                                        let previous_pcf_balance = 0;

                                        // const rows = $('#exampleModal #viewDataTable tbody.inp-group-view tr');
                                        const rows = rows1 
                                        const startIndex = startRow ? rows.index(startRow) : 0;

                                        console.log("Total rows to process:", rows.length);
                                        console.log("Starting from index:", startIndex);

                                        let lastBalances = {
                                            clt: initial_clt_balance,
                                            cb: initial_cb_balance,
                                            ca: 0,
                                            pcf: 0
                                        };

                                        // Check if there are any rows to process
                                        if (rows.length === 0) {
                                            // If no rows, set last balances to initial balances
                                            $('#exampleModal #clt_last_balance').val(lastBalances.clt.toFixed(2));
                                            $('#exampleModal #cb_last_balance').val(lastBalances.cb.toFixed(2));
                                            $('#exampleModal #ca_last_balance').val(lastBalances.ca.toFixed(2));
                                            $('#exampleModal #pcf_last_balance').val(lastBalances.pcf.toFixed(2));

                                            console.log("No rows to process. Setting last balances to initial balances.");
                                            console.log("Last CLT:", lastBalances.clt, "Last CB:", lastBalances.cb, "Last CA:", lastBalances.ca, "Last PCF:", lastBalances.pcf);

                                            return {
                                                lastBalances: lastBalances,
                                                rowCount: 0
                                            };
                                        }


                                        rows.each(function(index) {
                                            if (index < startIndex) {
                                                // For rows before the start row, just update the previous balances
                                                previous_clt_balance = parseFloat($(this).find('input[name="clt_balance[]"]').val()) || 0;
                                                previous_cb_balance = parseFloat($(this).find('input[name="cb_balance[]"]').val()) || 0;
                                                previous_ca_balance = parseFloat($(this).find('input[name="ca_balance[]"]').val()) || 0;
                                                previous_pcf_balance = parseFloat($(this).find('input[name="pcf_balance[]"]').val()) || 0;
                                            } else {
                                                console.log("Processing Index: ", index, "Row Element: ", $(this)[0]);

                                                const clt_in = parseFloat($(this).find('input[name="clt_in_data[]"]').val()) || 0;
                                                const clt_out = parseFloat($(this).find('input[name="clt_out_data[]"]').val()) || 0;
                                                const cb_in = parseFloat($(this).find('input[name="cb_in_data[]"]').val()) || 0;
                                                const cb_out = parseFloat($(this).find('input[name="cb_out_data[]"]').val()) || 0;
                                                const ca_receipt = parseFloat($(this).find('input[name="ca_receipt_data[]"]').val()) || 0;
                                                const ca_disbursement = parseFloat($(this).find('input[name="ca_disbursement_data[]"]').val()) || 0;
                                                const pcf_receipt = parseFloat($(this).find('input[name="pcf_receipt_data[]"]').val()) || 0;
                                                const pcf_payments = parseFloat($(this).find('input[name="pcf_payments_data[]"]').val()) || 0;

                                                console.log("Previous CLT balance: ", previous_clt_balance, " Clt in: ", clt_in, " Clt out: ", clt_out);

                                                // Calculate current balances
                                                const current_clt_balance = previous_clt_balance + clt_in - clt_out;
                                                const current_cb_balance = previous_cb_balance + cb_in - cb_out;
                                                const current_ca_balance = previous_ca_balance + ca_receipt - ca_disbursement;
                                                const current_pcf_balance = previous_pcf_balance + pcf_receipt - pcf_payments;

                                                // Update the current row's balance fields
                                                $(this).find('input[name="clt_balance[]"]').val(current_clt_balance.toFixed(2));
                                                $(this).find('input[name="cb_balance[]"]').val(current_cb_balance.toFixed(2));
                                                $(this).find('input[name="ca_balance[]"]').val(current_ca_balance.toFixed(2));
                                                $(this).find('input[name="pcf_balance[]"]').val(current_pcf_balance.toFixed(2));

                                                // Update previous balances for the next iteration
                                                previous_clt_balance = current_clt_balance;
                                                previous_cb_balance = current_cb_balance;
                                                previous_ca_balance = current_ca_balance;
                                                previous_pcf_balance = current_pcf_balance;

                                                // Update lastBalances object
                                                lastBalances.clt = current_clt_balance;
                                                lastBalances.cb = current_cb_balance;
                                                lastBalances.ca = current_ca_balance;
                                                lastBalances.pcf = current_pcf_balance;

                                                // At the end of the function, after processing all rows:
                                                $('#exampleModal #clt_last_balance').val(lastBalances.clt.toFixed(2));
                                                $('#exampleModal #cb_last_balance').val(lastBalances.cb.toFixed(2));
                                                $('#exampleModal #ca_last_balance').val(lastBalances.ca.toFixed(2));
                                                $('#exampleModal #pcf_last_balance').val(lastBalances.pcf.toFixed(2));

                                                console.log("Last CLT:", lastBalances.clt, "Last CB:", lastBalances.cb, "Last CA:", lastBalances.ca, "Last PCF:", lastBalances.pcf);

                                            }
                                        });
                                        return {
                                            lastBalances: lastBalances,
                                            rowCount: rows.length
                                        };
                                        
                                    }

                                    const table_result = updateAllBalances();
                                    let rowCount = table_result.rowCount;
                                    let lastCLTBalance = table_result.lastBalances.clt;
                                    let lastCBBalance = table_result.lastBalances.cb;
                                    let lastCABalance = table_result.lastBalances.ca;
                                    let lastPCFBalance = table_result.lastBalances.pcf;

                                    console.log("Returned Rows:", table_result.rowCount);
                                    // Call this function after populating the table
                                    updateExistingRows();

                                    

                                    // Add a new input group
                                    function addInput(afterElement = null) {
                                        //for individual buttons
                                        // const table = document.querySelector(`#exampleModal #viewDataTable`);
                                        // const hiddenGroups = {
                                        //     cashTreasury: table.classList.contains('hide-cash-treasury'),
                                        //     cashBank: table.classList.contains('hide-cash-bank'),
                                        //     cashAdvance: table.classList.contains('hide-cash-advance'),
                                        //     pettyCash: table.classList.contains('hide-petty-cash')
                                        // };


                                        //for dropdown
                                         //for the dropdown
                                         const table = document.querySelector('#exampleModal #viewDataTable');
                                        const hiddenGroups = {
                                            cashTreasury: table.classList.contains('hide-cash-treasury'),
                                            cashBank: table.classList.contains('hide-cash-bank'),
                                            cashAdvance: table.classList.contains('hide-cash-advance'),
                                            pettyCash: table.classList.contains('hide-petty-cash')
                                        };

                                        const newRow = document.createElement("tr");

                                        console.log("Add Input is triggered");

                                        const cells = [
                                            createCell('input', '', {type: 'date', name: 'date_data[]', required: true}),
                                            createCell('input', '', {type: 'text', name: 'particulars_1[]' , required: false}),
                                            createCell('input', '', {type: 'text', name: 'particulars_2[]', required: false}),
                                            createCell('input', '', {type: 'text', name: 'reference_1[]' ,required: false}),
                                            createCell('input', '', {type: 'text', name: 'reference_2[]' ,required: false}),
                                            createCell('input', '', {type: 'number', name: 'clt_in_data[]', required: false,  step: "0.01", value: 0}),
                                            createCell('input', '', {type: 'number', name: 'clt_out_data[]', required: false,  step: "0.01", value: 0}),
                                            createCell('input', '', {type: 'number', name: 'clt_balance_data[]', required: false, step: "0.01",  value: 0, disabled: true}),
                                            createCell('input', '', {type: 'number', name: 'cb_in_data[]', required: false,  step: "0.01", value: 0}),
                                            createCell('input', '', {type: 'number', name: 'cb_out_data[]', required: false,  step: "0.01", value: 0}),
                                            createCell('input', '', {type: 'number', name: 'cb_balance_data[]', required: false,  step: "0.01",  value: 0, disabled: true}),
                                            createCell('input', '', {type: 'number', name: 'ca_receipt_data[]', required: false,  step: "0.01", value: 0}),
                                            createCell('input', '', {type: 'number', name: 'ca_disbursement_data[]', required: false, step: "0.01", value: 0}),
                                            createCell('input', '', {type: 'number', name: 'ca_balance_data[]', required: false,  step: "0.01",  value: 0, disabled: true}),
                                            createCell('input', '', {type: 'number', name: 'pcf_receipt_data[]', required: false, step: "0.01", value: 0}),
                                            createCell('input', '', {type: 'number', name: 'pcf_payments_data[]', required: false,  step: "0.01", value: 0}),
                                            createCell('input', '', {type: 'number', name: 'pcf_balance_data[]', required: false,  step: "0.01",  value: 0, disabled: true}),
                                            // ... create cells for all other inputs ...
                                        ];

                                        setupRowEventListeners(newRow);
                                        //fpr individual buttons
                                    //     cells.forEach((cell, index) => {
                                    //     // Add appropriate hidden classes based on the input name
                                    //     const inputName = cell.querySelector('input')?.name;
                                    //     if (inputName) {
                                    //         if (hiddenGroups.cashTreasury && inputName.startsWith('clt_')) {
                                    //             cell.classList.add('hidden');
                                    //         }
                                    //         if (hiddenGroups.cashBank && inputName.startsWith('cb_')) {
                                    //             cell.classList.add('hidden');
                                    //         }
                                    //         if (hiddenGroups.cashAdvance && inputName.startsWith('ca_')) {
                                    //             cell.classList.add('hidden');
                                    //         }
                                    //         if (hiddenGroups.pettyCash && inputName.startsWith('pcf_')) {
                                    //             cell.classList.add('hidden');
                                    //         }
                                    //     }
                                    //     newRow.appendChild(cell);
                                    // });

                                    //for dropdown
                                    cells.forEach((cell, index) => {
                                        const inputName = cell.querySelector('input')?.name;
                                        if (inputName) {
                                            if (hiddenGroups.cashTreasury && inputName.startsWith('clt_')) {
                                                cell.classList.add('hidden');
                                            }
                                            if (hiddenGroups.cashBank && inputName.startsWith('cb_')) {
                                                cell.classList.add('hidden');
                                            }
                                            if (hiddenGroups.cashAdvance && inputName.startsWith('ca_')) {
                                                cell.classList.add('hidden');
                                            }
                                            if (hiddenGroups.pettyCash && inputName.startsWith('pcf_')) {
                                                cell.classList.add('hidden');
                                            }
                                        }
                                        newRow.appendChild(cell);
                                    });

                                        // Create action buttons
                                        const hiddenInput = document.createElement('input');
                                        hiddenInput.type = 'hidden';
                                        hiddenInput.name = 'up_counter[]';
                                        hiddenInput.value = window.upCounter;
                                        newRow.appendChild(hiddenInput);

                                        const actionCell = document.createElement('td');
                                        actionCell.classList.add('action-buttons');
                                        actionCell.innerHTML = `
                                            <a href="#" class="add">+</a>
                                            <a href="#" class="delete">X</a>
                                        `;
                                        newRow.appendChild(actionCell);

                                        console.log("Received Rows:", rowCount);

                                        // Add event listeners for calculating clt balance
                                        const cltInInput = newRow.querySelector('input[name="clt_in_data[]"]');
                                        const cltOutInput = newRow.querySelector('input[name="clt_out_data[]"]');
                                        const cltBalanceInput = newRow.querySelector('input[name="clt_balance_data[]"]');

                                        cltInInput.addEventListener('input', updateCLTBalances);
                                        cltOutInput.addEventListener('input', updateCLTBalances);

                                        const cltLastBalanceInput = document.getElementById('clt_last_balance');
                                        cltLastBalanceInput.addEventListener('change', updateCLTBalances);


                                        function updateCLTBalances() {
                                            // Get the latest initial balance
                                            const initialBalance = parseFloat(cltLastBalanceInput.value) || 0; // Default to 0 if NaN
                                            const rows = document.querySelectorAll("#exampleModal .inp-group-view tr"); // Get all rows
                                            let previousBalance = initialBalance; // Start with the initial balance

                                            rows.forEach((row) => {
                                                const cltInInput = row.querySelector('input[name="clt_in_data[]"]');
                                                const cltOutInput = row.querySelector('input[name="clt_out_data[]"]');
                                                const balanceInput = row.querySelector('input[name="clt_balance_data[]"]');

                                                if (cltInInput && cltOutInput && balanceInput) {
                                                    const cltInValue = parseFloat(cltInInput.value) || 0; // CLT In
                                                    const cltOutValue = parseFloat(cltOutInput.value) || 0; // CLT Out

                                                    // Calculate new balance
                                                    const newBalance = previousBalance + cltInValue - cltOutValue; 
                                                    balanceInput.value = newBalance.toFixed(2);// Update balance input

                                                    // Update previousBalance for the next iteration
                                                    previousBalance = parseFloat(newBalance.toFixed(2));
                                                    // Log for debugging
                                                    //#cbinitbalance$(this).find('input[name="clt_balance_data[]"]').val(newBalance.toFixed(2));
                                                    // Alert if the balance is negative
                                                    if (newBalance < 0) {
                                                        alert('Warning: A Cash in Local Treasury Balance is negative! Please check your inputs.');
                                                    }
                                                }
                                            });
                                        }

                                        // Add event listeners for calculating cb balance
                                        const cbInInput = newRow.querySelector('input[name="cb_in_data[]"]');
                                        const cbOutInput = newRow.querySelector('input[name="cb_out_data[]"]');
                                        const cbBalanceInput = newRow.querySelector('input[name="cb_balance_data[]"]');

                                        cbInInput.addEventListener('input', updateCBBalances);
                                        cbOutInput.addEventListener('input', updateCBBalances);

                                        // Add event listener to the initial balance input
                                        const cbLastBalanceInput = document.getElementById('cb_last_balance');
                                        cbLastBalanceInput.addEventListener('change', updateCBBalances);

                                        function updateCBBalances() {
                                            // Get the latest initial balance
                                            const initialBalance = parseFloat(cbLastBalanceInput.value) || 0; // Default to 0 if NaN
                                            const rows = document.querySelectorAll("#exampleModal .inp-group-view tr"); // Get all rows
                                            let previousBalance = initialBalance; // Start with the initial balance

                                            rows.forEach((row) => {
                                                const cbInInput = row.querySelector('input[name="cb_in_data[]"]');
                                                const cbOutInput = row.querySelector('input[name="cb_out_data[]"]');
                                                const balanceInput = row.querySelector('input[name="cb_balance_data[]"]');

                                                if (cbInInput && cbOutInput && balanceInput) {
                                                    const cbInValue = parseFloat(cbInInput.value) || 0; // Cash In
                                                    const cbOutValue = parseFloat(cbOutInput.value) || 0; // Cash Out

                                                    // Calculate new balance
                                                    const newBalance = previousBalance + cbInValue - cbOutValue; 
                                                    balanceInput.value = newBalance.toFixed(2);// Update balance input

                                                    // Update previousBalance for the next iteration
                                                    previousBalance = parseFloat(newBalance.toFixed(2));
                                                    //$(this).find('input[name="cb_balance_data[]"]').val(newBalance.toFixed(2));
                                                    // Alert if the balance is negative
                                                    if (newBalance < 0) {
                                                        alert('Warning: A Cash in Bank Balance is negative! Please check your inputs.');
                                                    }
                                                }
                                            });
                                        }


                                            // Add event listeners for calculating ca balance
                                        const caInInput = newRow.querySelector('input[name="ca_receipt_data[]"]');
                                        const caOutInput = newRow.querySelector('input[name="ca_disbursement_data[]"]');
                                        const caBalanceInput = newRow.querySelector('input[name="ca_balance_data[]"]');

                                        caInInput.addEventListener('input', updateCABalances);
                                        caOutInput.addEventListener('input', updateCABalances);

                                        // Add event listener to the initial balance input
                                        const caLastBalanceInput = document.getElementById('ca_last_balance');
                                        caLastBalanceInput.addEventListener('change', updateCABalances);

                                        function updateCABalances() {
                                            let initialBalance = parseFloat(caLastBalanceInput.value) || 0;
                                            const rows = document.querySelectorAll("#exampleModal .inp-group-view tr"); // Get all rows
                                            let previousBalance = initialBalance; // Start with the initial balance

                                            rows.forEach((row) => {
                                                const caInInput = row.querySelector('input[name="ca_receipt_data[]"]');
                                                const caOutInput = row.querySelector('input[name="ca_disbursement_data[]"]');
                                                const balanceInput = row.querySelector('input[name="ca_balance_data[]"]');

                                                if (caInInput && caOutInput && balanceInput) {
                                                    const caInValue = parseFloat(caInInput.value) || 0; // Cash Advance In
                                                    const caOutValue = parseFloat(caOutInput.value) || 0; // Cash Advance Out

                                                    // Calculate new balance
                                                    const newBalance = previousBalance + caInValue - caOutValue; 
                                                    balanceInput.value = newBalance.toFixed(2);// Update balance input

                                                    // Update previousBalance for the next iteration
                                                    previousBalance = parseFloat(newBalance.toFixed(2));
                                                    //$(this).find('input[name="ca_balance_data[]"]').val(newBalance.toFixed(2));
                                                    // Alert if the balance is negative
                                                    if (newBalance < 0) {
                                                        alert('Warning: A Cash Advance Balance is negative! Please check your inputs.');
                                                    }
                                                }
                                            });
                                        }


                                        // Add event listeners for calculating pcf balance
                                        const pcfInInput = newRow.querySelector('input[name="pcf_receipt_data[]"]');
                                        const pcfOutInput = newRow.querySelector('input[name="pcf_payments_data[]"]');
                                        const pcfBalanceInput = newRow.querySelector('input[name="pcf_balance_data[]"]');

                                        pcfInInput.addEventListener('input', updatePCFBalances);
                                        pcfOutInput.addEventListener('input', updatePCFBalances);

                                        // Add event listener to the initial balance input
                                        const pcfLastBalanceInput = document.getElementById('pcf_last_balance');
                                        pcfLastBalanceInput.addEventListener('change', updatePCFBalances);

                                        function updatePCFBalances() {
                                            let initialBalance = parseFloat(pcfLastBalanceInput.value) || 0;
                                            const rows = document.querySelectorAll("#exampleModal .inp-group-view tr"); // Get all rows
                                            let previousBalance = initialBalance; // Start with the initial balance

                                            rows.forEach((row) => {
                                                const pcfInInput = row.querySelector('input[name="pcf_receipt_data[]"]');
                                                const pcfOutInput = row.querySelector('input[name="pcf_payments_data[]"]');
                                                const balanceInput = row.querySelector('input[name="pcf_balance_data[]"]');

                                                if (pcfInInput && pcfOutInput && balanceInput) {
                                                    const pcfInValue = parseFloat(pcfInInput.value) || 0; // Petty Cash In
                                                    const pcfOutValue = parseFloat(pcfOutInput.value) || 0; // Petty Cash Out

                                                    // Calculate new balance
                                                    const newBalance = previousBalance + pcfInValue - pcfOutValue; 
                                                    balanceInput.value = newBalance.toFixed(2);// Update balance input

                                                    // Update previousBalance for the next iteration
                                                    previousBalance = parseFloat(newBalance.toFixed(2));
                                                    //$(this).find('input[name="pcf_balance_data[]"]').val(newBalance.toFixed(2));

                                                    // Alert if the balance is negative
                                                    if (newBalance < 0) {
                                                        alert('Warning: A Petty Cash Balance is negative! Please check your inputs.');
                                                    }
                                                }
                                            });
                                        }


                                        // Add event listener to delete button
                                        actionCell.querySelector('.delete').addEventListener('click', function(event) {
                                            event.preventDefault();
                                            if (confirm("Are you sure you want to remove this row?")) {
                                                newRow.remove(); // Remove the row
                                                updateCLTBalances();
                                                updateCBBalances();
                                                updateCABalances();
                                                updatePCFBalances();
                                                update_up_Counter(); 
                                            }
                                        });
                                        update_up_Counter(); 

                                        actionCell.querySelector('.add').addEventListener('click', function(event) {
                                            event.preventDefault(); // Prevent default action
                                            addInput(newRow); // Call to add a new row
                                        });

                                        function initializeBalances(newRow) {
                                            // Initialize CLT Balance
                                            updateCLTBalances();
                                            
                                            // Initialize CB Balance
                                            updateCBBalances();
                                            
                                            // Initialize CA Balance
                                            updateCABalances();
                                            
                                            // Initialize PCF Balance
                                            updatePCFBalances();
                                        }

                                    
                                        // Add the new group to the form
                                        if (afterElement) {
                                        afterElement.insertAdjacentElement('afterend', newRow);
                                        } else {
                                            document.querySelector("#exampleModal .inp-group-view").appendChild(newRow);
                                        }
                                        window.upCounter++; 
                                        update_up_Counter(); 
                                        updateDateInputs();
                                        initializeBalances(newRow);

                                    }
                                    updateAllBalances();
                                    update_up_Counter(); 

                                    function createCell(elementType, textContent = '', attributes = {}) {
                                    const cell = document.createElement('td');
                                    const element = document.createElement(elementType);
                                    
                                    if (textContent) element.textContent = textContent;
                                    
                                    for (const [key, value] of Object.entries(attributes)) {
                                        element.setAttribute(key, value);
                                    }
                                    
                                    cell.appendChild(element);
                                    return cell;
                                    }

                                    function updateAllRowBalances() {
                                        console.log("Update All Row Balance is called:");
                                        const balanceTypes = [
                                            { name: 'clt', in: 'clt_in_data[]', out: 'clt_out_data[]', balance: 'clt_balance_data[]', lastBalance: 'clt_last_balance' },
                                            { name: 'cb', in: 'cb_in_data[]', out: 'cb_out_data[]', balance: 'cb_balance_data[]', lastBalance: 'cb_last_balance' },
                                            { name: 'ca', in: 'ca_receipt_data[]', out: 'ca_disbursement_data[]', balance: 'ca_balance_data[]', lastBalance: 'ca_last_balance' },
                                            { name: 'pcf', in: 'pcf_receipt_data[]', out: 'pcf_payments_data[]', balance: 'pcf_balance_data[]', lastBalance: 'pcf_last_balance' }
                                        ];

                                        balanceTypes.forEach(type => {
                                            const lastBalanceInput = document.getElementById(type.lastBalance);
                                            let initialBalance = parseFloat(lastBalanceInput.value) || 0;
                                            let previousBalance = initialBalance;

                                            // Get all rows
                                            const allRows = Array.from(document.querySelectorAll("#exampleModal .inp-group-view tr"));
                                            console.log("All Rows: ", allRows);
                                            
                                            // Get the received rows count
                                            const receivedRows = parseInt(rowCount) || 0;
                                            console.log("Received Rows: ", receivedRows);
                                            
                                            // Slice the array to get only rows after the received rows
                                            const newRows = allRows.slice(receivedRows);
                                            console.log("New Rows: ", newRows);

                                            console.log(`Starting calculations from row ${receivedRows + 1}`);

                                            newRows.forEach((row, index) => {
                                                const inInput = row.querySelector(`input[name="${type.in}"]`);
                                                const outInput = row.querySelector(`input[name="${type.out}"]`);
                                                const balanceInput = row.querySelector(`input[name="${type.balance}"]`);

                                                if (inInput && outInput && balanceInput) {
                                                    const inValue = parseFloat(inInput.value) || 0;
                                                    const outValue = parseFloat(outInput.value) || 0;

                                                    const newBalance = previousBalance + inValue - outValue;
                                                    balanceInput.value = newBalance.toFixed(2);

                                                    previousBalance = newBalance;

                                                    $(this).find(`input[name="${type.balance}"]`).val(newBalance.toFixed(2));
                                                    

                                                    if (newBalance < 0) {
                                                        alert(`Warning: A ${type.name.toUpperCase()} Balance is negative! Please check your inputs.`);
                                                    }
                                                }
                                            });
                                        });
                                    }


                                        // Add event listeners
                                        document.querySelectorAll('#exampleModal .inp-group-view input').forEach(input => {
                                            input.addEventListener('input', updateAllRowBalances);
                                        });

                                        document.querySelectorAll('#clt_last_balance, #cb_last_balance, #ca_last_balance, #pcf_last_balance, #cltinitbalanceField, #cbinitbalanceField').forEach(input => {
                                            input.addEventListener('change', (event) => {
                                                console.log("Balance field changed:", event.target.id);
                                                updateAllRowBalances();
                                            });
                                        });

                                        // Call the function initially to set up initial balances
                                        updateAllRowBalances();
                                    
                                };
                            }

                                // Call FunctionForModal2 to set up the modal
                            FunctionForModal2();
                            }
                            window.FunctionForModal2 = FunctionForModal2;
                        
                        });

                        $(document).on('click', '.deleteBtn', function(event) {
                            var table = $('#example').DataTable();
                            event.preventDefault();
                            var cashbook_id = $(this).data('cashbook_id');
                            console.log('Cashbook ID:', cashbook_id); 
                            if (confirm("Are you sure want to delete this cashbook Record ? ")) {
                                $.ajax({
                                    url: "delete.php",
                                    data: {
                                        cashbook_id: cashbook_id,
                                    },
                                    type: "post",
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        status = json.status;
                                        if (status == 'success') {
                                            $("#" + cashbook_id).closest('tr').remove();
                                        } else {
                                            alert('Failed');
                                            return;
                                        }
                                    }
                                });
                            } else {
                                return null;
                            }
                        })

                        // Function to format the period covered
                        function formatPeriodCovered(dateString) {
                            const date = new Date(dateString);
                            const month = date.toLocaleString('default', { month: 'long' }).toUpperCase();
                            const year = date.getFullYear();
                            const lastDay = new Date(year, date.getMonth() + 1, 0).getDate();
                            return `${month} 1-${lastDay}, ${year}`;
                        }

                        $('#example').on('click', '.infoBtn', function(event) {
                        let trid = $(this).closest('tr').attr('id');
                        let cashbook_id = $(this).data('item-id');

                        $('#cashbook_id').val(cashbook_id);
                        $('#trid').val(trid);
                        $('#viewDataModal').modal('show');

                        $('.inp-group-view').empty(); 
                        $('.initial-value').empty();
                        $('.ending-value').empty();
                        // Clear previous data
                        let upCounter = 1; // Initialize the counter

                        $.ajax({
                            url: "get_single_data.php",
                            data: { cashbook_id: cashbook_id },
                            type: 'post',
                            success: function(data) {
                                try {
                                    let json = JSON.parse(data);
                                    console.log("Full Data:", json);

                                    if (json.status === 'true') {
                                        let record = json.record;
                                        let cashbookData = json.cashbook_data;

                                        let formattedPeriod = formatPeriodCovered(record.period_covered);

                                        // Populate input fields with the main record data
                                        $('#periodcoveredView').val(record.period_covered);
                                        $('#treasurernameView').val(record.treasurer_name);
                                        $('#cltinitbalanceView').val(record.clt_init_balance);
                                        $('#cbinitbalanceView').val(record.cb_init_balance);

                                        $('#treasurernameCertView').text(record.treasurer_name);
                                        $('#periodcoveredCertView').text(formattedPeriod);

                                        // Append initial values for "Initial" and "Balances"
                                        const initialRow = `
                                            <tr>
                                                <td><input type="number" disabled></td>
                                                <td colspan="2"></td>
                                                <td colspan="2"><input type="text" value="Initial Balances" disabled></td>
                                                <td colspan="2"></td>
                                                <td><input type="number" name="clt_init_balance[]" value="${record.clt_init_balance}" disabled></td>
                                                <td colspan="2"></td>
                                                <td><input type="number" name="cb_init_balance[]" value="${record.cb_init_balance}" disabled></td>
                                                <td colspan="2"></td>
                                                <td><input type="number" disabled></td>
                                                <td colspan="2"></td>
                                                <td><input type="number" disabled></td>
                                            </tr>`;
                                        $('#viewDataTable tbody.initial-value').append(initialRow);

                                        const endingRow = `
                                            <tr>
                                                <td><input type="number" disabled></td>
                                                <td colspan="2"></td>
                                                <td colspan="2"><input type="text" value=" Totals" disabled></td>
                                                <td><input type="number" name="clt_end_balance[]" value="${record.clt_end_in}" disabled></td>
                                                <td><input type="number" name="clt_end_balance[]" value="${record.clt_end_out}" disabled></td>
                                                <td><input type="number" name="clt_end_balance[]" value="${record.clt_end_balance}" disabled></td>
                                                <td><input type="number" name="clt_end_balance[]" value="${record.cb_end_in}" disabled></td>
                                                <td><input type="number" name="clt_end_balance[]" value="${record.cb_end_out}" disabled></td>
                                                <td><input type="number" name="cb_end_balance[]" value="${record.cb_end_balance}" disabled></td>
                                                <td><input type="number" name="clt_end_balance[]" value="${record.ca_end_receipt}" disabled></td>
                                                <td><input type="number" name="clt_end_balance[]" value="${record.ca_end_disbursement}" disabled></td>
                                                <td><input type="number" name="clt_end_balance[]" value="${record.ca_end_balance}" disabled></td>
                                                <td><input type="number" name="clt_end_balance[]" value="${record.pcf_end_receipt}" disabled></td>
                                                <td><input type="number" name="clt_end_balance[]" value="${record.pcf_end_payments}" disabled></td>
                                                <td><input type="number" name="clt_end_balance[]" value="${record.pcf_end_balance}" disabled></td>
                                            </tr>`;
                                        $('#viewDataTable tbody.ending-value').append(endingRow);

                                        // Populate input fields with associated records
                                        cashbookData.forEach(function(cData) {
                                            const inputGroupRow = `
                                                <tr>
                                                    <td class="hidden"><input type="hidden" name="up_counter[]" value="${upCounter}"></td>
                                                    <td class="hidden"><input type="hidden" name="cashbook_data_id[]" value="${cData.cashbook_data_id}"></td>
                                                    <td><input type="date" name="date_data[]" value="${cData.date_data}" disabled></td>
                                                    <td><input type="text" name="particulars_1[]" value="${cData.particulars_1}" disabled></td>
                                                    <td><input type="text" name="particulars_2[]" value="${cData.particulars_2}" disabled></td>
                                                    <td><input type="text" name="reference_1[]" value="${cData.reference_1}" disabled></td>
                                                    <td><input type="text" name="reference_2[]" value="${cData.reference_2}" disabled></td>
                                                    <td><input type="number" name="clt_in_data[]" value="${cData.clt_in}" disabled></td>
                                                    <td><input type="number" name="clt_out_data[]" value="${cData.clt_out}" disabled></td>
                                                    <td><input type="number" name="clt_balance[]" value="${cData.clt_balance}" disabled></td>
                                                    <td><input type="number" name="cb_in_data[]" value="${cData.cb_in}" disabled></td>
                                                    <td><input type="number" name="cb_out_data[]" value="${cData.cb_out}" disabled></td>
                                                    <td><input type="number" name="cb_balance[]" value="${cData.cb_balance}" disabled></td>
                                                    <td><input type="number" name="ca_receipt_data[]" value="${cData.ca_receipt}" disabled></td>
                                                    <td><input type="number" name="ca_disbursement_data[]" value="${cData.ca_disbursement}" disabled></td>
                                                    <td><input type="number" name="ca_balance[]" value="${cData.ca_balance}" disabled></td>
                                                    <td><input type="number" name="pcf_receipt_data[]" value="${cData.pcf_receipt}" disabled></td>
                                                    <td><input type="number" name="pcf_payments_data[]" value="${cData.pcf_payments}" disabled></td>
                                                    <td><input type="number" name="pcf_balance[]" value="${cData.pcf_balance}" disabled></td>
                                                </tr>`;
                                            $('#viewDataTable tbody.inp-group-view').append(inputGroupRow);
                                            upCounter++; // Increment the counter for the next row
                                        });

                                    } else {
                                        console.error('Error in JSON response:', json.message);
                                        alert("Error: " + json.message); // Alert user if there's an error message
                                    }
                                } catch (e) {
                                    console.error("Failed to parse JSON:", e);
                                    alert("An error occurred while processing the data.");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error: " + status + ": " + error);
                                alert("An error occurred while fetching data.");
                            }
                        });
                    });

                    document.addEventListener('DOMContentLoaded', function () {
                        $('#initModal').on('show.bs.modal', function() {
                            console.log("Init Modal is Opened");
                            // AJAX request to fetch existing initial balance data
                            $.ajax({
                                url: "get_init.php", // Separate PHP file to get initial balance data
                                type: "get",
                                dataType: "json",
                                success: function(data) {
                                    if (data && data.status === 'true') {
                                        // Populate input fields with fetched data
                                        $('#cltinitField').val(data.clt_init_balance);
                                        $('#cbinitField').val(data.cb_init_balance);
                                    } else {
                                        // Clear input fields if no data is found or an error occurs
                                        $('#cltinitField').val('');
                                        $('#cbinitField').val('');
                                        console.log('No existing data found or error fetching data.');
                                    }
                                },
                                error: function() {
                                    console.log('Error fetching initial balance data.');
                                }
                            });
                        });
                    });

                    $(document).on('submit', '#initForm', function(e) {
                            e.preventDefault();
                            var clt_init = $('#cltinitField').val();
                            var cb_init = $('#cbinitField').val();
                            if (clt_init !== '' && cb_init !== '' ) {
                                $.ajax({
                                    url: "init.php",
                                    type: "post",
                                    data: {
                                        clt_init: clt_init,
                                        cb_init: cb_init,
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        if (status == 'true') {
                                            mytable = $('#example').DataTable();
                                            mytable.draw();
                                            $('#initModal').modal('hide');
                                        } else {
                                            alert('failed');
                                        }
                                    }
                                });
                            } else {
                                alert('Fill all the required fields');
                            }
                        });

                    </script>
                </section><!-- .home-->
                <!-- Modal -->
                <!-- Initial Balance-->
                <div class="modal fade" id="initModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Beginning Balance for Cash in Bank and Cash Advances</h5>
                                <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="initForm">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cltinitField">Cash in Local Treasurer Beginning Balance:</label>
                                                <input type="number" id="cltinitField" name="clt_init" step="0.01"  required>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cbinitField">Cash in Bank Beginning Balance:</label>
                                                <input type="number" id="cbinitField" name="cb_init" step="0.01" required >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- View Transaction -->
                  <section class="transaction">
                 <div class="modal fade" id="viewDataModal" tabindex="-1" aria-labelledby="viewDataModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewDataModalLabel">CASHBOOK</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="cashbook-container">
                            <!-- Header Section -->
                            <div class="cashbook-header">
                                <h1>Cashbook Record</h1>
                                <div class="details">
                                    <div class="info">
                                        <label>Barangay Treasurer:</label> <input type="text" id="treasurernameView" name="treasurer_name" disabled />
                                    </div>
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
                                        <label>Period Covered:</label> <input type="date" id = "periodcoveredView" name = "period_covered" disabled />
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
                            <!-- Action buttons -->
                            <div class="cashbook-actions">
                                <button id="print-btn">Print</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Update Transaction -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update CASHBOOK</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                    <input type="hidden" name="cashbook_id" id="cashbook_id" value="">
                                    <input type="hidden" name="trid" id="trid" value="">

                                    <input type="hidden" name="clt_last_balance" id="clt_last_balance" value="">
                                    <input type="hidden" name="cb_last_balance" id="cb_last_balance" value="">
                                    <input type="hidden" name="ca_last_balance" id="ca_last_balance" value="">
                                    <input type="hidden" name="pcf_last_balance" id="pcf_last_balance" value="">
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="periodcoveredField">Period Covered:</label>
                                        <input type="date" id="periodcoveredField" name="period_covered" required disabled>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="treasurernameField">Treasurer Name:</label>
                                            <input type="text" id="treasurernameField" name="treasurer_name" required>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cltinitbalanceField">Cash in Local Treasurer Beginning Balance:</label>
                                        <input type="number" id="cltinitbalanceField" name="clt_init_balance" step="0.01"  required disabled>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cbinitbalanceField">Cash in Bank Beginning Balance:</label>
                                        <input type="number" id="cbinitbalanceField" name="cb_init_balance" step="0.01" required disabled>
                                    </div>
                                    </div>
                                    </div>
                                    <div class = "tb-cashbook-container">
                                  <!-- Cashbook Table -->
                                  <table id = "viewDataTable" class="cashbook-table">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="hidden">Counter</th>
                                        <th rowspan="2" class="hidden">ID</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Particulars</th> <!-- Combined Particulars -->
                                        <th colspan="2">References</th>  <!-- Combined References -->

                                        <!-- For 1st Group -->
                                        <th colspan="3"  class="cash-treasury">Cash in Local Treasury</th>
                                        <!-- For 2nd Group -->
                                        <th colspan="3" class="cash-bank">Cash in Bank</th>
                                        <!-- For 3rd Group -->
                                        <th colspan="3" class="cash-advance">Cash Advances</th>
                                        <!-- For 4th Group -->
                                        <th colspan="3" class="petty-cash">Petty Cash Fund</th>
                                        <th rowspan="3">Action</th>

                                    </tr>
                                    <tr>
                                        <!-- Sub-columns for Particulars and References -->
                                        <th >Particular 1</th>
                                        <th >Particular 2</th>
                                        <th>Reference 1</th>
                                        <th>Reference 2</th>

                                         <!--1st Group-->
                                        <th class="cash-treasury">Collection</th>
                                        <th class="cash-treasury">Deposit</th>
                                        <th class="cash-treasury">Balance</th>

                                        <!--2nd Group-->
                                        <th class="cash-bank">Deposit</th>
                                        <th class="cash-bank">Check Issued</th>
                                        <th class="cash-bank">Balance</th>

                                        <!--3rd Group-->
                                        <th class="cash-advance">Receipt</th>
                                        <th class="cash-advance">Disbursement</th>
                                        <th class="cash-advance">Balance</th>

                                        <!--4th Group-->
                                        <th class="petty-cash">Receipt Replenishment</th>
                                        <th class="petty-cash">Payments</th>
                                        <th class="petty-cash">Balance</th>
                                    </tr>
                                </thead>

                                <tbody class = "inp-group-view">
                                     <!-- Dynamic rows go here -->
                                </tbody>
                                
                            </table>
                            </div>

                                <div class="modal-footer">

                                <select class="form-select" id="sectionToggle2" onchange="toggleGroup(this.value, 'exampleModal')">
                                    <option value="cashTreasury" selected>Cash in Treasury</option>
                                    <option value="cashBank">Cash in Bank</option>
                                    <option value="cashAdvance">Cash Advances</option>
                                    <option value="pettyCash">Petty Cash Fund</option>
                                </select>

                                    <!-- <button type="button" data-group="cashTreasury" data-modal-id="exampleModal">Toggle Cash in Treasury</button>
                                    <button type="button" data-group="cashBank" data-modal-id="exampleModal">Toggle Cash in Bank</button>
                                    <button type="button" data-group="cashAdvance" data-modal-id="exampleModal">Toggle Cash Advances</button>
                                    <button type="button" data-group="pettyCash" data-modal-id="exampleModal">Toggle Petty Cash Fund</button> -->

                                    <button class="add">+</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Transaction -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Add Cashbook Record</h5>
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
                                        <label for="treasurername">Treasurer Name:</label>
                                         <input type="text" id="treasurername" name="treasurer_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cltinitbalance">Cash in Local Treasurer Beginning Balance:</label>
                                            <input type="number" id="cltinitbalance" name="clt_init_balance" step="0.01"  required disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cbinitbalance">Cash in Bank Beginning Balance:</label>
                                        <input type="number" id="cbinitbalance" name="cb_init_balance" step="0.01" required disabled>
                                    </div>
                                </div>
                            </div>
                            
                            <table id = "viewDataTable" class="cashbook-table">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="hidden">Counter</th>
                                        <th rowspan="2" class="hidden">ID</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Particulars</th> <!-- Combined Particulars -->
                                        <th colspan="2">References</th>  <!-- Combined References -->

                                        <!-- For 1st Group -->
                                        <th colspan="3"  class="cash-treasury">Cash in Local Treasury</th>
                                        <!-- For 2nd Group -->
                                        <th colspan="3" class="cash-bank">Cash in Bank</th>
                                        <!-- For 3rd Group -->
                                        <th colspan="3" class="cash-advance">Cash Advances</th>
                                        <!-- For 4th Group -->
                                        <th colspan="3" class="petty-cash">Petty Cash Fund</th>
                                        <th rowspan="3">Action</th>

                                    </tr>
                                    <tr>
                                        <!-- Sub-columns for Particulars and References -->
                                        <th >Particular 1</th>
                                        <th >Particular 2</th>
                                        <th>Reference 1</th>
                                        <th>Reference 2</th>

                                         <!--1st Group-->
                                        <th class="cash-treasury">Collection</th>
                                        <th class="cash-treasury">Deposit</th>
                                        <th class="cash-treasury">Balance</th>

                                        <!--2nd Group-->
                                        <th class="cash-bank">Deposit</th>
                                        <th class="cash-bank">Check Issued</th>
                                        <th class="cash-bank">Balance</th>

                                        <!--3rd Group-->
                                        <th class="cash-advance">Receipt</th>
                                        <th class="cash-advance">Disbursement</th>
                                        <th class="cash-advance">Balance</th>

                                        <!--4th Group-->
                                        <th class="petty-cash">Receipt Replenishment</th>
                                        <th class="petty-cash">Payments</th>
                                        <th class="petty-cash">Balance</th>
                                    </tr>
                                </thead>

                                <tbody class = "inp-group-view">
                                     <!-- Dynamic rows go here -->
                                </tbody>
                                
                            </table>

                            <div class="modal-footer">
                                
                            <select class="form-select" id="sectionToggle" onchange="toggleGroup(this.value, 'addUserModal')">
                                <option value="cashTreasury" selected>Cash in Treasury</option>
                                <option value="cashBank">Cash in Bank</option>
                                <option value="cashAdvance">Cash Advances</option>
                                <option value="pettyCash">Petty Cash Fund</option>
                            </select>

                                <!-- <button type="button" data-group="cashTreasury" data-modal-id="addUserModal">Toggle Cash in Treasury</button>
                                <button type="button" data-group="cashBank" data-modal-id="addUserModal">Toggle Cash in Bank</button>
                                <button type="button" data-group="cashAdvance" data-modal-id="addUserModal">Toggle Cash Advances</button>
                                <button type="button" data-group="pettyCash" data-modal-id="addUserModal">Toggle Petty Cash Fund</button> -->

                                <button class="add">+</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </section>
    </body> 

    <!-- <script>
     // For the Individual Buttons
   
    function toggleGroup(group, modalId) {
    const table = document.querySelector(`#${modalId} #viewDataTable`);
    const button = document.querySelector(`button[data-group="${group}"][data-modal-id="${modalId}"]`);
    
    if (!table) {
        console.log(`Table not found in modal: ${modalId}`);
        return;
    }

    // Toggle button active state
    button.classList.toggle('active');

    switch (group) {
        case 'cashTreasury':
            table.classList.toggle('hide-cash-treasury');
            const cltCells = table.querySelectorAll('td:has(input[name^="clt_"])');
            cltCells.forEach(cell => cell.classList.toggle('hidden'));
            break;
            
        case 'cashBank':
            table.classList.toggle('hide-cash-bank');
            const cbCells = table.querySelectorAll('td:has(input[name^="cb_"])');
            cbCells.forEach(cell => cell.classList.toggle('hidden'));
            break;
            
        case 'cashAdvance':
            table.classList.toggle('hide-cash-advance');
            const caCells = table.querySelectorAll('td:has(input[name^="ca_"])');
            caCells.forEach(cell => cell.classList.toggle('hidden'));
            break;
            
        case 'pettyCash':
            table.classList.toggle('hide-petty-cash');
            const pcfCells = table.querySelectorAll('td:has(input[name^="pcf_"])');
            pcfCells.forEach(cell => cell.classList.toggle('hidden'));
            break;
    }
}


document.addEventListener('DOMContentLoaded', function () {
    // Add event listeners to buttons with data-group attributes
    document.querySelectorAll('.modal-footer button[data-group][data-modal-id]').forEach(button => {
        button.classList.add('active');

        button.addEventListener('click', function () {
            const group = button.getAttribute('data-group');
            const modalId = button.getAttribute('data-modal-id');
            console.log(`Button clicked: ${group} in modal: ${modalId}`); // Log which button and modal was clicked
            toggleGroup(group, modalId);
        });
    });

    // Log for other buttons if needed
    const addButton = document.querySelector('.modal-footer .add');
    if (addButton) {
        addButton.addEventListener('click', function () {
            console.log('Add button clicked');
            // Add your functionality for adding a row here
        });
    }

    const submitButton = document.querySelector('.modal-footer .btn-primary');
    if (submitButton) {
        submitButton.addEventListener('click', function () {
            console.log('Submit button clicked');
            // Add any validation or functionality for submitting the form here
        });
    }
});
    </script> -->

   <script>
function toggleGroup(group, modalId) {
    const table = document.querySelector(`#${modalId} #viewDataTable`);
    console.log(`Table modal: ${modalId}`);

    if (!table) {
        console.log(`Table not found in modal: ${modalId}`);
        return;
    }

    // Hide all sections first
    table.classList.add('hide-cash-treasury', 'hide-cash-bank', 'hide-cash-advance', 'hide-petty-cash');
    const allCells = table.querySelectorAll('td:has(input[name^="clt_"]), td:has(input[name^="cb_"]), td:has(input[name^="ca_"]), td:has(input[name^="pcf_"])');
    allCells.forEach(cell => cell.classList.add('hidden'));

    // Show only the selected section
    switch (group) {
        case 'cashTreasury':
            table.classList.remove('hide-cash-treasury');
            const cltCells = table.querySelectorAll('td:has(input[name^="clt_"])');
            cltCells.forEach(cell => {
                const input = cell.querySelector('input');
                if (input && input.value === "") {
                    // Check if the input is numeric or not
                    if (input.type === 'number') {
                        input.value = 0;  // Set default to 0 for numeric fields
                    } else {
                        input.value = " ";  // Set default to " " for text fields
                    }
                }
                cell.classList.remove('hidden');
            });
            break;
            
        case 'cashBank':
            table.classList.remove('hide-cash-bank');
            const cbCells = table.querySelectorAll('td:has(input[name^="cb_"])');
            cbCells.forEach(cell => cell.classList.remove('hidden'));
            break;
            
        case 'cashAdvance':
            table.classList.remove('hide-cash-advance');
            const caCells = table.querySelectorAll('td:has(input[name^="ca_"])');
            caCells.forEach(cell => cell.classList.remove('hidden'));
            break;
            
        case 'pettyCash':
            table.classList.remove('hide-petty-cash');
            const pcfCells = table.querySelectorAll('td:has(input[name^="pcf_"])');
            pcfCells.forEach(cell => cell.classList.remove('hidden'));
            break;
    }
}


document.addEventListener('DOMContentLoaded', function () {
    const sectionToggle1 = document.getElementById('sectionToggle');
    if (sectionToggle1) {
        toggleGroup(sectionToggle1.value, 'addUserModal');
    }

    // Initialize exampleModal toggle
    const sectionToggle2 = document.getElementById('sectionToggle2');
    if (sectionToggle2) {
        toggleGroup(sectionToggle2.value, 'exampleModal');
    }
    console.log('Selected value:', sectionToggle.value);

    if (sectionToggle) {
        // Initial toggle based on default selected option
        const initialGroup = sectionToggle.value;
        const initialModalId = sectionToggle.options[sectionToggle.selectedIndex].getAttribute('data-modal-id');
        toggleGroup(initialGroup, initialModalId);

        // Add change event listener
        sectionToggle.addEventListener('change', function () {

            const selectedGroup = this.value;
            console.log('Change detected!: ',selectedGroup );
            const modalId = this.options[this.selectedIndex].getAttribute('data-modal-id');
            console.log(`Section changed to: ${selectedGroup} in modal: ${modalId}`);
             // Debug logging
            console.log('Change detected!');
            console.log({
                selectedValue: selectedGroup,
                modalId: modalId,
                selectedIndex: this.selectedIndex,
                selectedText: this.options[this.selectedIndex].text
            });
            toggleGroup(selectedGroup, modalId);
        });

        // Method 3: Log all properties of the selected option
        console.log('Full option details:', {
            value: sectionToggle.value,
            text: sectionToggle.options[sectionToggle.selectedIndex].text,
            modalId: sectionToggle.options[sectionToggle.selectedIndex].getAttribute('data-modal-id'),
            index: sectionToggle.selectedIndex
        });
    }

    // Keep the existing add and submit button handlers
    const addButton = document.querySelector('.modal-footer .add');
    if (addButton) {
        addButton.addEventListener('click', function () {
            console.log('Add button clicked');
            // Add your functionality for adding a row here
        });
    }

    const submitButton = document.querySelector('.modal-footer .btn-primary');
    if (submitButton) {
        submitButton.addEventListener('click', function () {
            console.log('Submit button clicked');
            // Add any validation or functionality for submitting the form here
        });
    }
});
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#viewDataModal').on('hidden.bs.modal', function() {
                $('.inp-group-view').empty();
                $('.initial-value').empty();
                $('.ending-value').empty();
                console.log("Info Modal closed");
            });
        });

    </script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const modal1 = document.getElementById('addUserModal');
    let modal1Initialized = false;
    let addInputHandler;

    $('#addUserModal').on('show.bs.modal', function () {
        if (!modal1Initialized) {
            initializeModal1();
            modal1Initialized = true;
        }
       
    });

    $('#addUserModal').on('hidden.bs.modal', function () {
        // Clean up event listeners when the modal is closed
   
        if (addInputHandler) {
            const addButton = document.querySelector('#addUserModal .modal-footer .add');
            addButton.removeEventListener('click', addInputHandler);
        }
    });

    function initializeModal1() {
        console.log('Modal 1 is initialized');

        const periodCoveredInput = document.querySelector('#periodcovered');
        const inpGroup = document.querySelector('#addUserModal .inp-group-view');
        const cltBalanceInput = document.querySelector('#cltinitbalance');
        const cbBalanceInput = document.querySelector('#cbinitbalance');
        let addCounter = 1;

        periodCoveredInput.addEventListener('change', function() {
    fetch(`get_monthly.php?date=${this.value}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'true') {
                // Set the balances from the response for the requested month
                cltBalanceInput.value = parseFloat(data.clt_start_balance).toFixed(2);
                cbBalanceInput.value = parseFloat(data.cb_start_balance).toFixed(2);
            } else {
                console.error('Error:', data.error);

                // Check if the error is about missing sequential months
                if (data.missingMonths && data.firstMissingMonth) {
                    alert(
                        `Records are missing for certain months. Please start by adding the record for ${data.firstMissingMonth}.`
                    );

                    // Set the input to the first missing month
                    const firstMissingMonthWithDay = data.firstMissingMonth + '-01';
                    periodCoveredInput.value = firstMissingMonthWithDay;

                    // Set the balances for the first missing month from the response
                    cltBalanceInput.value = parseFloat(data.clt_start_balance).toFixed(2);
                    cbBalanceInput.value = parseFloat(data.cb_start_balance).toFixed(2);

                } else if (data.error.includes("record already exists")) {
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

            // Reset balances to 0.00 if there is a fetch error
            cltBalanceInput.value = '0.00';
            cbBalanceInput.value = '0.00';
        });
});


        // Function to format date as YYYY-MM-DD
        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }

        // Function to get the last day of a month
        function getLastDayOfMonth(year, month) {
            return new Date(year, month + 1, 0).getDate();
        }

        // Update min and max attributes for date inputs based on the selected period
        function updateDateInputs() {
            const selectedDate = new Date(periodCoveredInput.value);
            if (isNaN(selectedDate.getTime())) return; // No valid date selected

            const month = selectedDate.getMonth(); // 0-based month
            const year = selectedDate.getFullYear();

            const startOfMonth = new Date(year, month, 2);
            const lastDay = getLastDayOfMonth(year, month);
            const endOfMonth = new Date(year, month, lastDay+1);

            const minDate = formatDate(startOfMonth);
            const maxDate = formatDate(endOfMonth);

            const dateInputs = document.querySelectorAll('#addUserModal input[name="date_data[]"]');
            dateInputs.forEach(input => {
                input.setAttribute('min', minDate);
                input.setAttribute('max', maxDate);

                // Validate the input value only if it exists
                if (input.value) {
                    const currentDate = new Date(input.value);
                    if (currentDate < startOfMonth || currentDate > endOfMonth) {
                        console.log(`Date ${input.value} is outside the valid range.`);
                    }
                }
            });
        }

        // Event listener for period covered input change
        periodCoveredInput.addEventListener('change', updateDateInputs);

        function addInputHandler(event) {
            event.preventDefault();
            addInput();
            updateDateInputs();
        }

        // Add event listener for adding new input groups
        const addButton = document.querySelector('#addUserModal .modal-footer .add');
        addButton.addEventListener('click', addInputHandler);
        
        // Remove an input group
        function removeInput(event) {
            event.preventDefault(); // Prevent default link behavior
            if (confirm("Are you sure you want to remove this row?")) {
                const inputGroup = event.target.closest('#addUserModal tr');
                if (inputGroup) {
                    inputGroup.remove();
                    update_add_Counter();
                }
            }
        }

        // Function to update the counters after a row is removed
        function update_add_Counter() {
            const rows = document.querySelectorAll("#addUserModal .inp-group-view tr");
            let updatedCounter = 1;  // Start counter from 1

            rows.forEach(function(row) {
                const label = row.querySelector("label");
                const hiddenInput = row.querySelector("input[type='hidden']");

                if (label) {
                    label.textContent = updatedCounter; // Update label text
                }
                if (hiddenInput) {
                    hiddenInput.value = updatedCounter; // Update hidden input value
                }
                updatedCounter++;  // Increment counter for the next row
            });

            addCounter = updatedCounter;
        }

        // Add a new input group
        function addInput(afterElement = null) {

            //for the individual buttons
            const table = document.querySelector(`#addUserModal #viewDataTable`);
            const hiddenGroups = {
                cashTreasury: table.classList.contains('hide-cash-treasury'),
                cashBank: table.classList.contains('hide-cash-bank'),
                cashAdvance: table.classList.contains('hide-cash-advance'),
                pettyCash: table.classList.contains('hide-petty-cash')
            };

            //for the dropdown
            // const table = document.querySelector('#addUserModal #viewDataTable');
            // const selectedGroup = document.getElementById('sectionToggle').value;

            const newRow = document.createElement("tr");

            const cells = [
                createCell('input', '', {type: 'date', name: 'date_data[]', required: true}),
                createCell('input', '', {type: 'text', name: 'particulars_1[]' , required: false}),
                createCell('input', '', {type: 'text', name: 'particulars_2[]', required: false}),
                createCell('input', '', {type: 'text', name: 'reference_1[]' ,required: false}),
                createCell('input', '', {type: 'text', name: 'reference_2[]' ,required: false}),
                createCell('input', '', {type: 'number', name: 'clt_in_data[]', required: false, min: 0, step: "0.01", value: 0}),
                createCell('input', '', {type: 'number', name: 'clt_out_data[]', required: false, min: 0, step: "0.01", value: 0}),
                createCell('input', '', {type: 'number', name: 'clt_balance_data[]', required: false, min: 0, step: "0.01", disabled: true, value: 0}),
                createCell('input', '', {type: 'number', name: 'cb_in_data[]', required: false, min: 0, step: "0.01", value: 0}),
                createCell('input', '', {type: 'number', name: 'cb_out_data[]', required: false, min: 0, step: "0.01", value: 0}),
                createCell('input', '', {type: 'number', name: 'cb_balance_data[]', required: false, min: 0, step: "0.01", disabled: true, value: 0}),
                createCell('input', '', {type: 'number', name: 'ca_receipt_data[]', required: false, min: 0, step: "0.01", value: 0}),
                createCell('input', '', {type: 'number', name: 'ca_disbursement_data[]', required: false, min: 0, step: "0.01", value: 0}),
                createCell('input', '', {type: 'number', name: 'ca_balance_data[]', required: false, min: 0, step: "0.01", disabled: true, value: 0}),
                createCell('input', '', {type: 'number', name: 'pcf_receipt_data[]', required: false, min: 0, step: "0.01", value: 0}),
                createCell('input', '', {type: 'number', name: 'pcf_payments_data[]', required: false, min: 0, step: "0.01", value: 0}),
                createCell('input', '', {type: 'number', name: 'pcf_balance_data[]', required: false, min: 0, step: "0.01", disabled: true, value: 0}),
            ];

            //for individual buttons
            cells.forEach((cell, index) => {
            // Add appropriate hidden classes based on the input name
            const inputName = cell.querySelector('input')?.name;
            if (inputName) {
                if (hiddenGroups.cashTreasury && inputName.startsWith('clt_')) {
                    cell.classList.add('hidden');
                }
                if (hiddenGroups.cashBank && inputName.startsWith('cb_')) {
                    cell.classList.add('hidden');
                }
                if (hiddenGroups.cashAdvance && inputName.startsWith('ca_')) {
                    cell.classList.add('hidden');
                }
                if (hiddenGroups.pettyCash && inputName.startsWith('pcf_')) {
                    cell.classList.add('hidden');
                }
            }
            newRow.appendChild(cell);
        });

        //fpr dropdown
//        cells.forEach((cell) => {
//     const inputName = cell.querySelector('input')?.name;
//     if (inputName) {
//         // Keep common fields visible
//         if (!inputName.startsWith('date_') && 
//             !inputName.startsWith('particulars_') && 
//             !inputName.startsWith('reference_')) {
            
//             // Hide only the section-specific cells
//             if (
//                 (selectedGroup !== 'cashTreasury' && inputName.startsWith('clt_')) ||
//                 (selectedGroup !== 'cashBank' && inputName.startsWith('cb_')) ||
//                 (selectedGroup !== 'cashAdvance' && inputName.startsWith('ca_')) ||
//                 (selectedGroup !== 'pettyCash' && inputName.startsWith('pcf_'))
//             ) {
//                 cell.classList.add('hidden');
//             }
//         }
//     }
//     newRow.appendChild(cell);
// });




            // Create action buttons
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'add_counter[]';
            hiddenInput.value = document.querySelectorAll("#addUserModal .inp-group-view tr").length + 1;
            newRow.appendChild(hiddenInput);

            const actionCell = document.createElement('td');
            actionCell.classList.add('action-buttons');
            actionCell.innerHTML = `
                <a href="#" class="add">+</a>
                <a href="#" class="delete">X</a>
            `;
            newRow.appendChild(actionCell);

            // Add event listeners for calculating clt balance
            const cltInInput = newRow.querySelector('input[name="clt_in_data[]"]');
            const cltOutInput = newRow.querySelector('input[name="clt_out_data[]"]');
            const cltBalanceInput = newRow.querySelector('input[name="clt_balance_data[]"]');

            cltInInput.addEventListener('input', updateCLTBalances);
            cltOutInput.addEventListener('input', updateCLTBalances);

            // Add event listener to the initial balance input
            const cltInitBalanceInput = document.getElementById('cltinitbalance');
            cltInitBalanceInput.addEventListener('input', updateCLTBalances);

            function updateCLTBalances() {
                const initialBalance = parseFloat(cltInitBalanceInput.value) || 0;
                const rows = document.querySelectorAll("#addUserModal .inp-group-view tr");
                let previousBalance = initialBalance;

                rows.forEach((row) => {
                    const cltInValue = parseFloat(row.querySelector('input[name="clt_in_data[]"]').value) || 0;
                    const cltOutValue = parseFloat(row.querySelector('input[name="clt_out_data[]"]').value) || 0;

                    const newBalance = previousBalance + cltInValue - cltOutValue; 
                    row.querySelector('input[name="clt_balance_data[]"]').value = newBalance;

                    previousBalance = newBalance; 

                    if (newBalance < 0) {
                        alert('Warning: A Cash in Local Treasury Balance is negative! Please check your inputs.');
                    }
                });
            }

            // Add event listeners for calculating cb balance
            const cbInInput = newRow.querySelector('input[name="cb_in_data[]"]');
            const cbOutInput = newRow.querySelector('input[name="cb_out_data[]"]');
            const cbBalanceInput = newRow.querySelector('input[name="cb_balance_data[]"]');

            cbInInput.addEventListener('input', updateCBBalances);
            cbOutInput.addEventListener('input', updateCBBalances);

            // Add event listener to the initial balance input
            const cbInitBalanceInput = document.getElementById('cbinitbalance');
            cbInitBalanceInput.addEventListener('input', updateCBBalances);

            function updateCBBalances() {
                const initialBalance = parseFloat(cbInitBalanceInput.value) || 0;
                const rows = document.querySelectorAll("#addUserModal .inp-group-view tr");
                let previousBalance = initialBalance;

                rows.forEach((row) => {
                    const cbInValue = parseFloat(row.querySelector('input[name="cb_in_data[]"]').value) || 0; 
                    const cbOutValue = parseFloat(row.querySelector('input[name="cb_out_data[]"]').value) || 0;

                    const newBalance = previousBalance + cbInValue - cbOutValue; 
                    row.querySelector('input[name="cb_balance_data[]"]').value = newBalance;

                    previousBalance = newBalance; 

                    if (newBalance < 0) {
                        alert('Warning: A Cash in Bank Balance is negative! Please check your inputs.');
                    }
                });
            }

            // Add event listeners for calculating ca balance
            const caInInput = newRow.querySelector('input[name="ca_receipt_data[]"]');
            const caOutInput = newRow.querySelector('input[name="ca_disbursement_data[]"]');
            const caBalanceInput = newRow.querySelector('input[name="ca_balance_data[]"]');

            caInInput.addEventListener('input', updateCABalances);
            caOutInput.addEventListener('input', updateCABalances);

            function updateCABalances() {
                let initialBalance = 0; 
                const rows = document.querySelectorAll("#addUserModal .inp-group-view tr");
                let previousBalance = initialBalance;

                rows.forEach((row) => {
                    const caInValue = parseFloat(row.querySelector('input[name="ca_receipt_data[]"]').value) || 0; 
                    const caOutValue = parseFloat(row.querySelector('input[name="ca_disbursement_data[]"]').value) || 0;

                    const newBalance = previousBalance + caInValue - caOutValue; 
                    row.querySelector('input[name="ca_balance_data[]"]').value = newBalance;

                    previousBalance = newBalance; 

                    if (newBalance < 0) {
                        alert('Warning: A Cash Advance Balance is negative! Please check your inputs.');
                    }
                });
            }

            // Add event listeners for calculating pcf balance
            const pcfInInput = newRow.querySelector('input[name="pcf_receipt_data[]"]');
            const pcfOutInput = newRow.querySelector('input[name="pcf_payments_data[]"]');
            const pcfBalanceInput = newRow.querySelector('input[name="pcf_balance_data[]"]');

            pcfInInput.addEventListener('input', updatePCFBalances);
            pcfOutInput.addEventListener('input', updatePCFBalances);

            function updatePCFBalances() {
                let initialBalance = 0;
                const rows = document.querySelectorAll("#addUserModal .inp-group-view tr");
                let previousBalance = initialBalance;

                rows.forEach((row) => {
                    const pcfInValue = parseFloat(row.querySelector('input[name="pcf_receipt_data[]"]').value) || 0; 
                    const pcfOutValue = parseFloat(row.querySelector('input[name="pcf_payments_data[]"]').value) || 0;

                    const newBalance = previousBalance + pcfInValue - pcfOutValue; 
                    row.querySelector('input[name="pcf_balance_data[]"]').value = newBalance;

                    previousBalance = newBalance; 

                    if (newBalance < 0) {
                        alert('Warning: A Petty Cash Balance is negative! Please check your inputs.');
                    }
                });
            }

            // Add event listener to delete button
            actionCell.querySelector('.delete').addEventListener('click', function(event) {
                event.preventDefault();
                if (confirm("Are you sure you want to remove this row?")) {
                    newRow.remove();
                    updateCLTBalances();
                    updateCBBalances();
                    updateCABalances();
                    updatePCFBalances();
                }
            });

            actionCell.querySelector('.add').addEventListener('click', function(event) {
                event.preventDefault();
                addInput(newRow);
            });

            function initializeBalances(newRow) {
                // Initialize CLT Balance
                updateCLTBalances();
                
                // Initialize CB Balance
                updateCBBalances();
                
                // Initialize CA Balance
                updateCABalances();
                
                // Initialize PCF Balance
                updatePCFBalances();
            }

            // Add the new group to the form
            if (afterElement) {
                afterElement.insertAdjacentElement('afterend', newRow);
            } else {
                document.querySelector("#addUserModal .inp-group-view").appendChild(newRow);
            }
            update_add_Counter(); 
            updateDateInputs();
            initializeBalances(newRow);

            console.log("New Row Added");
        }

        function createCell(elementType, textContent = '', attributes = {}) {
            const cell = document.createElement('td');
            const element = document.createElement(elementType);

            if (textContent) element.textContent = textContent;

            for (const [key, value] of Object.entries(attributes)) {
                element.setAttribute(key, value);
            }

            cell.appendChild(element);
            return cell;
        }

        // Initial call to set the correct date range
        updateDateInputs();
    }
});

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

</html>
