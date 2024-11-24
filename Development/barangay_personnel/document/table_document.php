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
                        <tr>
                            <th>Document ID</th>
                            <th>Document Name</th>
                            <th>Document Date</th>
                            <th>Document Info</th>
                            <th>Document Type</th>
                            <th>Images</th>
                        </tr>
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
                            "targets": [0],
                            "visible": false,
                            "searchable": false
                            },{
                            "bSortable": false,
                            "aTargets": [4]
                        }]
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
    // Function to fetch images for a specific document and display them in the table
function fetchImagesForDocument(document_id, imageCell) {
    fetch('fetch_images.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'document_id=' + document_id
    })
    .then(response => response.json())
    .then(images => {
        // Clear any existing content in the image cell
        imageCell.innerHTML = '';

        if (images.length > 0) {
            // Create a container for the images
            const imageContainer = document.createElement('div');
            imageContainer.className = 'd-flex flex-wrap align-items-center';

            images.forEach(imagePath => {
                // Create an img element for each image
                const img = document.createElement('img');
                img.src = imagePath;
                img.alt = 'Document Image';
                img.className = 'img-thumbnail m-1';
                img.style.width = '50px'; // Adjust the width
                img.style.height = '50px'; // Adjust the height

                // Add the image to the container
                imageContainer.appendChild(img);
            });

            // Append the container to the image cell
            imageCell.appendChild(imageContainer);
        } else {
            // If no images are available, display a message
            imageCell.textContent = 'No images available';
        }
    })
    .catch(error => {
        console.error('Error fetching images:', error);
        imageCell.textContent = 'Error loading images';
    });
}

// Function to load images for all rows in the table
function loadImagesForTable() {
    const table = document.getElementById('example'); // Update to your table ID
    const rows = table.querySelectorAll('tbody tr');

    rows.forEach(row => {
        // Get the document ID from the relevant cell
        const documentIdCell = row.querySelector('.document-id'); // Update class name if needed
        const imageCell = row.querySelector('.image-cell'); // Update class name if needed

        if (documentIdCell && imageCell) {
            const document_id = documentIdCell.textContent.trim();
            // Fetch images for this document ID and populate the image cell
            fetchImagesForDocument(document_id, imageCell);
        }
    });
}

// Automatically load images when the DOM content is fully loaded
document.addEventListener('DOMContentLoaded', loadImagesForTable);

</script>

</html>
