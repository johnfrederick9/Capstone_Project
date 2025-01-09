<?php
include '../../head.php';
include '../../sidebar.php';
include '../../connection.php';

// Updated query to include the condition for isDisplayed = 1
$query = "SELECT resident_id, CONCAT(resident_firstname, ' ', 
                                     IF(resident_middlename != '' AND resident_middlename IS NOT NULL, CONCAT(LEFT(resident_middlename, 1), '.'), ''), ' ', 
                                     resident_lastname) 
          AS resident_fullname 
          FROM tb_resident 
          WHERE isDisplayed = 1";
$result = mysqli_query($conn, $query);

$residents = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $residents[] = $row;
    }
}
?>
<body>
    <section class="home">  
        <div class="certificate">
        <div class="table-container" style="overflow: visible;">
                    <div class="table-header">
                    <div class="head">
                            <h1>Blotter Table</h1>
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
                        <th>Buttons</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                <?php include 'function.php'?>
                </section><!-- .home-->
                <!-- Modal -->
                 <section class="blotter-modal">
                 <!-- Update Blotter -->
                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Blotter Issued Update Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateBlotter">
                                <input type="hidden" name="blotter_id" id="blotter_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="blotter">
                                <div class="add">
                                    <div class="form-grid">
                                    <div class="input-wrapper">
                                            <label for="blotter_complainant" class="input-label">Complainant's Name:</label>
                                            <input id="blotter_complainantField" name="blotter_complainant" class="input-field"  readonly>
                                        </div>
                                        <div class="input-wrapper">
                                        <label for="resident_contact" class="input-label">Complainant's Contact No.:</label>
                                            <input type="tel" placeholder="Enter 11-digit number" id="blotter_complainant_noField" name="blotter_complainant_no" class="input-field" maxlength="16" require 
                                                style="flex: 1; border: 1px solid #ccc; border-left: none;">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainant_add" class="input-label">Complainant's Address:</label>
                                            <select id="blotter_complainant_addField" name="blotter_complainant_add" class="input-field" require>
                                                <option value="" disabled selected>Address</option>
                                                <option value="Sitio Sto. Nino">Sitio Sto. Nino</option>
                                                <option value="Sitio Suwa">Sitio Suwa</option>
                                                <option value="Sitio Private">Sitio Private</option>
                                                <option value="Sitio Lahug">Sitio Lahug</option>
                                                <option value="Sitio Lapa">Sitio Lapa</option>
                                                <option value="Sitio Sampig">Sitio Sampig</option>
                                                <option value="Sitio Alang-Alang">Sitio Alang-Alang</option>
                                                <option value="Sitio Granchina">Sitio Granchina</option>
                                                <option value="Sitio Catambisan">Sitio Catambisan</option>
                                                <option value="Sitio Mag-Alambac">Sitio Mag-Alambac</option>
                                            </select> 
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainee" class="input-label">Complainee's Name:</label>
                                            <input id="blotter_complaineeField" name="blotter_complainee" class="input-field" readonly>
                                        </div> 
                                        <div class="input-wrapper">
                                        <label for="resident_contact" class="input-label">Complainee's Contact No.:</label>
                                            <input type="tel" placeholder="Enter 11-digit number" id="blotter_complainee_noField" name="blotter_complainee_no" class="input-field" maxlength="16" require 
                                                style="flex: 1; border: 1px solid #ccc; border-left: none;">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainee_add" class="input-label">Complainee's Address:</label>
                                            <select id="blotter_complainee_addField" name="blotter_complainee_add" class="input-field" require>
                                                <option value="" disabled selected>Address</option>
                                                <option value="Sitio Sto. Nino">Sitio Sto. Nino</option>
                                                <option value="Sitio Suwa">Sitio Suwa</option>
                                                <option value="Sitio Private">Sitio Private</option>
                                                <option value="Sitio Lahug">Sitio Lahug</option>
                                                <option value="Sitio Lapa">Sitio Lapa</option>
                                                <option value="Sitio Sampig">Sitio Sampig</option>
                                                <option value="Sitio Alang-Alang">Sitio Alang-Alang</option>
                                                <option value="Sitio Granchina">Sitio Granchina</option>
                                                <option value="Sitio Catambisan">Sitio Catambisan</option>
                                                <option value="Sitio Mag-Alambac">Sitio Mag-Alambac</option>
                                            </select> 
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complaint" class="input-label">Complaint:</label>
                                            <input type="text" id="blotter_complaintField" name="blotter_complaint" class="input-field"  >
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_action" class="input-label">Action Taken:</label>
                                            <input type="text" id="blotter_actionField" name="blotter_action" class="input-field"  >
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_incidence" class="input-label">Incidence:</label>
                                            <input type="text" id="blotter_incidenceField" name="blotter_incidence" class="input-field"  >
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_date_recorded" class="input-label">Date Recorded:</label>
                                            <input type="date" id="blotter_date_recordedField" name="blotter_date_recorded" class="input-field"  >
                                        </div>
                                    <div class="input-wrapper">
                                    <label for="blotter_status" class="input-label">Status:</label>
                                    <select id="blotter_statusField" name="blotter_status" class="input-field">
                                        <option value="" disabled selected>Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Settled">Settled</option>
                                        <option value="Unsettled">Unsettled</option>
                                    </select>
                                </div>
                                <!-- Hidden Input Fields -->
                                <div class="input-wrapper" id="dateSettledWrapper" style="display:none;">
                                    <label for="blotter_date_settled" class="input-label">Date Settled:</label>
                                    <input type="date" id="blotter_date_settledField" name="blotter_date_settled" class="input-field">
                                </div>
                                <div class="input-wrapper" id="recordedByWrapper" style="display:none;">
                                    <label for="blotter_recorded_by" class="input-label">Recorded By:</label>
                                    <input type="text" id="blotter_recorded_byField" name="blotter_recorded_by" class="input-field">
                                </div>
                                <!-- Other Input Fields -->
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
           <!-- Add Blotter -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Blotter Record Form</h5>
                        <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addBlotter" action="">
                            <div class="certificate">                              
                                <div class="add">
                                    <div class="form-grid">                                      
                                    <div class="input-wrapper">
                                    <label for="add_complainantField" class="input-label">Complainant:</label>
                                    <input type="text" class="input-field" id="blotter_complainant" name="blotter_complainant" 
                                        oninput="filterResidents('complainant')" 
                                        onfocus="filterResidents('complainant')"
                                        onblur="setTimeout(() => document.getElementById('complainantSuggestions').innerHTML = '', 200)">
                                    <ul id="complainantSuggestions" class="suggestions-list"></ul>
                                    </div>
                                        <div class="input-wrapper">
                                        <label for="blotter_complainant_no" class="input-label">Complainant's Contact No.:</label>
                                            <input type="tel" placeholder="Enter 11-digit number" id="blotter_complainant_no" name="blotter_complainant_no" class="input-field" maxlength="16" require 
                                                style="flex: 1; border: 1px solid #ccc; border-left: none;">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainant_add" class="input-label">Complainant's Address:</label>
                                            <select id="blotter_complainant_add" name="blotter_complainant_add" class="input-field" require>
                                                <option value="" disabled selected>Address</option>
                                                <option value="Sitio Sto. Nino">Sitio Sto. Nino</option>
                                                <option value="Sitio Suwa">Sitio Suwa</option>
                                                <option value="Sitio Private">Sitio Private</option>
                                                <option value="Sitio Lahug">Sitio Lahug</option>
                                                <option value="Sitio Lapa">Sitio Lapa</option>
                                                <option value="Sitio Sampig">Sitio Sampig</option>
                                                <option value="Sitio Alang-Alang">Sitio Alang-Alang</option>
                                                <option value="Sitio Granchina">Sitio Granchina</option>
                                                <option value="Sitio Catambisan">Sitio Catambisan</option>
                                                <option value="Sitio Mag-Alambac">Sitio Mag-Alambac</option>
                                            </select> 
                                        </div>
                                        <div class="input-wrapper">
                                        <label for="blotter_complainee" class="input-label">Complainee:</label>
                                        <input type="text" class="input-field" id="blotter_complainee" name="blotter_complainee" 
                                            oninput="filterResidents('complainee')" 
                                            onfocus="filterResidents('complainee')"
                                            onblur="setTimeout(() => document.getElementById('complaineeSuggestions').innerHTML = '', 200)">
                                        <ul id="complaineeSuggestions" class="suggestions-list"></ul>
                                        </div>
                                        <div class="input-wrapper">
                                        <label for="blotter_complainee_no" class="input-label">Complainee's Contact No.:</label>
                                            <input type="tel" placeholder="Enter 11-digit number" id="blotter_complainee_no" name="blotter_complainee_no" class="input-field" maxlength="16" require 
                                                style="flex: 1; border: 1px solid #ccc; border-left: none;">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainee_add" class="input-label">Complainee's Address:</label>
                                            <select id="blotter_complainee_add" name="blotter_complainee_add" class="input-field" require>
                                                <option value="" disabled selected>Address</option>
                                                <option value="Sitio Sto. Nino">Sitio Sto. Nino</option>
                                                <option value="Sitio Suwa">Sitio Suwa</option>
                                                <option value="Sitio Private">Sitio Private</option>
                                                <option value="Sitio Lahug">Sitio Lahug</option>
                                                <option value="Sitio Lapa">Sitio Lapa</option>
                                                <option value="Sitio Sampig">Sitio Sampig</option>
                                                <option value="Sitio Alang-Alang">Sitio Alang-Alang</option>
                                                <option value="Sitio Granchina">Sitio Granchina</option>
                                                <option value="Sitio Catambisan">Sitio Catambisan</option>
                                                <option value="Sitio Mag-Alambac">Sitio Mag-Alambac</option>
                                            </select> 
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complaint" class="input-label">Complaint:</label>
                                            <input type="text" id="blotter_complaint" name="blotter_complaint" class="input-field"  >
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_action" class="input-label">Action Taken:</label>
                                            <input type="text" id="blotter_action" name="blotter_action" class="input-field"  >
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_incidence" class="input-label">Incidence:</label>
                                            <input type="text" id="blotter_incidence" name="blotter_incidence" class="input-field"  >
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_date_recorded" class="input-label">Date Recorded:</label>
                                            <input type="date" id="blotter_date_recorded" name="blotter_date_recorded" class="input-field"  >
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_status" class="input-label">Status:</label>
                                            <select id="blotter_status" name="blotter_status" class="input-field">
                                                <option value="" disabled selected>Status</option>
                                                    <option value="New">New</option>
                                                    <option value="Pending">Pending</option>
                                                </select>
                                        </div>
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
        <!-- View Modal -->
        <section class="view-modal">
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel">Blotter Details</h5>
                            <button type="button" class="bx bxs-x-circle icon" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Complainant Name:</strong> <span id="view_1"></span></p>
                                    <p><strong>Complainant Contact No.:</strong> <span id="view_2"></span></p>
                                    <p><strong>Complainant Address:</strong> <span id="view_3"></span></p>
                                    <p><strong>Status:</strong> <span id="view_8"></span></p>
                                    <p><strong>Action:</strong> <span id="view_9"></span></p>
                                    <p><strong>Incidence:</strong> <span id="view_10"></span></p>
                                    <p><strong>Complaint:</strong> <span id="view_7"></span></p> 
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Complainee Name:</strong> <span id="view_4"></span></p>
                                    <p><strong>Complainee Contact No.:</strong> <span id="view_5"></span></p>
                                    <p><strong>Complainee Address:</strong> <span id="view_6"></span></p>
                                    <p><strong>Date Recorded:</strong> <span id="view_11"></span></p>
                                    <p><strong>Date Settled:</strong> <span id="view_12"></span></p>
                                    <p><strong>Recorded By:</strong> <span id="view_13"></span></p>
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
    <script>
        // JavaScript to toggle the visibility of input fields based on status
        document.getElementById('blotter_statusField').addEventListener('change', function () {
            const status = this.value;
            const dateSettledWrapper = document.getElementById('dateSettledWrapper');
            const recordedByWrapper = document.getElementById('recordedByWrapper');

            if (status === 'Settled') {
                // Show fields for "Settled"
                dateSettledWrapper.style.display = 'block';
                recordedByWrapper.style.display = 'block';
            } else if (status === 'Pending' || status === 'Unsettled') {
                // Hide fields for "Pending" or "Unsettled"
                dateSettledWrapper.style.display = 'none';
                recordedByWrapper.style.display = 'none';
            }
        });
    </script>
    </body> 
</html>


