<?php
include '../../head.php';
include '../../sidebar_mainofficials.php';
include '../../connection.php';

// Assuming you have a database connection in $conn
$query = "SELECT resident_id, CONCAT(resident_firstname, ' ', 
                                     IF(resident_middlename != '' AND resident_middlename IS NOT NULL, CONCAT(LEFT(resident_middlename, 1), '.'), ''), ' ', 
                                     resident_lastname) 
          AS resident_fullname 
          FROM tb_resident";
$result = mysqli_query($conn, $query);

$residents = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $residents[] = $row;
    }
}
?>
<style>
    .form-group{
        margin-top: -5px;
    }
</style>
<body>
    <section class="home">  
        <div class="certificate">
        <div class="table-container" style="overflow: visible;">
                    <div class="table-header">
                    <div class="head">
                            <h1>Request Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn">+ Add</button>
                            <button class="print-btn " title="Print Selected">
                                <i class="bx bx-printer"></i>
                            </button>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                    <th>#</th>
                    <th>
                        <button class="print-all-btn" title="Print All">
                                    <i class="bx bx-printer"></i>
                            </button>
                        </th>
                        <th>Requester Name</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Buttons</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                <?php include 'function.php'?>
                </section><!-- .home-->
                 <!-- Modal -->
                <!-- Update Request -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Request Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateRequest" action="">
                            <input type="hidden" name="request_id" id="request_id" value="">
                            <input type="hidden" name="trid" id="trid" value="">
                                <div class="form-group">
                                    <label for="requestername">Requester Name</label>
                                    <input type="text" id="requester_nameField" name="requester_nameField" required>
                                </div>
                                <div class="form-group">
                                    <label for="requesttype">Request Type</label>
                                    <input type="text" id="request_typeField" name="request_typeField" required>
                                </div>
                                <div class="form-group">
                                    <label for="requestdescription">Request Description</label>
                                    <input type="text" id="request_descriptionField" name="request_descriptionField" required>
                                </div>
                                <div class="form-group">
                                    <label for="requestdate">Request Date</label>
                                    <input type="datetime-local" id="request_dateField" name="request_dateField" required>
                                </div>
                                <div class="form-group">
                                    <label for="requeststatus">Request Status</label>
                                    <select id="request_statusField" name="request_statusField">
                                        <option value="" disabled selected>Status</option>
                                            <option value="New">New</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Completed">Completed</option>
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
            <!-- Add Modal -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Request Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="addRequest" action="">
                            <div class="form-group">
                                <label for="requestername">Requester Name</label>
                                <input type="text" id="requester_name" name="requester_name" required>
                            </div>
                            <div class="form-group">
                                <label for="requesttype">Request Type</label>
                                <input type="text" id="request_type" name="request_type" required>
                            </div>
                            <div class="form-group">
                                <label for="requestdescription">Request Description</label>
                                <input type="text" id="request_description" name="request_description" required>
                            </div>
                            <div class="form-group">
                                <label for="requestdate">Request Date</label>
                                <input type="datetime-local" id="request_date" name="request_date" required>
                            </div>
                            <div class="form-group">
                                <label for="requeststatus">Request Status</label>
                                <select id="request_status" name="request_status">
                                        <option value="" disabled selected>Status</option>
                                            <option value="New">New</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Completed">Completed</option>
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

