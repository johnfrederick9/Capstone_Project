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
        <div class="inventory">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Item Transaction Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Item</button>
                            <!--<button class="print-btn" title="Print">
                                <i class="bx bx-printer"></i>
                            </button>-->
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Items</th>
                        <th>Quantity</th>
                        <th>Reserved Date</th>
                        <th>Borrowed Date</th>
                        <th>Return Date</th>
                        <th>Approved By</th>
                        <th>Released By</th>
                        <th>Date Returned</th>
                        <th>Return Quantity</th>
                        <th>Transaction Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                <script type="text/javascript">
             $(document).ready(function() {
                $('#example').DataTable({
                    "fnCreatedRow": function(nRow, aData, iDataIndex) {
                        // Set row ID and data attribute for delete button
                        $(nRow).attr('id', aData[0]);
                        $(nRow).find('.deleteBtn').attr('data-transaction_id', aData[0]);
                    },
                    'serverSide': true, // Boolean value without quotes
                    'processing': true,
                    'paging': true,
                    'order': [], // Empty array means no initial ordering
                    'ajax': {
                        'url': 'fetch_data.php',
                        'type': 'POST',
                    },
                    "columnDefs": [
                        {
                            "targets": [0, 2, 4, 11],  // Target specific columns
                            "visible": false, // Hide those columns
                            "searchable": false // Disable search for those columns
                        },
                        {
                            "targets": [10], // Target column 10
                            "orderable": false // Disable sorting for column 10
                        }
                    ]
                });
            });
                        $(document).on('submit', '#addUser', function(e) {
                            e.preventDefault();

                            // Initialize FormData directly from the form
                            var formData = new FormData(this);

                            var borrower_name = $('#borrowername').val();
                            var borrower_address = $('#borroweraddress').val();
                            var reserved_on = $('#reservedon').val();
                            var date_borrowed = $('#dateborrowed').val();
                            var return_date = $('#returndate').val();
                            var approved_by = $('#approvedby').val();
                            var released_by = $('#releasedby').val();
                            
                            // Collect borrowed quantities and item selections
                            var borrowed_quantity = $('input[name="borrow_quantity[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            
                            var items = $('select[name="items[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            // Append additional data (items and quantities) as JSON strings
                            formData.append('items', JSON.stringify(items));
                            formData.append('borrow_quantity', JSON.stringify(borrowed_quantity));

                            // Check if all required fields are filled
                            if (borrower_name !== '' && borrower_address !== '' && reserved_on !== '' && 
                                date_borrowed !== '' && return_date !== '' && approved_by !== '' && released_by !== '') {
                                
                                // Submit the form data using AJAX
                                $.ajax({
                                    url: "add.php",  // Server-side script to process form data
                                    type: "post",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        console.log("Status:", status);
                                        
                                        if (status == 'true') {
                                            mytable = $('#example').DataTable();
                                            mytable.draw();
                                            $('#addUserModal').modal('hide');
                                        } else {
                                            alert('Failed to submit data');
                                        }
                                    }
                                });
                            } else {
                                alert('Please fill all the required fields');
                            }
                        });

                        $(document).on('submit', '#updateUser', function(e) {
                            e.preventDefault();

                            // Collect values from the form
                            var borrower_name = $('#borrowernameField').val();
                            var borrower_address = $('#borroweraddressField').val();
                            var reserved_on = $('#reservedonField').val();
                            var date_borrowed = $('#dateborrowedField').val();
                            var return_date = $('#returndateField').val();
                            var approved_by = $('#approvedbyField').val();
                            var released_by = $('#releasedbyField').val();
                            var returned_by = $('#returnedbyField').val();
                            var date_returned = $('#datereturnedField').val();
                            var transaction_id = $('#transaction_id').val(); // Ensure you're getting the correct transaction ID
                            var trid = $('#trid').val();
                            // Log values for debugging
                            console.log("Borrower Name:", borrower_name);
                            console.log("Borrower Address:", borrower_address);
                            console.log("Reserved On:", reserved_on);
                            console.log("Date Borrowed:", date_borrowed);
                            console.log("Return Date:", return_date);
                            console.log("Approved By:", approved_by);
                            console.log("Released By:", released_by);
                            console.log("Returned By:", returned_by);
                            console.log("Date Returned:", date_returned);
                            console.log("Transaction ID:", transaction_id);


                            // Collect dynamic item data
                            var items = [];
                            $('.inp-group-update > .flex').each(function() {
                                var item_id = $(this).find('select[name="items[]"]').val();
                                var borrow_quantity = $(this).find('input[name="borrow_quantity[]"]').val();
                                var return_quantity = $(this).find('input[name="return_quantity[]"]').val();
                                
                                items.push({
                                    item_id: item_id,
                                    borrow_quantity: borrow_quantity,
                                    return_quantity: return_quantity
                                });
                            });

                            console.log("Items: ", items);

                            if (borrower_name && borrower_address && reserved_on && date_borrowed && return_date && approved_by && released_by) {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: {
                                        transaction_id: transaction_id,
                                        borrower_name: borrower_name,
                                        borrower_address: borrower_address,
                                        reserved_on: reserved_on,
                                        date_borrowed: date_borrowed,
                                        return_date: return_date,
                                        approved_by: approved_by,
                                        released_by: released_by,
                                        returned_by: returned_by,
                                        date_returned: date_returned,
                                        items: JSON.stringify(items)
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        var available_count = json.available_count; // This might need to be adapted based on your response structure

                                        if (status == 'true') {
                                            console.log("Borrower Name:", data.borrower_name);
                                            console.log("Borrower Address:", data.borrower_address);
                                            console.log("Reserved On:", data.reserved_on);
                                            console.log("Date Borrowed:", data.date_borrowed);
                                            console.log("Return Date:", data.return_date);
                                            console.log("Approved By:", data.approved_by);
                                            console.log("Released By:", data.released_by);
                                            console.log("Returned By:", data.returned_by);
                                            console.log("Date Returned:", data.date_returned);
                                            console.log("Transaction ID:", data.transaction_id);
                                            
                                            var table = $('#example').DataTable();
                                            // Update the DataTable row with the new values
                                            var button = `
                                                <td>
                                                    <div class="buttons">
                                                        <a href="javascript:void();" data-id="${transaction_id}" class="update-btn btn-sm editbtn"><i class="bx bx-sync"></i></a>
                                                        <a href="!#" data-item_id="${transaction_id}" class="delete-btn btn-sm deleteBtn"><i class="bx bxs-trash"></i></a>
                                                    </div>
                                                </td>
                                            `;
                                            var row = table.row("[id='" + trid + "']");
                                            row.data([transaction_id, borrower_name, borrower_address, reserved_on, date_borrowed, return_date, approved_by, released_by, returned_by, date_returned, available_count, button]);

                                            // Close the modal
                                            $('#exampleModal').modal('hide');
                                        } else {
                                            alert('Update failed: ' + (json.error || 'Unknown error'));
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("AJAX Error: " + status + ": " + error);
                                        alert("An error occurred while updating data.");
                                    }
                                });
                            } else {
                                alert('Please fill all the required fields');
                            }
                        });

                        $('#example').on('click', '.editbtn', function(event) {
                            var table = $('#example').DataTable();
                            var trid = $(this).closest('tr').attr('id');
                            var transaction_id = $(this).data('id');

                            $('#transaction_id').val(transaction_id);
                            $('#trid').val(trid);
                            
                            $('#exampleModal').modal('show');

                            $.ajax({
                                url: "get_single_data.php",
                                data: { transaction_id: transaction_id },
                                type: 'post',
                                success: function(data) {
                                    try {
                                        var json = JSON.parse(data);
                                        console.log("AJAX request successful. Data:", data);
                                        
                                        // Check if json is structured as expected
                                        if (json.status == 'true') {
                                            var transaction = json.transaction;
                                            $('#borrowernameField').val(transaction.borrower_name);
                                            $('#borroweraddressField').val(transaction.borrower_address);
                                            $('#reservedonField').val(transaction.reserved_on);
                                            $('#dateborrowedField').val(transaction.date_borrowed);
                                            $('#returndateField').val(transaction.return_date);
                                            $('#approvedbyField').val(transaction.approved_by);
                                            $('#releasedbyField').val(transaction.released_by);
                                            $('#returnedbyField').val(transaction.returned_by);
                                            $('#datereturnedField').val(transaction.date_returned);

                                            // Clear existing inputs
                                            $('.inp-group-update').empty();

                                            // Populate selected items
                                            if (json.items && Array.isArray(json.items)) {
                                                json.items.forEach(function(item) {
                                                    const itemRow = `
                                                        <div class="flex">
                                                            <select name="items[]" onchange="updateMaxQuantity(this)">
                                                                <option value="${item.item_id}" selected>
                                                                    ${item.item_name}
                                                                </option>
                                                            </select>
                                                            <input type="number" name="borrow_quantity[]" value="${item.borrow_quantity}" required>
                                                            <input type="number" name="return_quantity[]" value="${item.return_quantity}">
                                                            <a href="#" class="delete" onclick="removeInput(event)">X</a>
                                                        </div>
                                                    `;
                                                    $('.inp-group-update').append(itemRow);
                                                });
                                            }
                                        } else {
                                            console.error('Error in JSON response:', json.error);
                                        }
                                    } catch (e) {
                                        console.error("Failed to parse JSON:", e);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("AJAX Error: " + status + ": " + error);
                                    alert("An error occurred while fetching data.");
                                }
                            });
                        });

                        $(document).on('click', '.deleteBtn', function(event) {
                            var table = $('#example').DataTable();
                            event.preventDefault();
                            var transaction_id = $(this).data('transaction_id');
                            console.log('Transaction ID:', transaction_id); 
                            if (confirm("Are you sure want to delete this transaction ? ")) {
                                $.ajax({
                                    url: "delete.php",
                                    data: {
                                        transaction_id: transaction_id,
                                    },
                                    type: "post",
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        status = json.status;
                                        if (status == 'success') {
                                            $("#" + transaction_id).closest('tr').remove();
                                        } else {
                                            alert('Failed');
                                            return;
                                        }
                                    }
                                });
                            } else {
                                return null;
                            }
                        })
                    </script>
                </section><!-- .home-->
                <!-- Modal -->
                <!-- Update Transaction -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Item</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <div class="form-group">
                                    <input type="hidden" name="transaction_id" id="transaction_id" value="">
                                    <input type="hidden" name="trid" id="trid" value="">
                                </div>
                                <div class="form-group">
                                    <label for="borrowernameField">Borrower Name:</label>
                                    <input type="text" id="borrowernameField" name="borrower_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="borroweraddressField">Borrower Address:</label>
                                    <input type="text" id="borroweraddressField" name="borrower_address" required>
                                </div>
                                <div class="form-group">
                                    <label for="reservedonField">Reserved On:</label>
                                    <input type="date" id="reservedonField" name="reserved_on" required>
                                </div>
                                <div class="form-group">
                                    <label for="dateborrowedField">Borrowed Date:</label>
                                    <input type="date" id="dateborrowedField" name="date_borrowed" required>
                                </div>
                                <div class="form-group">
                                    <label for="returndateField">Return Date:</label>
                                    <input type="date" id="returndateField" name="return_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="approvedbyField">Approved By:</label>
                                    <input type="text" id="approvedbyField" name="approved_by" required>
                                </div>
                                <div class="form-group">
                                    <label for="releasedbyField">Released By:</label>
                                    <input type="text" id="releasedbyField" name="released_by" required>
                                </div>
                                <div class="form-group">
                                    <label for="returnedbyField">Returned By:</label>
                                    <input type="text" id="returnedbyField" name="returned_by">
                                </div>
                                <div class="form-group">
                                    <label for="datereturnedField">Date Returned:</label>
                                    <input type="date" id="datereturnedField" name="date_returned">
                                </div>
                                <div class="form-group">
                                    <div class="wrap">
                                        <h2>Selected Items</h2>
                                        <a href="#" class="add-update">+</a>
                                    </div>
                                    <div class="inp-group-update">
                                        <!-- Dynamic Inputs Will Be Added Here -->
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
            <!-- Add Transaction -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                            <div class="form-group">
                                <label for="borrowername">Borrower Name:</label>
                                <input type="text" id="borrowername" name="borrower_name" required>
                            </div>

                            <div class="form-group">
                                <label for="borroweraddress">Borrower Address:</label>
                                <input type="text" id="borroweraddress" name="borrower_address" required>
                            </div>

                            <div class="form-group">
                                <label for="reservedon">Reserved On:</label>
                                <input type="date" id="reservedon" name="reserved_on" required>
                            </div>

                            <div class="form-group">
                                <label for="dateborrowed">Date Borrowed:</label>
                                <input type="date" id="dateborrowed" name="date_borrowed" required>
                            </div>

                            <div class="form-group">
                                <label for="returndate">Return Date:</label>
                                <input type="date" id="returndate" name="return_date" required>
                            </div>

                            <div class="form-group">
                                <label for="approvedby">Approved By:</label>
                                <input type="text" id="approvedby" name="approved_by" required>
                            </div>

                            <div class="form-group">
                                <label for="releasedby">Released By:</label>
                                <input type="text" id="releasedby" name="released_by" required>
                            </div>
                            
                            <div class="form-group">
                                <div class="wrap">
                                    <h2>Select Items</h2>
                                    <a href="#" class="add">+</a>
                                </div>
                                
                                <!-- Default Item Selection -->
                                <div class="inp-group">
                                    <div class="flex">
                                        <select name="items[]" onchange="updateMaxQuantity(this)">
                                            <!-- Options will be populated here by JavaScript -->
                                        </select>
                                        <input type="number" name="borrow_quantity[]" placeholder="Enter Quantity" required>
                                    </div>
                                </div>
                                
                                <!-- Dynamic Inputs Will Be Added Here -->
                            </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                alert("The 'Date Borrowed' cannot be before 'Reserved On' date.");
                dateBorrowed.value = "";
            }

            if (returnDate.value && dateBorrowedDate > returnDateValue) {
                alert("The 'Return Date' cannot be before 'Date Borrowed' date.");
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
