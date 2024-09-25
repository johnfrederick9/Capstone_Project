<?php
include '../../sidebar.php';
include '../../head.php';
require '../../database.php';
?>

<body>
    <section class="home">  
        <div class="inventory">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Inventory Table</h1>
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
                                "aoColumnDefs": [{
                                    "bSortable": false,
                                    "aTargets": [5]
                                },

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
                                            var button = '<td><div class= "buttons"> <a href="javascript:void();" data-id="'+ item_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a>  <a href="!#" data-item_id="' + item_id + '"  class="delete-btn btn-sm deleteBtn" ><i class="bx bxs-trash"></i></a></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([item_id, item_name, item_description, item_brand, item_serialNo, item_custodian, item_count, item_price, item_amount, item_year, lendable_count, available_count , button]);
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
                            var table = $('#example').DataTable();
                            event.preventDefault();
                            var item_id = $(this).data('item_id');
                            if (confirm("Are you sure want to delete this Item ? ")) {
                                $.ajax({
                                    url: "delete.php",
                                    data: {
                                        item_id: item_id
                                    },
                                    type: "post",
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        status = json.status;
                                        if (status == 'success') {
                                            $("#" + item_id).closest('tr').remove();
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
                        <div class="add">
                            <form id="updateUser" onsubmit="return validateForm2();">
                            <input type="hidden" name="item_id" id="item_id" value="">
                            <input type="hidden" name="trid" id="trid" value="">
                            <div class="form-grid">
                            <div class="input-wrapper">
                                <label for="nameField" class="input-label">Item Name:</label>
                                <input type="text" id="nameField" name="item_name" class="input-field" value="<?php echo htmlspecialchars($item_data['item_name']); ?>" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="descriptionField" class="input-label">Item Description:</label>
                                <input type="text" id="descriptionField" name="item_description" class="input-field" value="<?php echo htmlspecialchars($item_data['item_description']); ?>" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="brandField" class="input-label">Item Brand:</label>
                                <input type="text" id="brandField" name="item_brand" class="input-field" value="<?php echo htmlspecialchars($item_data['item_brand']); ?>" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="serialNoField" class="input-label">Serial No:</label>
                                <input type="text" id="serialNoField" name="item_serialNo" class="input-field" value="<?php echo htmlspecialchars($item_data['item_serialNo']); ?>" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="custodianField" class="input-label">Property Custodian:</label>
                                <input type="text" id="custodianField" name="item_custodian" class="input-field" value="<?php echo htmlspecialchars($item_data['item_custodian']); ?>" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="countField" class="input-label">Item Quantity:</label>
                                <input type="number" id="countField" name="item_count" class="input-field" value="<?php echo htmlspecialchars($item_data['item_count']); ?>" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="priceField" class="input-label">Item Price:</label>
                                <input type="number" id="priceField" name="item_price" class="input-field" value="<?php echo htmlspecialchars($item_data['item_price']); ?>" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="yearField" class="input-label">Item Year:</label>
                                <input type="number" id="yearField" name="item_year" class="input-field" value="<?php echo htmlspecialchars($item_data['item_year']); ?>" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="statusField" class="input-label">Item Status:</label>
                                <select id="statusField" name="item_status" class="input-field" required>
                                    <option value="" disabled >Select Status</option>
                                    <option value="Serviceable">Serviceable</option>
                                    <option value="Unserviceable" >Unserviceable</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="lendablecountField" class="input-label">Lendable Quantity:</label>
                                <input type="number" id="lendablecountField" name="lendable_count" class="input-field" value="<?php echo htmlspecialchars($item_data['lendable_count']); ?>" required>
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
                        <div class="add">
                            <form id="addUser" action=""  onsubmit="return validateForm();">
                            <div class="form-grid">
                            <div class="input-wrapper">
                                    <label for="itemname" class="input-label">Item Name:</label>
                                    <input type="text" id="itemname" name="item_name" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemdescription" class="input-label">Item Description:</label>
                                    <input type="text" id="itemdescription" name="item_description" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itembrand" class="input-label">Item Brand:</label>
                                    <input type="text" id="itembrand" name="item_brand" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemserialNo" class="input-label">Serial No:</label>
                                    <input type="text" id="itemserialNo" name="item_serialNo" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemcustodian" class="input-label">Item Custodian:</label>
                                    <input type="text" id="itemcustodian" name="item_custodian" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemcount" class="input-label">Item Count:</label>
                                    <input type="number" id="itemcount" name="item_count" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemprice" class="input-label">Item Price:</label>
                                    <input type="number" id="itemprice" name="item_price" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemyear" class="input-label">Year Acquired:</label>
                                    <input type="number" id="itemyear" name="item_year" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemstatus" class="input-label">Item Status:</label>
                                    <select id="itemstatus" name="item_status" class="input-field" required>
                                        <option value="" disabled>Select Status</option>
                                        <option value="Serviceable">Serviceable</option>
                                        <option value="Unserviceable">Unserviceable</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>

                                <div class="input-wrapper">
                                    <label for="lendablecount" class="input-label">Lendable Quantity:</label>
                                    <input type="number" id="lendablecount" name="lendable_count" class="input-field" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
