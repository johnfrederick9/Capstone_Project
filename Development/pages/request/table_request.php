<?php
include '../../head.php';
include '../../sidebar.php';
include '../../connection.php';
?>
<?php
// Assuming you have a database connection in $conn
$query = "SELECT resident_id, CONCAT(resident_firstname, ' ', 
                                     IF(resident_middlename != '' AND resident_middlename IS NOT NULL, CONCAT(LEFT(resident_middlename, 1), '.'), ''), ' ', 
                                     resident_lastname) 
          AS resident_fullname 
          FROM tb_resident";
$result = mysqli_query($conn, $query);

$residents = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $residents[] = $row;
    }
}
?>
<style>
    .form-group{
        margin-top: -5px;
    }
</style>
<body>
    <section class="home">  
        <div class="certificate">
        <div class="table-container" style="overflow: visible;">
                    <div class="table-header">
                    <div class="head">
                            <h1>Request Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Request</button>
                            <button class="print-btn " title="Print Selected">
                                <i class="bx bx-printer"></i>
                            </button>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                    <th>
                        <button class="print-all-btn" title="Print All">
                                    <i class="bx bx-printer"></i>
                            </button>
                        </th>
                        <th>Requester Name</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
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
                                        "targets": [],  
                                        "visible": false, 
                                        "searchable": false, 
                                    },
                                    {
                                    "bSortable": false,
                                    "aTargets": [6]
                                    },
                                ]
                            });
                        });
                        $('#selectAll').click(function() {
                            var checkedStatus = this.checked;
                            $('.row-checkbox').each(function() {
                                $(this).prop('checked', checkedStatus);
                            });
                        });

                        // Function to trigger the print dialog with the loaded HTML content
                        function printContentFromPage(url, ids = '') {
                            $.ajax({
                                url: url,
                                type: 'GET',
                                data: { ids: ids }, // Pass IDs if needed (for print_selected.php)
                                success: function(response) {
                                    // Create an iframe to print the content
                                    var iframe = document.createElement('iframe');
                                    iframe.style.position = 'absolute';
                                    iframe.style.width = '0px';
                                    iframe.style.height = '0px';
                                    iframe.style.border = 'none';
                                    document.body.appendChild(iframe);

                                    // Write the content into the iframe
                                    var doc = iframe.contentWindow.document;
                                    doc.open();
                                    doc.write(response);
                                    doc.close();

                                    // Trigger print dialog
                                    iframe.contentWindow.focus();
                                    iframe.contentWindow.print();

                                    // Remove iframe after printing
                                    document.body.removeChild(iframe);
                                },
                                error: function() {
                                    alert('Failed to load print content.');
                                }
                            });
                        }

                        // Print selected rows
                        $('.print-btn').click(function() {
                            var selectedIds = [];
                            $('.row-checkbox:checked').each(function() {
                                selectedIds.push($(this).val());
                            });

                            if (selectedIds.length > 0) {
                                var idsString = selectedIds.join(',');
                                printContentFromPage('print_selected.php', idsString); // Load and print content from print_selected.php
                            } else {
                                alert('Please select at least one row to print.');
                                
                            }
                        });
                        // Print all rows
                        $('.print-all-btn').click(function() {
                            printContentFromPage('print_all.php'); // Load and print content from print_all.php
                        });
                     $(document).on('submit', '#addRequest', function(e) {
                            e.preventDefault();
                            var requester_name = $('#requester_name').val();
                            var request_type = $('#request_type').val();
                            var request_description = $('#request_description').val();
                            var request_date = $('#request_date').val();
                            var request_status = $('#request_status').val();
                            if (requester_name !== '' && request_type !== '' && request_description !== '' && request_date !== '' && request_status !== '') {
                                $.ajax({
                                    url: "add.php",
                                    type: "post",
                                    data: {
                                        requester_name: requester_name,
                                        request_type: request_type,
                                        request_description: request_description,
                                        request_date: request_date,
                                        request_status: request_status,
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        if (status == 'true') {
                                            mytable = $('#example').DataTable();
                                            mytable.draw();
                                            $('#addUserModal').modal('hide');
                                        } else {
                                            alert('failed');
                                        }
                                    }
                                });
                            } else {
                                alert('Fill all the required fields');
                            }
                        });
                        $(document).on('submit', '#updateRequest', function(e) {
                            e.preventDefault();
                            var requester_name = $('#requester_nameField').val();
                            var request_type = $('#request_typeField').val();
                            var request_description = $('#request_descriptionField').val();
                            var request_date = $('#request_dateField').val();
                            var request_status = $('#request_statusField').val();
                            var trid = $('#trid').val();
                            var request_id = $('#request_id').val();
                            if (requester_name !== '' && request_type !== '' && request_description !== '' && request_date !== '' && request_status !== '') {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: {
                                        requester_name: requester_name,
                                        request_type: request_type,
                                        request_description: request_description,
                                        request_date: request_date,
                                        request_status: request_status,
                                        request_id: request_id
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        if (json.status == 'true') {
                                            table = $('#example').DataTable();
                                            var checkbox = '<td><input type="checkbox" class="row-checkbox" value="'+request_id+'"></td>';
                                            var button = '<td><div class="buttons"> <a href="javascript:void();" data-id="'+ request_id +'" class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.data([checkbox, requester_name, request_type, request_description, request_date, request_status, button]);
                                            $('#exampleModal').modal('hide');
                                        } else {
                                            alert('Update failed: ' + json.message);
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
                        var request_id = $(this).data('id');
                        $('#exampleModal').modal('show');

                        $.ajax({
                            url: "get_single_data.php",
                            data: {
                                request_id: request_id
                            },
                            type: 'post',
                            success: function(data) {
                                var json = JSON.parse(data);
                                $('#requester_nameField').val(json.requester_name);
                                $('#request_typeField').val(json.request_type);
                                $('#request_descriptionField').val(json.request_description);
                                $('#request_dateField').val(json.request_date);
                                $('#request_statusField').val(json.request_status);
                                $('#request_id').val(request_id);
                                $('#trid').val(trid);
                            }
                        })
                    });
                    $(document).ready(function() {
                    // Event listener for the print button
                    $(document).on('click', '.print-btn', function() {
                        var requestId = $(this).data('id'); // Get the indigency_id

                        // Make an AJAX request to fetch the certificate content
                        $.ajax({
                            url: 'fetch_request.php', // URL to fetch the certificate HTML
                            type: 'POST',
                            data: {id: requestId},
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
                    </script>
                </section><!-- .home-->
                 <!-- Modal -->
                <!-- Update Request -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Request Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateRequest" action="">
                            <input type="hidden" name="request_id" id="request_id" value="">
                            <input type="hidden" name="trid" id="trid" value="">
                                <div class="form-group">
                                    <label for="requestername">Requester Name</label>
                                    <input type="text" id="requester_nameField" name="requester_nameField" required>
                                </div>
                                <div class="form-group">
                                    <label for="requesttype">Request Type</label>
                                    <input type="text" id="request_typeField" name="request_typeField" required>
                                </div>
                                <div class="form-group">
                                    <label for="requestdescription">Request Description</label>
                                    <input type="text" id="request_descriptionField" name="request_descriptionField" required>
                                </div>
                                <div class="form-group">
                                    <label for="requestdate">Request Date</label>
                                    <input type="datetime-local" id="request_dateField" name="request_dateField" required>
                                </div>
                                <div class="form-group">
                                    <label for="requeststatus">Request Status</label>
                                    <input type="text" id="request_statusField" name="request_statusField" required>
                                </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Request -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Request Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="addRequest" action="">
                            <div class="form-group">
                                <label for="requestername">Requester Name</label>
                                <input type="text" id="requester_name" name="requester_name" required>
                            </div>
                            <div class="form-group">
                                <label for="requesttype">Request Type</label>
                                <input type="text" id="request_type" name="request_type" required>
                            </div>
                            <div class="form-group">
                                <label for="requestdescription">Request Description</label>
                                <input type="text" id="request_description" name="request_description" required>
                            </div>
                            <div class="form-group">
                                <label for="requestdate">Request Date</label>
                                <input type="datetime-local" id="request_date" name="request_date" required>
                            </div>
                            <div class="form-group">
                                <label for="requeststatus">Request Status</label>
                                <input type="text" id="request_status" name="request_status" required>
                            </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body> 
</html>

