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
                "targets": [0,8,10,11,12,13,14],  // Target the first column (aData[0])
                "visible": false, // Hide the column
                "searchable": false // Disable search for this column if needed
                },
                {
                "bSortable": false,
                "aTargets": [0,1,2,3,4,5,6,7,8,9,10]
            }],
            // Event that triggers when the table is redrawn (pagination or search)
            "drawCallback": function() {
                updateCheckboxStates()
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
    $(document).on('submit', '#addBlotter', function(e) {
    e.preventDefault();

    // Residents data fetched from the backend
    const residents = <?php echo json_encode($residents); ?>;

    // Validation function for checking if the resident exists
    function validateResident(name, type) {
        const isValid = residents.some(resident => resident.resident_fullname === name);
        if (!isValid) {
            showAlert(`No match found for the ${type}: ${name}`, "alert-danger");
        }
        return isValid;
    }

    // Gather form values
    var blotter_complainant = $('#blotter_complainant').val().trim();
    var blotter_complainant_no = $('#blotter_complainant_no').val();
    var blotter_complainant_add = $('#blotter_complainant_add').val().trim();
    var blotter_complainee = $('#blotter_complainee').val().trim();
    var blotter_complainee_no = $('#blotter_complainee_no').val();
    var blotter_complainee_add = $('#blotter_complainee_add').val().trim();
    var blotter_complaint = $('#blotter_complaint').val();
    var blotter_status = $('#blotter_status').val();
    var blotter_action = $('#blotter_action').val();
    var blotter_incidence = $('#blotter_incidence').val();
    var blotter_date_recorded = $('#blotter_date_recorded').val();
    var blotter_date_settled = $('#blotter_date_settled').val();
    var blotter_recorded_by = $('#blotter_recorded_by').val();

    // Check if all required fields are filled
    if (
        blotter_complainant &&
        blotter_complainant_add &&
        blotter_complainee &&
        blotter_complainee_add &&
        blotter_complaint &&
        blotter_status &&
        blotter_action &&
        blotter_incidence &&
        blotter_date_recorded
    ) {
        // Validate complainant and complainee
        if (
            !validateResident(blotter_complainant, "complainant") || 
            !validateResident(blotter_complainee, "complainee")
        ) {
            return; // Stop submission if validation fails
        }

        // Validate contact numbers
        function validateContact(contact, type) {
            if (contact) { // Only run validation if a contact number is provided
                if (!contact.startsWith('0') && !contact.startsWith('+63')) {
                    showAlert(`${type} contact should start with '0' or '+63'.`, "alert-danger");
                    return false;
                }
                if (contact.startsWith('+63')) {
                    contact = contact.replace('+63', '0'); // Replace "+63" with "0"
                }
                const contactDigits = contact.replace(/\D/g, ''); // Remove non-numeric characters
                if (contactDigits.length !== 11) {
                    showAlert(`${type} contact should have exactly 11 digits after formatting.`, "alert-danger");
                    return false;
                }
            }
            return true;
        }

        if (
            !validateContact(blotter_complainant_no, "Complainant") ||
            !validateContact(blotter_complainee_no, "Complainee")
        ) {
            return; // Stop submission if contact validation fails
        }

        // Proceed with AJAX request
        $.ajax({
            url: "add.php",
            type: "post",
            data: {
                blotter_complainant: blotter_complainant,
                blotter_complainant_no: blotter_complainant_no,
                blotter_complainant_add: blotter_complainant_add,
                blotter_complainee: blotter_complainee,
                blotter_complainee_no: blotter_complainee_no,
                blotter_complainee_add: blotter_complainee_add,
                blotter_complaint: blotter_complaint,
                blotter_status: blotter_status,
                blotter_action: blotter_action,
                blotter_incidence: blotter_incidence,
                blotter_date_recorded: blotter_date_recorded,
                blotter_date_settled: blotter_date_settled,
                blotter_recorded_by: blotter_recorded_by
            },
            success: function(data) {
                var json = JSON.parse(data);
                var status = json.status;

                if (status === 'duplicate') {
                    showAlert("Blotter with the same name already exists.", "alert-danger");
                } else if (status === 'true') {
                    $('#example').DataTable().draw();
                    $('#addUserModal').modal('hide');
                    showAlert("Blotter added successfully.", "alert-success");
                    $('#addBlotter')[0].reset(); // Clear the form fields
                } else {
                    showAlert("Failed to add blotter.", "alert-danger");
                }
            }
        });
    } else {
        showAlert("Fill all the required fields", "alert-danger");
    }
});




    $(document).on('submit', '#updateBlotter', function(e) {
    e.preventDefault();

    var blotter_complainant = $('#blotter_complainantField').val();
    var blotter_complainant_no = $('#blotter_complainant_noField').val();
    var blotter_complainant_add = $('#blotter_complainant_addField').val();
    var blotter_complainee = $('#blotter_complaineeField').val();
    var blotter_complainee_no = $('#blotter_complainee_noField').val();
    var blotter_complainee_add = $('#blotter_complainee_addField').val();
    var blotter_complaint = $('#blotter_complaintField').val();
    var blotter_status = $('#blotter_statusField').val();
    var blotter_action = $('#blotter_actionField').val();
    var blotter_incidence = $('#blotter_incidenceField').val();
    var blotter_date_recorded = $('#blotter_date_recordedField').val();
    var blotter_date_settled = $('#blotter_date_settledField').val();
    var blotter_recorded_by = $('#blotter_recorded_byField').val();
    var trid = $('#trid').val();
    var blotter_id = $('#blotter_id').val();

    // Validate contact numbers
    function validateContactNumber(contact, fieldName) {
        // Ensure the contact starts with either '0' or '+63'
        if (!contact.startsWith('0') && !contact.startsWith('+63')) {
            showAlert(`${fieldName} should start with '0' or '+63'.`, "alert-danger");
            return false;
        }

        // Check if it starts with "+63" and remove the prefix for validation
        if (contact.startsWith('+63')) {
            contact = contact.replace('+63', '0'); // Replace "+63" with "0" for consistent length validation
        }

        // Remove all non-numeric characters (like spaces, dashes, etc.)
        var contact_digits = contact.replace(/\D/g, '');

        // Check if the contact has exactly 11 digits
        if (contact_digits.length !== 11) {
            showAlert(`${fieldName} should have exactly 11 digits after formatting.`, "alert-danger");
            return false;
        }

        return true;
    }

    // Run validation on both contacts
    if (blotter_complainant_no && !validateContactNumber(blotter_complainant_no, "Complainant contact")) return;
    if (blotter_complainee_no && !validateContactNumber(blotter_complainee_no, "Complainee contact")) return;

    // Check if other required fields are filled
    if (
        blotter_complainant &&
        blotter_complainant_add &&
        blotter_complainee &&
        blotter_complainee_add &&
        blotter_complaint &&
        blotter_status &&
        blotter_action &&
        blotter_incidence &&
        blotter_date_recorded 
    ) {
        // Proceed with the AJAX request
        $.ajax({
            url: "update.php",
            type: "post",
            data: {
                blotter_complainant: blotter_complainant,
                blotter_complainant_no: blotter_complainant_no,
                blotter_complainant_add: blotter_complainant_add,
                blotter_complainee: blotter_complainee,
                blotter_complainee_no: blotter_complainee_no,
                blotter_complainee_add: blotter_complainee_add,
                blotter_complaint: blotter_complaint,
                blotter_status: blotter_status,
                blotter_action: blotter_action,
                blotter_incidence: blotter_incidence,
                blotter_date_recorded: blotter_date_recorded,
                blotter_date_settled: blotter_date_settled,
                blotter_recorded_by: blotter_recorded_by,
                blotter_id: blotter_id
            },
            success: function(data) {
                var json = JSON.parse(data);
                var status = json.status;
                if (status === 'duplicate') {
                    showAlert("Blotter with the same name already exists.", "alert-danger");
                } else if (status === 'true') {
                    $('#example').DataTable().draw();
                    $('#exampleModal').modal('hide');
                    showAlert("Blotter update successful.", "alert-success");
                } else {
                    showAlert("Failed to update blotter.", "alert-danger");
                }
            },
            error: function() {
                showAlert("Error updating record.", "alert-danger");
            }
        });
    } else {
        showAlert("Fill all the required fields", "alert-danger");
    }
});
    
    $(document).on('click', '.deleteBtn', function(event) {
    event.preventDefault();
    var blotter_id = $(this).data('id'); // Get blotter ID from data attribute
    var table = $('#example').DataTable();

    // Open the modal
    $('#deleteConfirmationModal').modal('show');

    // Handle the confirmation
    $('#confirmDeleteBtn').off('click').on('click', function() {
    $.ajax({
        url: "delete.php",
        type: "POST",
        data: { blotter_id: blotter_id },
        success: function(response) {
        var json = JSON.parse(response);
        if (json.status === 'success') {
            // Remove the row from DataTable
            table.row($(event.target).closest('tr')).remove().draw();
        } else {
            alert('Deletion failed');
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
    $('#example').on('click', '.editbtn ', function(event) {
    var table = $('#example').DataTable();
    var trid = $(this).closest('tr').attr('id');
    // console.log(selectedRow);
    var blotter_id = $(this).data('id');
    $('#exampleModal').modal('show');

    $.ajax({
        url: "get_single_data.php",
        data: {
            blotter_id: blotter_id
        },
        type: 'post',
        success: function(data) {
            var json = JSON.parse(data);
            $('#blotter_complainantField').val(json.blotter_complainant);
            $('#blotter_complainant_noField').val(json.blotter_complainant_no);
            $('#blotter_complainant_addField').val(json.blotter_complainant_add);
            $('#blotter_complaineeField').val(json.blotter_complainee);
            $('#blotter_complainee_noField').val(json.blotter_complainee_no);
            $('#blotter_complainee_addField').val(json.blotter_complainee_add);
            $('#blotter_complaintField').val(json.blotter_complaint);
            $('#blotter_statusField').val(json.blotter_status);
            $('#blotter_actionField').val(json.blotter_action);
            $('#blotter_incidenceField').val(json.blotter_incidence);
            $('#blotter_date_recordedField').val(json.blotter_date_recorded);
            $('#blotter_date_settledField').val(json.blotter_date_settled);
            $('#blotter_recorded_byField').val(json.blotter_recorded_by);
            $('#blotter_id').val(blotter_id);
            $('#trid').val(trid);
        }
    })
});
$(document).ready(function() {
    $('#example').on('click', '.viewbtn', function(event) {
        var table = $('#example').DataTable();
        var blotter_id = $(this).data('id');
        
        // Debugging: Check if blotter_id is found
        console.log("blotter ID:", blotter_id);
        
        if (!blotter_id) {
            console.error("blotter ID is not defined.");
            alert("blotter ID is missing. Please try again.");
            return;
        }

        $('#viewModal').modal('show');
        $.ajax({
            url: "fetch_details.php",
            data: {
                blotter_id: blotter_id
            },
            type: 'post',
            success: function(data) {
                console.log("AJAX data response:", data);
                try {
                    var json = JSON.parse(data);
                    $('#view_1').text(json.blotter_complainant || "N/A");
                    $('#view_2').text(json.blotter_complainant_no || "N/A");
                    $('#view_3').text(json.blotter_complainant_add || "N/A");
                    $('#view_4').text(json.blotter_complainee || "N/A");
                    $('#view_5').text(json.blotter_complainee_no || "N/A");
                    $('#view_6').text(json.blotter_complainee_add || "N/A");
                    $('#view_7').text(json.blotter_complaint || "N/A");
                    $('#view_8').text(json.blotter_status || "N/A");
                    $('#view_9').text(json.blotter_action || "N/A");
                    $('#view_10').text(json.blotter_incidence || "N/A");
                    $('#view_11').text(json.blotter_date_recorded || "N/A");
                    $('#view_12').text(json.blotter_date_settled || "N/A");
                    $('#view_13').text(json.blotter_recorded_by || "N/A");
                } catch (e) {
                    console.error("JSON parsing error:", e);
                    alert("An error occurred while processing the data.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", error);
                alert("Failed to fetch details: " + error);
            }
        });
    });
});
</script>
<script>
        document.getElementById('blotter_complainant').addEventListener('change', function() {
            let complainantId = this.value;
            let complaineeSelect = document.getElementById('blotter_complainee');
            
            // Reset complainee options
            complaineeSelect.innerHTML = `<option value="" disabled selected>Select a complainee</option>`;
            
            <?php foreach ($residents as $resident): ?>
                if (complainantId !== "<?php echo $resident['resident_fullname']; ?>") {
                    complaineeSelect.innerHTML += `<option value="<?php echo $resident['resident_fullname']; ?>"><?php echo htmlspecialchars($resident['resident_fullname']); ?></option>`;
                }
            <?php endforeach; ?>
        });
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
</script>
    <script>
    // Residents data fetched from the backend
    const residents = <?php echo json_encode($residents); ?>;

    // Variables to track selected complainant and complainee
    let selectedComplainant = null;
    let selectedComplainee = null;

    // Function to dynamically filter residents based on input
    function filterResidents(type, formPrefix = '') {
        const inputField = document.getElementById(`${formPrefix}blotter_${type}`);
        const suggestionsList = document.getElementById(`${formPrefix}${type}Suggestions`);
        const query = inputField.value.toLowerCase().trim();

        // Clear the suggestions list
        suggestionsList.innerHTML = '';

        if (query === '') return; // Exit if query is empty

        // Filter residents
        const filteredResidents = residents.filter(resident => {
            const name = resident.resident_fullname.toLowerCase();

            // Avoid duplication: Exclude complainee when searching for complainant and vice versa
            if (type === 'complainant' && resident.resident_fullname === selectedComplainee) {
                return false;
            }
            if (type === 'complainee' && resident.resident_fullname === selectedComplainant) {
                return false;
            }

            return name.includes(query); // Return true if the name matches the query
        });

        // Populate suggestions
        if (filteredResidents.length === 0) {
            const li = document.createElement('li');
            li.textContent = 'No matching residents found';
            li.className = 'no-results'; // Optional styling
            suggestionsList.appendChild(li);
        } else {
            filteredResidents.forEach(resident => {
                const li = document.createElement('li');
                li.textContent = resident.resident_fullname;
                li.onclick = () => selectResident(type, resident.resident_fullname, formPrefix);
                suggestionsList.appendChild(li);
            });
        }
    }

    // Function to select a resident
    function selectResident(type, name, formPrefix = '') {
        const inputField = document.getElementById(`${formPrefix}blotter_${type}`);
        const suggestionsList = document.getElementById(`${formPrefix}${type}Suggestions`);

        inputField.value = name; // Set the selected name in the input field
        suggestionsList.innerHTML = ''; // Clear suggestions

        // Track the selection
        if (type === 'complainant') {
            selectedComplainant = name;
        } else if (type === 'complainee') {
            selectedComplainee = name;
        }
    }
</script>