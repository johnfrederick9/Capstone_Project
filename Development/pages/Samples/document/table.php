<?php
include '../../head.php';
?>

<body>
    <section class="home">  
        <div class="text">Sample</div>
        <div class="inventory">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Document Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Document</button>
                            <!--<button class="print-btn" title="Print">
                                <i class="bx bx-printer"></i>
                            </button>-->
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Document Name</th>
                        <th>Document Date</th>
                        <th>Document Info</th>
                        <th>Document Type</th>
                        <th>Update</th>
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
                            var document_name = $('#document_name').val();
                            var document_date = $('#document_date').val();
                            var document_info = $('#document_info').val();
                            var document_type = $('#document_type').val();
                            //var document_filepath = $('#fileInput').val();
                            if (document_name != '' && document_date != '' && document_info != '' && document_type != '') {
                                $.ajax({
                                    url: "add.php",
                                    type: "post",
                                    data: {
                                        document_name: document_name,
                                        document_date: document_date,
                                        document_info: document_info,
                                        document_type: document_type,
                                        //document_filepath: document_filepath,
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
                            var document_name = $('#nameField').val();
                            var document_date = $('#dateField').val();
                            var document_info = $('#infoField').val();
                            var document_type = $('#typeField').val();
                            var trid = $('#trid').val();
                            var document_id = $('#document_id').val();
                            if (document_name != '' && document_date != '' && document_info != '' && document_type != '') {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: {
                                        document_name: document_name,
                                        document_date: document_date,
                                        document_info: document_info,
                                        document_type: document_type,
                                        document_id: document_id
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        if (status == 'true') {
                                            table = $('#example').DataTable();
                                            var button = '<td><div class= "buttons"> <a href="javascript:void();" data-id="'+ document_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([document_id, document_name, document_date, document_info, document_type, button]);
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
                        var document_id = $(this).data('id');
                        $('#exampleModal').modal('show');

                        $.ajax({
                            url: "get_single_data.php",
                            data: {
                                document_id: document_id
                            },
                            type: 'post',
                            success: function(data) {
                                var json = JSON.parse(data);
                                $('#nameField').val(json.document_name);
                                $('#dateField').val(json.document_date);
                                $('#infoField').val(json.document_info);
                                $('#typeField').val(json.document_type);
                                $('#document_id').val(document_id);
                                $('#trid').val(trid);
                            }
                        })
                    });

                    </script>
                </section><!-- .home-->
                <!-- Modal -->
                <!-- Update Project -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Document</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="document_id" id="document_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="form-group">
                                <label for="documentName">Document Name</label>
                                <input type="text" id="nameField" name="document_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="documentDate">Document Date</label>
                                    <input type="date" id="dateField" name="document_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="documentInfo">Document Info</label>
                                    <input type="text" id="infoField" name="document_info" required>
                                </div>
                                <div class="form-group">
                                    <label for="documentType">Document Type</label>
                                    <input type="text" id="typeField" name="document_type" required>
                                </div>
                                <!--<div class="file-upload">
                                    <label for="fileInput" id="fileLabel" style="background-color: #ffdddd;">
                                        <i class='bx bx-paperclip'></i> Attach File
                                    </label>
                                    <span>Document File</span>
                                    <input type="file" id="fileInput" name="document_filepath" required onchange="checkFile()">
                                </div>-->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Project -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Document</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                            <div class="form-group">
                                <label for="documentName">Document Name</label>
                                <input type="text" id="document_name" name="document_name" required>
                            </div>
                            <div class="form-group">
                                <label for="documentDate">Document Date</label>
                                <input type="date" id="document_date" name="document_date" required>
                            </div>
                            <div class="form-group">
                                <label for="documentInfo">Document Info</label>
                                <input type="text" id="document_info" name="document_info" required>
                            </div>
                            <div class="form-group">
                                <label for="documentType">Document Type</label>
                                <input type="text" id="document_type" name="document_type" required>
                            </div>
                            <!--<div class="file-upload">
                                <label for="fileInput" id="fileLabel" style="background-color: #ffdddd;">
                                    <i class='bx bx-paperclip'></i> Attach File
                                </label>
                                <span>Document File</span>
                                <input type="file" id="fileInput" name="document_filepath" required onchange="checkFile()">
                            </div>-->
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
