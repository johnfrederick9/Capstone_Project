<?php
include '../../sidebar.php';
include '../../head.php';
require '../../database.php';
?>

<body>
    <section class="home">  
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Inventory Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn">+ Add</button>
                            <button class="print-btn " title="Print Selected">
                            <i class="bx bx-printer"></i>
                        </button>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                    <th>#</th>
                    <th><button class="print-all-btn" title="Print All">
                                    <i class="bx bx-printer"></i>
                                </button>
                            </th>
                        
                        <th>Name</th>
                        <th>Serial No:</th>
                        <th>Property Custodian</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Year Acquired</th>
                        <th>Lendable Quantity</th>
                        <th>Available Quantity</th>
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
                                        "aTargets": [10]
                                    }
                                ]
                            });
                        });
                        $(document).on('submit', '#addUser', function(e) {
                            e.preventDefault();
                            console.log("Add form submitted");

                            var item_name = $('#itemname').val();
                            var item_description = $('#itemdescription').val();
                            var item_brand = $('#itembrand').val();
                            var item_serialNo = $('#itemserialNo').val();
                            var item_custodian = $('#itemcustodian').val();
                            var item_count = $('#itemcount').val();
                            var item_price = $('#itemprice').val();
                            var item_year = $('#itemyear').val();
                            var item_status = $('#itemstatus').val();
                            var lendable_count = $('#lendablecount').val();

                            if (item_name != '' && item_description != '' && item_count != '' && item_status != '' && item_custodian != '' && item_price != '' && lendable_count != '') {
                                $.ajax({
                                    url: "add.php",
                                    type: "post",
                                    data: {
                                        item_name: item_name,
                                        item_description: item_description,
                                        item_brand: item_brand,
                                        item_serialNo: item_serialNo,
                                        item_custodian: item_custodian,
                                        item_count: item_count,
                                        item_price: item_price,
                                        item_year: item_year,
                                        item_status: item_status,
                                        lendable_count: lendable_count
                                    },
                                    success: function(data) {
                                        console.log("Response:", data);
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        console.log("Status:", status);

                                        if (status == 'true') {
                                            mytable = $('#example').DataTable();
                                            mytable.draw();
                                            $('#addUserModal').modal('hide');
                                        } else {
                                            alert('Failed');
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("AJAX Error:", error);
                                    }
                                });
                            } else {
                                alert('Fill all the required fields');
                            }
                        });

                        $('#selectAll').click(function() {
                            var checkedStatus = this.checked;
                            $('.row-checkbox').each(function() {
                                $(this).prop('checked', checkedStatus);
                            });
                        });

                        // Function to trigger the print dialog with the loaded HTML content
                        function printContentFromPage(url, ids = '') {
                            $.ajax({
                                url: url,
                                type: 'GET',
                                data: { ids: ids }, // Pass IDs if needed (for print_selected.php)
                                success: function(response) {
                                    // Create an iframe to print the content
                                    var iframe = document.createElement('iframe');
                                    iframe.style.position = 'absolute';
                                    iframe.style.width = '0px';
                                    iframe.style.height = '0px';
                                    iframe.style.border = 'none';
                                    document.body.appendChild(iframe);

                                    // Write the content into the iframe
                                    var doc = iframe.contentWindow.document;
                                    doc.open();
                                    doc.write(response);
                                    doc.close();

                                    // Trigger print dialog
                                    iframe.contentWindow.focus();
                                    iframe.contentWindow.print();

                                    // Remove iframe after printing
                                    document.body.removeChild(iframe);
                                },
                                error: function() {
                                    alert('Failed to load print content.');
                                }
                            });
                        }

                        // Print selected rows
                        $('.print-btn').click(function() {
                            var selectedIds = [];
                            $('.row-checkbox:checked').each(function() {
                                selectedIds.push($(this).val());
                            });

                            if (selectedIds.length > 0) {
                                var idsString = selectedIds.join(',');
                                printContentFromPage('print_selected.php', idsString); // Load and print content from print_selected.php
                            } else {
                                alert('Please select at least one row to print.');
                                
                            }
                        });

                        // Print all rows
                        $('.print-all-btn').click(function() {
                            printContentFromPage('print_all.php'); // Load and print content from print_all.php
                        });

                        $(document).on('submit', '#updateUser', function(e) {
                            e.preventDefault();
                            //var tr = $(this).closest('tr');
                            

                            var item_name = $('#nameField').val();
                            var item_description = $('#descriptionField').val();
                            var item_brand = $('#brandField').val();
                            var item_serialNo = $('#serialNoField').val();
                            var item_custodian = $('#custodianField').val();
                            var item_count = $('#countField').val();
                            var item_price = $('#priceField').val();
                            var item_year = $('#yearField').val();
                            var item_status = $('#statusField').val();
                            var lendable_count = $('#lendablecountField').val();

                            var trid = $('#trid').val();
                            var item_id = $('#item_id').val();

                            console.log(trid);

                            if (item_name != '' && item_description != '' && item_count != '' && item_status != '' && item_custodian != '' && item_price != '' && lendable_count != '') {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: {
                                        item_name: item_name,
                                        item_description: item_description,
                                        item_brand: item_brand,
                                        item_serialNo: item_serialNo,
                                        item_custodian: item_custodian,
                                        item_count: item_count,
                                        item_price: item_price,
                                        item_year: item_year,
                                        item_status: item_status,
                                        lendable_count: lendable_count,
                                        item_id: item_id
                                    },
                                    success: function(data) {
                                        console.log("Raw response data:", data);
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        var available_count = json.available_count;
                                        var item_amount = json.item_amount;

                                        if (status == 'true') {
                                            table = $('#example').DataTable();
                                            var checkbox = '<td><input type="checkbox" class="row-checkbox" value="'+item_id+'"></td>';
                                            var button = '<td><div class= "buttons"> <a href="javascript:void();" data-id="'+ item_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a>  <a href="!#" data-item_id="' + item_id + '"  class="delete-btn btn-sm deleteBtn" ><i class="bx bxs-trash"></i></a></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([item_id, checkbox, item_name, item_serialNo, item_custodian, item_count, item_price, item_amount, item_year, lendable_count, available_count , button]);
                                            $('#exampleModal').modal('hide');
                                        } else {
                                            alert('failed');
                                        }
                                    }
                                });
                            } else {
                                alert('Fill all the required fields');
                            }
                        });
                        $('#example').on('click', '.editbtn ', function(event) {
                        var table = $('#example').DataTable();
                        var trid = $(this).closest('tr').attr('id');
                        var item_id = $(this).data('id');
                        $('#exampleModal').modal('show');

                        $.ajax({
                            url: "get_single_data.php",
                            data: {
                                item_id: item_id
                            },
                            type: 'post',
                            success: function(data) {
                                var json = JSON.parse(data);
                                $('#nameField').val(json.item_name);
                                $('#descriptionField').val(json.item_description);
                                $('#brandField').val(json.item_brand); 
                                $('#serialNoField').val(json.item_serialNo); 
                                $('#custodianField').val(json.item_custodian); 
                                $('#countField').val(json.item_count);
                                $('#priceField').val(json.item_price); 
                                $('#yearField').val(json.item_year); 
                                $('#statusField').val(json.item_status);
                                $('#lendablecountField').val(json.lendable_count); 
                                $('#item_id').val(item_id);
                                $('#trid').val(trid); 
                            }
                        })
                    });
                    $(document).on('click', '.deleteBtn', function(event) {
                    event.preventDefault();
                    var item_id = $(this).data('id'); // Get item ID from data attribute
                    var table = $('#example').DataTable();

                    // Open the modal
                    $('#deleteConfirmationModal').modal('show');

                    // Handle the confirmation
                    $('#confirmDeleteBtn').off('click').on('click', function() {
                    $.ajax({
                        url: "delete.php",
                        type: "POST",
                        data: { item_id: item_id },
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
                </section><!-- .home-->
                <!-- Modal -->
                 <!-- Update Inventory -->
                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Item</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser" onsubmit="return validateForm2();">
                            <div class="form-group">
                                <input type="hidden" name="item_id" id="item_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <label for="nameField">Item Name:</label>
                                <input type="text" id="nameField" name="item_name" value="<?php echo htmlspecialchars($item_data['item_name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="descriptionField">Item Description:</label>
                                <input type="text" id="descriptionField" name="item_description" value="<?php echo htmlspecialchars($item_data['item_description']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="brandField">Item Brand:</label>
                                <input type="text" id="brandField" name="item_brand" value="<?php echo htmlspecialchars($item_data['item_brand']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="serialNoField">Serial No:</label>
                                <input type="text" id="serialNoField" name="item_serialNo" value="<?php echo htmlspecialchars($item_data['item_serialNo']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="custodianField">Property Custodian:</label>
                                <input type="text" id="custodianField" name="item_custodian" value="<?php echo htmlspecialchars($item_data['item_custodian']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="countField">Item Quantity:</label>
                                <input type="number" id="countField" name="item_count" value="<?php echo htmlspecialchars($item_data['item_count']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="priceField">Item Price:</label>
                                <input type="number" id="priceField" name="item_price" value="<?php echo htmlspecialchars($item_data['item_price']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="yearField">Item Year:</label>
                                <input type="number" id="yearField" name="item_year" value="<?php echo htmlspecialchars($item_data['item_year']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="statusField">Item Status:</label>
                                <select id="statusField" name="item_status" required>
                                    <option value="" disabled >Select Status</option>
                                    <option value="Serviceable">Serviceable</option>
                                    <option value="Unserviceable" >Unserviceable</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lendablecountField">Lendable Quantity:</label>
                                <input type="number" id="lendablecountField" name="lendable_count" value="<?php echo htmlspecialchars($item_data['lendable_count']); ?>" required>
                            </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Inventory -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action=""  onsubmit="return validateForm();">
                                <div class="form-group">
                                    <label for="itemname">Item Name:</label>
                                    <input type="text" id="itemname" name="item_name" required>
                                </div>

                                <div class="form-group">
                                    <label for="itemdescription">Item Description:</label>
                                    <input type="text" id="itemdescription" name="item_description" required>
                                </div>

                                <div class="form-group">
                                    <label for="itembrand">Item Brand:</label>
                                    <input type="text" id="itembrand" name="item_brand" required>
                                </div>

                                <div class="form-group">
                                    <label for="itemserialNo">Serial No:</label>
                                    <input type="text" id="itemserialNo" name="item_serialNo" required>
                                </div>

                                <div class="form-group">
                                    <label for="itemcustodian">Item Custodian:</label>
                                    <input type="text" id="itemcustodian" name="item_custodian" required>
                                </div>

                                <div class="form-group">
                                    <label for="itemcount">Item Count:</label>
                                    <input type="number" id="itemcount" name="item_count" required>
                                </div>

                                <div class="form-group">
                                    <label for="itemprice">Item Price:</label>
                                    <input type="number" id="itemprice" name="item_price" required>
                                </div>

                                <div class="form-group">
                                    <label for="itemyear">Year Acquired:</label>
                                    <input type="number" id="itemyear" name="item_year" required>
                                </div>

                                <div class="form-group">
                                    <label for="itemstatus">Item Status:</label>
                                    <select id="itemstatus" name="item_status" required>
                                        <option value="" disabled>Select Status</option>
                                        <option value="Serviceable">Serviceable</option>
                                        <option value="Unserviceable">Unserviceable</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="lendablecount">Lendable Quantity:</label>
                                    <input type="number" id="lendablecount" name="lendable_count" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
        function validateForm() {
                var itemCount = parseInt(document.getElementById('itemcount').value);
                var lendableCount = parseInt(document.getElementById('lendablecount').value);

                if (lendableCount > itemCount) {
                    alert("Lendable count cannot be more than item count.");
                    return false;
                }

                return true;
            }

            function validateForm2(){
                var itemCountField = parseInt(document.getElementById('countField').value);
                var lendableCountField = parseInt(document.getElementById('lendablecountField').value);

                if (lendableCountField > itemCountField) {
                    alert("Lendable count cannot be more than item count.");
                    return false;
                }
                return true;
            }
    </script>

</html>
