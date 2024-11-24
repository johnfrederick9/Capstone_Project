<?php
include '../../head.php';
include "../../sidebar_mainofficials.php";
?>
<style>
    .form-group{
        margin-top: -5px;
    }
    .head{
        margin-top: 10px;
    }
    .financial-rao{
        margin-top: 20px;
    }
    .financial-rao .print-btn, .add-popup{
        display: none;
    }
    .dataTables_filter{
      margin-left: 800px;
    }

.column-titles {
  display: grid;
  grid-template-columns: 20px repeat(9, 1fr) 50px; 
  gap: 10px; 
  align-items: center; 
  font-size: small;
}

.column-titles span {
  text-align: center; 
}
.inp-group-ap, .inp-group-ap-update{
    height: 110px;
    overflow: auto;
}
.inp-group-ob, .inp-group-ob-update{
    height: 110px;
    overflow: auto;
}
.wrap{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    margin-bottom: 10px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e4e1e1;
}
.add_ap, .add_ap_update{
    text-decoration: none;
    display: inline-block;
    width:30px;
    height: 30px;
    background: #8bc34a;
    font-size: 2rem;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
}
.add_ob, .add_ob_update{
    text-decoration: none;
    display: inline-block;
    width:30px;
    height: 30px;
    background: #8bc34a;
    font-size: 2rem;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
}
.flex{
    display: grid;
    grid-template-columns: 20px repeat(9, 1fr) 50px;  
    gap: 5px; 
    margin-bottom: 10px; 
    align-items: center;
}
.delete{
    text-decoration: none;
    display: inline-block;
    background: #f44336;
    color: #fff;
    font-size: 1.5rem;
    font-weight: bold;
    width: 30px;
    height: 30px;
    color: #fff;
    margin-left: auto;
    display: flex;
    justify-content:center;
    align-items: center;
    cursor: pointer;
}
.rao .modal-lg {
  max-width: 80%; /* Make the modal wider */
}
</style>
<body>
    <section class="home">  
        <div class="financial_rao">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Records of Appropriations and Obligations</h1>
                        </div>
                        <div class="table-actions">    
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="add-popup">+ Add Table</button>
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Year Covered</th>
                        <th>Total Appropriations</th>
                        <th>Total Obligations</th>
                        <th>Appropriation Balance to Date</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            window.apCounterUpdate = 1;
                            window.obCounterUpdate = 1;

                            $('#example').DataTable({
                                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                                    $(nRow).attr('id', aData[0]);
                                    $(nRow).find('.deleteBtn').attr('data-rao_id', aData[0]);
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
                                        "aTargets": [4]
                                    }
                                ]
                            });
                        });
                    </script>
                </section><!-- .home-->
        </body> 
</html>
