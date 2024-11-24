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
                            <h1>Residency Certificate Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn">+ Add</button>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Issued Requirements</th>
                        <th>Certificate Date Issued</th>
                        <th>Paid</th>
                        <th>DST</th>
                        <th>Buttons</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                <?php include 'function.php'?>
                </section><!-- .home-->
                <!-- Modal -->
                <!-- Update residency -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Residency Issued Update Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="residency_id" id="residency_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="certificate">
                                <div class="form-group">
                                    <label for="certificate">Name:</label>
                                    <input type="text" id="nameField" name="residency_name">
                                </div>
                                <div class="form-group">
                                    <label for="certificate">Requirements Issued:</label>
                                    <input type="text" id="issuedField" name="residency_issued" require>
                                </div>
                                <div class="form-group">
                                    <label for="certificate"> Issued Date:</label>
                                    <input type="date" id="dateField" name="residency_date" require>
                                </div>
                                <div class="form-row" style="display: flex; gap: 10px; align-items: center;">
                                    <div class="form-group" style="flex: 1;">
                                        <label for="paidField">Paid:</label>
                                        <input type="number" id="paidField" name="residency_paid" require>
                                    </div>
                                    <div class="form-group" style="flex: 1;">
                                        <label for="dstField">D.S.T:</label>
                                        <input type="number" id="dstField" name="residency_dst" require>
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
            <!-- Add residency -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Residency Issued Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                            <div class="certificate">
                                <div class="form-group">
                                    <label for="certificate">Name:</label>
                                    <input type="text" id="residency_name" name="residency_name">
                                </div>
                                <div class="form-group">
                                    <label for="certificate">Requirements Issued:</label>
                                    <input type="text" id="residency_issued" name="residency_issued" require>
                                </div>
                                <div class="form-group">
                                    <label for="certificate"> Issued Date:</label>
                                    <input type="date" id="residency_date" name="residency_date" require>
                                </div>
                                <div class="form-row" style="display: flex; gap: 10px; align-items: center;">
                                    <div class="form-group" style="flex: 1;">
                                        <label for="paidField">Paid:</label>
                                        <input type="number" id="residency_paid" name="residency_paid" require>
                                    </div>
                                    <div class="form-group" style="flex: 1;">
                                        <label for="dstField">D.S.T:</label>
                                        <input type="number" id="residency_dst" name="residency_dst" require>
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

