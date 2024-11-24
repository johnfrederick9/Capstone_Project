<?php
include "../../sidebar_officials.php";
include '../../head.php';
require '../../database.php';
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
                            <h1>Inventory Table</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Item</button>
                            <button class="print-btn " title="Print Selected">
                            <i class="bx bx-printer"></i>
                        </button>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                    <th>#</th>
                        <th>Name</th>
                        <th>Serial No:</th>
                        <th>Property Custodian</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Year Acquired</th>
                        <th>Lendable Quantity</th>
                        <th>Available Quantity</th>
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
                                "columnDefs": [
                                    {
                                        "targets": [0],  // Target the first column (aData[0])
                                        "visible": false, // Hide the column
                                        "searchable": false // Disable search for this column if needed
                                    },
                                    {
                                        "bSortable": false,
                                        "aTargets": [9]
                                    }
                                ]
                            });
                        });
                    </script>
                </section><!-- .home-->
    </body> 
    <script>
        function validateForm() {
                var itemCount = parseInt(document.getElementById('itemcount').value);
                var lendableCount = parseInt(document.getElementById('lendablecount').value);

                if (lendableCount > itemCount) {
                    alert("Lendable count cannot be more than item count.");
                    return false;
                }

                return true;
            }

            function validateForm2(){
                var itemCountField = parseInt(document.getElementById('countField').value);
                var lendableCountField = parseInt(document.getElementById('lendablecountField').value);

                if (lendableCountField > itemCountField) {
                    alert("Lendable count cannot be more than item count.");
                    return false;
                }
                return true;
            }
    </script>

</html>
