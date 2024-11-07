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
                var indigency_cname = $('#indigency_cname').val();
                var indigency_mname = $('#indigency_mname').val();
                var indigency_fname = $('#indigency_fname').val();
                var indigency_date = $('#indigency_date').val();
                if (indigency_cname != '' && indigency_mname != '' && indigency_fname != '' && indigency_date != '') {
                    $.ajax({
                        url: "add.php",
                        type: "post",
                        data: {
                            indigency_cname: indigency_cname,
                            indigency_mname: indigency_mname,
                            indigency_fname: indigency_fname,
                            indigency_date: indigency_date,
                        },
                        success: function(data) {
                            var json = JSON.parse(data);
                            var status = json.status;
                            if (status === 'duplicate') {
                                showAlert("Indigency Certificate with the same name already exists.", "alert-danger");
                                } else if (status == 'true') {
                                    $('#example').DataTable().draw();
                                    $('#addUserModal').modal('hide');
                                    showAlert("Indigency Certificate added successfully.", "alert-success");
                                    $('#addUser')[0].reset();  // Clear the form fields
                            } else {
                                showAlert("Failed to add Indigency Certificate.", "alert-danger");
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
                var indigency_cname = $('#cnameField').val();
                var indigency_mname = $('#mnameField').val();
                var indigency_fname = $('#fnameField').val();
                var indigency_date = $('#dateField').val();
                var trid = $('#trid').val();
                var indigency_id = $('#indigency_id').val();
                if (indigency_cname != '' && indigency_mname != '' && indigency_fname != '' && indigency_date != '') {
                    $.ajax({
                        url: "update.php",
                        type: "post",
                        data: {
                            indigency_cname: indigency_cname,
                            indigency_mname: indigency_mname,
                            indigency_fname: indigency_fname,
                            indigency_date: indigency_date,
                            indigency_id: indigency_id
                        },
                        success: function(data) {
                            var json = JSON.parse(data);
                            var status = json.status;
                           
                        if (status === 'duplicate') {
                            showAlert("Indigency Certificate with the same name already exists.", "alert-danger");
                        } else if (status === 'true') {
                            $('#example').DataTable().draw();
                            $('#exampleModal').modal('hide');
                            showAlert("Indigency Certificate update successfully.", "alert-success");
                        } else {
                            showAlert("Failed to Update Indigency Certificate.", "alert-danger");
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
            var indigency_id = $(this).data('id');
            $('#exampleModal').modal('show');

            $.ajax({
                url: "get_single_data.php",
                data: {
                    indigency_id: indigency_id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#cnameField').val(json.indigency_cname);
                    $('#mnameField').val(json.indigency_mname);
                    $('#fnameField').val(json.indigency_fname);
                    $('#dateField').val(json.indigency_date);
                    $('#indigency_id').val(indigency_id);
                    $('#trid').val(trid);
                }
            })
        });
        $(document).ready(function() {
        // Event listener for the print button
        $(document).on('click', '.print-btn', function() {
            var indigencyId = $(this).data('id'); // Get the indigency_id

            // Make an AJAX request to fetch the certificate content
            $.ajax({
                url: 'fetch_indigency.php', // URL to fetch the certificate HTML
                type: 'POST',
                data: {id: indigencyId},
                success: function(response) {
                    // Create a new window to print the content
                    var printWindow = window.open('', '', 'height=600,width=800');
                    printWindow.document.write(response);
                    printWindow.document.close();
                    printWindow.focus();
                    printWindow.print();
                    printWindow.close();
                }
            });
        });
    });
    $(document).on('click', '.deleteBtn', function(event) {
    event.preventDefault();
    var indigency_id = $(this).data('id'); // Get indigency ID from data attribute
    var table = $('#example').DataTable();

    // Open the modal
    $('#deleteConfirmationModal').modal('show');

    // Handle the confirmation
    $('#confirmDeleteBtn').off('click').on('click', function() {
      $.ajax({
        url: "delete.php",
        type: "POST",
        data: { indigency_id: indigency_id },
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