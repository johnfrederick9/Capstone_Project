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

    $(document).on('submit', '#addUser', function(e) {
    e.preventDefault();
        var employee_firstname = $('#employee_firstname').val();
        var employee_lastname = $('#employee_lastname').val();
        var employee_middlename = $('#employee_middlename').val();
        var employee_maidenname = $('#employee_maidenname').val();
        var employee_sex = $('#employee_sex').val();
        var employee_suffixes = $('#employee_suffixes').val();
        var employee_address = $('#employee_address').val();
        var employee_educationalattainment = $('#employee_educationalattainment').val();
        var employee_birthdate = $('#employee_birthdate').val();
        var employee_age = $('#employee_age').val();
        var employee_status = $('#employee_status').val();
        var employee_position = $('#employee_position').val();
        var employee_contact = $('#employee_contact').val();
        if (employee_firstname != '' && employee_lastname != '' && employee_sex != '' && employee_suffixes != '' && employee_address != '' && employee_educationalattainment != '' && employee_birthdate != '' && employee_status != '' && employee_position != '') {
            $.ajax({
                url: "add.php",
                type: "post",
                data: {
                    employee_firstname: employee_firstname,
                    employee_lastname: employee_lastname,
                    employee_middlename: employee_middlename,
                    employee_maidenname: employee_maidenname,
                    employee_sex: employee_sex,
                    employee_suffixes: employee_suffixes,
                    employee_address: employee_address,
                    employee_educationalattainment: employee_educationalattainment,
                    employee_birthdate: employee_birthdate,
                    employee_age: employee_age,
                    employee_status: employee_status,
                    employee_position: employee_position,
                    employee_contact: employee_contact,
                },
            success: function(data) {
                var json = JSON.parse(data);
                var status = json.status;
                // Validate employee_contact if it has a value
                var employee_contact = $('#employee_contact').val() || $('#contactField').val(); // Check both fields for add and update

                if (employee_contact) { // Only run validation if a contact number is provided
                // Ensure the contact starts with either '0' or '+63'
                if (!employee_contact.startsWith('0') && !employee_contact.startsWith('+63')) {
                    showAlert("Employee contact should start with '0' or '+63'.", "alert-danger");
                    return;
                }

                // Check if it starts with "+63" and remove the prefix for validation
                if (employee_contact.startsWith('+63')) {
                    employee_contact = employee_contact.replace('+63', '0'); // Replace "+63" with "0" for consistent length validation
                }

                // Remove all non-numeric characters (like spaces, dashes, etc.)
                var employee_contact_digits = employee_contact.replace(/\D/g, ''); 

                // Check if employee_contact has exactly 11 digits
                if (employee_contact_digits.length !== 11) {
                    showAlert("Employee contact should have exactly 11 digits after formatting.", "alert-danger");
                    return;
                }
            }

                if (status === 'duplicate') {
                    showAlert("Employee with the same name already exists.", "alert-danger");
                } else if (status === 'true') {
                    $('#example').DataTable().draw();
                    $('#addUserModal').modal('hide');
                    showAlert("Employee added successfully.", "alert-success");
                    $('#addUser')[0].reset();  // Clear the form fields
                } else {
                    showAlert("Failed to add employee.", "alert-danger");
                }
            }
        });
    } else {
        showAlert("Fill all the required fields", "alert-danger");
    }
});

