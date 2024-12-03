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

        function updateApprovalStatus(userId, status, reason = '') {
            $.ajax({
                url: 'updateApproval.php',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ user_id: userId, status, reason }),
                success: function (response) {
                    alert(response.message);
                    table.ajax.reload(); // Refresh table data
                },
                error: function () {
                    alert('An error occurred. Please try again.');
                },
            });
        }

        $(document).on('click', '.btn-approve', function () {
            const userId = $(this).data('id');
            if (confirm('Are you sure you want to approve this user?')) {
                updateApprovalStatus(userId, 1);
            }
        });

        $(document).on('click', '.btn-disapprove', function () {
            const userId = $(this).data('id');
            const reason = prompt('Please provide a reason for disapproval:');
            if (reason) {
                updateApprovalStatus(userId, 3, reason);
            }
        });
    });
</script>
        </section><!-- .home-->
    </body> 
</html>
