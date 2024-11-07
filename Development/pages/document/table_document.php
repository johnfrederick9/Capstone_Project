<?php
include '../../head.php';
include '../../sidebar.php';
?>
<style>
#imageContainer {
display: flex;
flex-wrap: wrap;
justify-content: center;
}

.image-wrapper {
margin: 10px;
}

.img-thumbnail {
max-width: 150px;
max-height: 150px;
object-fit: cover;
}

</style>
<body>
    <section class="home">  
        <div class="document">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Documentation Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn">+ Add</button>
                            <button class="print-btn " title="Print Selected">
                            <i class="bx bx-printer"></i>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                    <th>#</th>
                    <th><button class="print-all-btn" title="Print All">
                                <i class="bx bx-printer"></i>
                            </button>
                        </th>
                        <th>Document Name</th>
                        <th>Document Date</th>
                        <th>Document Info</th>
                        <th>Document Type</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Update Document</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="document_id" id="document_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="form-group">
                                <label for="documentName">Document Name</label>
                                <input type="text" id="nameField" name="document_name" require>
                                </div>
                                <div class="form-group">
                                    <label for="documentDate">Document Date</label>
                                    <input type="date" id="dateField" name="document_date" require>
                                </div>
                                <div class="form-group">
                                    <label for="documentInfo">Document Info</label>
                                    <input type="text" id="infoField" name="document_info" require>
                                </div>
                                <div class="form-group">
                                    <label for="documentType">Document Type</label>
                                    <input type="text" id="typeField" name="document_type" require>
                                </div>
                                <div class="file-upload">
                                    <label for="updateFileInput" id="updateFileLabel" style="background-color: #ffdddd;">
                                        <i class='bx bx-paperclip'></i> Attach Files
                                    </label>
                                    <span id="updateFileName">No files selected</span>
                                    <input type="file" id="updateFileInput" name="filepath" class="file-input" multiple onchange="handleFileChange('updateFileInput', 'updateFileName', 'updateFileLabel')">
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Document</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="addUser" action="add.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="documentName">Document Name</label>
                                <input type="text" id="document_name" name="document_name" require>
                            </div>
                            <div class="form-group">
                                <label for="documentDate">Document Date</label>
                                <input type="date" id="document_date" name="document_date" require>
                            </div>
                            <div class="form-group">
                                <label for="documentInfo">Document Info</label>
                                <input type="text" id="document_info" name="document_info" require>
                            </div>
                            <div class="form-group">
                                <label for="documentType">Document Type</label>
                                <input type="text" id="document_type" name="document_type" require>
                            </div>
                            <div class="file-upload">
                                <label for="addFileInput" id="addFileLabel" style="background-color: #ffdddd;">
                                    <i class='bx bx-paperclip'></i> Attach Files
                                </label>
                                <span id="addFileName">No files selected</span>
                                <input type="file" id="addFileInput" name="document_files[]" class="file-input" multiple onchange="handleFileChange('addFileInput', 'addFileName', 'addFileLabel')">
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
            <section class="delete-modal">
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel">View Uploaded Images</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="imageContainer" class="d-flex flex-wrap">
                                <!-- Images will be loaded here dynamically -->
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
