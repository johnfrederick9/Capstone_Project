<?php
include '../../head.php';
include '../../sidebar.php';
?>
<body>
    <section class="home">  
        <div class="inventory">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Project Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Project</button>
                            <button class="print-btn " title="Print Selected">
                            <i class="bx bx-printer"></i>
                        </button>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                    <th><button class="print-all-btn" title="Print All">
                                <i class="bx bx-printer"></i>
                            </button>
                        </th>
                        <th>Project Name</th>
                        <th>Project Start</th>
                        <th>Project End</th>
                        <th>Project Budget</th>
                        <th>Project Source</th>
                        <th>Project Location</th>
                        <th>Project Managers</th>
                        <th>Stakeholders</th>
                        <th>Project Status</th>
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
                                    "aTargets": [10]
                                },

                                ]
                            });
                        });
                        $(document).on('submit', '#addUser', function(e) {
                            e.preventDefault();
                            var project_name = $('#project_name').val();
                            var project_start = $('#project_start').val();
                            var project_end = $('#project_end').val();
                            var project_budget = $('#project_budget').val();
                            var project_source = $('#project_source').val();
                            var project_location = $('#project_location').val();
                            var project_managers = $('#project_managers').val();
                            var project_stakeholders = $('#project_stakeholders').val();
                            var project_status = $('#project_status').val();
                            var project_description = $('#project_description').val();
                            if (project_name != '' && project_start != '' && project_end != '' && project_budget != '' && project_source != '' && project_location != '' && project_managers != '' && project_stakeholders != '' && project_status != '' && project_description != '') {
                                $.ajax({
                                    url: "add.php",
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
                                            var checkbox = '<input type="checkbox" class="row-checkbox" value="' +project_id+'">';
                                            var button = '<td><div class= "buttons"> <a href="javascript:void();" data-id="'+ project_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([checkbox, project_name, project_start, project_end, project_budget, project_source, project_location, project_managers, project_stakeholders, project_status, button]);
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
                        var project_id = $(this).data('id');
                        $('#exampleModal').modal('show');

                        $.ajax({
                            url: "get_single_data.php",
                            data: {
                                project_id: project_id
                            },
                            type: 'post',
                            success: function(data) {
                                var json = JSON.parse(data);
                                $('#nameField').val(json.project_name);
                                $('#startField').val(json.project_start);
                                $('#endField').val(json.project_end);
                                $('#budgetField').val(json.project_budget);
                                $('#sourceField').val(json.project_source);
                                $('#locationField').val(json.project_location);
                                $('#managersField').val(json.project_managers);
                                $('#stakeholdersField').val(json.project_stakeholders);
                                $('#statusField').val(json.project_status);
                                $('#descriptionField').val(json.project_description);
                                $('#project_id').val(project_id);
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
                            <h5 class="modal-title" id="exampleModalLabel">Update Project</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="project_id" id="project_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="add">
                                    <div class="form-grid">
                                    <div class="input-wrapper">
                                        <label for="ProjectName" class="input-label">Project Name:</label>
                                        <input type="text" placeholder="Project Name" id="nameField" name="project_name" class="input-field">
                                    </div>
                                    <div class="input-wrapper ">
                                        <label for="Project Start" class="input-label">Project Start:</label>
                                        <input type="date" id="startField" name="project_start" class="input-field">
                                    </div>
                                    <div class="input-wrapper ">
                                        <label for="Project End" class="input-label">Project End:</label>
                                        <input type="date" id="endField" name="project_end" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                    <label for="Project Location" class="input-label">Project Budget:</label>
                                        <input type="number" placeholder="Project Budget" id="budgetField" name="project_budget" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                    <label for="Project Funding" class="input-label">Funding Source:</label>
                                        <input type="text" placeholder="Project Funding" id="sourceField" name="project_source" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                        <label for="Project Status" class="input-label">Project Status:</label>
                                        <select id="statusField" name="project_status" class="input-field">
                                        <option value="" disabled selected>Project Status</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="#"></option>
                                        </select>
                                    </div>

                                    <div class="input-wrapper address">
                                        <label for="Project Status" class="input-label">Project Description & Location:</label>
                                        <input type="text" placeholder="Project Description" id="descriptionField"  name="project_description" class="input-field">
                                        <input type="text" placeholder="Project Location" id="locationField" name="project_location" class="input-field">
                                    </div>
                                    
                                    <div class="input-wrapper ">
                                        <label for="Project Status" class="input-label">Project Managers:</label>
                                        <input type="text" placeholder="Project Managers"  name="project_managers" id="managersField" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                        <label for="Project Status" class="input-label">Stakeholders:</label>
                                        <input type="text" placeholder="Stakeholders" name="project_stakeholders" id="stakeholdersField" class="input-field">
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
            <!-- Add Project -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                                <div class="add">
                                    <div class="form-grid">
                                    <div class="input-wrapper">
                                        <label for="ProjectName" class="input-label">Project Name:</label>
                                        <input type="text" placeholder="Project Name" id="project_name" name="project_name" class="input-field">
                                    </div>
                                    <div class="input-wrapper ">
                                        <label for="Project Start" class="input-label">Project Start:</label>
                                        <input type="date" id="project_start" name="project_start" class="input-field">
                                    </div>
                                    <div class="input-wrapper ">
                                        <label for="Project End" class="input-label">Project End:</label>
                                        <input type="date" id="project_end" name="project_end" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                    <label for="Project Location" class="input-label">Project Budget:</label>
                                        <input type="number" placeholder="Project Budget" id="project_budget" name="project_budget" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                    <label for="Project Funding" class="input-label">Funding Source:</label>
                                        <input type="text" placeholder="Project Funding" id="project_source" name="project_source" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                        <label for="Project Status" class="input-label">Project Status:</label>
                                        <select id="project_status" name="project_status" class="input-field">
                                        <option value="" disabled selected>Project Status</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="#"></option>
                                        </select>
                                    </div>

                                    <div class="input-wrapper address">
                                        <label for="Project Status" class="input-label">Project Description & Location:</label>
                                        <input type="text" placeholder="Project Description"  name="project_description" id="project_description" class="input-field">
                                        <input type="text" placeholder="Project Location" id="project_location" name="project_location" class="input-field">
                                    </div>
                                    
                                    <div class="input-wrapper ">
                                        <label for="Project Status" class="input-label">Project Managers:</label>
                                        <input type="text" placeholder="Project Managers"  name="project_managers" id="project_managers" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                        <label for="Project Status" class="input-label">Stakeholders:</label>
                                        <input type="text" placeholder="Stakeholders" name="project_stakeholders" id="project_stakeholders" class="input-field">
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
    </body> 
</html>
