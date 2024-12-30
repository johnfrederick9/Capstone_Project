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
                "aTargets": [0,1,2,3,5,6,7]
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
    var resident_birthdate = $('#resident_birthdate').val();
    var resident_height = $('#resident_height').val();
    var resident_weight = $('#resident_weight').val();
    var resident_heightstat = $('#resident_heightstat').val();
    var resident_weightstat = $('#resident_weightstat').val();
    var resident_BMIstat = $('#resident_BMIstat').val();
    var resident_medical = $('#resident_medical').val();
    var resident_lactating = $('#resident_lactating').val();
    var resident_pregnant = $('#resident_pregnant').val();
    var resident_PWD = $('#resident_PWD').val();
    var resident_SY = $('#resident_SY').val();

    if (resident_firstname && resident_lastname && resident_middlename && resident_birthdate && resident_height && resident_weight && resident_heightstat && resident_weightstat && resident_BMIstat && resident_medical && resident_lactating && resident_pregnant && resident_PWD && resident_SY) {
        $.ajax({
            url: "add.php",  
            type: "post",
            data: {
                resident_firstname: resident_firstname,
                resident_lastname: resident_lastname,
                resident_middlename: resident_middlename,
                resident_birthdate: resident_birthdate,
                resident_height: resident_height,
                resident_weight: resident_weight,
                resident_heightstat: resident_heightstat,
                resident_weightstat: resident_weightstat,
                resident_BMIstat: resident_BMIstat,
                resident_medical: resident_medical,
                resident_lactating: resident_lactating,
                resident_pregnant: resident_pregnant,
                resident_PWD: resident_PWD,
                resident_SY: resident_SY,
            },
            success: function(data) {
                var json = JSON.parse(data);
                var status = json.status;

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
    var resident_birthdate = $('#birthField').val();
    var resident_height = $('#heightField').val();
    var resident_weight = $('#weightField').val();
    var resident_heightstat = $('#heightstatField').val();
    var resident_weightstat = $('#weightstatField').val();
    var resident_BMIstat = $('#bmiField').val();
    var resident_medical = $('#medField').val();
    var resident_lactating = $('#lactatingField').val();
    var resident_pregnant = $('#pregnantField').val();
    var resident_PWD = $('#pwdField').val();
    var resident_SY = $('#syField').val();
    var trid = $('#trid').val();
    var resident_id = $('#resident_id').val();
    if(resident_height && resident_weight && resident_heightstat && resident_weightstat && resident_medical && resident_lactating && resident_pregnant && resident_PWD && resident_SY) {
        $.ajax({
            url: "update.php",
            type: "post",
            data: {
                resident_firstname: resident_firstname,
                resident_lastname: resident_lastname,
                resident_middlename: resident_middlename,
                resident_birthdate: resident_birthdate,
                resident_height: resident_height,
                resident_weight: resident_weight,
                resident_heightstat: resident_heightstat,
                resident_weightstat: resident_weightstat,
                resident_BMIstat: resident_BMIstat,
                resident_medical: resident_medical,
                resident_lactating: resident_lactating,
                resident_pregnant: resident_pregnant,
                resident_PWD: resident_PWD,
                resident_SY: resident_SY,
                resident_id: resident_id
            },
            success: function(data) {
                var json = JSON.parse(data);
                var status = json.status;
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
                $('#minameField').val(json.resident_middlename);
                $('#heightField').val(json.resident_height);
                $('#weightField').val(json.resident_weight);
                $('#heightstatField').val(json.resident_heightstat);
                $('#weightstatField').val(json.resident_weightstat);
                $('#birthField').val(json.resident_birthdate);
                $('#bmiField').val(json.resident_BMIstat);
                $('#medField').val(json.resident_medical);
                $('#lactatingField').val(json.resident_lactating);
                $('#pregnantField').val(json.resident_pregnant);
                $('#pwdField').val(json.resident_PWD);
                $('#syField').val(json.resident_SY);
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
                    $('#view_firstname').text(json.resident_firstname || "Not Updated");
                    $('#view_middlename').text(json.resident_middlename || "Not Updated");
                    $('#view_lastname').text(json.resident_lastname || "Not Updated");
                    $('#view_1').text(json.resident_height || "Not Updated");
                    $('#view_2').text(json.resident_weight || "Not Updated");
                    $('#view_birthdate').text(json.resident_birthdate || "Not Updated");
                    $('#view_age').text(json.resident_age || "Not Updated");
                    $('#view_3').text(json.resident_BMI || "Not Updated");
                    $('#view_4').text(json.resident_BMIstatus || "Not Updated");
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
