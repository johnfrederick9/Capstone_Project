<?php
include '../../sidebar.php';
include '../../head.php';
require '../../database.php';

include('../../connection.php');

//Fetch available items open for lending from the tb_inventory table
$item_query = "
    SELECT 
        item_id, 
        item_name,
        available_count
    FROM 
        tb_inventory 
    WHERE 
        lendability = 1 AND available_count > 0 AND isDisplayed = 1
";
$item_result = $con->query($item_query);

// Fetch and output the items as JSON
$items = [];
while ($row = $item_result->fetch_assoc()) {
    $items[] = $row;
}
$items_json = json_encode($items);


// Fetch the items borrowed in the current transaction
$borrowed_items_query = "
    SELECT
        i.item_id,
        i.item_name,
        i.available_count,
        i.lendability,
        t.borrow_quantity,
        t.return_quantity,
        t.item_status
    FROM
        tb_transaction_items t
    INNER JOIN tb_inventory i ON i.item_id = t.item_id
    WHERE
        t.transaction_id = ? AND
        t.item_status = 'Borrowed'
";
$stmt = $conn->prepare($borrowed_items_query);
$stmt->bind_param("i", $transaction_id);
$stmt->execute();
$borrowed_items_result = $stmt->get_result();

// Store borrowed items
$borrowedItems = [];
while ($row = $borrowed_items_result->fetch_assoc()) {
    $borrowedItems[] = $row;
}

// Fetch all items from tb_inventory and determine available items
$available_items_query = "
    SELECT
        i.item_id,
        i.item_name,
        i.available_count
    FROM
        tb_inventory i
    WHERE
        lendability = 1 AND available_count > 0 
";
$available_items_result = $conn->query($available_items_query);

// Store available items and filter out borrowed items
$availableItems = [];
$borrowedItemIds = array_column($borrowedItems, 'item_id');
while ($row = $available_items_result->fetch_assoc()) {
    // Exclude items that are already borrowed in the current transaction
    if (!in_array($row['item_id'], $borrowedItemIds)) {
        $availableItems[] = $row;
    }
}

// Combine borrowed items with available items
$combinedItems = array_merge($borrowedItems, $availableItems);

// Encode data for JavaScript
$items_json_2 = json_encode($combinedItems);
$borrowedItems_json = json_encode($borrowedItems);
?>


<style>
.transaction .modal-lg {
    max-width: 70%; /* Make the modal wider */
}

