<?php
include '../../head.php';
include '../../sidebar_officials.php';
?>
<style>
    .head{
        margin-top: 10px;
    }
    .dataTables_filter{
      margin-left: 800px;
    }
    /* Modal Header Styling */

/* Member List Styling */
#householdMembersList {
    padding: 10px;
    max-height: 400px; /* Limit the height of the list */
    overflow-y: auto; /* Enable scrolling if content exceeds height */
    border: 1px solid #ddd;
    border-radius: 5px;
}

#householdMembersList .list-group-item {
    font-size: 16px;
    font-weight: 500;
    border: none;
    padding: 10px 15px;
    background: #f8f9fa; /* Light background for list items */
    margin-bottom: 5px;
    border-left: 5px solid #007bff; /* Add a left border to make items visually distinct */
}

#householdMembersList .list-group-item:hover {
    background: #e9ecef; /* Slightly darker background on hover */
}

/* Close Button Hover Effect */
.modal-footer .btn-secondary:hover {
    background-color: #6c757d; /* Darker shade of gray */
    border-color: #6c757d;
}

/* General Modal Enhancements */
.modal-content {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    padding: 15px;
}


</style>
<body>
    <section class="home">  
        <div class="resident">
        <div class="table-container">
    <div class="table-header">
        <div class="head">
            <h1>Household Table</h1>
        </div>
                    </div>
                    <table id="example" class="table-table">
                        <thead>
                            <th>#</th>
                            <th>Household Number</th>
                            <th>Household Name</th>
                            <th>Household Head</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
