<?php
include '../../head.php';
include "../../sidebar_officials.php";
?>
<style>
    #imageContainer {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.image-wrapper {
    margin: 10px;
}

.img-thumbnail {
    max-width: 150px;
    max-height: 150px;
    object-fit: cover;
}
    .head{
        margin-top: 10px;
    }
    .inventory{
        margin-top: 20px;
    }
    .inventory .print-btn, .add-popup{
        display: none;
    }
    .dataTables_filter{
      margin-left: 800px;
    }
    .inventory .view-btn{
        margin-left: 30px;
    }

</style>
<body>
    <section class="home">  
        <div class="inventory">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Document Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Document</button>
                            <button class="print-btn " title="Print Selected">
                            <i class="bx bx-printer"></i>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>Document Name</th>
                        <th>Document Date</th>
                        <th>Document Info</th>
                        <th>Document Type</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                    <script type="text/javascript">
                    $(document).ready(function() {
                    // DataTable initialization
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
                        "aoColumnDefs": [{
                            "bSortable": false,
                            "aTargets": [4]
                        }]
                    });
                    
                    // Handle "View" button click
                    $('#example').on('click', '.viewbtn', function(event) {
                        var document_id = $(this).data('id');
                        $('#viewModal').modal('show'); // Show the modal

                        // Fetch images for the selected document
                        $.ajax({
                            url: "fetch_images.php", // PHP script to fetch images
                            type: "post",
                            data: { document_id: document_id },
                            success: function(data) {
                                var images = JSON.parse(data);
                                var imageContainer = $('#imageContainer');
                                imageContainer.empty(); // Clear previous images

                                // Loop through images and display them
                                if (images.length > 0) {
                                    images.forEach(function(image) {
                                        imageContainer.append('<div class="image-wrapper"><img src="' + image.filepath + '" class="img-fluid img-thumbnail m-2" alt="Document Image"></div>');
                                    });
                                } else {
                                    imageContainer.append('<p>No images available for this document.</p>');
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('Error fetching images: ' + error);
                            }
                        });
                    });
                });
                    </script>
                </section><!-- .home-->
                <!-- Modal -->
            <!-- View Modal -->
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel">View Uploaded Images</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="imageContainer" class="d-flex flex-wrap">
                                <!-- Images will be loaded here dynamically -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body> 
<script>
function handleFileChange() {
    const fileInput = document.getElementById('fileInput');
    const fileNameSpan = document.getElementById('fileName');
    const fileLabel = document.getElementById('fileLabel');
  
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
    handleFileChange();
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

</html>
