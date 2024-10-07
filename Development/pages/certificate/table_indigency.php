<?php
include '../../head.php';
include '../../sidebar.php';
?>
<body>
    <section class="home">  
        <div class="certificate">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Indigency Certificate Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Certificate</button>
                            <!--<button class="print-btn" title="Print">
                                <i class="bx bx-printer"></i>
                            </button>-->
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>Child's Name</th>
                        <th>Mother's Name</th>
                        <th>Father's Name</th>
                        <th>Certificate Date Issued</th>
                        <th>Actions</th>
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
                            var indigency_cname = $('#indigency_cname').val();
                            var indigency_mname = $('#indigency_mname').val();
                            var indigency_fname = $('#indigency_fname').val();
                            var indigency_date = $('#indigency_date').val();
                            if (indigency_cname != '' && indigency_mname != '' && indigency_fname != '' && indigency_date != '') {
                                $.ajax({
                                    url: "add.php",
                                    type: "post",
                                    data: {
                                        indigency_cname: indigency_cname,
                                        indigency_mname: indigency_mname,
                                        indigency_fname: indigency_fname,
                                        indigency_date: indigency_date,
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
                            var indigency_cname = $('#cnameField').val();
                            var indigency_mname = $('#mnameField').val();
                            var indigency_fname = $('#fnameField').val();
                            var indigency_date = $('#dateField').val();
                            var trid = $('#trid').val();
                            var indigency_id = $('#indigency_id').val();
                            if (indigency_cname != '' && indigency_mname != '' && indigency_fname != '' && indigency_date != '') {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: {
                                        indigency_cname: indigency_cname,
                                        indigency_mname: indigency_mname,
                                        indigency_fname: indigency_fname,
                                        indigency_date: indigency_date,
                                        indigency_id: indigency_id
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        if (status == 'true') {
                                            table = $('#example').DataTable();
                                            var button = '<td><div class= "buttons"> <a href="javascript:void();" data-id="'+ indigency_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a> <button class="print-btn" data-id="'+indigency_id+'" title="Print Selected"> <i class="bx bx-printer"></i></button></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([indigency_cname, indigency_mname, indigency_fname, indigency_date, button]);
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
                        var indigency_id = $(this).data('id');
                        $('#exampleModal').modal('show');

                        $.ajax({
                            url: "get_single_data.php",
                            data: {
                                indigency_id: indigency_id
                            },
                            type: 'post',
                            success: function(data) {
                                var json = JSON.parse(data);
                                $('#cnameField').val(json.indigency_cname);
                                $('#mnameField').val(json.indigency_mname);
                                $('#fnameField').val(json.indigency_fname);
                                $('#dateField').val(json.indigency_date);
                                $('#indigency_id').val(indigency_id);
                                $('#trid').val(trid);
                            }
                        })
                    });
                    $(document).ready(function() {
                    // Event listener for the print button
                    $(document).on('click', '.print-btn', function() {
                        var indigencyId = $(this).data('id'); // Get the indigency_id

                        // Make an AJAX request to fetch the certificate content
                        $.ajax({
                            url: 'fetch_indigency.php', // URL to fetch the certificate HTML
                            type: 'POST',
                            data: {id: indigencyId},
                            success: function(response) {
                                // Create a new window to print the content
                                var printWindow = window.open('', '', 'height=600,width=800');
                                printWindow.document.write(response);
                                printWindow.document.close();
                                printWindow.focus();
                                printWindow.print();
                                printWindow.close();
                            }
                        });
                    });
                });
                    </script>
                </section><!-- .home-->
                <!-- Modal -->
                <!-- Update Indigency -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Indigency Issued Update Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="indigency_id" id="indigency_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="certificate">
                                <div class="form-group">
                                    <label for="certificatedate"> Child's Name:</label>
                                    <input type="text" id="cnameField" name="indigency_cname">
                                </div>
                                <div class="form-group">
                                    <label for="certificate">Mother's Name:</label>
                                    <input type="text" id="mnameField" name="indigency_mname" required>
                                </div>
                                <div class="form-group">
                                    <label for="certificatedate"> Father's Name:</label>
                                    <input type="text" id="fnameField" name="indigency_fname" required>
                                </div>
                                <div class="form-group">
                                    <label for="certificatedate"> Issued Date:</label>
                                    <input type="date" id="dateField" name="indigency_date" required>
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
            <!-- Add Indigency -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Indigency Issued Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                            <div class="certificate">
                                <div class="form-group">
                                    <label for="certificatedate"> Child's Name:</label>
                                    <input type="text" id="indigency_cname" name="indigency_cname">
                                </div>
                                <div class="form-group">
                                    <label for="certificate">Mother's Name:</label>
                                    <input type="text" id="indigency_mname" name="indigency_mname">
                                </div>
                                <div class="form-group">
                                    <label for="certificatedate"> Father's Name:</label>
                                    <input type="text" id="indigency_fname" name="indigency_fname">
                                </div>
                                <div class="form-group">
                                    <label for="certificatedate"> Issued Date:</label>
                                    <input type="date" id="indigency_date" name="indigency_date">
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

