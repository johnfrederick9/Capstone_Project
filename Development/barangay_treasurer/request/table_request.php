<?php
include '../../head.php';
include "../../sidebar_officials.php";
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
    .head{
        margin-top: 10px;
    }
    .certificate .print-btn, .add-popup{
        display: none;
    }
    .dataTables_filter{
      margin-left: 800px;
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
                        <th>#</th>
                        <th>checkbox</th>
                        <th>Requester Name</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Status</th>
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
                                        "targets": [0,1],  
                                        "visible": false, 
                                        "searchable": false, 
                                    },
                                    {
                                    "bSortable": false,
                                    "aTargets": [4]
                                    },
                                ]
                            });
                        });
                    </script>
                </section><!-- .home-->
    </body> 
</html>

