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
                "targets": [0,4],  // Target the first column (aData[0])
                "visible": false, // Hide the column
                "searchable": false // Disable search for this column if needed
                },
                {
                "bSortable": false,
                "aTargets": [0,1,2,3,5,6,7,8,9,10]
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
            var alertDiv = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' + message +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
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
    var resident_pension = $('#resident_pension').val();
    var resident_beneficiaries = $('#resident_beneficiaries').val();

    if (resident_firstname && resident_lastname && resident_sex && resident_suffixes && resident_address && resident_educationalattainment && resident_birthdate && resident_occupation && resident_religion && resident_indigenous && resident_status && resident_householdrole && household_id && resident_pension && resident_beneficiaries) {
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
                resident_pension: resident_pension,
                resident_beneficiaries: resident_beneficiaries,
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
    var resident_pension = $('#pensionerField').val();
    var resident_beneficiaries = $('#beneficiariesField').val();
    var trid = $('#trid').val();
    var resident_id = $('#resident_id').val();

    if (resident_firstname && resident_lastname && resident_sex && resident_suffixes && resident_address && resident_educationalattainment && resident_birthdate && resident_occupation && resident_religion && resident_indigenous && resident_status && resident_householdrole && household_id && resident_pension && resident_beneficiaries) {
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
                resident_pension: resident_pension,
                resident_beneficiaries: resident_beneficiaries,
                resident_id: resident_id
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
                    $('#exampleModal').modal('hide');
                    showAlert("Resident update successfully.", "alert-success");
                } else {
                    showAlert("Failed to Update resident.", "alert-danger");
                }
            },
            error: function() {
                showAlert("An error occurred while processing the request.", "alert-danger");
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
            showAlert("Resident information remove successfully.", "alert-success");
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
                $('#pensionerField').val(json.resident_pension);
                $('#beneficiariesField').val(json.resident_beneficiaries);
                $('#resident_id').val(resident_id);
                $('#trid').val(trid);
            }
        })
    });
    $(document).ready(function() {
    $('#example').on('click', '.viewbtn', function(event) {
        var table = $('#example').DataTable();
        var resident_id = $(this).data('id');
        
        // Debugging: Check if resident_id is found
        console.log("Resident ID:", resident_id);
        
        if (!resident_id) {
            console.error("Resident ID is not defined.");
            alert("Resident ID is missing. Please try again.");
            return;
        }

        $('#viewModal').modal('show');
        $.ajax({
            url: "fetch_details.php",
            data: {
                resident_id: resident_id
            },
            type: 'post',
            success: function(data) {
                console.log("AJAX data response:", data);
                try {
                    var json = JSON.parse(data);
                    $('#view_firstname').text(json.resident_firstname || "N/A");
                    $('#view_middlename').text(json.resident_middlename || "N/A");
                    $('#view_lastname').text(json.resident_lastname || "N/A");
                    $('#view_suffixes').text(json.resident_suffixes || "N/A");
                    $('#view_sex').text(json.resident_sex || "N/A");
                    $('#view_birthdate').text(json.resident_birthdate || "N/A");
                    $('#view_age').text(json.resident_age || "N/A");
                    $('#view_contact').text(json.resident_contact || "N/A");
                    $('#view_status').text(json.resident_status || "N/A");
                    $('#view_householdrole').text(json.resident_householdrole || "N/A");
                    $('#view_household_id').text(json.household_id || "N/A");
                    $('#view_address').text(json.resident_address || "N/A");
                    $('#view_educationalattainment').text(json.resident_educationalattainment || "N/A");
                    $('#view_maidenname').text(json.resident_maidenname || "N/A");
                    $('#view_occupation').text(json.resident_occupation || "N/A");
                    $('#view_religion').text(json.resident_religion || "N/A");
                    $('#view_indigenous').text(json.resident_indigenous || "N/A");
                    $('#view_pension').text(json.resident_pension || "N/A");
                    $('#view_beneficiaries').text(json.resident_beneficiaries || "N/A");
                    $('#view_1').text(json.resident_height || "Not Updated");
                    $('#view_2').text(json.resident_weight || "Not Updated");
                    $('#view_3').text(json.resident_BMIstat || "Not Updated");
                    $('#view_4').text(json.resident_heightstat || "Not Updated");
                    $('#view_5').text(json.resident_weightstat || "Not Updated");
                    $('#view_6').text(json.resident_medical || "Not Updated");
                    $('#view_7').text(json.resident_lactating || "Not Updated");
                    $('#view_8').text(json.resident_pregnant || "Not Updated");
                    $('#view_9').text(json.resident_PWD || "Not Updated");
                    $('#view_10').text(json.resident_SY || "Not Updated");
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
