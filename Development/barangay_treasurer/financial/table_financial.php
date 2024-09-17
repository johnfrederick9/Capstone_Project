<?php
include '../../head.php';
include '../sidebar.php';
?>
<body>
    <section class="home">  
        <div class="financial">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Financial Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Table</button>
                            <!--<button class="print-btn" title="Print">
                                <i class="bx bx-printer"></i>
                            </button>-->
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Financial Type</th>
                        <th>Financial Date</th>
                        <th>File Name</th>
                        <th class="action">Action</th>
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
                            var financial_type = $('#financial_type').val();
                            var financial_date = $('#todayDate').val();
                            var financial_filepath = $('#fileInput').val();

                            if (financial_type != '' && financial_date != '' && financial_filepath != '') {
                                $.ajax({
                                    url: "add.php",
                                    type: "post",
                                    data: {
                                        financial_type: financial_type,
                                        financial_date: financial_date,
                                        financial_filepath: financial_filepath,
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
                            var project_name = $('#nameField').val();
                            var project_start = $('#startField').val();
                            var project_end = $('#endField').val();
                            var project_budget = $('#budgetField').val();
                            var project_source = $('#sourceField').val();
                            var project_location = $('#locationField').val();
                            var project_managers = $('#managersField').val();
                            var project_stakeholders = $('#stakeholdersField').val();
                            var project_status = $('#statusField').val();
                            var project_description = $('#descriptionField').val();
                            var trid = $('#trid').val();
                            var project_id = $('#project_id').val();
                            if (project_name != '' && project_start != '' && project_end != '' && project_budget != '' && project_source != '' && project_location != '' && project_managers != '' && project_stakeholders != '' && project_status != '' && project_description != '') {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: {
                                        project_name: project_name,
                                        project_start: project_start,
                                        project_end: project_end,
                                        project_budget: project_budget,
                                        project_source: project_source,
                                        project_location: project_location,
                                        project_managers: project_managers,
                                        project_stakeholders: project_stakeholders,
                                        project_status: project_status,
                                        project_description: project_description,
                                        project_id: project_id
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        if (status == 'true') {
                                            table = $('#example').DataTable();
                                            var button = '<td><div class= "buttons"> <a href="javascript:void();" data-id="'+ project_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([project_id, project_name, project_start, project_end, project_budget, project_source, project_location, project_managers, project_stakeholders, project_status, button]);
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
                        var financial_id     = $(this).data('id');
                        $('#exampleModal').modal('show');

                        $.ajax({
                            url: "get_single_data.php",
                            data: {
                                financial_id: financial_id
                            },
                            type: 'post',
                            success: function(data) {
                                var json = JSON.parse(data);
                                $('#typeField').val(json.financial_type);
                                $('#dateField').val(json.financial_date);
                                $('#fileField').val(json.financial_file);
                                $('#financial_id').val(financial_id);
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
                            <h5 class="modal-title" id="exampleModalLabel">Update employee</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="project_id" id="project_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="form-group">
                                <label for="financialType">Financial Type:</label>
                                <select id="typeField" name="financial_type">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Expense">Expense</option>
                                    <option value="Budget">Budget</option>
                                    <option value="Tax">Tax</option>
                                </select>
                            </div>
                                <div class="form-group">
                                    <label for="financialDate">Financial Date:</label>
                                    <div class="input-wrapper">
                                        <input type="date" id="dateField" name="financial_date">
                                    </div>
                                </div>
                                <div class="file-upload">
                                <label for="fileInput" id="fileLabel" style="background-color: #ffdddd;">
                                    <i class='bx bx-paperclip'></i> Attach File
                                </label>
                                <span>Financial File</span>
                                <input type="file" id="fileField" name="financial_filepath" required onchange="checkFile()">
                            </div>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add employee</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                            <div class="form-group">
                                <label for="financialType">Financial Type:</label>
                                <select id="financial_type" name="financial_type">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Expense">Expense</option>
                                    <option value="Budget">Budget</option>
                                    <option value="Tax">Tax</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="financialDate">Financial Date:</label>
                                <div class="input-wrapper">
                                    <input type="date" id="todayDate" name="financial_date">
                                </div>
                            </div>
                            <div class="file-upload">
                            <label for="fileInput" id="fileLabel" style="background-color: #ffdddd;">
                                <i class='bx bx-paperclip'></i> Attach File
                            </label>
                            <span>Financial File</span>
                            <input type="file" id="fileInput" name="financial_filepath" required onchange="checkFile()">
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
    <script>
        //Today's Date Script
        // Set today's date to the input field with id="todayDate"
        document.getElementById('todayDate').value = new Date().toISOString().split('T')[0];
    </script>
</html>
