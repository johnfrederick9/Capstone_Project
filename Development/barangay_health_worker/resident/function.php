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
                "targets": [0],  // Target the first column (aData[0])
                "visible": false, // Hide the column
                "searchable": false // Disable search for this column if needed
                },
                {
                "bSortable": false,
                "aTargets": [0,1,2,3,4,5,6,7,8,9,10]
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

    var resident_firstname = $('#resident_firstname').val();
    var resident_lastname = $('#resident_lastname').val();
    var resident_middlename = $('#resident_middlename').val();
    var resident_maidenname = $('#resident_maidenname').val();
    var resident_sex = $('#resident_sex').val();
    var resident_suffixes = $('#resident_suffixes').val();
    var resident_address = $('#resident_address').val();
    var resident_educationalattainment = $('#resident_educationalattainment').val();
    var resident_birthdate = $('#resident_birthdate').val();
    var resident_age = $('#resident_age').val();
    var resident_contact = $('#resident_contact').val();
    var resident_occupation = $('#resident_occupation').val();
    var resident_religion = $('#resident_religion').val();
    var resident_indigenous = $('#resident_indigenous').val();
    var resident_status = $('#resident_status').val();
    var resident_householdrole = $('#resident_householdrole').val();
    var household_id = $('#household_id').val();

    if (resident_firstname && resident_lastname && resident_sex && resident_suffixes && resident_address && resident_educationalattainment && resident_birthdate && resident_occupation && resident_religion && resident_indigenous && resident_status && resident_householdrole && household_id) {
        $.ajax({
            url: "add.php",  
            type: "post",
            data: {
                resident_firstname: resident_firstname,
                resident_lastname: resident_lastname,
                resident_middlename: resident_middlename,
                resident_maidenname: resident_maidenname,
                resident_sex: resident_sex,
                resident_suffixes: resident_suffixes,
                resident_address: resident_address,
                resident_educationalattainment: resident_educationalattainment,
                resident_birthdate: resident_birthdate,
                resident_age: resident_age,
                resident_contact: resident_contact,
                resident_occupation: resident_occupation,
                resident_religion: resident_religion,
                resident_indigenous: resident_indigenous,
                resident_status: resident_status,
                resident_householdrole: resident_householdrole,
                household_id: household_id,
            },
            success: function(data) {
                var json = JSON.parse(data);
                var status = json.status;
                // Validate resident_contact if it has a value
                var resident_contact = $('#resident_contact').val() || $('#contactField').val(); // Check both fields for add and update

                if (resident_contact) { // Only run validation if a contact number is provided
                // Ensure the contact starts with either '0' or '+63'
                if (!resident_contact.startsWith('0') && !resident_contact.startsWith('+63')) {
                    showAlert("Resident contact should start with '0' or '+63'.", "alert-danger");
                    return;
                }

                // Check if it starts with "+63" and remove the prefix for validation
                if (resident_contact.startsWith('+63')) {
                    resident_contact = resident_contact.replace('+63', '0'); // Replace "+63" with "0" for consistent length validation
                }

                // Remove all non-numeric characters (like spaces, dashes, etc.)
                var resident_contact_digits = resident_contact.replace(/\D/g, ''); 

                // Check if resident_contact has exactly 11 digits
                if (resident_contact_digits.length !== 11) {
                    showAlert("Resident contact should have exactly 11 digits after formatting.", "alert-danger");
                    return;
                }
            }

                if (status === 'duplicate') {
                    showAlert("Resident with the same name already exists.", "alert-danger");
                } else if (status === 'true') {
                    $('#example').DataTable().draw();
                    $('#addUserModal').modal('hide');
                    showAlert("Resident added successfully.", "alert-success");
                    $('#addUser')[0].reset();  // Clear the form fields
                } else {
                    showAlert("Failed to add resident.", "alert-danger");
                }
            }
        });
    } else {
        showAlert("Fill all the required fields", "alert-danger");
    }
});

