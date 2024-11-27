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
                            <th>Buttons</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
                            "targets": [0],  // Target the first column (aData[0])
                            "visible": false, // Hide the column
                            "searchable": false // Disable search for this column if needed
                            },
                            {
                            "bSortable": false,
                            "aTargets": []
                        }],
                    });
                });

                document.addEventListener('DOMContentLoaded', function () {
    // Function to send approval/disapproval status
    function updateApprovalStatus(userId, status, reason = '') {
        fetch('updateApproval.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ user_id: userId, status, reason }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload(); // Reload the table to reflect changes
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Approve button click event
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-approve')) {
            const userId = e.target.getAttribute('data-id');
            if (confirm('Are you sure you want to approve this user?')) {
                updateApprovalStatus(userId, 1); // Approve the user
            }
        }
    });

    // Disapprove button click event
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-disapprove')) {
            const userId = e.target.getAttribute('data-id');
            const reason = prompt('Please provide a reason for disapproval:');
            if (reason) {
                updateApprovalStatus(userId, 0, reason); // Disapprove the user with a reason
            }
        }
    });
});

        </script>
        </section><!-- .home-->
    </body> 
</html>
