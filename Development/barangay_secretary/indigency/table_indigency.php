<?php
include '../../head.php';
include '../../sidebar_mainofficials.php';
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
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn">+ Add</button>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Child's Name</th>
                        <th>Mother's Name</th>
                        <th>Father's Name</th>
                        <th>Certificate Date Issued</th>
                        <th>Buttons</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                <?php include 'function.php'?>
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
                                    <input type="text" id="mnameField" name="indigency_mname" require>
                                </div>
                                <div class="form-group">
                                    <label for="certificatedate"> Father's Name:</label>
                                    <input type="text" id="fnameField" name="indigency_fname" require>
                                </div>
                                <div class="form-group">
                                    <label for="certificatedate"> Issued Date:</label>
                                    <input type="date" id="dateField" name="indigency_date" require>
                                </div>
                                <div class="form-row" style="display: flex; gap: 10px; align-items: center;">
                                    <div class="form-group" style="flex: 1;">
                                        <label for="paidField">Paid:</label>
                                        <input type="number" id="paidField" name="indigency_paid" require>
                                    </div>
                                    <div class="form-group" style="flex: 1;">
                                        <label for="dstField">DST:</label>
                                        <input type="number" id="dstField" name="indigency_dst" require>
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
                                <div class="form-row" style="display: flex; gap: 10px; align-items: center;">
                                    <div class="form-group" style="flex: 1;">
                                        <label for="paidField">Paid:</label>
                                        <input type="number" id="indigency_paid" name="indigency_paid" require>
                                    </div>
                                    <div class="form-group" style="flex: 1;">
                                        <label for="dstField">DST:</label>
                                        <input type="number" id="indigency_dst" name="indigency_dst" require>
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
            <!-- Print Modal -->
            <section class="print-modal">
            <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-body text-center">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Choose a print option:</h5>
                            <button id="printOption1" class="btn btn-primary" data-id=""><i class="bx bx-printer"></i> Certificate of Indigency</button>
                            <button id="printOption2" class="btn btn-secondary" data-id=""><i class="bx bx-printer"></i> Certificate of Indigency-BIR</button>
                    </div>
                </div>
            </div>
        </div>
        </section>
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
</html>

