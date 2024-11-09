<script type="text/javascript">
            $(document).ready(function() {
                // DataTable initialization
                var table = $('#example').DataTable({
                    "fnCreatedRow": function(nRow, aData, iDataIndex) {
                        $(nRow).attr('data-event-id', aData[0]); // Set row data attribute to event ID
                    },
                    'serverSide': true,
                    'processing': true,
                    'paging': true,
                    'order': [],
                    'ajax': {
                        'url': 'fetch_data.php',
                        'type': 'POST',
                    },
                    "columnDefs": [{
                    "targets": [0,2,3],  // Target the first column (aData[0])
                    "visible": false, // Hide the column
                    "searchable": false // Disable search for this column if needed
                    },{
                        "orderable": false,
                        "targets": [4] // Adjust index as needed for columns that shouldn’t be sortable
                    }]
                });
            });
            $(document).on('submit', '#addUser', function(e) {
            e.preventDefault();
            var event_name = $('#event_name').val();
            var event_location = $('#event_location').val();
            var event_type = $('#event_type').val();
            var event_start = $('#event_start').val();
            var event_end = $('#event_end').val();
            if (event_name !== '' && event_location !== '' && event_type !== '' && event_start !== '' && event_end !== '') {
                $.ajax({
                    url: "add.php",
                    type: "post",
                    data: {
                        event_name: event_name,
                        event_location: event_location,
                        event_type: event_type,
                        event_start: event_start,
                        event_end: event_end,
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                            if (status === 'duplicate') {
                            showAlert("Event with the same name already exists.", "alert-danger");
                            } else if (status == 'true') {
                                $('#example').DataTable().draw();
                                $('#eventModal').modal('hide');
                                showAlert("Event added successfully.", "alert-success");
                                $('#addUser')[0].reset();  // Clear the form fields
                        } else {
                            showAlert("Failed to add event.", "alert-danger");
                        }
                    }
                });
            } else {
                showAlert('Fill all the required fields', "alert-danger");
            }
        });
            $(document).on('submit', '#updateUser', function(e) {
            e.preventDefault();
            var event_name = $('#Fieldname').val();
            var event_location = $('#Fieldlocation').val();
            var event_type = $('#Fieldtype').val();
            var event_start = $('#Fieldstart').val();
            var event_end = $('#Fieldend').val();
            var trid = $('#trid').val();
            var event_id = $('#event_id').val();

            if (event_name != '' && event_location != '' && event_type != '' && event_start != '' && event_end != '') {
                $.ajax({
                    url: "update.php",
                    type: "post",
                    data: {
                        event_name: event_name,
                        event_location: event_location,
                        event_type: event_type,
                        event_start: event_start,
                        event_end: event_end,
                        event_id: event_id
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if (status === 'duplicate') {
                            showAlert("Event with the same name already exists.", "alert-danger");
                            } else if (status === 'true') {
                            $('#example').DataTable().draw();
                            $('#exampleModal').modal('hide');
                            showAlert("Event update successfully.", "alert-success");
                        } else {
                            showAlert("Failed to Update event.", "alert-danger");
                        }
                    },
                    error: function() {
                        showAlert("Error updating record.", "alert-danger");
                    }
                });
            } else {
                showAlert("Fill all the required fields.", "alert-danger");
            }
        });
        $(document).on('click', '.deleteBtn', function(event) {
        event.preventDefault();
        var event_id = $(this).data('id'); // Get event ID from data attribute
        var table = $('#example').DataTable();

        // Open the modal
        $('#deleteConfirmationModal').modal('show');

        // Handle the confirmation
        $('#confirmDeleteBtn').off('click').on('click', function() {
        $.ajax({
            url: "delete.php",
            type: "POST",
            data: { event_id: event_id },
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
            $('#example').on('click', '.editbtn ', function(event) {
            var table = $('#example').DataTable();
            var trid = $(this).closest('tr').attr('id');
            // console.log(selectedRow);
            var event_id = $(this).data('id');
            $('#exampleModal').modal('show');

            $.ajax({
                url: "get_single_data.php",
                type: 'post',
                data: { event_id: event_id },
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#Fieldname').val(json.event_name);
                    $('#Fieldlocation').val(json.event_location);
                    $('#Fieldtype').val(json.event_type);
                    $('#Fieldstart').val(json.event_start);
                    $('#Fieldend').val(json.event_end);
                    $('#event_id').val(event_id);
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