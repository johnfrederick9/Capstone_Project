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
                var permit_name = $('#permit_name').val();
                var permit_business = $('#permit_business').val();
                var permit_locate = $('#permit_locate').val();
                var permit_date = $('#permit_date').val();
                var permit_paid = $('#permit_paid').val();
                var permit_dst = $('#permit_dst').val();
                if (permit_name != '' && permit_business != '' && permit_locate != '' && permit_date != '' && permit_paid != '' && permit_dst != '') {
                    $.ajax({
                        url: "add.php",
                        type: "post",
                        data: {
                            permit_name: permit_name,
                            permit_business: permit_business,
                            permit_locate: permit_locate,
                            permit_date: permit_date,
                            permit_paid: permit_paid,
                            permit_dst: permit_dst,
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
                var permit_name = $('#nameField').val();
                var permit_business = $('#businessField').val();
                var permit_locate = $('#locateField').val();
                var permit_date = $('#dateField').val();
                var permit_paid = $('#paidField').val();
                var permit_dst = $('#dstField').val();
                var trid = $('#trid').val();
                var permit_id = $('#permit_id').val();
                if (permit_name != '' && permit_business != '' && permit_locate != '' && permit_date != '' && permit_paid != '' && permit_dst != '') {
                    $.ajax({
                        url: "update.php",
                        type: "post",
                        data: {
                            permit_name: permit_name,
                            permit_business: permit_business,
                            permit_locate: permit_locate,
                            permit_date: permit_date,
                            permit_paid: permit_paid,
                            permit_dst: permit_dst,
                            permit_id: permit_id
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
            var permit_id = $(this).data('id');
            $('#exampleModal').modal('show');

            $.ajax({
                url: "get_single_data.php",
                data: {
                    permit_id: permit_id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#nameField').val(json.permit_name);
                    $('#businessField').val(json.permit_business);
                    $('#locateField').val(json.permit_locate);
                    $('#dateField').val(json.permit_date);
                    $('#paidField').val(json.permit_paid);
                    $('#dstField').val(json.permit_dst);
                    $('#permit_id').val(permit_id);
                    $('#trid').val(trid);
                }
            })
        });
        $(document).ready(function() {
    // Event listener for the print button
    $(document).on('click', '.print-btn', function() {
        var permitId = $(this).data('id'); // Get the permit_id

        // Make an AJAX request to fetch the certificate content
        $.ajax({
            url: 'fetch_certificate.php', // URL to fetch the certificate HTML
            type: 'POST',
            data: { id: permitId },
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
    var permit_id = $(this).data('id'); // Get permit ID from data attribute
    var table = $('#example').DataTable();

    // Open the modal
    $('#deleteConfirmationModal').modal('show');

    // Handle the confirmation
    $('#confirmDeleteBtn').off('click').on('click', function() {
      $.ajax({
        url: "delete.php",
        type: "POST",
        data: { permit_id: permit_id },
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