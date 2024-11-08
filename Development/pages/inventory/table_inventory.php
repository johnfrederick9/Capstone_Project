<?php
include '../../sidebar.php';
include '../../head.php';
require '../../database.php';
?>

<body>
    <section class="home">  
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Inventory Table</h1>
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
                        <th>Serial No:</th>
                        <th>Property Custodian</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Year Acquired</th>
                        <th>Lendable Quantity</th>
                        <th>Available Quantity</th>
                        <th>Buttons</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                <?php include 'function.php'?>
                </section><!-- .home-->
                <!-- Modal -->
                 <!-- Update Inventory -->
                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Item</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser" onsubmit="return validateForm2();">
                            <div class="add">
                            <div class="form-grid">
                                <input type="hidden" name="item_id" id="item_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                            <div class="input-wrapper">    
                                <label for="nameField" class="input-label">Item Name:</label>
                                <input type="text" id="nameField" name="item_name" value="<?php echo htmlspecialchars($item_data['item_name']); ?>" class="input-field" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="descriptionField" class="input-label">Item Description:</label>
                                <input type="text" id="descriptionField" name="item_description" value="<?php echo htmlspecialchars($item_data['item_description']); ?>" class="input-field" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="brandField" class="input-label">Item Brand:</label>
                                <input type="text" id="brandField" name="item_brand" value="<?php echo htmlspecialchars($item_data['item_brand']); ?>" class="input-field" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="serialNoField" class="input-label">Serial No:</label>
                                <input type="text" id="serialNoField" name="item_serialNo" value="<?php echo htmlspecialchars($item_data['item_serialNo']); ?>" class="input-field" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="custodianField" class="input-label">Property Custodian:</label>
                                <input type="text" id="custodianField" name="item_custodian" value="<?php echo htmlspecialchars($item_data['item_custodian']); ?>" class="input-field" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="countField" class="input-label">Item Quantity:</label>
                                <input type="number" id="countField" name="item_count" value="<?php echo htmlspecialchars($item_data['item_count']); ?>" class="input-field" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="priceField" class="input-label">Item Price:</label>
                                <input type="number" id="priceField" name="item_price" value="<?php echo htmlspecialchars($item_data['item_price']); ?>" class="input-field" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="yearField" class="input-label">Item Year:</label>
                                <input type="number" id="yearField" name="item_year" value="<?php echo htmlspecialchars($item_data['item_year']); ?>" class="input-field" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="statusField" class="input-label">Item Status:</label>
                                <select id="statusField" name="item_status" class="input-field" required>
                                    <option value="" disabled >Select Status</option>
                                    <option value="Serviceable">Serviceable</option>
                                    <option value="Unserviceable" >Unserviceable</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="lendablecountField" class="input-label">Lendable Quantity:</label>
                                <input type="number" id="lendablecountField" name="lendable_count" value="<?php echo htmlspecialchars($item_data['lendable_count']); ?>" class="input-field" required>
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
            <!-- Add Inventory -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action=""  onsubmit="return validateForm();">
                            <div class="add">
                            <div class="form-grid">
                                <div class="input-wrapper">
                                    <label for="itemname" class="input-label">Item Name:</label>
                                    <input type="text" id="itemname" name="item_name" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemdescription" class="input-label">Item Description:</label>
                                    <input type="text" id="itemdescription" name="item_description" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itembrand" class="input-label">Item Brand:</label>
                                    <input type="text" id="itembrand" name="item_brand" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemserialNo" class="input-label">Serial No:</label>
                                    <input type="text" id="itemserialNo" name="item_serialNo" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemcustodian" class="input-label">Item Custodian:</label>
                                    <input type="text" id="itemcustodian" name="item_custodian" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemcount" class="input-label">Item Count:</label>
                                    <input type="number" id="itemcount" name="item_count" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemprice" class="input-label">Item Price:</label>
                                    <input type="number" id="itemprice" name="item_price" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemyear" class="input-label">Year Acquired:</label>
                                    <input type="number" id="itemyear" name="item_year" class="input-field" required>
                                </div>

                                <div class="input-wrapper">
                                    <label for="itemstatus" class="input-label">Item Status:</label>
                                    <select id="itemstatus" name="item_status" class="input-field" required>
                                        <option value="" disabled>Select Status</option>
                                        <option value="Serviceable">Serviceable</option>
                                        <option value="Unserviceable">Unserviceable</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>

                                <div class="input-wrapper">
                                    <label for="lendablecount" class="input-label">Lendable Quantity:</label>
                                    <input type="number" id="lendablecount" name="lendable_count" class="input-field" required>
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
                                <h5 class="modal-title" id="viewModalLabel">Inventory Details</h5>
                                <button type="button" class="bx bxs-x-circle icon" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Item Name:</strong> <span id="view_name"></span></p>
                                        <p><strong>Item Description:</strong> <span id="view_description"></span></p>
                                        <p><strong>Item Brand:</strong> <span id="view_brand"></span></p>
                                        <p><strong>Serial No.:</strong> <span id="view_SerialNo"></span></p>
                                        <p><strong>Item Custodian:</strong> <span id="view_custodian"></span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Item Count:</strong> <span id="view_count"></span></p>
                                        <p><strong>Item Price:</strong> <span id="view_price"></span></p>
                                        <p><strong>Year Acquired:</strong> <span id="view_year"></span></p>
                                        <p><strong>Item Status:</strong> <span id="view_status"></span></p>
                                        <p><strong>Lendable Quantity:</strong> <span id="view_lendable"></span></p>
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
    <script>
        function validateForm() {
                var itemCount = parseInt(document.getElementById('itemcount').value);
                var lendableCount = parseInt(document.getElementById('lendablecount').value);

                if (lendableCount > itemCount) {
                    alert("Lendable count cannot be more than item count.");
                    return false;
                }

                return true;
            }

            function validateForm2(){
                var itemCountField = parseInt(document.getElementById('countField').value);
                var lendableCountField = parseInt(document.getElementById('lendablecountField').value);

                if (lendableCountField > itemCountField) {
                    alert("Lendable count cannot be more than item count.");
                    return false;
                }
                return true;
            }
    </script>

</html>
