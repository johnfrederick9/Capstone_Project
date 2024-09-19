<?php
include '../../head.php';
include '../../sidebar.php';
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
                            <!--<button class="print-btn" title="Print">
                                <i class="bx bx-printer"></i>
                            </button>-->
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
                        $(document).on('submit', '#addUser', function(e) {
                            e.preventDefault();

                            // Collect form data
                            var formData = new FormData(this); // Create a FormData object from the form

                            // Perform AJAX request to send form data to the server
                            $.ajax({
                                url: "add.php", // PHP script to handle form data and file upload
                                type: "post",
                                data: formData, // Use FormData to send the form data including files
                                processData: false, // Do not process data as a regular query string
                                contentType: false, // Do not set content-type header (it will be set automatically)
                                success: function(data) {
                                    var json = JSON.parse(data);
                                    var status = json.status;
                                    if (status == 'true') {
                                        mytable = $('#example').DataTable();
                                        mytable.draw();
                                        $('#addUserModal').modal('hide');
                                    } else {
                                        alert('Failed: ' + (json.error || 'Unknown error'));
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('AJAX error: ' + error);
                                }
                            });
                        });
                        $(document).on('submit', '#updateUser', function(e) {
                            e.preventDefault();
                            //var tr = $(this).closest('tr');
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
                                        if (status == 'true') {
                                            table = $('#example').DataTable();
                                            var button = '<td><div class= "buttons"> <a href="javascript:void(0);" data-id="'+ document_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a><a href="javascript:void(0);" onclick="openViewModal(' + document_id +');" class="view-btn btn-sm viewbtn"><i class="bx bx-show"></i></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([document_name, document_date, document_info, document_type, button]);
                                            $('#exampleModal').modal('hide');
                                        } else {
                                            alert('failed');
                                        }
                                    }
                                });
                            } else {
                                alert('Fill all the required fields');
                            }
                        });
                        $('#example').on('click', '.editbtn ', function(event) {
                        var table = $('#example').DataTable();
                        var trid = $(this).closest('tr').attr('id');
                        // console.log(selectedRow);
                        var document_id = $(this).data('id');
                        $('#exampleModal').modal('show');

                        $.ajax({
                            url: "get_single_data.php",
                            data: {
                                document_id: document_id
                            },
                            type: 'post',
                            success: function(data) {
                                var json = JSON.parse(data);
                                $('#nameField').val(json.document_name);
                                $('#dateField').val(json.document_date);
                                $('#infoField').val(json.document_info);
                                $('#typeField').val(json.document_type);
                                $('#document_id').val(document_id);
                                $('#trid').val(trid);
                            }
                        })
                    });
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
                <!-- Update Project -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Document</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="document_id" id="document_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="form-group">
                                <label for="documentName">Document Name</label>
                                <input type="text" id="nameField" name="document_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="documentDate">Document Date</label>
                                    <input type="date" id="dateField" name="document_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="documentInfo">Document Info</label>
                                    <input type="text" id="infoField" name="document_info" required>
                                </div>
                                <div class="form-group">
                                    <label for="documentType">Document Type</label>
                                    <input type="text" id="typeField" name="document_type" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Project -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Document</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="addUser" action="add.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="documentName">Document Name</label>
                                <input type="text" id="document_name" name="document_name" required>
                            </div>
                            <div class="form-group">
                                <label for="documentDate">Document Date</label>
                                <input type="date" id="document_date" name="document_date" required>
                            </div>
                            <div class="form-group">
                                <label for="documentInfo">Document Info</label>
                                <input type="text" id="document_info" name="document_info" required>
                            </div>
                            <div class="form-group">
                                <label for="documentType">Document Type</label>
                                <input type="text" id="document_type" name="document_type" required>
                            </div>
                            <div class="file-upload">
                                <label for="fileInput" id="fileLabel" style="background-color: #ffdddd;">
                                    <i class='bx bx-paperclip'></i> Attach Files
                                </label>
                                <span id="fileName">No files selected</span>
                                <input type="file" id="fileInput" name="document_files[]" class="file-input" multiple required onchange="handleFileChange()">
                            </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
