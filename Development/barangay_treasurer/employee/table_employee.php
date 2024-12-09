<?php
include '../../head.php';
include "../../sidebar_officials.php";
?>
<style>
    .head{
        margin-top: 10px;
    }
    .inventory .print-btn, .add-popup{
        display: none;
    }
    .dataTables_filter{
      margin-left: 800px;
    }
</style>
<body>
    <section class="home">  
        <div class="inventory">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Barangay Workers Table</h1>
                        </div>
                        <div class="table-actions">    
                        <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Employee</button>
                        <button class="print-btn " title="Print Selected">
                            <i class="bx bx-printer"></i>
                        </button>
                    </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Educational Attainment</th>
                        <th>Position</th>
                        <th>Birth Date</th>
                        <th>Age</th>
                        <th>Contact</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
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
                            "aTargets": [0]
                        }],
                    });
                });
                    </script>
                </section><!-- .home-->
    </body> 
</html>
