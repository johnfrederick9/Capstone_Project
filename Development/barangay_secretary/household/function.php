<script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable({
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
                        "aTargets": [0]
                    }],
                });
            });
            $(document).on('submit', '#updateUser', function(e) {
            e.preventDefault();

            // Get input values
            var household_name = $('#nameField').val();
            var household_head = $('#headField').val();
            var household_address = $('#addressField').val();
            var household_contact = $('#contactField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();

            if (household_name && household_head && household_address) {
                $.ajax({
                    url: "update.php",
                    type: "post",
                    data: {
                        household_name: household_name,
                        household_head: household_head,
                        household_address: household_address,
                        household_contact: household_contact,
                        id: id
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        // Validate household_contact if it has a value
                        var household_contact = $('#household_contact').val() || $('#contactField').val(); // Check both fields for add and update

                            if (household_contact) { // Only run validation if a contact number is provided
                            // Ensure the contact starts with either '0' or '+63'
                            if (!household_contact.startsWith('0') && !household_contact.startsWith('+63')) {
                                showAlert("Household contact should start with '0' or '+63'.", "alert-danger");
                                return;
                            }

                            // Check if it starts with "+63" and remove the prefix for validation
                            if (household_contact.startsWith('+63')) {
                                household_contact = household_contact.replace('+63', '0'); // Replace "+63" with "0" for consistent length validation
                            }

                            // Remove all non-numeric characters (like spaces, dashes, etc.)
                            var household_contact_digits = household_contact.replace(/\D/g, ''); 

                            // Check if household_contact has exactly 11 digits
                            if (household_contact_digits.length !== 11) {
                                showAlert("Household contact should have exactly 11 digits after formatting.", "alert-danger");
                                return;
                            }
                        }
                        if (status === 'duplicate') {
                            showAlert("Household with the same name already exists.", "alert-danger");
                        } else if (status === 'true') {
                            $('#example').DataTable().draw();
                            $('#exampleModal').modal('hide');
                            showAlert("Household update successfully.", "alert-success");
                        } else {
                            showAlert("Failed to Update Household.", "alert-danger");
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
            var id = $(this).data('id');
            $('#exampleModal').modal('show');

            $.ajax({
                url: "get_single_data.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#household_id').val(json.houselhold_id);
                    $('#nameField').val(json.household_name);
                    $('#headField').val(json.household_head);
                    $('#addressField').val(json.household_address);
                    $('#contactField').val(json.household_contact);
                    $('#id').val(id);
                    $('#trid').val(trid);
                }
            })
        });
        $(document).on('click', '.viewbtn', function () {
    const householdId = $(this).data('household-id'); // Retrieve household ID from the button
    const modal = $('#viewModal'); // Get the modal

    // Clear any previous data in the table
    $('#householdMembersTable').empty();

    // Fetch members from the server
    $.ajax({
        url: 'fetch_members.php', // Path to your PHP script
        type: 'GET',
        data: { household_id: householdId }, // Send household_id as a GET parameter
        success: function (response) {
            try {
                const members = response; // Response is already JSON
                if (members.length > 0) {
                    // Loop through each member and append them as table rows
                    members.forEach((member, index) => {
                        $('#householdMembersTable').append(
                            `<tr>
                                <td>${index + 1}</td>
                                <td>${member.full_name}</td>
                                <td>${member.resident_householdrole}</td>
                            </tr>`
                        );
                    });
                } else {
                    // If no members are found
                    $('#householdMembersTable').append(
                        '<tr><td colspan="3" class="text-center">No members found.</td></tr>'
                    );
                }
            } catch (error) {
                console.error("Error processing response:", error);
                $('#householdMembersTable').append(
                    '<tr><td colspan="3" class="text-center text-danger">An error occurred while processing data.</td></tr>'
                );
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX errors
            console.error("AJAX Error:", status, error);
            $('#householdMembersTable').append(
                '<tr><td colspan="3" class="text-center text-danger">Failed to fetch members. Please try again later.</td></tr>'
            );
        }
    });

    // Show the modal after initiating the request
    modal.modal('show');
});

    $(document).ready(function() {
    // Event listener for the print button
    $(document).on('click', '.print-btn', function() {
        var bempId = $(this).data('id'); // Get the bemp_id

        // Make an AJAX request to fetch the certificate content
        $.ajax({
            url: 'fetch_certificate.php', // URL to fetch the certificate HTML
            type: 'POST',
            data: { id: bempId },
            success: function(response) {
                // Create a new window to print the content
                var printWindow = window.open('', '', 'height=600,width=800');
                printWindow.document.write(response);
                printWindow.document.close();

                // Wait for all images in the new window to load
                var images = printWindow.document.images;
                var totalImages = images.length;
                var loadedImages = 0;

                if (totalImages === 0) {
                    // If there are no images, proceed to print
                    printWindow.focus();
                    printWindow.print();
                    printWindow.close();
                } else {
                    // Check each image for load completion
                    for (var i = 0; i < totalImages; i++) {
                        images[i].onload = images[i].onerror = function() {
                            loadedImages++;
                            if (loadedImages === totalImages) {
                                // All images have loaded, proceed to print
                                printWindow.focus();
                                printWindow.print();
                                printWindow.close();
                            }
                        };
                    }
                }
            }
        });
    });
});
    $(document).on('click', '.deleteBtn', function(event) {
    event.preventDefault();
    var id = $(this).data('id'); // Get indigency ID from data attribute
    var table = $('#example').DataTable();

    // Open the modal
    $('#deleteConfirmationModal').modal('show');

    // Handle the confirmation
    $('#confirmDeleteBtn').off('click').on('click', function() {
      $.ajax({
        url: "delete.php",
        type: "POST",
        data: { id: id },
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