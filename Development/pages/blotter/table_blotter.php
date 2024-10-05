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



<body>
    <section class="home">  
        <div class="certificate">
        <div class="table-container" style="overflow: visible;">
                    <div class="table-header">
                    <div class="head">
                            <h1>Blotter Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Blotter</button>
                            <!--<button class="print-btn" title="Print">
                                <i class="bx bx-printer"></i>
                            </button>-->
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>Complainant Name</th>
                        <th>Complainant Contact No.</th>
                        <th>Complainant Address</th>
                        <th>Complainee Name</th>
                        <th>Complainee Contact No.</th>
                        <th>Complainee Address</th>
                        <th>Complaint</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Incidence</th>
                        <th>Date Recorded</th>
                        <th>Date Settled</th>
                        <th>Recorded By</th>
                        <th>Buttons</th>
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
                                        "targets": [10, 11, 12],  
                                        "visible": false, 
                                        "searchable": false, 
                                    },
                                    {
                                    "bSortable": false,
                                    "aTargets": [13]
                                    },
                                ]
                            });
                        });
                     $(document).on('submit', '#addBlotter', function(e) {
                            e.preventDefault();
                            var blotter_complainant = $('#blotter_complainant').val();
                            var blotter_complainant_no = $('#blotter_complainant_no').val();
                            var blotter_complainant_add = $('#blotter_complainant_add').val();
                            var blotter_complainee = $('#blotter_complainee').val();
                            var blotter_complainee_no = $('#blotter_complainee_no').val();
                            var blotter_complainee_add = $('#blotter_complainee_add').val();
                            var blotter_complaint = $('#blotter_complaint').val();
                            var blotter_status = $('#blotter_status').val();
                            var blotter_action = $('#blotter_action').val();
                            var blotter_incidence = $('#blotter_incidence').val();
                            var blotter_date_recorded = $('#blotter_date_recorded').val();
                            var blotter_date_settled = $('#blotter_date_settled').val();
                            var blotter_recorded_by = $('#blotter_recorded_by').val();
                            if (
                                blotter_complainant !== ''
                            ) {
                                $.ajax({
                                    url: "add.php",
                                    type: "post",
                                    data: {
                                        blotter_complainant: blotter_complainant,
                                        blotter_complainant_no: blotter_complainant_no,
                                        blotter_complainant_add: blotter_complainant_add,
                                        blotter_complainee: blotter_complainee,
                                        blotter_complainee_no: blotter_complainee_no,
                                        blotter_complainee_add: blotter_complainee_add,
                                        blotter_complaint: blotter_complaint,
                                        blotter_status: blotter_status,
                                        blotter_action: blotter_action,
                                        blotter_incidence: blotter_incidence,
                                        blotter_date_recorded: blotter_date_recorded,
                                        blotter_date_settled: blotter_date_settled,
                                        blotter_recorded_by: blotter_recorded_by
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
                        $(document).on('submit', '#updateBlotter', function(e) {
                            e.preventDefault();

                            var blotter_complainant = $('#blotter_complainantField').val();
                            var blotter_complainant_no = $('#blotter_complainant_noField').val();
                            var blotter_complainant_add = $('#blotter_complainant_addField').val();
                            var blotter_complainee = $('#blotter_complaineeField').val();
                            var blotter_complainee_no = $('#blotter_complainee_noField').val();
                            var blotter_complainee_add = $('#blotter_complainee_addField').val();
                            var blotter_complaint = $('#blotter_complaintField').val();
                            var blotter_status = $('#blotter_statusField').val();
                            var blotter_action = $('#blotter_actionField').val();
                            var blotter_incidence = $('#blotter_incidenceField').val();
                            var blotter_date_recorded = $('#blotter_date_recordedField').val();
                            var blotter_date_settled = $('#blotter_date_settledField').val();
                            var blotter_recorded_by = $('#blotter_recorded_byField').val();
                            var trid = $('#trid').val();
                            var blotter_id = $('#blotter_id').val();

                            if (blotter_complainant !== '') {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: {
                                        blotter_complainant: blotter_complainant,
                                        blotter_complainant_no: blotter_complainant_no,
                                        blotter_complainant_add: blotter_complainant_add,
                                        blotter_complainee: blotter_complainee,
                                        blotter_complainee_no: blotter_complainee_no,
                                        blotter_complainee_add: blotter_complainee_add,
                                        blotter_complaint: blotter_complaint,
                                        blotter_status: blotter_status,
                                        blotter_action: blotter_action,
                                        blotter_incidence: blotter_incidence,
                                        blotter_date_recorded: blotter_date_recorded,
                                        blotter_date_settled: blotter_date_settled,
                                        blotter_recorded_by: blotter_recorded_by,
                                        blotter_id: blotter_id
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        if (json.status == 'true') {
                                            table = $('#example').DataTable();
                                            var button = '<td><div class="buttons"> <a href="javascript:void();" data-id="'+ blotter_id +'" class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a> <button class="print-btn" data-id="'+blotter_id+'" title="Print Selected"> <i class="bx bx-printer"></i></button></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.data([blotter_complainant, blotter_complainant_no, blotter_complainant_add, blotter_complainee, blotter_complainee_no, blotter_complainee_add, blotter_complaint, blotter_status, blotter_action, blotter_incidence, blotter_date_recorded, blotter_date_settled, blotter_recorded_by, button]);
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
                        var blotter_id = $(this).data('id');
                        $('#exampleModal').modal('show');

                        $.ajax({
                            url: "get_single_data.php",
                            data: {
                                blotter_id: blotter_id
                            },
                            type: 'post',
                            success: function(data) {
                                var json = JSON.parse(data);
                                $('#blotter_complainantField').val(json.blotter_complainant);
                                $('#blotter_complainant_noField').val(json.blotter_complainant_no);
                                $('#blotter_complainant_addField').val(json.blotter_complainant_add);
                                $('#blotter_complaineeField').val(json.blotter_complainee);
                                $('#blotter_complainee_noField').val(json.blotter_complainee_no);
                                $('#blotter_complainee_addField').val(json.blotter_complainee_add);
                                $('#blotter_complaintField').val(json.blotter_complaint);
                                $('#blotter_statusField').val(json.blotter_status);
                                $('#blotter_actionField').val(json.blotter_action);
                                $('#blotter_incidenceField').val(json.blotter_incidence);
                                $('#blotter_date_recordedField').val(json.blotter_date_recorded);
                                $('#blotter_date_settledField').val(json.blotter_date_settled);
                                $('#blotter_recorded_byField').val(json.blotter_recorded_by);
                                $('#blotter_id').val(blotter_id);
                                $('#trid').val(trid);
                            }
                        })
                    });
                    $(document).ready(function() {
                    // Event listener for the print button
                    $(document).on('click', '.print-btn', function() {
                        var blotterId = $(this).data('id'); // Get the indigency_id

                        // Make an AJAX request to fetch the certificate content
                        $.ajax({
                            url: 'fetch_blotter.php', // URL to fetch the certificate HTML
                            type: 'POST',
                            data: {id: blotterId},
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
                <!-- Update Blotter -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Blotter Issued Update Form</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateBlotter">
                                <input type="hidden" name="blotter_id" id="blotter_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="blotter">
                                <div class="add">
                                    <div class="form-grid">
                                    <div class="input-wrapper">
                                            <label for="blotter_complainant" class="input-label">Complainant's Name:</label>
                                            <select id="blotter_complainantField" name="blotter_complainant" class="input-field" required>
                                                <option value="" disabled selected>Select a complainant</option>
                                                <?php foreach ($residents as $resident): ?>
                                                    <option value="<?php echo $resident['resident_fullname']; ?>">
                                                        <?php echo htmlspecialchars($resident['resident_fullname']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainant_no" class="input-label">Complainant's Contact No.:</label>
                                            <input type="text" id="blotter_complainant_noField" name="blotter_complainant_no" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainant_add" class="input-label">Complainant's Address:</label>
                                            <input type="text" id="blotter_complainant_addField" name="blotter_complainant_add" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainee" class="input-label">Complainee's Name:</label>
                                            <select id="blotter_complaineeField" name="blotter_complainee" class="input-field" required>
                                                <option value="" disabled selected>Select a complainee</option>
                                                <?php foreach ($residents as $resident): ?>
                                                    <option value="<?php echo $resident['resident_fullname']; ?>">
                                                        <?php echo htmlspecialchars($resident['resident_fullname']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div> 
                                        <div class="input-wrapper">
                                            <label for="blotter_complainee_no" class="input-label">Complainee's Contact No.:</label>
                                            <input type="text" id="blotter_complainee_noField" name="blotter_complainee_no" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainee_add" class="input-label">Complainee's Address:</label>
                                            <input type="text" id="blotter_complainee_addField" name="blotter_complainee_add" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complaint" class="input-label">Complaint:</label>
                                            <input type="text" id="blotter_complaintField" name="blotter_complaint" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_status" class="input-label">Status:</label>
                                            <input type="text" id="blotter_statusField" name="blotter_status" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_action" class="input-label">Action Taken:</label>
                                            <input type="text" id="blotter_actionField" name="blotter_action" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_incidence" class="input-label">Incidence:</label>
                                            <input type="text" id="blotter_incidenceField" name="blotter_incidence" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_date_recorded" class="input-label">Date Recorded:</label>
                                            <input type="date" id="blotter_date_recordedField" name="blotter_date_recorded" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_date_settled" class="input-label">Date Settled:</label>
                                            <input type="date" id="blotter_date_settledField" name="blotter_date_settled"  class="input-field">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_recorded_by" class="input-label">Recorded By:</label>
                                            <input type="text" id="blotter_recorded_byField" name="blotter_recorded_by" class="input-field" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
           <!-- Add Blotter -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Blotter Record Form</h5>
                        <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addBlotter" action="">
                            <div class="certificate">                              
                                <div class="add">
                                    <div class="form-grid">                                      
                                        <div class="input-wrapper">
                                            <label for="blotter_complainant" class="input-label">Complainant's Name:</label>
                                            <select id="blotter_complainant" name="blotter_complainant" class="input-field" required>
                                                <option value="" disabled selected>Select a complainant</option>
                                                <?php foreach ($residents as $resident): ?>
                                                    <option value="<?php echo $resident['resident_fullname']; ?>">
                                                        <?php echo htmlspecialchars($resident['resident_fullname']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainant_no" class="input-label">Complainant's Contact No.:</label>
                                            <input type="text" id="blotter_complainant_no" name="blotter_complainant_no" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainant_add" class="input-label">Complainant's Address:</label>
                                            <input type="text" id="blotter_complainant_add" name="blotter_complainant_add" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainee" class="input-label">Complainee's Name:</label>
                                            <select id="blotter_complainee" name="blotter_complainee" class="input-field" required>
                                                <option value="" disabled selected>Select a complainee</option>
                                                <?php foreach ($residents as $resident): ?>
                                                    <option value="<?php echo $resident['resident_fullname']; ?>">
                                                        <?php echo htmlspecialchars($resident['resident_fullname']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainee_no" class="input-label">Complainee's Contact No.:</label>
                                            <input type="text" id="blotter_complainee_no" name="blotter_complainee_no" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complainee_add" class="input-label">Complainee's Address:</label>
                                            <input type="text" id="blotter_complainee_add" name="blotter_complainee_add" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_complaint" class="input-label">Complaint:</label>
                                            <input type="text" id="blotter_complaint" name="blotter_complaint" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_status" class="input-label">Status:</label>
                                            <input type="text" id="blotter_status" name="blotter_status" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_action" class="input-label">Action Taken:</label>
                                            <input type="text" id="blotter_action" name="blotter_action" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_incidence" class="input-label">Incidence:</label>
                                            <input type="text" id="blotter_incidence" name="blotter_incidence" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_date_recorded" class="input-label">Date Recorded:</label>
                                            <input type="date" id="blotter_date_recorded" name="blotter_date_recorded" class="input-field" required>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_date_settled" class="input-label">Date Settled:</label>
                                            <input type="date" id="blotter_date_settled" name="blotter_date_settled" class="input-field">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="blotter_recorded_by" class="input-label">Recorded By:</label>
                                            <input type="text" id="blotter_recorded_by" name="blotter_recorded_by" class="input-field" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body> 
    <script>
            document.getElementById('blotter_complainant').addEventListener('change', function() {
                let complainantId = this.value;
                let complaineeSelect = document.getElementById('blotter_complainee');
                
                // Reset complainee options
                complaineeSelect.innerHTML = `<option value="" disabled selected>Select a complainee</option>`;
                
                <?php foreach ($residents as $resident): ?>
                    if (complainantId !== "<?php echo $resident['resident_fullname']; ?>") {
                        complaineeSelect.innerHTML += `<option value="<?php echo $resident['resident_fullname']; ?>"><?php echo htmlspecialchars($resident['resident_fullname']); ?></option>`;
                    }
                <?php endforeach; ?>
            });
        </script>
</html>

