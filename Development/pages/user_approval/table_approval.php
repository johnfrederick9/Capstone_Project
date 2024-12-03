<?php
include '../../head.php';
include '../../sidebar.php';
?>
<style>
    .head{
        margin-top: 10px;
    }
    .user .print-btn, .add-table-btn{
        display: none;
    }
    .dataTables_filter{
      margin-left: 800px;
    }
</style>
<body>
    <section class="home">  
        <div class="user">
        <div class="table-container">
    <div class="table-header">
        <div class="head">
            <h1>User Approval Table</h1>
        </div>
                    <div class="table-actions">    
                        <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-table-btn">+ Add</button>
                        <button class="print-btn " title="Print Selected">
                            <i class="bx bx-printer"></i>
                        </button>
                    </div>
                    </div>
                    <table id="example" class="table-table">
                        <thead>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Sex</th>
                            <th>Birth Date</th>
                            <th>Barangay Position</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </section><!-- .home-->
                    <script>
    $(document).ready(function () {
        const table = $('#example').DataTable({
            serverSide: true,
            processing: true,
            ajax: { url: 'fetch_data.php', type: 'POST' },
            columnDefs: [
                { targets: [0], visible: false, searchable: false },
                { orderable: false, targets: [6] },
            ],
        });

        let selectedUserId = null;

        // Function to update approval status
        function updateApprovalStatus(userId, status, reason = '') {
            $.ajax({
                url: 'updateApproval.php',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ user_id: userId, status, reason }),
                success: function (response) {
                    // Use the custom showAlert function for success messages
                    if (status === 1) {
                        showAlert('Successfully approved the account!', 'alert-success');
                    } else if (status === 3) {
                        showAlert('Successfully disapproved the account!', 'alert-danger');
                    }
                    table.ajax.reload(); // Refresh table data
                },
                error: function () {
                    // Use the custom showAlert function for error messages
                    showAlert('An error occurred. Please try again.', 'alert-danger');
                },
            });
        }

        // Approve button click
        $(document).on('click', '.btn-approve', function () {
            selectedUserId = $(this).data('id');
            $('#approvalModal').modal('show');
        });

        // Disapprove button click
        $(document).on('click', '.btn-disapprove', function () {
            selectedUserId = $(this).data('id');
            $('#disapprovalModal').modal('show');
        });

        // Approval modal - Yes
        $('#approveYes').on('click', function () {
            updateApprovalStatus(selectedUserId, 1);
            $('#approvalModal').modal('hide');
        });

        // Disapproval modal - Submit
        $('#disapproveSubmit').on('click', function () {
            const reason = $('#disapproveReason').val().trim();
            if (reason) {
                updateApprovalStatus(selectedUserId, 3, reason);
                $('#disapprovalModal').modal('hide');
            } else {
                showAlert('Please provide a reason for disapproval.', 'alert-warning');
            }
        });
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
        setTimeout(function () { alertDiv.alert('close'); }, 500);
    }
</script>

        <section class="approval-modal">
        <!-- Approval Modal -->
        <div id="approvalModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ApprovalConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Approve Account</h5>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Do you want to approve this account?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="approveYes">Yes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- Disapproval Modal -->
        <div id="disapprovalModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="disapprovalConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Disapprove Account</h5>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="disapproveReason">Reason for disapproval:</label>
                        <textarea id="disapproveReason" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="disapproveSubmit">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
</section>
    </body> 
</html>
