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
                        "aTargets": [0,1,2,3,4]
                    }],
                });
            });
            $(document).on('submit', '#addUser', function(e) {
                e.preventDefault();
                var bemp_name = $('#bemp_name').val();
                var bemp_employed = $('#bemp_employed').val();
                var bemp_address = $('#bemp_address').val();
                var bemp_locate = $('#bemp_locate').val();
                var bemp_date = $('#bemp_date').val();
                var bemp_paid = $('#bemp_paid').val();
                var bemp_dst = $('#bemp_dst').val();
                if (bemp_name != '' && bemp_employed != '' && bemp_address != '' && bemp_locate != '' && bemp_date != '' && bemp_paid != '' && bemp_dst != '') {
                    $.ajax({
                        url: "add.php",
                        type: "post",
                        data: {
                            bemp_name: bemp_name,
                            bemp_employed: bemp_employed,
                            bemp_address: bemp_address,
                            bemp_locate: bemp_locate,
                            bemp_date: bemp_date,
                            bemp_paid: bemp_paid,
                            bemp_dst: bemp_dst,
                        },
                        success: function(data) {
                            var json = JSON.parse(data);
                            var status = json.status;
                            if (status === 'duplicate') {
                                showAlert("Bussiness Employee Certificate with the same name already exists.", "alert-danger");
                                } else if (status == 'true') {
                                    $('#example').DataTable().draw();
                                    $('#addUserModal').modal('hide');
                                    showAlert("Bussiness Employee Certificate added successfully.", "alert-success");
                                    $('#addUser')[0].reset();  // Clear the form fields
                            } else {
                                showAlert("Failed to add Bussiness Employee Certificate.", "alert-danger");
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
                var bemp_name = $('#nameField').val();
                var bemp_employed = $('#employedField').val();
                var bemp_address = $('#addressField').val();
                var bemp_locate = $('#locateField').val();
                var bemp_date = $('#dateField').val();
                var bemp_paid = $('#paidField').val();
                var bemp_dst = $('#dstField').val();
                var trid = $('#trid').val();
                var bemp_id = $('#bemp_id').val();
                if (bemp_name != '' && bemp_employed != '' && bemp_address != '' && bemp_locate != '' && bemp_date != '' && bemp_paid != '' && bemp_dst != '') {
                    $.ajax({
                        url: "update.php",
                        type: "post",
                        data: {
                            bemp_name: bemp_name,
                            bemp_employed: bemp_employed,
                            bemp_address: bemp_address,
                            bemp_locate: bemp_locate,
                            bemp_date: bemp_date,
                            bemp_paid: bemp_paid,
                            bemp_dst: bemp_dst,
                            bemp_id: bemp_id
                        },
                        success: function(data) {
                            var json = JSON.parse(data);
                            var status = json.status;
                           
                        if (status === 'duplicate') {
                            showAlert("Bussiness Employee Certificate with the same name already exists.", "alert-danger");
                        } else if (status === 'true') {
                            $('#example').DataTable().draw();
                            $('#exampleModal').modal('hide');
                            showAlert("Bussiness Employee Certificate update successfully.", "alert-success");
                        } else {
                            showAlert("Failed to Update Bussiness Employee Certificate.", "alert-danger");
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
            var bemp_id = $(this).data('id');
            $('#exampleModal').modal('show');

            $.ajax({
                url: "get_single_data.php",
                data: {
                    bemp_id: bemp_id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#nameField').val(json.bemp_name);
                    $('#employedField').val(json.bemp_employed);
                    $('#addressField').val(json.bemp_address);
                    $('#locateField').val(json.bemp_locate);
                    $('#dateField').val(json.bemp_date);
                    $('#paidField').val(json.bemp_paid);
                    $('#dstField').val(json.bemp_dst);
                    $('#bemp_id').val(bemp_id);
                    $('#trid').val(trid);
                }
            })
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
    var bemp_id = $(this).data('id'); // Get bemp ID from data attribute
    var table = $('#example').DataTable();

    // Open the modal
    $('#deleteConfirmationModal').modal('show');

    // Handle the confirmation
    $('#confirmDeleteBtn').off('click').on('click', function() {
      $.ajax({
        url: "delete.php",
        type: "POST",
        data: { bemp_id: bemp_id },
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