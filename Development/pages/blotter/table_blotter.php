<?php
include '../../head.php';
include '../../sidebar.php';
?>
<body>
    <style>
        .blooterM .modal-lg{
            max-width: 90%;
        }
    </style>
    <section class="home">  
        <div class="certificate">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Blotter Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Blotter</button>
                            <!--<button class="print-btn" title="Print">
                                <i class="bx bx-printer"></i>
                            </button>-->
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>Complainant Name</th>
                        <th>Complainant Contact No.</th>
                        <th>Complainant Address</th>
                        <th>Complainee Name</th>
                        <th>Complainee Contact No.</th>
                        <th>Complainee Address</th>
                        <th>Complaint</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Incidence</th>
                        <th>Date Recorded</th>
                        <th>Date Settled</th>
                        <th>Recorded By</th>
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
             <section class="blotterM">
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Blotter Record Form</h5>
                <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addBlotter" action="">
                    <div class="certificate">
                        <!-- First Row -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="blotter_complainant">Complainant's Name:</label>
                                <input type="text" id="blotter_complainant" name="blotter_complainant" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blotter_complainant_no">Complainant's Contact No.:</label>
                                <input type="text" id="blotter_complainant_no" name="blotter_complainant_no" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="blotter_complainant_add">Complainant's Address:</label>
                                <input type="text" id="blotter_complainant_add" name="blotter_complainant_add" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blotter_complainee">Complainee's Name:</label>
                                <input type="text" id="blotter_complainee" name="blotter_complainee" required>
                            </div>
                        </div>
                        
                        <!-- Second Row -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="blotter_complainee_no">Complainee's Contact No.:</label>
                                <input type="text" id="blotter_complainee_no" name="blotter_complainee_no" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blotter_complainee_add">Complainee's Address:</label>
                                <input type="text" id="blotter_complainee_add" name="blotter_complainee_add" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="blotter_complaint">Complaint:</label>
                                <input type="text" id="blotter_complaint" name="blotter_complaint" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blotter_status">Status:</label>
                                <input type="text" id="blotter_status" name="blotter_status" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="blotter_action">Action Taken:</label>
                                <input type="text" id="blotter_action" name="blotter_action" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blotter_incidence">Incidence:</label>
                                <input type="text" id="blotter_incidence" name="blotter_incidence" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="blotter_date_recorded">Date Recorded:</label>
                                <input type="date" id="blotter_date_recorded" name="blotter_date_recorded" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blotter_date_settled">Date Settled:</label>
                                <input type="date" id="blotter_date_settled" name="blotter_date_settled">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="blotter_recorded_by">Recorded By:</label>
                                <input type="text" id="blotter_recorded_by" name="blotter_recorded_by" required>
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
            </section>

    </body> 
    <script>
    function printCertificate(id) {
        window.open('indigency_certificate.php?indigency_id=' + id, '_blank');
    }
    </script>
</html>