$(document).on('submit', '#updateUser', function(e) {
    e.preventDefault();

    // Gather input values
    var employee_firstname = $('#fnameField').val();
    var employee_middlename = $('#minameField').val();
    var employee_lastname = $('#lnameField').val();
    var employee_maidenname = $('#manameField').val();
    var employee_sex = $('#sexField').val();
    var employee_suffixes = $('#suffixesField').val();
    var employee_address = $('#addressField').val();
    var employee_educationalattainment = $('#educField').val();
    var employee_birthdate = $('#birthField').val();
    var employee_status = $('#statusField').val();
    var employee_position = $('#positionField').val();
    var employee_contact = $('#contactField').val();
    var trid = $('#trid').val();
    var employee_id = $('#employee_id').val();

    if (employee_firstname && employee_lastname && employee_sex && employee_suffixes && employee_address && employee_educationalattainment && employee_birthdate && employee_status && employee_position) {
        $.ajax({
            url: "update.php",
            type: "post",
            data: {
                employee_firstname: employee_firstname,
                employee_middlename: employee_middlename,
                employee_lastname: employee_lastname,
                employee_maidenname: employee_maidenname,
                employee_sex: employee_sex,
                employee_suffixes: employee_suffixes,
                employee_address: employee_address,
                employee_educationalattainment: employee_educationalattainment,
                employee_birthdate: employee_birthdate,
                employee_status: employee_status,
                employee_contact: employee_contact,
                employee_position: employee_position,
                employee_id: employee_id
            },
            success: function(data) {
                var json = JSON.parse(data);
                var status = json.status;

                if (status === 'duplicate') {
                    showAlert("Employee with the same name already exists. Update failed.", "alert-danger");
                } else if (status === 'true') {
                    // Fetch updated employee data to get recalculated age
                    $.ajax({
                        url: "get_age.php",
                        type: "post",
                        data: { employee_id: employee_id },
                        success: function(data) {
                            var employee = JSON.parse(data);
                            var table = $('#example').DataTable();

                           // Validate employee_contact if it has a value
                           var employee_contact = $('#employee_contact').val() || $('#contactField').val(); // Check both fields for add and update

                            if (employee_contact) { // Only run validation if a contact number is provided
                                // Ensure the contact starts with either '0' or '+63'
                                if (!employee_contact.startsWith('0') && !employee_contact.startsWith('+63')) {
                                    showAlert("Employee contact should start with '0' or '+63'.", "alert-danger");
                                    return;
                                }

                                // Check if it starts with "+63" and remove the prefix for validation
                                if (employee_contact.startsWith('+63')) {
                                    employee_contact = employee_contact.replace('+63', '0'); // Replace "+63" with "0" for consistent length validation
                                }

                                // Remove all non-numeric characters (like spaces, dashes, etc.)
                                var employee_contact_digits = employee_contact.replace(/\D/g, ''); 

                                // Check if employee_contact has exactly 11 digits
                                if (employee_contact_digits.length !== 11) {
                                    showAlert("Employee contact should have exactly 11 digits after formatting.", "alert-danger");
                                    return;
                                }
                            }

                            // Update row with new data, including age
                            var row = table.row("[id='" + trid + "']");
                            row.data([
                                employee_id,
                                `<input type="checkbox" class="row-checkbox" value="${employee_id}">`,
                                employee.employee_firstname,
                                employee.employee_middlename,
                                employee.employee_lastname,
                                employee.employee_address,
                                employee.employee_educationalattainment,
                                employee.employee_position,
                                employee.employee_birthdate,
                                employee.employee_age,
                                employee.employee_contact,
                                employee.employee_status,
                                `<div class="dropdown"><button class="action-btn" onclick="toggleDropdown(this)">ACTIONS <i class="bx bx-chevron-down"></i></button><div class="dropdown-menu"><a href="javascript:void(0);" data-id="${employee_id}" class="dropdown-item update-btn editbtn"><i class="bx bx-edit"></i></a><a href="javascript:void(0);" data-id="${employee_id}" class="dropdown-item delete-btn deleteBtn"><i class="bx bx-trash"></i></a></div></div>`
                            ]);

                            $('#exampleModal').modal('hide');
                            showAlert("Employee information updated successfully.", "alert-success");
                        }
                    });
                } else {
                    showAlert("Failed to update employee information.", "alert-danger");
                }
            }
        });
    } else {
        showAlert("Please fill all the required fields.", "alert-danger");
    }
});


$(document).on('click', '.deleteBtn', function(event) {
    event.preventDefault();
    var employee_id = $(this).data('id'); // Get employee ID from data attribute
    var table = $('#example').DataTable();

    // Open the modal
    $('#deleteConfirmationModal').modal('show');

    // Handle the confirmation
    $('#confirmDeleteBtn').off('click').on('click', function() {
      $.ajax({
        url: "delete.php",
        type: "POST",
        data: { employee_id: employee_id },
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
        var employee_id = $(this).data('id');
        $('#exampleModal').modal('show');

        $.ajax({
            url: "get_single_data.php",
            data: {
                employee_id: employee_id
            },
            type: 'post',
            success: function(data) {
                var json = JSON.parse(data);
                $('#fnameField').val(json.employee_firstname);
                $('#lnameField').val(json.employee_lastname);
                $('#manameField').val(json.employee_maidenname);
                $('#minameField').val(json.employee_middlename);
                $('#sexField').val(json.employee_sex);
                $('#suffixesField').val(json.employee_suffixes);
                $('#addressField').val(json.employee_address);
                $('#educField').val(json.employee_educationalattainment);
                $('#birthField').val(json.employee_birthdate);
                $('#ageField').val(json.employee_age);
                $('#contactField').val(json.employee_contact);
                $('#occupationField').val(json.employee_occupation);
                $('#religionField').val(json.employee_religion);
                $('#indigenousField').val(json.employee_indigenous);
                $('#statusField').val(json.employee_status);
                $('#roleField').val(json.employee_householdrole);
                $('#idField').val(json.household_id);
                $('#employee_id').val(employee_id);
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
<script>
    // Add event listener for the Enter key when the modal is open
document.addEventListener('keydown', function(event) {
    const modalOpen = document.getElementById('deleteConfirmationModal').classList.contains('show');
    if (modalOpen && event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('confirmDeleteBtn').click();
    }
});