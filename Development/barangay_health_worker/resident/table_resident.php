<?php
include '../../head.php';
include "../../sidebar_officials.php";
?>
<body>
    <section class="home">  
        <div class="resident">
        <div class="table-container">
    <div class="table-header">
        <div class="head">
            <h1>Resident Table</h1>
        </div>
                    <div class="table-actions">    
                        <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn" style="display:none;" >+ Add</button>
                        <button class="print-btn " title="Print Selected">
                            <i class="bx bx-printer"></i>
                        </button>
                    </div>
                    </div>
                    <table id="example" class="table-table">
                        <thead>
                        <th>#</th>
                            <th><button class="print-all-btn" title="Print All">
                                    <i class="bx bx-printer"></i>
                                </button>
                            </th>
                            <th>Full Name</th>
                            <th>Age</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>BMI</th>
                            <th>BMI Status</th>
                            <th>Medical History</th>
                            <th>Buttons</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <?php include 'function.php';?>
                </section><!-- .home-->
                <!-- Modal -->
                <!-- Update Resident -->
                <section class="resident_modal">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Resident</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="resident_id" id="resident_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="add">
                            <div class="form-grid">
                            <div class="input-wrapper">
                                <label for="Last Name" class="input-label">Last Name:</label>
                                <input type="text" placeholder="Last Name" id="lnameField" name="resident_lastname" class="input-field" readonly>
                            </div>
                            <div class="input-wrapper">
                                <label for="First Name" class="input-label">First Name:</label>
                                <input type="text" placeholder="First Name" id="fnameField" name="resident_firstname" class="input-field" readonly>
                            </div>
                            <div class="input-wrapper">
                                <label for="Middle Name" class="input-label">Middle Name:</label>
                                <input type="text" placeholder="Middle Name" id="minameField" name="resident_middlename" class="input-field" readonly>
                            </div>
                            <div class="input-wrapper ">
                            <label for="birthdate" class="input-label">Birth Date:</label>
                                <input type="date" id="birthField" name="resident_birthdate" class="input-field" readonly>
                            </div>
                            <div class="input-wrapper">
                                <label for="Height" class="input-label">Height:</label>
                                <input type="text" placeholder="Height" id="heightField" name="resident_height" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="Weight" class="input-label">Weight:</label>
                                <input type="text" placeholder="Weight" id="weightField" name="resident_weight" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="" class="input-label">Height Status:</label>
                                <input type="text" placeholder="Height Status" id="heightstatField" name="resident_heightstat" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="" class="input-label">Weight Status:</label>
                                <input type="text" placeholder="Weight Status" id="weightstatField" name="resident_weightstat" class="input-field">
                            </div>
                            <div class="input-wrapper ">
                            <label for="" class="input-label">Medical History:</label>
                                <input type="text" id="medField" name="resident_medical" class="input-field" require>
                            </div>
                    
                            <div class="input-wrapper">
                                <label for="" class="input-label">Lactating:</label>
                                <input type="text" placeholder="Lactating" id="lactatingField" name="resident_lactating" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="" class="input-label">Pregnant:</label>
                                <input type="text" placeholder="Pregnant" id="pregnantField" name="resident_pregnant" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="" class="input-label">PWD:</label>
                                <input type="text" placeholder="PWD" id="pwdField" name="resident_PWD" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="" class="input-label">Out of SY:</label>
                                <input type="text" placeholder="SY" id="syField" name="resident_SY" class="input-field" require>
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
            <!-- Add Resident -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Resident</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                            <div class="add">
                            <div class="form-grid">
                            <div class="input-wrapper">
                                <label for="Last Name" class="input-label">Last Name:</label>
                                <input type="text" placeholder="Last Name" id="resident_lastname" name="resident_lastname" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="First Name" class="input-label">First Name:</label>
                                <input type="text" placeholder="First Name" id="resident_firstname" name="resident_firstname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Middle Name" class="input-label">Middle Name:</label>
                                <input type="text" placeholder="Middle Name" id="resident_middlename" name="resident_middlename" class="input-field">
                            </div>
                            <div class="input-wrapper ">
                            <label for="birthdate" class="input-label">Birth Date:</label>
                                <input type="date" id="resident_birthdate" name="resident_birthdate" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="Height" class="input-label">Height:</label>
                                <input type="text" placeholder="Height" id="resident_height" name="resident_height" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="Weight" class="input-label">Weight:</label>
                                <input type="text" placeholder="Weight" id="resident_weight" name="resident_weight" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="" class="input-label">Height Status:</label>
                                <input type="text" placeholder="Height Status" id="resident_heightstat" name="resident_heightstat" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="" class="input-label">Weight Status:</label>
                                <input type="text" placeholder="Weight Status" id="resident_weightstat" name="resident_weightstat" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="" class="input-label">BMI Status:</label>
                                <select id="resident_BMIstat" class="input-field" name="resident_BMIstat" require>
                                <option value="" disabled selected>Status</option>
                                    <option value="Under Weight">Under Weight</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Over Weight">Over Weight</option>
                                    <option value="Obese">Obese</option>
                                </select>
                            </div>
                            <div class="input-wrapper ">
                            <label for="" class="input-label">Medical History:</label>
                                <input type="text" id="resident_medical" name="resident_medical" class="input-field" require>
                            </div>
                    
                            <div class="input-wrapper">
                                <label for="" class="input-label">Lactating:</label>
                                <input type="text" placeholder="Lactating" id="resident_lactating" name="resident_lactating" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="" class="input-label">Pregnant:</label>
                                <input type="text" placeholder="Pregnant" id="resident_pregnant" name="resident_pregnant" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="" class="input-label">PWD:</label>
                                <input type="text" placeholder="PWD" id="resident_PWD" name="resident_PWD" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="" class="input-label">Out of SY:</label>
                                <input type="text" placeholder="SY" id="resident_SY" name="resident_SY" class="input-field" require>
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
                            <h5 class="modal-title" id="viewModalLabel">Resident Details</h5>
                            <button type="button" class="bx bxs-x-circle icon" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>First Name:</strong> <span id="view_firstname"></span></p>
                                    <p><strong>Middle Name:</strong> <span id="view_middlename"></span></p>
                                    <p><strong>Last Name:</strong> <span id="view_lastname"></span></p>
                                    <p><strong>Birth Date:</strong> <span id="view_birthdate"></span></p>
                                    <p><strong>Age:</strong> <span id="view_age"></span></p>
                                    <p><strong>Height:</strong> <span id="view_1"></span></p>
                                    <p><strong>Weight:</strong> <span id="view_2"></span></p>
                                    
                                </div>
                                <div class="col-md-6">
                                    <p><strong>BMI:</strong> <span id="view_3"></span></p>
                                    <p><strong>BMI Status:</strong> <span id="view_4"></span></p>
                                    <p><strong>Medical History:</strong> <span id="view_6"></span></p>
                                    <p><strong>Lactating:</strong> <span id="view_7"></span></p>
                                    <p><strong>Pregnant:</strong> <span id="view_8"></span></p>
                                    <p><strong>PWD:</strong> <span id="view_9"></span></p>
                                    <p><strong>SY:</strong> <span id="view_10"></span></p>
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