$(document).on('submit', '#updateUser', function(e) {
    e.preventDefault();

    // Get input values
    var resident_firstname = $('#fnameField').val();
    var resident_middlename = $('#minameField').val();
    var resident_lastname = $('#lnameField').val();
    var resident_maidenname = $('#manameField').val();
    var resident_sex = $('#sexField').val();
    var resident_suffixes = $('#suffixesField').val();
    var resident_address = $('#addressField').val();
    var resident_educationalattainment = $('#educField').val();
    var resident_birthdate = $('#birthField').val();
    var resident_contact = $('#contactField').val();
    var resident_occupation = $('#occupationField').val();
    var resident_religion = $('#religionField').val();
    var resident_indigenous = $('#indigenousField').val();
    var resident_status = $('#statusField').val();
    var resident_householdrole = $('#roleField').val();
    var household_id = $('#idField').val();
    var trid = $('#trid').val();
    var resident_id = $('#resident_id').val();

    if (resident_firstname && resident_lastname && resident_sex && resident_suffixes && resident_address && resident_educationalattainment && resident_birthdate && resident_occupation && resident_religion && resident_indigenous && resident_status && resident_householdrole && household_id) {
        $.ajax({
            url: "update.php",
            type: "post",
            data: {
                resident_firstname: resident_firstname,
                resident_middlename: resident_middlename,
                resident_lastname: resident_lastname,
                resident_maidenname: resident_maidenname,
                resident_sex: resident_sex,
                resident_suffixes: resident_suffixes,
                resident_address: resident_address,
                resident_educationalattainment: resident_educationalattainment,
                resident_birthdate: resident_birthdate,
                resident_contact: resident_contact,
                resident_occupation: resident_occupation,
                resident_religion: resident_religion,
                resident_indigenous: resident_indigenous,
                resident_status: resident_status,
                resident_householdrole: resident_householdrole,
                household_id: household_id,
                resident_id: resident_id
            },
            success: function(data) {
                var json = JSON.parse(data);
                var status = json.status;

                if (status === 'true') {
                    // Fetch updated resident data to get the recalculated age
                    $.ajax({
                        url: "get_age.php", // This file should retrieve the resident data by ID
                        type: "post",
                        data: { resident_id: resident_id },
                        success: function(data) {
                            var resident = JSON.parse(data);
                            // Validate resident_contact if it has a value
                            var resident_contact = $('#resident_contact').val() || $('#contactField').val(); // Check both fields for add and update

                            if (resident_contact) { // Only run validation if a contact number is provided
                                // Ensure the contact starts with either '0' or '+63'
                                if (!resident_contact.startsWith('0') && !resident_contact.startsWith('+63')) {
                                    showAlert("Resident contact should start with '0' or '+63'.", "alert-danger");
                                    return;
                                }

                                // Check if it starts with "+63" and remove the prefix for validation
                                if (resident_contact.startsWith('+63')) {
                                    resident_contact = resident_contact.replace('+63', '0'); // Replace "+63" with "0" for consistent length validation
                                }

                                // Remove all non-numeric characters (like spaces, dashes, etc.)
                                var resident_contact_digits = resident_contact.replace(/\D/g, ''); 

                                // Check if resident_contact has exactly 11 digits
                                if (resident_contact_digits.length !== 11) {
                                    showAlert("Resident contact should have exactly 11 digits after formatting.", "alert-danger");
                                    return;
                                }
                            }

                            // Update the DataTable row with the new data
                            var table = $('#example').DataTable();
                            var checkbox = '<input type="checkbox" class="row-checkbox" value="' + resident_id + '">';
                            var button = '<div class="dropdown"><button class="action-btn" onclick="toggleDropdown(this)">ACTIONS <i class="bx bx-chevron-down"></i></button><div class="dropdown-menu"><a href="javascript:void(0);" data-id="' + resident_id + '" class="dropdown-item update-btn editbtn"><i class="bx bx-edit"></i></a><a href="javascript:void(0);" data-id="' + resident_id + '" class="dropdown-item delete-btn deleteBtn"><i class="bx bx-trash"></i></a></div></div>';

                            // Update row with new data including calculated age from get_resident.php response
                            var row = table.row("[id='" + trid + "']");
                            row.data([
                                resident_id,
                                checkbox,
                                resident.resident_firstname,
                                resident.resident_middlename,
                                resident.resident_lastname,
                                resident.resident_maidenname,
                                resident.resident_address,
                                resident.resident_educationalattainment,
                                resident.resident_birthdate,
                                resident.resident_age, // Updated age from get_resident.php
                                resident.resident_contact, 
                                resident.resident_status,
                                button
                            ]);

                            $('#exampleModal').modal('hide');
                            showAlert("Resident information updated successfully.", "alert-success");
                        }
                    });
                } else if (status === 'duplicate') {
                    showAlert("Resident with the same name already exists. Update failed.", "alert-danger");
                } else {
                    showAlert("Failed to update resident information.", "alert-danger");
                }
            }
        });
    } else {
        showAlert("Fill all the required fields", "alert-danger");
    }
});


$(document).on('click', '.deleteBtn', function(event) {
    event.preventDefault();
    var resident_id = $(this).data('id'); // Get resident ID from data attribute
    var table = $('#example').DataTable();

    // Open the modal
    $('#deleteConfirmationModal').modal('show');

    // Handle the confirmation
    $('#confirmDeleteBtn').off('click').on('click', function() {
      $.ajax({
        url: "delete.php",
        type: "POST",
        data: { resident_id: resident_id },
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
        var resident_id = $(this).data('id');
        $('#exampleModal').modal('show');

        $.ajax({
            url: "get_single_data.php",
            data: {
                resident_id: resident_id
            },
            type: 'post',
            success: function(data) {
                var json = JSON.parse(data);
                $('#fnameField').val(json.resident_firstname);
                $('#lnameField').val(json.resident_lastname);
                $('#manameField').val(json.resident_maidenname);
                $('#minameField').val(json.resident_middlename);
                $('#sexField').val(json.resident_sex);
                $('#suffixesField').val(json.resident_suffixes);
                $('#addressField').val(json.resident_address);
                $('#educField').val(json.resident_educationalattainment);
                $('#birthField').val(json.resident_birthdate);
                $('#ageField').val(json.resident_age);
                $('#contactField').val(json.resident_contact);
                $('#occupationField').val(json.resident_occupation);
                $('#religionField').val(json.resident_religion);
                $('#indigenousField').val(json.resident_indigenous);
                $('#statusField').val(json.resident_status);
                $('#roleField').val(json.resident_householdrole);
                $('#idField').val(json.household_id);
                $('#resident_id').val(resident_id);
                $('#trid').val(trid);
            }
        })
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
