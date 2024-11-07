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
                "targets": [0],
                "visible": false,
                "searchable": false
                },
                {
                "bSortable": false,
                "aTargets": [0,1,2,3,4,5]
            }],
            "drawCallback": function() {
                updateCheckboxStates()
            }
        });
        
        $('#example').on('click', '.viewbtn', function(event) {
            var document_id = $(this).data('id');
            $('#viewModal').modal('show');

            $.ajax({
                url: "fetch_images.php",
                type: "post",
                data: { document_id: document_id },
                success: function(data) {
                    var images = JSON.parse(data);
                    var imageContainer = $('#imageContainer');
                    imageContainer.empty();

                    if (images.length > 0) {
                        images.forEach(function(image) {
                            imageContainer.append('<div class="image-wrapper"><img src="' + image.filepath + '" class="img-fluid img-thumbnail m-2" alt="Document Image"></div>');
                        });
                    } else {
                        imageContainer.append('<p>No images available for this document.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    showAlert('Error fetching images: ' + error, "alert-danger");
                }
            });
        });

        function updateCheckboxStates() {
            $('.row-checkbox').each(function() {
                var id = $(this).val();
                if (selectedIds.includes(id)) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });
        }

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

        $('#selectAll').click(function() {
            var checkedStatus = this.checked;
            $('.row-checkbox').each(function() {
                $(this).prop('checked', checkedStatus);
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

        $('.print-btn').click(function() {
            if (selectedIds.length > 0) {
                var idsString = selectedIds.join(',');
                printContentFromPage('print_selected.php', idsString);
            } else {
                showAlert("Please select at least one row to print.", "alert-danger");
            }
        });

        $('.print-all-btn').click(function() {
            printContentFromPage('print_all.php');
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

        $(document).on('submit', '#addUser', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    var document_name = $('#document_name').val();
    var document_date = $('#document_date').val();
    var document_info = $('#document_info').val();
    var document_type = $('#document_type').val();

    if (document_name && document_date && document_info && document_type) {
        $.ajax({
            url: "add.php",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                var json = JSON.parse(data);
                var status = json.status; // Get status from JSON response
                
                if (status === 'duplicate') {
                    showAlert("Document with the same name already exists.", "alert-danger");
                } else if (status === 'true') {
                    $('#example').DataTable().draw();
                    $('#addUserModal').modal('hide');
                    showAlert("Document added successfully.", "alert-success");
                    $('#addUser')[0].reset(); // Clear the form fields
                } else {
                    showAlert('Failed: ' + (json.error || 'Unknown error'), "alert-danger");
                }
            },
            error: function(xhr, status, error) {
                showAlert('AJAX error: ' + error, "alert-danger");
            }
        });
    } else {
        showAlert("Fill all the required fields", "alert-danger");
    }
});
        $(document).on('submit', '#updateUser', function(e) {
            e.preventDefault();
            var document_name = $('#nameField').val();
            var document_date = $('#dateField').val();
            var document_info = $('#infoField').val();
            var document_type = $('#typeField').val();
            var trid = $('#trid').val();
            var document_id = $('#document_id').val();

            if (document_name != '' && document_date != '' && document_info != '' && document_type != '') {
                $.ajax({
                    url: "update.php",
                    type: "post",
                    data: {
                        document_name: document_name,
                        document_date: document_date,
                        document_info: document_info,
                        document_type: document_type,
                        document_id: document_id
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;

                        if (status === 'duplicate') {
                            showAlert("Document with the same name already exists.", "alert-danger");
                        } else if (status === 'true') {
                            $('#example').DataTable().draw();
                            $('#exampleModal').modal('hide');
                            showAlert("Document update successfully.", "alert-success");
                        } else {
                            showAlert("Failed to Update document.", "alert-danger");
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
            var document_id = $(this).data('id');
            var table = $('#example').DataTable();

            $('#deleteConfirmationModal').modal('show');
            $('#confirmDeleteBtn').off('click').on('click', function() {
                $.ajax({
                    url: "delete.php",
                    type: "POST",
                    data: { document_id: document_id },
                    success: function(response) {
                        var json = JSON.parse(response);
                        if (json.status === 'success') {
                            table.row($(event.target).closest('tr')).remove().draw();
                            showAlert('Document remove successfully!', "alert-success"); // Success alert
                        } else {
                            showAlert('Deletion failed.', "alert-danger");
                        }
                        $('#deleteConfirmationModal').modal('hide');
                    },
                    error: function() {
                        showAlert("Error deleting record.", "alert-danger");
                    }
                });
            });
        });

        $('#example').on('click', '.editbtn', function(event) {
    var table = $('#example').DataTable();
    var trid = $(this).closest('tr').attr('id');
    var document_id = $(this).data('id');
    $('#exampleModal').modal('show');

    $.ajax({
        url: "get_single_data.php",
        data: { document_id: document_id },
        type: "post",
        success: function(data) {
            var json = JSON.parse(data);
            $('#nameField').val(json.document_name);
            $('#dateField').val(json.document_date);
            $('#infoField').val(json.document_info);
            $('#typeField').val(json.document_type);
            $('#updateFileName').val(json.filepath);  // File path from tb_document_files
            $('#document_id').val(document_id);
            $('#trid').val(trid);
        },
        error: function() {
            showAlert("Failed to load record details.", "alert-danger");
        }
    });
});
});
</script>
<script>
function handleFileChange(fileInputId, fileNameSpanId, fileLabelId) {
    const fileInput = document.getElementById(fileInputId);
    const fileNameSpan = document.getElementById(fileNameSpanId);
    const fileLabel = document.getElementById(fileLabelId);

    if (fileInput.files.length > 0) {
        const fileNames = Array.from(fileInput.files).map(file => file.name).join(', ');
        fileNameSpan.textContent = fileNames;

        // Change background color to green if files are selected
        fileLabel.style.backgroundColor = '#27c707';
    } else {
        // Reset to default text and background color if no files are selected
        fileNameSpan.textContent = 'No files selected';
        fileLabel.style.backgroundColor = '#c70707';
    }
}

window.onload = function() {
    // Initialize for both modals if needed
    handleFileChange('addFileInput', 'addFileName', 'addFileLabel');
    handleFileChange('updateFileInput', 'updateFileName', 'updateFileLabel');
};

</script>
<script>
// Function to fetch and display images in the modal
function loadImages(document_id) {
    // Clear previous images
    const imageContainer = document.getElementById('imageContainer');
    imageContainer.innerHTML = '';

    // Fetch images from the server
    fetch('fetch_images.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'document_id=' + document_id
    })
    .then(response => response.json())
    .then(images => {
        if (images.length > 0) {
            images.forEach(imagePath => {
                // Create image element
                const img = document.createElement('img');
                img.src = imagePath;
                img.alt = 'Uploaded Image';
                img.className = 'img-thumbnail m-2';
                img.style.width = '150px'; // You can adjust the size as needed
                
                // Append image to the container
                imageContainer.appendChild(img);
            });
        } else {
            // Show message if no images are found
            const noImagesMessage = document.createElement('p');
            noImagesMessage.textContent = 'No images uploaded for this document.';
            imageContainer.appendChild(noImagesMessage);
        }
    })
    .catch(error => {
        console.error('Error fetching images:', error);
    });
}

// Example function to open the modal and load images for a specific document
function openViewModal(document_id) {
    // Load the images for the selected document
    loadImages(document_id);

    // Open the modal
    const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
    viewModal.show();
}
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