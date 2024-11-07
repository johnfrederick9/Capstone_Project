<script type="text/javascript">
$(document).ready(function() {
    // Array to store selected checkbox IDs
    var selectedIds = [];

    var table = $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
            $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
            'url': 'fetch_data.php',
            'type': 'post',
        },
        "aoColumnDefs": [
            {
            "targets": [0,2,4,11],  // Target the first column (aData[0])
            "visible": false, // Hide the column
            "searchable": false // Disable search for this column if needed
            },
            {
            "bSortable": false,
            "aTargets": [12]
        }],
        // Event that triggers when the table is redrawn (pagination or search)
        "drawCallback": function() {
            updateCheckboxStates();
        }
    });

    // Update checkbox state on page draw
    function updateCheckboxStates() {
        // Iterate through each row checkbox
        $('.row-checkbox').each(function() {
            var id = $(this).val();
            // If the ID is in the selected array, keep it checked
            if (selectedIds.includes(id)) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
    }
            // Print function (same as your original code)
            function printContentFromPage(url, ids = '') {
        $.ajax({
            url: url,
            type: 'GET',
            data: { ids: ids },
            success: function(response) {
                var iframe = document.createElement('iframe');
                iframe.style.position = 'absolute';
                iframe.style.width = '0px';
                iframe.style.height = '0px';
                iframe.style.border = 'none';
                document.body.appendChild(iframe);

                var doc = iframe.contentWindow.document;
                doc.open();
                doc.write(response);
                doc.close();

                iframe.contentWindow.focus();
                iframe.contentWindow.print();

                document.body.removeChild(iframe);
            },
            error: function() {
                showAlert("Failed to load print content.", "alert-danger");
            }
        });
    }

    // Select all checkboxes
    $('#selectAll').click(function() {
        var checkedStatus = this.checked;
        $('.row-checkbox').each(function() {
            $(this).prop('checked', checkedStatus);

            // Add or remove IDs from selectedIds array
            var id = $(this).val();
            if (checkedStatus) {
                if (!selectedIds.includes(id)) {
                    selectedIds.push(id);
                }
            } else {
                selectedIds = [];
            }
        });
    });

    // Individual checkbox change event
    $('#example').on('change', '.row-checkbox', function() {
        var id = $(this).val();
        if ($(this).is(':checked')) {
            if (!selectedIds.includes(id)) {
                selectedIds.push(id);
            }
        } else {
            selectedIds = selectedIds.filter(item => item !== id);
        }
    });

    // Print selected rows
    $('.print-btn').click(function() {
        if (selectedIds.length > 0) {
            var idsString = selectedIds.join(',');
            printContentFromPage('print_selected.php', idsString);
        } else {
            showAlert("Please select at least one row to print.", "alert-danger");
        }
    });

    // Print all rows
    $('.print-all-btn').click(function() {
        printContentFromPage('print_all.php');
    });

    // Function to show alert
    function showAlert(message, alertClass) {
        var alertDiv = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' + message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        alertDiv.css({
            "position": "fixed",
            "top": "10px",
            "right": "10px",
            "z-index": "9999",
            "background-color": alertClass === "alert-danger" ? "#f8d7da" : "#d4edda",
            "border-color": alertClass === "alert-danger" ? "#f5c6cb" : "#c3e6cb"
        });
        $("body").append(alertDiv);
        setTimeout(function() {
            alertDiv.alert('close');
        }, 900);
    }
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
                                    showAlert("Transaction Added successfully.", "alert-success");
                                    $('#addUser')[0].reset();  // Clear the form fields
                                } else {
                                    showAlert("Failed to add item.", "alert-danger");
                                }
                            }
                        });
                    } else {
                        showAlert("Fill all the required fields", "alert-danger");
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
                                    var checkbox = '<td><input type="checkbox" class="row-checkbox" value="'+transaction_id+'"></td>';
                                    var row = table.row("[id='" + trid + "']");
                                    row.data([transaction_id, checkbox, borrower_name, borrower_address, reserved_on, date_borrowed, return_date, approved_by, released_by, returned_by, date_returned, available_count, button]);

                                    // Close the modal
                                    $('#exampleModal').modal('hide');
                                    showAlert("Transaction update successfully.", "alert-success");
                                } else {
                                    showAlert('Update failed: ' + (json.error || 'Unknown error', "alert-danger"));
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error: " + status + ": " + error);
                                alert("An error occurred while updating data.");
                            }
                        });
                    } else {
                        showAlert("Fill all the required fields", "alert-danger");
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
                event.preventDefault();
                var transaction_id = $(this).data('id'); // Get transaction ID from data attribute
                var table = $('#example').DataTable();

                // Open the modal
                $('#deleteConfirmationModal').modal('show');

                // Handle the confirmation
                $('#confirmDeleteBtn').off('click').on('click', function() {
                $.ajax({
                    url: "delete.php",
                    type: "POST",
                    data: { transaction_id: transaction_id },
                    success: function(response) {
                    var json = JSON.parse(response);
                    if (json.status === 'success') {
                        // Remove the row from DataTable
                        table.row($(event.target).closest('tr')).remove().draw();
                    } else {
                        showAlert("Deletion Field", "alert-danger");
                    }
                    // Close the modal
                    $('#deleteConfirmationModal').modal('hide');
                    }
                });
                });
            });
            // Function to show alert
            function showAlert(message, alertClass) {
                var alertDiv = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' + message +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                alertDiv.css({
                    "position": "fixed",
                    "top": "10px",
                    "right": "10px",
                    "z-index": "9999",
                    "background-color": alertClass === "alert-danger" ? "#f8d7da" : "#d4edda",
                    "border-color": alertClass === "alert-danger" ? "#f5c6cb" : "#c3e6cb"
                });
                $("body").append(alertDiv);
                setTimeout(function() { alertDiv.alert('close'); }, 900);
            }
        </script>
<script>
 function toggleDropdown(button) {
    // Get the dropdown menu associated with the button
    var dropdownMenu = button.nextElementSibling;
    
    // Get the icon element in the button
    var icon = button.querySelector('i');

    // Toggle the display of the dropdown menu
    if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
        dropdownMenu.style.display = "flex"; // Show the menu as flex (horizontal layout)
        icon.classList.remove('bx-chevron-down');
        icon.classList.add('bx-chevron-up');
    } else {
        dropdownMenu.style.display = "none"; // Hide the menu
        icon.classList.remove('bx-chevron-up');
        icon.classList.add('bx-chevron-down');
    }
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.action-btn') && !event.target.closest('.dropdown')) {
        var dropdowns = document.getElementsByClassName("dropdown-menu");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "flex") {
                openDropdown.style.display = "none";

                // Reset the icon to down-arrow for each open button
                var icon = openDropdown.previousElementSibling.querySelector('i');
                icon.classList.remove('bx-chevron-up');
                icon.classList.add('bx-chevron-down');
            }
        }
    }
}
</script>
<script>
    // Add event listener for the Enter key when the modal is open
document.addEventListener('keydown', function(event) {
    const modalOpen = document.getElementById('deleteConfirmationModal').classList.contains('show');
    if (modalOpen && event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('confirmDeleteBtn').click();
    }
});