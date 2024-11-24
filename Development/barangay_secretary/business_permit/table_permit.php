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
                            <h1>Business Permit Certificate Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn">+ Add</button>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Business</th>
                        <th>Located</th>
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
                <!-- Update permit -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Business Permit Issued Update Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="permit_id" id="permit_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="certificate">
                                <div class="form-group">
                                    <label for="certificatedate">Name:</label>
                                    <input type="text" id="nameField" name="permit_name">
                                </div>
                                <div class="form-group">
                                    <label for="certificate">Business</label>
                                    <input type="text" id="businessField" name="permit_business" require>
                                </div>
                                    <div class="form-group">
                                        <label for="" >Located:</label>
                                        <select id="locateField" name="permit_locate" require>
                                            <option value="" disabled selected>Locate</option>
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
                                <div class="form-group">
                                    <label for="certificatedate"> Issued Date:</label>
                                    <input type="date" id="dateField" name="permit_date" require>
                                </div>
                                <div class="form-row" style="display: flex; gap: 10px; align-items: center;">
                                    <div class="form-group" style="flex: 1;">
                                        <label for="paidField">Paid:</label>
                                        <input type="number" id="paidField" name="permit_paid" require>
                                    </div>
                                    <div class="form-group" style="flex: 1;">
                                        <label for="dstField">DST:</label>
                                        <input type="number" id="dstField" name="permit_dst" require>
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
            <!-- Add permit -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Business Permit Issued Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                            <div class="certificate">
                                <div class="form-group">
                                    <label for="certificate">Name:</label>
                                    <input type="text" id="permit_name" name="permit_name">
                                </div>
                                <div class="form-group">
                                    <label for="certificate">Business:</label>
                                    <input type="text" id="permit_business" name="permit_business">
                                </div>
                                    <div class="form-group">
                                        <label for="" >Located:</label>
                                        <select id="permit_locate" name="permit_locate" require>
                                            <option value="" disabled selected>Locate</option>
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
                                <div class="form-group">
                                    <label for="certifi">Issued Date:</label>
                                    <input type="date" id="permit_date" name="permit_date">
                                </div>
                                <div class="form-row" style="display: flex; gap: 10px; align-items: center;">
                                    <div class="form-group" style="flex: 1;">
                                        <label for="paidField">Paid:</label>
                                        <input type="number" id="permit_paid" name="permit_paid" require>
                                    </div>
                                    <div class="form-group" style="flex: 1;">
                                        <label for="dstField">DST:</label>
                                        <input type="number" id="permit_dst" name="permit_dst" require>
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

