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
        var project_name = $('#project_name').val();
        var project_start = $('#project_start').val();
        var project_end = $('#project_end').val();
        var project_budget = $('#project_budget').val();
        var project_source = $('#project_source').val();
        var project_location = $('#project_location').val();
        var project_managers = $('#project_managers').val();
        var project_stakeholders = $('#project_stakeholders').val();
        var project_status = $('#project_status').val();
        var project_description = $('#project_description').val();
        if (project_name != '' && project_start != '' && project_end != '' && project_budget != '' && project_source != '' && project_location != '' && project_managers != '' && project_stakeholders != '' && project_status != '' && project_description != '') {
            $.ajax({
                url: "add.php",
                type: "post",
                data: {
                    project_name: project_name,
                    project_start: project_start,
                    project_end: project_end,
                    project_budget: project_budget,
                    project_source: project_source,
                    project_location: project_location,
                    project_managers: project_managers,
                    project_stakeholders: project_stakeholders,
                    project_status: project_status,
                    project_description: project_description,
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    var status = json.status;
                    if (status === 'duplicate') {
                    showAlert("Project with the same name already exists.", "alert-danger");
                    } else if (status == 'true') {
                        $('#example').DataTable().draw();
                        $('#addUserModal').modal('hide');
                        showAlert("Project added successfully.", "alert-success");
                        $('#addUser')[0].reset();  // Clear the form fields
                } else {
                    showAlert("Failed to add project.", "alert-danger");
                }
            }
        });
    } else {
        showAlert("Fill all the required fields", "alert-danger");
    }
    });

    $(document).on('submit', '#updateUser', function(e) {
        e.preventDefault();
        //var tr = $(this).closest('tr');
        var project_name = $('#nameField').val();
        var project_start = $('#startField').val();
        var project_end = $('#endField').val();
        var project_budget = $('#budgetField').val();
        var project_source = $('#sourceField').val();
        var project_location = $('#locationField').val();
        var project_managers = $('#managersField').val();
        var project_stakeholders = $('#stakeholdersField').val();
        var project_status = $('#statusField').val();
        var project_description = $('#descriptionField').val();
        var trid = $('#trid').val();
        var project_id = $('#project_id').val();
        if (project_name != '' && project_start != '' && project_end != '' && project_budget != '' && project_source != '' && project_location != '' && project_managers != '' && project_stakeholders != '' && project_status != '' && project_description != '') {
            $.ajax({
                url: "update.php",
                type: "post",
                data: {
                    project_name: project_name,
                    project_start: project_start,
                    project_end: project_end,
                    project_budget: project_budget,
                    project_source: project_source,
                    project_location: project_location,
                    project_managers: project_managers,
                    project_stakeholders: project_stakeholders,
                    project_status: project_status,
                    project_description: project_description,
                    project_id: project_id
                },
                success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;

                        if (status === 'duplicate') {
                            showAlert("Project with the same name already exists.", "alert-danger");
                        } else if (status === 'true') {
                            $('#example').DataTable().draw();
                            $('#exampleModal').modal('hide');
                            showAlert("Project update successfully.", "alert-success");
                        } else {
                            showAlert("Failed to Update project.", "alert-danger");
                        }
                    },
                    error: function() {
                        showAlert("Error updating record.", "alert-danger");
                    }
                });
    } else {
        showAlert("All fields are required.", "alert-danger");
    }
});
$(document).on('click', '.deleteBtn', function(event) {
    event.preventDefault();
    var project_id = $(this).data('id'); // Get project ID from data attribute
    var table = $('#example').DataTable();

    // Open the modal
    $('#deleteConfirmationModal').modal('show');

    // Handle the confirmation
    $('#confirmDeleteBtn').off('click').on('click', function() {
      $.ajax({
        url: "delete.php",
        type: "POST",
        data: { project_id: project_id },
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
    var project_id = $(this).data('id');
    $('#exampleModal').modal('show');

    $.ajax({
        url: "get_single_data.php",
        data: {
            project_id: project_id
        },
        type: 'post',
        success: function(data) {
            var json = JSON.parse(data);
            $('#nameField').val(json.project_name);
            $('#startField').val(json.project_start);
            $('#endField').val(json.project_end);
            $('#budgetField').val(json.project_budget);
            $('#sourceField').val(json.project_source);
            $('#locationField').val(json.project_location);
            $('#managersField').val(json.project_managers);
            $('#stakeholdersField').val(json.project_stakeholders);
            $('#statusField').val(json.project_status);
            $('#descriptionField').val(json.project_description);
            $('#project_id').val(project_id);
            $('#trid').val(trid);
        }
    })
});
$(document).ready(function() {
    $('#example').on('click', '.viewbtn', function(event) {
        var table = $('#example').DataTable();
        var project_id = $(this).data('id');
        
        // Debugging: Check if project_id is found
        console.log("project ID:", project_id);
        
        if (!project_id) {
            console.error("project ID is not defined.");
            alert("project ID is missing. Please try again.");
            return;
        }

        $('#viewModal').modal('show');
        $.ajax({
            url: "fetch_details.php",
            data: {
                project_id: project_id
            },
            type: 'post',
            success: function(data) {
                console.log("AJAX data response:", data);
                try {
                    var json = JSON.parse(data);
                    $('#view_name').text(json.project_name || "N/A");
                    $('#view_start').text(json.project_start || "N/A");
                    $('#view_end').text(json.project_end || "N/A");
                    $('#view_budget').text(json.project_budget || "N/A");
                    $('#view_source').text(json.project_source || "N/A");
                    $('#view_location').text(json.project_location || "N/A");
                    $('#view_managers').text(json.project_managers || "N/A");
                    $('#view_stakeholders').text(json.project_stakeholders || "N/A");
                    $('#view_status').text(json.project_status || "N/A");
                    $('#view_description').text(json.project_description || "N/A");
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