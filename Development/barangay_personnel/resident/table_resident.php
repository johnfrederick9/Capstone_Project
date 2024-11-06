<?php
include '../../head.php';
include "../../sidebar_officials.php";
?>
<body>
<style>
    .head{
        margin-top: 10px;
    }
    .resident .print-btn, .add-popup{
        display: none;
    }
    .dataTables_filter{
      margin-left: 800px;
    }
</style>
    <section class="home">  
        <div class="resident">
        <div class="table-container">
    <div class="table-header">
        <div class="head">
            <h1>Resident Table</h1>
        </div>
                    <div class="table-actions">    
                        <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Resident</button>
                        <button class="print-btn " title="Print Selected">
                            <i class="bx bx-printer"></i>
                        </button>
                    </div>
                    </div>
                    <table id="example" class="table-table">
                        <thead>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Maiden Name</th>
                            <th>Address</th>
                            <th>Educational Attainment</th>
                            <th>Birth Date</th>
                            <th>Age</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <script type="text/javascript">
                      $(document).ready(function() {
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
                            "aoColumnDefs": [{
                                "bSortable": false,
                                "aTargets": [7]
                            }]
                        });
                    });
                    </script>
                </section><!-- .home-->
    </body> 
</html>
