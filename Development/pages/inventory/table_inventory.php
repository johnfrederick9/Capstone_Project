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
                        <th>Item Name</th>
                        <th>Item Description</th>
                        <th>Item Count</th>
                        <th>Item Status</th>
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
                                    "aTargets": [4]
                                },

                                ]
                            });
                        });
                        $(document).on('submit', '#addUser', function(e) {
                            e.preventDefault();
                            var item_name = $('#item_name').val();
                            var item_description = $('#item_description').val();
                            var item_count = $('#item_count').val();
                            var item_status = $('#item_status').val();
                            if (item_name != '' && item_description != '' && item_count != '' && item_status != '') {
                                $.ajax({
                                    url: "add.php",
                                    type: "post",
                                    data: {
                                        item_name: item_name,
                                        item_description: item_description,
                                        item_count: item_count,
                                        item_status: item_status
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        if (status == 'true') {
                                            mytable = $('#example').DataTable();
                                            mytable.draw();
                                            $('#addUserModal').modal('hide');
                                        } else {
                                            alert('failed');
                                        }
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
                            var item_count = $('#countField').val();
                            var item_status = $('#statusField').val();
                            var trid = $('#trid').val();
                            var item_id = $('#item_id').val();
                            if (item_name != '' && item_description != '' && item_count != '' && item_status != '') {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: {
                                        item_name: item_name,
                                        item_description: item_description,
                                        item_count: item_count,
                                        item_status: item_status,
                                        item_id: item_id
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        if (status == 'true') {
                                            table = $('#example').DataTable();
                                            var button = '<td><div class= "buttons"> <a href="javascript:void();" data-id="'+ item_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a>  <a href="!#" data-item_id="' + item_id + '"  class="delete-btn btn-sm deleteBtn" ><i class="bx bxs-trash"></i></a></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([item_id, item_name, item_description, item_count, item_status, button]);
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
                        // console.log(selectedRow);
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
                                $('#countField').val(json.item_count);
                                $('#statusField').val(json.item_status);
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
                            <form id="updateUser">
                                <input type="hidden" name="item_id" id="item_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="form-group">
                                    <label for="itemname">Item Name</label>
                                    <div class="input-wrapper">
                                        <input type="text" id="nameField" name="item_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="itemdescription">Item Description</label>
                                    <div class="input-wrapper">
                                        <input type="text" id="descriptionField" name="item_description">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="itemcount">Item Description</label>
                                    <div class="input-wrapper">
                                        <input type="nmumber" id="countField" name="item_count">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="itemstatus">Item Status:</label>
                                    <select id="statusField" name="item_status" required>
                                        <option value="" disabled>Select Status</option>
                                        <option value="New">New</option>
                                        <option value="Used">Used</option>
                                        <!-- Add more options as needed -->
                                    </select>
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
                            <form id="addUser" action="">
                            <div class="form-group">
                                    <label for="financialDate">Item Name</label>
                                    <div class="input-wrapper">
                                        <input type="text" id="item_name" name="item_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="financialDate">Item Description</label>
                                    <div class="input-wrapper">
                                        <input type="text" id="item_description" name="item_description">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="financialDate">Item Count</label>
                                    <div class="input-wrapper">
                                        <input type="number" id="item_count" name="item_count">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="itemstatus">Item Status:</label>
                                    <select id="item_status" name="item_status" required>
                                        <option value="Select Status" disabled>Select Status</option>
                                        <option value="New">New</option>
                                        <option value="Used">Used</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </body> 
</html>
