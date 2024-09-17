<?php
include '../../head.php';
include '../sidebar.php';
?>
<style>
    .head{
        margin-top: 10px;
    }
    .certificate{
        margin-top: 20px;
    }
    .certificate .add-popup{
        display: none;
    }
    .dataTables_filter{
      margin-left: 800px;
    }
</style>
<body>
    <section class="home">  
        <div class="certificate">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Certificate Table</h1>
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
                                    "aTargets": [3]
                                },

                                ]
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
                                    <input type="text" id="indigency_mname" name="indigency_mname" required>
                                </div>
                                <div class="form-group">
                                    <label for="certificatedate"> Father's Name:</label>
                                    <input type="text" id="indigency_fname" name="indigency_fname" required>
                                </div>
                                <div class="form-group">
                                    <label for="certificatedate"> Issued Date:</label>
                                    <input type="date" id="indigency_date" name="indigency_date" required>
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
    <script>
    function printCertificate(id) {
        window.open('indigency_certificate.php?indigency_id=' + id, '_blank');
    }
    </script>
</html>

