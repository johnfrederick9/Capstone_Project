<?php
include '../../head.php';
include "../../sidebar_officials.php";
?>
<body>
<style>
    .head{
        margin-top: 10px;
    }
    .certificate{
        margin-top: 20px;
    }
    .certificate .print-btn, .add-popup{
        display: none;
    }
    .dataTables_filter{
      margin-left: 800px;
    }
</style>
    <section class="home">  
        <div class="certificate">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Indigency Certificate Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Certificate</button>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>Child's Name</th>
                        <th>Mother's Name</th>
                        <th>Father's Name</th>
                        <th>Certificate Date Issued</th>
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
                                "aoColumnDefs": [{
                                    "bSortable": false,
                                    "aTargets": [3]
                                },

                                ]
                            });
                        });
                    </script>
                </section><!-- .home-->
    </body> 
</html>

