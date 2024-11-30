<?php
include '../../head.php';
include '../../sidebar.php';
?>
<style>
    .head{
        margin-top: 10px;
    }
    .dataTables_filter{
      margin-left: 800px;
    }
    /* Modal Header Styling */

/* Member List Styling */
#householdMembersList {
    padding: 10px;
    max-height: 400px; /* Limit the height of the list */
    overflow-y: auto; /* Enable scrolling if content exceeds height */
    border: 1px solid #ddd;
    border-radius: 5px;
}

#householdMembersList .list-group-item {
    font-size: 16px;
    font-weight: 500;
    border: none;
    padding: 10px 15px;
    background: #f8f9fa; /* Light background for list items */
    margin-bottom: 5px;
    border-left: 5px solid #007bff; /* Add a left border to make items visually distinct */
}

#householdMembersList .list-group-item:hover {
    background: #e9ecef; /* Slightly darker background on hover */
}

/* Close Button Hover Effect */
.modal-footer .btn-secondary:hover {
    background-color: #6c757d; /* Darker shade of gray */
    border-color: #6c757d;
}

/* General Modal Enhancements */
.modal-content {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    padding: 15px;
}


</style>
<body>
    <section class="home">  
        <div class="resident">
        <div class="table-container">
    <div class="table-header">
        <div class="head">
            <h1>Household Table</h1>
        </div>
                    </div>
                    <table id="example" class="table-table">
                        <thead>
                            <th>#</th>
                            <th>Household Number</th>
                            <th>Household Name</th>
                            <th>Household Head</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Number of Members</th>
                            <th>Buttons</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <?php include 'function.php';?>
                </section><!-- .home-->
                <!-- Modal -->
                <!-- Update Household -->
                <section class="household_modal">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Resident</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="form-group">
                                <label for="documentName">Household Name</label>
                                <input type="text" id="nameField" name="household_name" require>
                                </div>
                                <div class="form-group">
                                <label for="householdHead">Household Head</label>
                                <input type="text"  id="headField" name="household_head" 
                                        oninput="filterResidents('head')" 
                                        onfocus="filterResidents('head')"
                                        onblur="setTimeout(() => document.getElementById('headSuggestions').innerHTML = '', 200)">
                                    <ul id="headSuggestions" class="suggestions-list"></ul>
                                </div>

                                <div class="form-group">
                                    <label for="documentInfo">Address</label>
                                    <input type="text" id="addressField" name="household_address" require>
                                </div>
                                <div class="form-group">
                                <label for="household_contact">Contact Number:</label>
                                <input type="tel" placeholder="Enter 10-digit number" id="contactField" name="household_contact" maxlength="16" require>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!-- View Modal -->
        <section class="view-modal">
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel">Household Details</h5>
                            <button type="button" class="bx bxs-x-circle icon" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table-table">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Household Role</th>
                                    </tr>
                                </thead>
                                <tbody id="householdMembersTable">
                                    <!-- Members will be dynamically added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
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
