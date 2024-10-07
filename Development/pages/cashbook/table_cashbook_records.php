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
    overflow-y: auto !important;
}
.cashbook-container {
    width: 100%;
    margin: 0 auto;
    padding: 5px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow-x: auto; /* Ensures table doesn't overflow horizontally */
}

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

.cashbook-table {
    width: 100%; /* Ensures the table fills the width of the container */
    max-width: 100%; /* Prevents it from overflowing */
    border-collapse: collapse;
    margin-bottom: 20px;
    table-layout: fixed;
    border: 3px solid #000 /* Ensures the table columns fit within the container */
}

.cashbook-table th, .cashbook-table td {
    border: 1px solid #000;
    padding: 5px;
    text-align: center;
    box-sizing: border-box; /* Ensures padding is included within the element width */
}

.cashbook-table th {
    background-color: #f0f0f0; /* Background color for headers */
    text-align: center; /* Center text in headers */
    padding: 10px; /* Padding for header cells */
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
    font-size: 10px; /* Same for all cash category columns */
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

.cashbook-table input[type="text"]:disabled , input[type="date"]:disabled{
    width: 100%;
    box-sizing: border-box;
    border: none;
    font-size: 10px;
    color: #000;
}
.cashbook-table input[type="number"]:disabled{
    width: 100%;
    padding: 2px;
    box-sizing: border-box;
    border: none;
    font-size: 15px;
    color: #000;
}
.hidden{
    display: none;
}

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
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Item</button>
                            <!--<button class="print-btn" title="Print">
                                <i class="bx bx-printer"></i>
                            </button>-->
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Period Covered</th>
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

                            $('.inp-group-up').empty();
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
                                                var InputGroup = `
                                                <div class="flex">
                                                    <input type="hidden" name="up_counter[]" value="${window.upCounter}">
                                                    <input type="hidden" name="cashbook_data_id[]" value="${cData.cashbook_data_id}">
                                                    <label>${window.upCounter}</label>
                                                    <input type="date" name="date_data[]" value="${cData.date_data}">
                                                    <input type="text" name="particulars_1[]" value="${cData.particulars_1}">
                                                    <input type="text" name="particulars_2[]" value="${cData.particulars_2}">
                                                    <input type="text" name="reference_1[]" value="${cData.reference_1}">
                                                    <input type="text" name="reference_2[]" value="${cData.reference_2}">
                                                    <input type="number" name="clt_in_data[]" value="${cData.clt_in}">
                                                    <input type="number" name="clt_out_data[]" value="${cData.clt_out}">
                                                    <input type="number" name="cb_in_data[]" value="${cData.cb_in}">
                                                    <input type="number" name="cb_out_data[]" value="${cData.cb_out}">
                                                    <input type="number" name="ca_receipt_data[]" value="${cData.ca_receipt}">
                                                    <input type="number" name="ca_disbursement_data[]" value="${cData.ca_disbursement}">
                                                    <input type="number" name="pcf_receipt_data[]" value="${cData.pcf_receipt}">
                                                    <input type="number" name="pcf_payments_data[]" value="${cData.pcf_payments}">
                                                    <div class="action-buttons">
                                                        <a href="#" class="add">+</a>
                                                        <a href="#" class="delete">x</a>
                                                    </div>
                                                </div>`;

                                                // Append the new input group to the modal
                                                $('#exampleModal .inp-group-up').append(InputGroup);

                                                window.upCounter++;  // Increment the counter
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

                                        // Populate input fields with the main record data
                                        $('#periodcoveredView').val(record.period_covered);
                                        $('#treasurernameView').val(record.treasurer_name);
                                        $('#cltinitbalanceView').val(record.clt_init_balance);
                                        $('#cbinitbalanceView').val(record.cb_init_balance);

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

                    </script>
                </section><!-- .home-->
                <!-- Modal -->
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
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="periodcoveredField">Period Covered:</label>
                                        <input type="date" id="periodcoveredField" name="period_covered" required>
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
                                        <input type="number" id="cltinitbalanceField" name="clt_init_balance" step="0.01"  required>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cbinitbalanceField">Cash in Bank Beginning Balance:</label>
                                        <input type="number" id="cbinitbalanceField" name="cb_init_balance" step="0.01" required>
                                    </div>
                                    </div>
                                    </div>

                                <div class="form-group">
                                    <div class="wrap">
                                        <h4>UPDATE RECORDS</h4>
                                        <a href="#" class="add">+</a>
                                    </div>
                                    <div class="column-titles">
                                        <span>#</span>
                                        <span>Date</span>
                                        <span>Particulars 1</span>
                                        <span>Particulars 2</span>
                                        <span>Reference 1</span>
                                        <span>Reference 2</span>
                                        <span>CLT In</span>
                                        <span>CLT Out</span>
                                        <span>CB In</span>
                                        <span>CB Out</span>
                                        <span>CA Receipt</span>
                                        <span>CA Disbursement</span>
                                        <span>PCF Receipt</span>
                                        <span>PCF Payments</span>
                                        <span>Action</span>
                                    </div>

                                    <div class="inp-group-up">
                                        <!-- Populate in the form -->
                                        
                                    </div>
                                    
                                    <!-- Dynamic Inputs Will Be Added Here -->
                                </div>
                                <div class="modal-footer">
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
                                            <input type="number" id="cltinitbalance" name="clt_init_balance" step="0.01"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cbinitbalance">Cash in Bank Beginning Balance:</label>
                                        <input type="number" id="cbinitbalance" name="cb_init_balance" step="0.01" required>
                                    </div>
                                </div>
                            </div>

                                <div class="form-group">
                                    <div class="wrap">
                                        <h2>ADD RECORDS</h2>
                                        <a href="#" class="add">+</a>
                                    </div>
                                    <div class="column-titles">
                                        <span>#</span>
                                        <span>Date</span>
                                        <span>Particulars 1</span>
                                        <span>Particulars 2</span>
                                        <span>Reference 1</span>
                                        <span>Reference 2</span>
                                        <span>CLT In</span>
                                        <span>CLT Out</span>
                                        <span>CB In</span>
                                        <span>CB Out</span>
                                        <span>CA Receipt</span>
                                        <span>CA Disbursement</span>
                                        <span>PCF Receipt</span>
                                        <span>PCF Payments</span>
                                        <span>Action</span>
                                    </div>

                                    <div class="inp-group-add">
                                        <!-- Populate in the form -->
                                        
                                    </div>
                                    
                                    <!-- Dynamic Inputs Will Be Added Here -->
                                </div>

                                <div class="modal-footer">
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
        function validateForm() {
                var itemCount = parseInt(document.getElementById('itemcount').value);
                var lendableCount = parseInt(document.getElementById('lendablecount').value);

                var itemCountField = parseInt(document.getElementById('countField').value);
                var lendableCountField = parseInt(document.getElementById('lendablecountField').value);

                if (lendableCount > itemCount) {
                    alert("Lendable count cannot be more than item count.");
                    return false;
                }

                if (lendableCountField > itemCountField) {
                    alert("Lendable count cannot be more than item count.");
                    return false;
                }

                return true;
            }
    </script>

    <script>


    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#addUserModal').on('shown.bs.modal', function () {
                console.log('Modal 1 is triggered');

                (function FunctionForModal1() {

                    const periodCoveredInput = document.querySelector('#periodcovered');
                    const inpGroup = document.querySelector('#addUserModal .inp-group-add');
                    let addCounter = 1;

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

                    // Add event listener for adding new input groups
                    document.querySelector('#addUserModal  .add').addEventListener('click', function(event) {
                        event.preventDefault();
                        addInput();
                        updateDateInputs(); // Ensure new inputs are validated
                    });

                    // Initial call to set the correct date range
                    updateDateInputs();

                    // Remove an input group
                    function removeInput(event) {
                        event.preventDefault(); // Prevent default link behavior
                        if (confirm("Are you sure you want to remove this row?")) {
                            // Remove the closest .flex (the group containing the inputs)
                            const inputGroup = event.target.closest('#addUserModal .flex');
                            if (inputGroup) {
                                inputGroup.remove();
                                update_add_Counter();
                            }
                        }
                    }

                    // Function to update the counters after a row is removed
                    function update_add_Counter() {
                        const rows = document.querySelectorAll("#addUserModal .inp-group-add .flex");
                        let updatedCounter = 1;  // Start counter from 1 or any other base

                        rows.forEach(function(row) {
                            const label = row.querySelector("label");
                            const hiddenInput = row.querySelector("#addUserModal input[type='hidden']");

                            // Update the label text and hidden input value to match the new counter
                            label.textContent = updatedCounter;
                            hiddenInput.value = updatedCounter;

                            updatedCounter++;  // Increment counter for the next row
                        });

                        // Update global counter to match the number of rows
                        addCounter = updatedCounter;
                    }



                    // Add a new input group
                    function addInput(afterElement = null) {
                        const newGroup = document.createElement("div");
                        newGroup.classList.add("flex");

                        const counter = document.createElement("label");
                        counter.textContent = addCounter;

                        const hiddenCounter = document.createElement("input");
                        hiddenCounter.type = "hidden";
                        hiddenCounter.name = "add_counter[]";
                        hiddenCounter.id = "add_counter";
                        hiddenCounter.value = addCounter;

                        const date_data = document.createElement("input");
                        date_data.type = "date";
                        date_data.name = "date_data[]";
                        date_data.required = true;
                        date_data.min = 1;
                        
                        const particulars_1 = document.createElement("input");
                        particulars_1.type = "text";
                        particulars_1.name = "particulars_1[]";
                        particulars_1.required = false;
                        particulars_1.min = 1;

                        const particulars_2 = document.createElement("input");
                        particulars_2.type = "text";
                        particulars_2.name = "particulars_2[]";
                        particulars_2.required = false;
                        particulars_2.min = 1;

                        const reference_1 = document.createElement("input");
                        reference_1.type = "text";
                        reference_1.name = "reference_1[]";
                        reference_1.required = false;
                        reference_1.min = 1;

                        const reference_2 = document.createElement("input");
                        reference_2.type = "text";
                        reference_2.name = "reference_2[]";
                        reference_2.required = false;
                        reference_2.min = 1;

                        const clt_in_data = document.createElement("input");
                        clt_in_data.type = "number";
                        clt_in_data.name = "clt_in_data[]";
                        clt_in_data.required = false;
                        clt_in_data.min = 1;

                        const clt_out_data = document.createElement("input");
                        clt_out_data.type = "number";
                        clt_out_data.name = "clt_out_data[]";
                        clt_out_data.required = false;
                        clt_out_data.min = 1;

                        const cb_in_data = document.createElement("input");
                        cb_in_data.type = "number";
                        cb_in_data.name = "cb_in_data[]";
                        cb_in_data.required = false;
                        cb_in_data.min = 1;

                        const cb_out_data = document.createElement("input");
                        cb_out_data.type = "number";
                        cb_out_data.name = "cb_out_data[]";
                        cb_out_data.required = false;
                        cb_out_data.min = 1;

                        const ca_receipt_data = document.createElement("input");
                        ca_receipt_data.type = "number";
                        ca_receipt_data.name = "ca_receipt_data[]";
                        ca_receipt_data.required = false;
                        ca_receipt_data.min = 1;

                        const ca_disbursement_data = document.createElement("input");
                        ca_disbursement_data.type = "number";
                        ca_disbursement_data.name = "ca_disbursement_data[]";
                        ca_disbursement_data.required = false;
                        ca_disbursement_data.min = 1;

                        const pcf_receipt_data = document.createElement("input");
                        pcf_receipt_data.type = "number";
                        pcf_receipt_data.name = "pcf_receipt_data[]";
                        pcf_receipt_data.required = false;
                        pcf_receipt_data.min = 1;

                        const pcf_payments_data = document.createElement("input");
                        pcf_payments_data.type = "number";
                        pcf_payments_data.name = "pcf_payments_data[]";
                        pcf_payments_data.required = false;
                        pcf_payments_data.min = 1;


                        // Create remove button
                        const removeButton = document.createElement("a");
                        removeButton.href = "#";
                        removeButton.textContent = "X";
                        removeButton.classList.add("delete");
                        removeButton.onclick = (event) => removeInput(event);

                        // Create add button
                        const addButton = document.createElement("a");
                        addButton.href = "#";
                        addButton.textContent = "+";
                        addButton.classList.add("add");
                        addButton.onclick = function (e) {
                            e.preventDefault();
                            addInput(newGroup); // Insert next to current row
                            update_add_Counter(); 
                        };

                        // Create the action column
                        const actionColumn = document.createElement("div");
                        actionColumn.classList.add("action-buttons");
                        actionColumn.appendChild(addButton);
                        actionColumn.appendChild(removeButton);

                        // Append elements to the new group
                        newGroup.appendChild(counter);
                        newGroup.appendChild(hiddenCounter);
                        newGroup.appendChild(date_data);
                        newGroup.appendChild(particulars_1);
                        newGroup.appendChild(particulars_2);
                        newGroup.appendChild(reference_1);
                        newGroup.appendChild(reference_2);
                        newGroup.appendChild(clt_in_data);
                        newGroup.appendChild(clt_out_data);
                        newGroup.appendChild(cb_in_data);
                        newGroup.appendChild(cb_out_data);
                        newGroup.appendChild(ca_receipt_data);
                        newGroup.appendChild(ca_disbursement_data);
                        newGroup.appendChild(pcf_receipt_data);
                        newGroup.appendChild(pcf_payments_data);

                        // Append the action buttons column
                        newGroup.appendChild(actionColumn);

                        // Add the new group to the form
                        if (afterElement) {
                        afterElement.insertAdjacentElement('afterend', newGroup);
                        } else {
                            document.querySelector("#addUserModal .inp-group-add").appendChild(newGroup);
                        }
                        addCounter++;
                        update_add_Counter(); 
                        updateDateInputs();

                    }

                })()
            });
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#exampleModal').on('shown.bs.modal', function () {
            console.log('Modal 2 is triggered');
            (function FunctionForModal2() {
                const periodCoveredInput = document.querySelector('#periodcoveredField');
                const inpGroup = document.querySelector('#exampleModal .inp-group-up');

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

                const startOfMonth = new Date(year, month, 2); // First day of the month
                const lastDay = getLastDayOfMonth(year, month);
                const endOfMonth = new Date(year, month, lastDay+1); // Last day of the month

                const minDate = formatDate(startOfMonth);
                const maxDate = formatDate(endOfMonth);

                const dateInputs = document.querySelectorAll('#exampleModal input[name="date_data[]"]');
                dateInputs.forEach(input => {
                    // Only set min and max attributes, don't clear the value
                    input.setAttribute('min', minDate);
                    input.setAttribute('max', maxDate);

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

                // Add event listener for adding new input groups
               // Add event listener for adding new input groups within inp-group-up
                // $('#exampleModal .inp-group-up').on('click', '.add', function(event) {
                //     event.preventDefault();
                //     console.log("Add button clicked in inp-group-up"); // Check if this is logged
                //     addInput($(this).closest('.flex')); // Pass the closest '.flex'
                //     update_up_Counter();
                //     updateDateInputs();
                // });

                // Add event listener for the main add button in the modal header
                document.querySelector('#exampleModal .add').addEventListener('click', function(event) {
                    event.preventDefault();
                    console.log("Main add button clicked"); // Check if this is logged
                    addInput(); // Call addInput without parameters
                    updateDateInputs(); // Ensure new inputs are validated
                });

                // Initial call to set the correct date range
                updateDateInputs();


                // Remove an input group
                $('#exampleModal .inp-group-up').on('click', '.delete', function(event) {
                    event.preventDefault();
                    // Confirm before removing the row
                    if (confirm("Are you sure you want to remove this row?")) {
                        // Remove the closest '.flex' container
                        $(this).closest('.flex').remove();
                        // Update counter after removing
                        update_up_Counter();
                    }
                });

                // Function to update the counters after a row is removed
                function update_up_Counter() {
                    const rows = document.querySelectorAll("#exampleModal .inp-group-up .flex");
                    let updatedCounter = 1;  // Start counter from 1 or any other base

                    rows.forEach(function(row) {
                        const label = row.querySelector("label");
                        const hiddenInput = row.querySelector("#exampleModal input[type='hidden']");

                        // Update the label text and hidden input value to match the new counter
                        label.textContent = updatedCounter;
                        hiddenInput.value = updatedCounter;

                        updatedCounter++;  // Increment counter for the next row
                    });

                    // Update global counter to match the number of rows
                    window.upCounter = updatedCounter;
                }
                

                // Add a new input group
                function addInput(afterElement = null) {
                        const newGroup = document.createElement("div");
                        newGroup.classList.add("flex");

                         // Make sure upCounter is initialized properly
                        if (typeof window.upCounter === 'undefined') {
                            window.upCounter = document.querySelectorAll('#exampleModal .inp-group-up .flex').length + 1;
                        }

                        const counter = document.createElement("label");
                        counter.textContent = upCounter;

                        const hiddenCounter = document.createElement("input");
                        hiddenCounter.type = "hidden";
                        hiddenCounter.name = "up_counter[]";
                        hiddenCounter.id = "up_counter";
                        hiddenCounter.value = upCounter;

                        const date_data = document.createElement("input");
                        date_data.type = "date";
                        date_data.name = "date_data[]";
                        date_data.required = true;
                        date_data.min = 1;
                        
                        const particulars_1 = document.createElement("input");
                        particulars_1.type = "text";
                        particulars_1.name = "particulars_1[]";
                        particulars_1.required = false;
                        particulars_1.min = 1;

                        const particulars_2 = document.createElement("input");
                        particulars_2.type = "text";
                        particulars_2.name = "particulars_2[]";
                        particulars_2.required = false;
                        particulars_2.min = 1;

                        const reference_1 = document.createElement("input");
                        reference_1.type = "text";
                        reference_1.name = "reference_1[]";
                        reference_1.required = false;
                        reference_1.min = 1;

                        const reference_2 = document.createElement("input");
                        reference_2.type = "text";
                        reference_2.name = "reference_2[]";
                        reference_2.required = false;
                        reference_2.min = 1;

                        const clt_in_data = document.createElement("input");
                        clt_in_data.type = "number";
                        clt_in_data.name = "clt_in_data[]";
                        clt_in_data.required = false;
                        clt_in_data.min = 1;

                        const clt_out_data = document.createElement("input");
                        clt_out_data.type = "number";
                        clt_out_data.name = "clt_out_data[]";
                        clt_out_data.required = false;
                        clt_out_data.min = 1;

                        const cb_in_data = document.createElement("input");
                        cb_in_data.type = "number";
                        cb_in_data.name = "cb_in_data[]";
                        cb_in_data.required = false;
                        cb_in_data.min = 1;

                        const cb_out_data = document.createElement("input");
                        cb_out_data.type = "number";
                        cb_out_data.name = "cb_out_data[]";
                        cb_out_data.required = false;
                        cb_out_data.min = 1;

                        const ca_receipt_data = document.createElement("input");
                        ca_receipt_data.type = "number";
                        ca_receipt_data.name = "ca_receipt_data[]";
                        ca_receipt_data.required = false;
                        ca_receipt_data.min = 1;

                        const ca_disbursement_data = document.createElement("input");
                        ca_disbursement_data.type = "number";
                        ca_disbursement_data.name = "ca_disbursement_data[]";
                        ca_disbursement_data.required = false;
                        ca_disbursement_data.min = 1;

                        const pcf_receipt_data = document.createElement("input");
                        pcf_receipt_data.type = "number";
                        pcf_receipt_data.name = "pcf_receipt_data[]";
                        pcf_receipt_data.required = false;
                        pcf_receipt_data.min = 1;

                        const pcf_payments_data = document.createElement("input");
                        pcf_payments_data.type = "number";
                        pcf_payments_data.name = "pcf_payments_data[]";
                        pcf_payments_data.required = false;
                        pcf_payments_data.min = 1;


                        // Create remove button
                        const removeButton = document.createElement('a');
                            removeButton.href = '#';
                            removeButton.textContent = 'X';
                            removeButton.classList.add('delete');
                            removeButton.addEventListener('click', function(event) {
                                event.preventDefault();
                                if (confirm("Are you sure you want to remove this row?")) {
                                    newGroup.remove();
                                    update_up_Counter();
                                }
                            });

                        // Create add button
                        const addButton = document.createElement('a');
                        addButton.href = '#';
                        addButton.textContent = '+';
                        addButton.classList.add('add');
                        addButton.addEventListener('click', function(event) {
                            event.preventDefault();
                            addInput(newGroup);
                            update_up_Counter();
                            console.log("Addbutton clicked ");
                            updateDateInputs();
                        });

                        // Create the action column
                        const actionColumn = document.createElement("div");
                        actionColumn.classList.add("action-buttons");
                        actionColumn.appendChild(addButton);
                        actionColumn.appendChild(removeButton);

                        // Append elements to the new group
                        newGroup.appendChild(counter);
                        newGroup.appendChild(hiddenCounter);
                        newGroup.appendChild(date_data);
                        newGroup.appendChild(particulars_1);
                        newGroup.appendChild(particulars_2);
                        newGroup.appendChild(reference_1);
                        newGroup.appendChild(reference_2);
                        newGroup.appendChild(clt_in_data);
                        newGroup.appendChild(clt_out_data);
                        newGroup.appendChild(cb_in_data);
                        newGroup.appendChild(cb_out_data);
                        newGroup.appendChild(ca_receipt_data);
                        newGroup.appendChild(ca_disbursement_data);
                        newGroup.appendChild(pcf_receipt_data);
                        newGroup.appendChild(pcf_payments_data);

                        // Append the action buttons column
                        newGroup.appendChild(actionColumn);

                        // Add the new group to the form
                        if (afterElement) {
                            afterElement.insertAdjacentElement('afterend', newGroup);
                        } else {
                            document.querySelector("#exampleModal .inp-group-up").appendChild(newGroup);
                        }
                        console.log("New input group added to the DOM.");
                        window.upCounter++;
                        update_up_Counter(); 
                        updateDateInputs();

                    }

            })();
        });
    });
</script>

</html>