.inp-group, .inp-group-update{
    height: 110px;
    overflow: auto;
}
.wrap{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    margin-bottom: 10px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e4e1e1;
}
.add, .add-update{
    text-decoration: none;
    display: inline-block;
    width:30px;
    height: 30px;
    background: #8bc34a;
    font-size: 2rem;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
}
.flex{
    display: flex;
    gap:75px;
    margin-bottom: 15px;
}
.delete{
    text-decoration: none;
    display: inline-block;
    background: #f44336;
    color: #fff;
    font-size: 1.5rem;
    font-weight: bold;
    width: 30px;
    height: 30px;
    color: #fff;
    margin-left: auto;
    display: flex;
    justify-content:center;
    align-items: center;
    cursor: pointer;
}
</style>
<body>
    <section class="home">  
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Item Transaction Table</h1>
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
                        <th>Address</th>
                        <th>Quantity</th>
                        <th>Reserved Date</th>
                        <th>Borrowed Date</th>
                        <th>Return Date</th>
                        <th>Approved By</th>
                        <th>Released By</th>
                        <th>Return Quantity</th>
                        <th>Transaction Status</th>
                        <th>Buttons</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                <?php include 'function.php'?>
                </section><!-- .home-->
                <!-- Modal -->
                <!-- Update Transaction -->
                <section class="transaction">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Item</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <!-- First Row -->
                                <input type="hidden" name="transaction_id" id="transaction_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="borrowernameField">Borrower Name:</label>
                                            <input type="text" id="borrowernameField" name="borrower_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="borroweraddressField">Borrower Address:</label>
                                            <input type="text" id="borroweraddressField" name="borrower_address" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="reservedonField">Reserved On:</label>
                                            <input type="date" id="reservedonField" name="reserved_on" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dateborrowedField">Borrowed Date:</label>
                                            <input type="date" id="dateborrowedField" name="date_borrowed" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Third Row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="returndateField">Return Date:</label>
                                            <input type="date" id="returndateField" name="return_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="approvedbyField">Approved By:</label>
                                            <input type="text" id="approvedbyField" name="approved_by" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fourth Row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="releasedbyField">Released By:</label>
                                            <input type="text" id="releasedbyField" name="released_by" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="returnedbyField">Returned By:</label>
                                            <input type="text" id="returnedbyField" name="returned_by" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!-- Fifth Row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="datereturnedField">Date Returned:</label>
                                            <input type="date" id="datereturnedField" name="date_returned" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </div>
                                </div>

                                <!-- Selected Items -->
                                <div class="form-group mt-3">
                                    <div class="wrap">
                                        <h2>Selected Items</h2>
                                        <a href="#" class="add-update">+</a>
                                    </div>
                                    <div class="inp-group-update">
                                        <!-- Dynamic Inputs Will Be Added Here -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Transaction -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUser" action="">
                    <!-- First Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="borrowername">Borrower Name:</label>
                                <input type="text" id="borrowername" name="borrower_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="borroweraddress">Borrower Address:</label>
                                <input type="text" id="borroweraddress" name="borrower_address" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reservedon">Reserved On:</label>
                                <input type="date" id="reservedon" name="reserved_on" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dateborrowed">Date Borrowed:</label>
                                <input type="date" id="dateborrowed" name="date_borrowed" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Third Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="returndate">Return Date:</label>
                                <input type="date" id="returndate" name="return_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="approvedby">Approved By:</label>
                                <input type="text" id="approvedby" name="approved_by" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Fourth Row (Released By & Submit Button) -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="releasedby">Released By:</label>
                                <input type="text" id="releasedby" name="released_by" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>

                    <!-- Item Selection -->
                    <div class="form-group mt-3">
                        <div class="wrap">
                            <h2>Select Items</h2>
                            <a href="#" class="add">+</a>
                        </div>

                        <!-- Default Item Selection -->
                        <div class="inp-group">
                            <div class="flex">
                                <select name="items[]" class="form-control" onchange="updateMaxQuantity(this)">
                                    <!-- Options will be populated here by JavaScript -->
                                </select>
                                <input type="number" name="borrow_quantity[]" class="form-control" placeholder="Enter Quantity" required>
                            </div>
                        </div>

                        <!-- Dynamic Inputs Will Be Added Here -->
                    </div>

                    <div class="modal-footer">
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
                <h5 class="modal-title" id="viewModalLabel">Item Transaction Details</h5>
                <button type="button" class="bx bxs-x-circle icon" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Borrower Name:</strong> <span id="view_name"></span></p>
                        <p><strong>Borrower Address:</strong> <span id="view_address"></span></p>
                        <p><strong>Borrowed Items:</strong> <span id="view_bitems"></span></p>
                        <p><strong>Borrowed Quantities:</strong> <span id="view_bquantity"></span></p>
                        <p><strong>Reserve On:</strong> <span id="view_reserved"></span></p>
                        <p><strong>Date Borrowed:</strong> <span id="view_bdate"></span></p>
                        <p><strong>Transaction Status:</strong> <span id="view_status"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Return Date:</strong> <span id="view_rdate"></span></p>
                        <p><strong>Approved By:</strong> <span id="view_approved"></span></p>
                        <p><strong>Released By:</strong> <span id="view_released"></span></p>
                        <p><strong>Returned By:</strong> <span id="view_returned"></span></p>
                        <p><strong>Date Returned:</strong> <span id="view_retdate"></span></p>
                        <p><strong>Return Quantities:</strong> <span id="view_rquantity"></span></p>
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
</section>

    </body> 
    <script>
        function validateForm() {
                var itemCount = parseInt(document.getElementById('itemcount').value);
                var lendableCount = parseInt(document.getElementById('lendablecount').value);

                var itemCountField = parseInt(document.getElementById('countField').value);
                var lendableCountField = parseInt(document.getElementById('lendablecountField').value);

                if (lendableCount > itemCount) {
                    alert("Lendable count cannot be more than item count.");
                    return false;
                }

                if (lendableCountField > itemCountField) {
                    alert("Lendable count cannot be more than item count.");
                    return false;
                }

                return true;
            }
    </script>

    <script>
        //Script for date proper sequence
        const reservedOn = document.getElementById('reservedon');
        const dateBorrowed = document.getElementById('dateborrowed');
        const returnDate = document.getElementById('returndate');

        function validateDates() {
            const reservedOnDate = new Date(reservedOn.value);
            const dateBorrowedDate = new Date(dateBorrowed.value);
            const returnDateValue = new Date(returnDate.value);

            if (dateBorrowed.value && reservedOnDate > dateBorrowedDate) {
                showAlert("The 'Return Date' cannot be before 'Date Borrowed' date.","alert-danger");
                dateBorrowed.value = "";
            }

            if (returnDate.value && dateBorrowedDate > returnDateValue) {
                showAlert("The 'Return Date' cannot be before 'Date Borrowed' date.","alert-danger");
                returnDate.value = "";
            }
        }

        reservedOn.addEventListener('change', validateDates);
        dateBorrowed.addEventListener('change', validateDates);
        returnDate.addEventListener('change', validateDates);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#addUserModal').on('shown.bs.modal', function () {
                console.log('Modal 1 is triggered');

                (function FunctionForModal1() {
                    const items = <?php echo $items_json; ?>;
                    const selectedItems = new Set();

                    function updateItemOptions() {
                        const selects = document.querySelectorAll("#addUserModal select[name='items[]']");
                        selectedItems.clear();

                        selects.forEach(select => {
                            if (select.value) {
                                selectedItems.add(select.value);
                            }
                        });

                        selects.forEach(select => {
                            const currentValue = select.value;
                            select.innerHTML = ''; // Clear current options

                            items.forEach(item => {
                                if (!selectedItems.has(item.item_id) || item.item_id == currentValue) {
                                    const option = document.createElement('option');
                                    option.value = item.item_id;
                                    option.textContent = `${item.item_name} (${item.available_count} available)`;
                                    option.dataset.availableCount = item.available_count;

                                    if (item.item_id == currentValue) {
                                        option.selected = true;
                                    }

                                    select.appendChild(option);
                                }
                            });
                        });
                    }

                    function updateMaxQuantity(select) {
                        const availableCount = select.options[select.selectedIndex].dataset.availableCount;
                        const quantityInput = select.nextElementSibling;
                        quantityInput.max = availableCount;
                        quantityInput.placeholder = `Enter Quantity (Max: ${availableCount})`;

                        // Update selected items
                        selectedItems.clear();
                        document.querySelectorAll("#addUserModal select[name='items[]']").forEach(s => {
                            if (s.value) {
                                selectedItems.add(s.value);
                            }
                        });

                        updateItemOptions();
                    }

                    document.querySelectorAll("#addUserModal select[name='items[]']").forEach(select => {
                        select.addEventListener('change', () => {
                            updateMaxQuantity(select);
                        });
                    });

                    // Call initializeOptions to set up initial state
                    updateItemOptions();

                    function allItemsSelected() {
                        const selects = document.querySelectorAll("#addUserModal select[name='items[]']");
                        const selectedItems = new Set();

                        selects.forEach(select => {
                            if (select.value) {
                                selectedItems.add(select.value);
                            }
                        });

                        // Create a set of all item IDs from combinedItems
                        const allItems = new Set();
                        items.forEach(item => allItems.add(item.item_id));

                        // Check if all items are selected
                        return allItems.size === selectedItems.size;
                    }

                    document.querySelector('.add').addEventListener('click', function(event) {
                        event.preventDefault();
                        addInput();

                        document.querySelectorAll("#addUserModal select[name='items[]']").forEach(select => {
                            updateMaxQuantity(select);
                        });

                    });

                    function removeInput(event) {
                        event.preventDefault();
                        if (confirm("Are you sure you want to remove this row?")) {
                            event.target.parentElement.remove();
                        }
                    }

                    function addInput() {
                        if (allItemsSelected()) {
                            showAlert("All items are already selected. Cannot add more fields.","alert-danger");
                            return;
                        }

                        const newGroup = document.createElement("div");
                        newGroup.classList.add("flex");

                        const itemSelect = document.createElement("select");
                        itemSelect.name = "items[]";
                        itemSelect.onchange = function () {
                            updateMaxQuantity(itemSelect);
                        };

                        const quantityInput = document.createElement("input");
                        quantityInput.type = "number";
                        quantityInput.name = "borrow_quantity[]";
                        quantityInput.placeholder = "Enter Quantity";
                        quantityInput.required = true;
                        quantityInput.min = 1;

                        const removeButton = document.createElement("a");
                        removeButton.href = "#";
                        removeButton.textContent = "X";
                        removeButton.classList.add("delete");
                        removeButton.onclick = removeInput;

                        newGroup.appendChild(itemSelect);
                        newGroup.appendChild(quantityInput);
                        newGroup.appendChild(removeButton);
                        document.querySelector("#addUserModal .inp-group").appendChild(newGroup);

                        updateItemOptions();
                    }

                    updateItemOptions();
                })();
            });
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#exampleModal').on('shown.bs.modal', function () {
            console.log('Modal 2 is triggered');
            (function FunctionForModal2() {
                
                const items = <?php echo $items_json_2; ?>;
                const borrowedItems = <?php echo $borrowedItems_json; ?>;
                const selectedItems = new Set();
                const combinedItems = new Map();

                console.log(items);
                console.log(borrowedItems);

                function updateItemOptions() {
                    const selects = document.querySelectorAll("#exampleModal select[name='items[]']");
                    selectedItems.clear();

                    selects.forEach(select => {
                        if (select.value) {
                            selectedItems.add(select.value);
                        }
                    });

                    borrowedItems.forEach(item => {
                        combinedItems.set(String(item.item_id), {
                            item_id: String(item.item_id),
                            item_name: item.item_name,
                            available_count: item.available_count,
                            borrow_quantity: item.borrow_quantity,
                            isBorrowed: true
                        });
                    });

                    items.forEach(item => {
                        if (!combinedItems.has(String(item.item_id))) {
                            combinedItems.set(String(item.item_id), {
                                item_id: String(item.item_id),
                                item_name: item.item_name,
                                available_count: item.available_count,
                                borrow_quantity: 0,
                                isBorrowed: false
                            });
                        }
                    });
                    // Add options to the select element
                    selects.forEach(select => {
                    const currentValue = select.value;
                    select.innerHTML = ''; // Clear current options

                    combinedItems.forEach(item => {
                        // Add the item if it's not selected elsewhere or if it's the current value
                        if (!selectedItems.has(item.item_id) || item.item_id == currentValue) {
                            const option = document.createElement('option');
                            option.value = item.item_id;
                            option.textContent = `${item.item_name} (Available: ${item.available_count})`;
                            option.dataset.availableCount = item.available_count;

                            if (item.item_id == currentValue) {
                                option.selected = true;
                            }

                            select.appendChild(option);
                        }
                    });
                });
                }
                // Update the maximum quantity based on the selected item
                function updateMaxQuantity(select) {
                    const selectedOption = select.options[select.selectedIndex];
                    if (selectedOption) {
                        const itemId = selectedOption.value;
                        const borrowedItem = borrowedItems.find(item => item.item_id == itemId);
                        let availableCount = parseInt(selectedOption.dataset.availableCount);

                        if (borrowedItem) {
                            availableCount += parseInt(borrowedItem.borrow_quantity);
                        }

                        const quantityInput = select.nextElementSibling;
                        quantityInput.max = availableCount;
                        quantityInput.placeholder = `Enter Quantity (Max: ${availableCount})`;
                    }
                    // Update the selected items
                    selectedItems.clear();
                    document.querySelectorAll("#exampleModal select[name='items[]']").forEach(s => {
                        if (s.value) {
                            selectedItems.add(s.value);
                        }
                    });
                    // Add borrowed items to the selected items set
                    borrowedItems.forEach(item => {
                        selectedItems.add(item.item_id);
                    });

                    // Update item options across all selects
                    updateItemOptions();
                }

                // Event listener for changes in dropdowns
                document.querySelectorAll("#exampleModal select[name='items[]']").forEach(select => {
                    select.addEventListener('change', () => {
                        updateMaxQuantity(select);
                    });
                });

                // Function to validate return quantity
                function validateReturnQuantity(event) {
                    const returnQuantityInput = event.target;
                    const borrowQuantityInput = returnQuantityInput.previousElementSibling; // Assumes return quantity input follows borrow quantity input

                    if (borrowQuantityInput) {
                        const borrowQuantity = parseInt(borrowQuantityInput.value, 10);
                        const returnQuantity = parseInt(returnQuantityInput.value, 10);

                        if (returnQuantity > borrowQuantity) {
                            alert("Return quantity cannot be greater than borrow quantity.");
                            returnQuantityInput.value = ""; // Clear invalid return quantity
                        }
                    }   
                }

                // Add event listeners to return quantity inputs for validation
                document.querySelectorAll("#exampleModal  input[name='return_quantity[]']").forEach(input => {
                    input.addEventListener('input', validateReturnQuantity);
                });


                // Call initializeOptions to set up initial state
                updateItemOptions();

                function allItemsSelected() {
                    const selects = document.querySelectorAll("#exampleModal select[name='items[]']");
                    const selectedItems = new Set();

                    selects.forEach(select => {
                        if (select.value) {
                            selectedItems.add(select.value);
                        }
                    });

                    // Create a set of all item IDs from combinedItems
                    const allItems = new Set();
                    combinedItems.forEach(item => allItems.add(item.item_id));

                    // Check if all items are selected
                    return allItems.size === selectedItems.size;
                }





                document.querySelector('#exampleModal .add-update').addEventListener('click', function (event) {
                    event.preventDefault();
                    addInput();

                    document.querySelectorAll("#exampleModal select[name='items[]']").forEach(select => {
                        updateMaxQuantity(select);
                    });

                    // Add event listeners to return quantity inputs for validation
                    document.querySelectorAll("#exampleModal  input[name='return_quantity[]']").forEach(input => {
                        input.addEventListener('input', validateReturnQuantity);
                    });

                });

                function removeInput(event) {
                    event.preventDefault();
                    if (confirm("Are you sure you want to remove this row?")) {
                        event.target.parentElement.remove();
                        updateItemOptions();
                    }
                }

                function addInput() {
                    if (allItemsSelected()) {
                        alert("All items are already selected. Cannot add more fields.");
                        return;
                    }

                    const newGroup = document.createElement("div");
                    newGroup.classList.add("flex");

                    const itemSelect = document.createElement("select");
                    itemSelect.name = "items[]";
                    itemSelect.onchange = function () {
                        updateMaxQuantity(itemSelect);
                    };

                    const borrowQuantityInput = document.createElement("input");
                    borrowQuantityInput.type = "number";
                    borrowQuantityInput.name = "borrow_quantity[]";
                    borrowQuantityInput.placeholder = "Enter Quantity";
                    borrowQuantityInput.required = true;
                    borrowQuantityInput.min = 1;

                    const returnQuantityInput = document.createElement("input");
                    returnQuantityInput.type = "number";
                    returnQuantityInput.name = "return_quantity[]";
                    returnQuantityInput.placeholder = "Enter Return Quantity";
                    returnQuantityInput.required = false;

                    const removeButton = document.createElement("a");
                    removeButton.href = "#";
                    removeButton.textContent = "X";
                    removeButton.classList.add("delete");
                    removeButton.onclick = removeInput;

                    newGroup.appendChild(itemSelect);
                    newGroup.appendChild(borrowQuantityInput);
                    newGroup.appendChild(returnQuantityInput);
                    newGroup.appendChild(removeButton);
                    document.querySelector("#exampleModal .inp-group-update").appendChild(newGroup);

                    updateItemOptions();
                }

                

                updateItemOptions();
            })();
        });
    });
</script>


</html>
