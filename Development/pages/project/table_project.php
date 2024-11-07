<?php
include '../../head.php';
include '../../sidebar.php';
?>
<body>
    <section class="home">  
        <div class="inventory">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Project Table</h1>
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
                        <th>Name</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Budget</th>
                        <th>Source</th>
                        <th>Location</th>
                        <th>Managers</th>
                        <th>Stakehold- ers</th>
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
                <!-- Update Project -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Project</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="project_id" id="project_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="add">
                                    <div class="form-grid">
                                    <div class="input-wrapper">
                                        <label for="ProjectName" class="input-label">Project Name:</label>
                                        <input type="text" placeholder="Project Name" id="nameField" name="project_name" class="input-field">
                                    </div>
                                    <div class="input-wrapper ">
                                        <label for="Project Start" class="input-label">Project Start:</label>
                                        <input type="date" id="startField" name="project_start" class="input-field">
                                    </div>
                                    <div class="input-wrapper ">
                                        <label for="Project End" class="input-label">Project End:</label>
                                        <input type="date" id="endField" name="project_end" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                    <label for="Project Location" class="input-label">Project Budget:</label>
                                        <input type="number" placeholder="Project Budget" id="budgetField" name="project_budget" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                    <label for="Project Funding" class="input-label">Funding Source:</label>
                                        <input type="text" placeholder="Project Funding" id="sourceField" name="project_source" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                        <label for="Project Status" class="input-label">Project Status:</label>
                                        <select id="statusField" name="project_status" class="input-field">
                                        <option value="" disabled selected>Project Status</option>
                                            <option value="New">New</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </div>

                                     <div class="input-wrapper">
                                        <label for="Project Status" class="input-label">Project Location:</label>
                                        <input type="text" placeholder="Project Location" id="locationField" name="project_location" class="input-field">
                                    </div>
                                    
                                    <div class="input-wrapper ">
                                        <label for="Project Status" class="input-label">Project Managers:</label>
                                        <input type="text" placeholder="Project Managers"  name="project_managers" id="managersField" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                        <label for="Project Status" class="input-label">Stakeholders:</label>
                                        <input type="text" placeholder="Stakeholders" name="project_stakeholders" id="stakeholdersField" class="input-field">
                                    </div>      
                                    
                                    <div class="input-wrapper">
                                        <label for="Project Status" class="input-label">Project Description:</label>
                                        <input type="text" placeholder="Project Description" id="descriptionField"  name="project_description" class="input-field">
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
            <!-- Add Project -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                                <div class="add">
                                    <div class="form-grid">
                                    <div class="input-wrapper">
                                        <label for="ProjectName" class="input-label">Project Name:</label>
                                        <input type="text" placeholder="Project Name" id="project_name" name="project_name" class="input-field">
                                    </div>
                                    <div class="input-wrapper ">
                                        <label for="Project Start" class="input-label">Project Start:</label>
                                        <input type="date" id="project_start" name="project_start" class="input-field">
                                    </div>
                                    <div class="input-wrapper ">
                                        <label for="Project End" class="input-label">Project End:</label>
                                        <input type="date" id="project_end" name="project_end" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                    <label for="Project Location" class="input-label">Project Budget:</label>
                                        <input type="number" placeholder="Project Budget" id="project_budget" name="project_budget" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                    <label for="Project Funding" class="input-label">Funding Source:</label>
                                        <input type="text" placeholder="Project Funding" id="project_source" name="project_source" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                        <label for="Project Status" class="input-label">Project Status:</label>
                                        <select id="project_status" name="project_status" class="input-field">
                                        <option value="" disabled selected>Project Status</option>
                                            <option value="New">New</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </div>

                                    <div class="input-wrapper address">
                                        <label for="Project Status" class="input-label">Project Location:</label>
                                        <input type="text" placeholder="Project Location" id="project_location" name="project_location" class="input-field">
                                    </div>
                                    
                                    <div class="input-wrapper ">
                                        <label for="Project Status" class="input-label">Project Managers:</label>
                                        <input type="text" placeholder="Project Managers"  name="project_managers" id="project_managers" class="input-field">
                                    </div>

                                    <div class="input-wrapper">
                                        <label for="Project Status" class="input-label">Stakeholders:</label>
                                        <input type="text" placeholder="Stakeholders" name="project_stakeholders" id="project_stakeholders" class="input-field">
                                    </div>         
                                    
                                    <div class="input-wrapper">
                                        <label for="Project Status" class="input-label">Project Description:</label>
                                        <input type="text" placeholder="Project Description" id="project_description"  name="project_description" class="input-field">
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
                                        <p><strong>Project Name:</strong> <span id="view_name"></span></p>
                                        <p><strong>Project Start:</strong> <span id="view_start"></span></p>
                                        <p><strong>Project End:</strong> <span id="view_end"></span></p>
                                        <p><strong>Budjet:</strong> <span id="view_budget"></span></p>
                                        <p><strong>Source:</strong> <span id="view_source"></span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Project Location:</strong> <span id="view_location"></span></p>
                                        <p><strong>Managers:</strong> <span id="view_managers"></span></p>
                                        <p><strong>Stakeholders:</strong> <span id="view_stakeholders"></span></p>
                                        <p><strong>Project Status:</strong> <span id="view_status"></span></p>
                                        <p><strong>Project Description:</strong> <span id="view_description"></span></p>
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
