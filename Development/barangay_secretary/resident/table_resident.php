<?php
include '../../head.php';
include '../../sidebar_mainofficials.php';
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
                        <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn">+ Add</button>
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
                            <th>Address</th>
                            <th>Maiden Name</th>
                            <th>Educational Attainment</th>
                            <th>Birth Date</th>
                            <th>Age</th>
                            <th>Contact Number</th>
                            <th>Status</th>
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
                                <input type="text" placeholder="Last Name" id="lnameField" name="resident_lastname" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="First Name" class="input-label">First Name:</label>
                                <input type="text" placeholder="First Name" id="fnameField" name="resident_firstname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Middle Name" class="input-label">Middle Name:</label>
                                <input type="text" placeholder="Middle Name" id="minameField" name="resident_middlename" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Maiden Name" class="input-label">Maiden Name:</label>
                                <input type="text" placeholder="Maiden Name" id="manameField" name="resident_maidenname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Sex" class="input-label">Sex:</label>
                                <select id="sexField" class="input-field" name="resident_sex" require>
                                <option value="" disabled selected>Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="LGBTQ">LGBTQ</option>
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="Suffixes" class="input-label">Suffixes:</label>
                                <select id="suffixesField" class="input-field" name="resident_suffixes" require>
                                    <option value=" ">None</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                </select>
                            </div>

                            <div class="input-wrapper">
                                <label for="" class="input-label">Address:</label>
                                <select id="addressField" name="resident_address" class="input-field" require>
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
                                <label for="" class="input-label">Educational Attainment:</label>
                                    <select id="educField" name="resident_educationalattainment" class="input-field" require>
                                        <option value="" disabled selected>Educational Attainment</option>
                                        <option value="Elementary">Elementary</option>
                                        <option value="High School, Undergrad">High School, Undergrad</option>
                                        <option value="High School, Graduate">High School, Graduate</option>
                                        <option value="College, Undergrad">College, Undergrad</option>
                                        <option value="Vocational">Vocational</option>
                                        <option value="Bachelor Degree">Bacherlor Degree</option>
                                        <option value="Master Degree">Master Degree</option>
                                        <option value="Doctorate Degree">Doctorate Degree</option>
                                    </select> 
                            </div>
                            
                            <div class="input-wrapper ">
                            <label for="birthdate" class="input-label">Birth Date:</label>
                                <input type="date" id="birthField" name="resident_birthdate" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="status" class="input-label">Status:</label>
                                <select id="statusField" class="input-field" name="resident_status" require>
                                    <option value="" disabled selected>Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>

                            <div class="input-wrapper">
                            <label for="resident_contact" class="input-label">Contact Number:</label>
                                <input type="tel" placeholder="Enter 10-digit number" id="contactField" name="resident_contact" class="input-field" maxlength="16" require 
                                    style="flex: 1; border: 1px solid #ccc; border-left: none;">
                                </div>
                    
                            <div class="input-wrapper">
                                <label for="age" class="input-label">Occupation:</label>
                                <input type="text" placeholder="Occupation" id="occupationField" name="resident_occupation" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="age" class="input-label">Religion:</label>
                                <input type="text" placeholder="Religion" id="religionField" name="resident_religion" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="Social_pensioner" class="input-label">Social Pensioner</label>
                                <input type="text" placeholder="Social Pensioner" id="pensionerField" name="resident_pension" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="Beneficiaries" class="input-label">Beneficiaries:</label>
                                <input type="text" placeholder="Beneficiaries" id="beneficiariesField" name="resident_beneficiaries" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="age" class="input-label">Indigenous:</label>
                                <input type="text" placeholder="Indigenous" id="indigenousField" name="resident_indigenous" class="input-field" require>
                            </div>
                            
                            
                            <div class="input-wrapper">
                                <label for="householdrole" class="input-label">Household Role:</label>
                                <input type="text" placeholder="Household Role" id="roleField" name="resident_householdrole" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="householdid" class="input-label">Household ID:</label>
                                <input type="Number" placeholder="Household ID" id="idField" name="household_id" class="input-field" >
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
                                <input type="text" placeholder="Last Name" id="resident_lastname" name="resident_lastname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="First Name" class="input-label">First Name:</label>
                                <input type="text" placeholder="First Name" id="resident_firstname" name="resident_firstname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Middle Name" class="input-label">Middle Name:</label>
                                <input type="text" placeholder="Middle Name" id="resident_middlename" name="resident_middlename" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Maiden Name" class="input-label">Maiden Name:</label>
                                <input type="text" placeholder="Maiden Name" id="resident_maidenname" name="resident_maidenname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Sex" class="input-label">Sex:</label>
                                <select id="resident_sex" class="input-field" name="resident_sex" require>
                                <option value="" disabled selected>Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="LGBTQ">LGBTQ</option>
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="Suffixes" class="input-label">Suffixes:</label>
                                <select id="resident_suffixes" class="input-field" name="resident_suffixes" require>
                                    <option value=" ">None</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                </select>
                            </div>

                            <div class="input-wrapper">
                                <label for="" class="input-label">Address:</label>
                                <select id="resident_address" name="resident_address" class="input-field" require>
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
                            <label for="" class="input-label">Educational Attainment:</label>
                                <select id="resident_educationalattainment" name="resident_educationalattainment" class="input-field" require>
                                    <option value="" disabled selected>Education Attainment</option>
                                    <option value="Elementary">Elementary</option>
                                    <option value="High School, Undergrad">High School, Undergrad</option>
                                    <option value="High School, Graduate">High School, Graduate</option>
                                    <option value="College, Undergrad">College, Undergrad</option>
                                    <option value="Vocational">Vocational</option>
                                    <option value="Bacherlor Degree">Bacherlor Degree</option>
                                    <option value="Master Degree">Master Degree</option>
                                    <option value="Doctorate Degree">Doctorate Degree</option>
                                </select> 
                            </div>
                            
                            <div class="input-wrapper ">
                            <label for="birthdate" class="input-label">Birth Date:</label>
                                <input type="date" id="resident_birthdate" name="resident_birthdate" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="status" class="input-label">Status:</label>
                                <select id="resident_status" class="input-field" name="resident_status" require>
                                    <option value="" disabled selected>Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="input-wrapper">
                            <label for="resident_contact" class="input-label">Contact Number:</label>
                                <input type="tel" placeholder="Enter 11-digit number" id="resident_contact" name="resident_contact" class="input-field" maxlength="11" require
                                    style="flex: 1; border: 1px solid #ccc; border-left: none;">
                            </div>
                            <div class="input-wrapper">
                                <label for="age" class="input-label">Occupation:</label>
                                <input type="text" placeholder="Occupation" id="resident_occupation" name="resident_occupation" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="age" class="input-label">Religion:</label>
                                <input type="text" placeholder="Religion" id="resident_religion" name="resident_religion" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="Social_pensioner" class="input-label">Social Pensioner:</label>
                                <input type="text" placeholder="" id="resident_pension" name="resident_pension" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="Beneficiaries" class="input-label">Beneficiaries:</label>
                                <input type="text" placeholder="" id="resident_beneficiaries" name="resident_beneficiaries" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="age" class="input-label">Indigenous:</label>
                                <input type="text" placeholder="Indigenous" id="resident_indigenous" name="resident_indigenous" class="input-field" require>
                            </div>
                            
                            <div class="input-wrapper">
                                <label for="householdrole" class="input-label">Household Role:</label>
                                <input type="text" placeholder="Household Role" id="resident_householdrole" name="resident_householdrole" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="householdid" class="input-label">Household ID:</label>
                                <input type="Number" placeholder="Household ID" id="household_id" name="household_id" class="input-field" require>
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
                                    <p><strong>Suffixes:</strong> <span id="view_suffixes"></span></p>
                                    <p><strong>Sex:</strong> <span id="view_sex"></span></p>
                                    <p><strong>Birth Date:</strong> <span id="view_birthdate"></span></p>
                                    <p><strong>Age:</strong> <span id="view_age"></span></p>
                                    <p><strong>Contact:</strong> <span id="view_contact"></span></p>
                                    <p><strong>Household Role:</strong> <span id="view_householdrole"></span></p>
                                    <p><strong>Household ID:</strong> <span id="view_household_id"></span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Status:</strong> <span id="view_status"></span></p>
                                    <p><strong>Address:</strong> <span id="view_address"></span></p>
                                    <p><strong>Educational Attainment:</strong> <span id="view_educationalattainment"></span></p>
                                    <p><strong>Maiden Name:</strong> <span id="view_maidenname"></span></p>
                                    <p><strong>Occupation:</strong> <span id="view_occupation"></span></p>
                                    <p><strong>Religion:</strong> <span id="view_religion"></span></p>
                                    <p><strong>Indigenous:</strong> <span id="view_indigenous"></span></p>
                                    <p><strong>Pension:</strong> <span id="view_pension"></span></p>
                                    <p><strong>Beneficiaries:</strong> <span id="view_beneficiaries"></span></p>
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
