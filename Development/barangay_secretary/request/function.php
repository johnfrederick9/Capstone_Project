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
                "aTargets": [0,1,2,3,4,5,6,7]
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
 $(document).on('submit', '#addRequest', function(e) {
    e.preventDefault();
    var requester_name = $('#requester_name').val();
    var request_type = $('#request_type').val();
    var request_description = $('#request_description').val();
    var request_date = $('#request_date').val();
    var request_status = $('#request_status').val();

    if (requester_name !== '' && request_type !== '' && request_description !== '' && request_date !== '' && request_status !== '') {
        $.ajax({
            url: "add.php",
            type: "post",
            data: {
                requester_name: requester_name,
                request_type: request_type,
                request_description: request_description,
                request_date: request_date,
                request_status: request_status,
            },
            success: function(data) {
                var json = JSON.parse(data);
                var status = json.status;

                if (status === 'not_found') {
                    showAlert("Requester name not found in residents.", "alert-danger");
                } else if (status === 'duplicate') {
                    showAlert("Request with the same name already exists.", "alert-danger");
                } else if (status === 'true') {
                    $('#example').DataTable().draw();
                    $('#addUserModal').modal('hide');
                    showAlert("Request added successfully.", "alert-success");
                    $('#addRequest')[0].reset(); // Clear the form fields
                } else {
                    showAlert("Failed to add request.", "alert-danger");
                }
            }
        });
    } else {
        alert('Fill all the required fields');
    }
});

        $(document).on('submit', '#updateRequest', function(e) {
            e.preventDefault();
            var requester_name = $('#requester_nameField').val();
            var request_type = $('#request_typeField').val();
            var request_description = $('#request_descriptionField').val();
            var request_date = $('#request_dateField').val();
            var request_status = $('#request_statusField').val();
            var trid = $('#trid').val();
            var request_id = $('#request_id').val();
            if (requester_name !== '' && request_type !== '' && request_description !== '' && request_date !== '' && request_status !== '') {
                $.ajax({
                    url: "update.php",
                    type: "post",
                    data: {
                        requester_name: requester_name,
                        request_type: request_type,
                        request_description: request_description,
                        request_date: request_date,
                        request_status: request_status,
                        request_id: request_id
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if (status === 'duplicate') {
                            showAlert("Request with the same name already exists.", "alert-danger");
                        } else if (status === 'true') {
                            $('#example').DataTable().draw();
                            $('#exampleModal').modal('hide');
                            showAlert("Request update successfully.", "alert-success");
                        } else {
                            showAlert("Failed to Update request.", "alert-danger");
                        }
                        },
                        error: function() {
                        showAlert("Error updating record.", "alert-danger");
                    }
                });
            } else {
                alert('Fill all the required fields');
            }
        });
        $(document).on('click', '.deleteBtn', function(event) {
        event.preventDefault();
        var request_id = $(this).data('id'); // Get request ID from data attribute
        var table = $('#example').DataTable();

        // Open the modal
        $('#deleteConfirmationModal').modal('show');

        // Handle the confirmation
        $('#confirmDeleteBtn').off('click').on('click', function() {
        $.ajax({
            url: "delete.php",
            type: "POST",
            data: { request_id: request_id },
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
        var request_id = $(this).data('id');
        $('#exampleModal').modal('show');

        $.ajax({
            url: "get_single_data.php",
            data: {
                request_id: request_id
            },
            type: 'post',
            success: function(data) {
                var json = JSON.parse(data);
                $('#requester_nameField').val(json.requester_name);
                $('#request_typeField').val(json.request_type);
                $('#request_descriptionField').val(json.request_description);
                $('#request_dateField').val(json.request_date);
                $('#request_statusField').val(json.request_status);
                $('#request_id').val(request_id);
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
</script>