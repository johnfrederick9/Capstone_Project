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
                        imageContainer.append('<p></p>');
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

        function printContentFromPage(url, idsString = '') {
    let queryString = idsString ? `?ids=${idsString}` : '';
    $.ajax({
        url: `${url}${queryString}`,
        type: 'GET',
        success: function (response) {
            // Create an invisible iframe to load the print content
            let iframe = document.createElement('iframe');
            iframe.style.position = 'absolute';
            iframe.style.width = '0px';
            iframe.style.height = '0px';
            iframe.style.border = 'none';
            document.body.appendChild(iframe);

            // Write response content into the iframe
            let iframeDoc = iframe.contentWindow.document;
            iframeDoc.open();
            iframeDoc.write(response);
            iframeDoc.close();

            // Wait for all images in the iframe to load
            let images = iframeDoc.querySelectorAll('img');
            let totalImages = images.length;
            let loadedImages = 0;

            if (totalImages > 0) {
                images.forEach((img) => {
                    img.addEventListener('load', imageLoaded);
                    img.addEventListener('error', imageLoaded);
                });
            } else {
                // Trigger print immediately if no images
                triggerPrint(iframe);
            }

            function imageLoaded() {
                loadedImages++;
                if (loadedImages === totalImages) {
                    triggerPrint(iframe);
                }
            }
        },
        error: function () {
            showAlert("Failed to load print content.", "alert-danger");
        },
    });
}

// Function to trigger printing from the iframe
function triggerPrint(iframe) {
    let iframeWindow = iframe.contentWindow;

    // Add a print-only style to ensure proper isolation of print content
    let style = iframeWindow.document.createElement('style');
    style.textContent = `
        @media print {
            body {
                display: block;
            }
        }
    `;
    iframeWindow.document.head.appendChild(style);

    // Trigger print
    iframeWindow.focus();
    iframeWindow.print();

    // Cleanup after printing
    document.body.removeChild(iframe);
}

// Print selected rows
$('.print-btn').click(function () {
    if (selectedIds.length > 0) {
        let idsString = selectedIds.join(',');
        printContentFromPage('print_selected.php', idsString);
    } else {
        showAlert("Please select at least one row to print.", "alert-danger");
    }
});

// Print all rows
$('.print-all-btn').click(function () {
    printContentFromPage('print_all.php');
});


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
$(document).on('submit', '#updateUser', function (e) {
    e.preventDefault();
    var formData = new FormData(this); // Automatically includes all form fields and files

    $.ajax({
        url: "update.php",
        type: "POST",
        data: formData,
        processData: false, // Do not process data as a query string
        contentType: false, // Do not set the content type header
        success: function (data) {
            var json = JSON.parse(data);
            var status = json.status;

            if (status === 'duplicate') {
                showAlert("Document with the same name already exists.", "alert-danger");
            } else if (status === 'true') {
                $('#example').DataTable().draw();
                $('#exampleModal').modal('hide');
                showAlert("Document updated successfully.", "alert-success");
                 // Clear file upload field and label
                 $('#updateFileInput').val(''); // Clear the file input value
                $('#updateFileName').text('No files selected'); // Reset the label text
                $('#updateFileLabel').css('background-color', '#c70707'); // Reset label background color
            } else {
                showAlert("Failed to update document.", "alert-danger");
            }
        },
        error: function () {
            showAlert("Error updating record.", "alert-danger");
        }
    });
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
            noImagesMessage.textContent = '';
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