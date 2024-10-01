<?php
include '../../head.php';
include '../../sidebar.php';
?>
<style>

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
                            <!--<button class="print-btn" title="Print">
                                <i class="bx bx-printer"></i>
                            </button>-->
                        </div>
                    </div>
                    <table id="example" class="table-table">
                    <thead>
                        <th>#</th>
                        <th>Year Covered</th>
                        <th>Total Appropriations</th>
                        <th>Total Obligations</th>
                        <th>Appropriation Balance to Date</th>
                        <th>Action</th>
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
                                "aoColumnDefs": [{
                                    "bSortable": false,
                                    "aTargets": [5]
                                },

                                ]
                            });
                        });
                        $(document).on('submit', '#addUser', function(e) {
                            e.preventDefault();
                            
                            var period_covered = $('#period_covered').val();
                            var formData = new FormData(this);

                            // Collect ap array data
                            var ap_counter = $('input[name="ap_counter[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_date_data = $('input[name="ap_date_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_reference = $('input[name="ap_reference[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_particulars = $('input[name="ap_particulars[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_salary = $('input[name="ap_salary[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_cash_gift = $('input[name="ap_cash_gift[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_year_end = $('input[name="ap_year_end[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_mid_year = $('input[name="ap_mid_year[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_sri = $('input[name="ap_sri[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_others = $('input[name="ap_others[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            // Collect ob array data
                            var ob_counter = $('input[name="ob_counter[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_date_data = $('input[name="ob_date_data[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_reference = $('input[name="ob_reference[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_particulars = $('input[name="ob_particulars[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_salary = $('input[name="ob_salary[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_cash_gift = $('input[name="ob_cash_gift[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_year_end = $('input[name="ob_year_end[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_mid_year = $('input[name="ob_mid_year[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_sri = $('input[name="ob_sri[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_others = $('input[name="ob_others[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            formData.append('ap_counter', JSON.stringify(ap_counter));
                            formData.append('ap_date_data', JSON.stringify(ap_date_data));
                            formData.append('ap_reference', JSON.stringify(ap_reference));
                            formData.append('ap_particulars', JSON.stringify(ap_particulars));
                            formData.append('ap_salary', JSON.stringify(ap_salary));
                            formData.append('ap_cash_gift', JSON.stringify(ap_cash_gift));
                            formData.append('ap_year_end', JSON.stringify(ap_year_end));
                            formData.append('ap_mid_year', JSON.stringify(ap_mid_year));
                            formData.append('ap_sri', JSON.stringify(ap_sri));
                            formData.append('ap_others', JSON.stringify(ap_others));

                            formData.append('ob_counter', JSON.stringify(ob_counter));
                            formData.append('ob_date_data', JSON.stringify(ob_date_data));
                            formData.append('ob_reference', JSON.stringify(ob_reference));
                            formData.append('ob_particulars', JSON.stringify(ob_particulars));
                            formData.append('ob_salary', JSON.stringify(ob_salary));
                            formData.append('ob_cash_gift', JSON.stringify(ob_cash_gift));
                            formData.append('ob_year_end', JSON.stringify(ob_year_end));
                            formData.append('ob_mid_year', JSON.stringify(ob_mid_year));
                            formData.append('ob_sri', JSON.stringify(ob_sri));
                            formData.append('ob_others', JSON.stringify(ob_others));


                            if (period_covered != '') {
                                $.ajax({
                                    url: "add.php",
                                    type: "POST",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        var message = json.message;
                                        var error = json.error;
                                        console.log("Status:",status);
                                        if (status == 'true') {
                                            mytable = $('#example').DataTable();
                                            mytable.draw();
                                            $('#addUserModal').modal('hide');
                                        } else {
                                            alert(error || message || 'Failed'); 
                                        }
                                    }
                                });
                            } else {
                                alert('Fill all the required fields to Add');
                            }
                        });
                        $(document).on('submit', '#updateUser', function(e) {
                            e.preventDefault();

                            var trid = $(this).data('trid'); 
                            var rao_id = $(this).data('rao_id'); 
                            var period_covered = $('#period_covered_update').val();
                            
                            // Collect dynamic data for AP
                            var ap_counter = $('input[name="ap_counterUpdate[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var rao_ap_data_id = $('input[name="rao_ap_data_id[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_date_data = $('input[name="ap_date_data_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_reference = $('input[name="ap_reference_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_particulars = $('input[name="ap_particulars_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_salary = $('input[name="ap_salary_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_cash_gift = $('input[name="ap_cash_gift_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_year_end = $('input[name="ap_year_end_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_mid_year = $('input[name="ap_mid_year_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_sri = $('input[name="ap_sri_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ap_others = $('input[name="ap_others_update[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            // Collect dynamic data for OB
                            var ob_counter = $('input[name="ob_counterUpdate[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var rao_ob_data_id = $('input[name="rao_ob_data_id[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_date_data = $('input[name="ob_date_data_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_reference = $('input[name="ob_reference_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_particulars = $('input[name="ob_particulars_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_salary = $('input[name="ob_salary_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_cash_gift = $('input[name="ob_cash_gift_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_year_end = $('input[name="ob_year_end_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_mid_year = $('input[name="ob_mid_year_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_sri = $('input[name="ob_sri_update[]"]').map(function() {
                                return $(this).val();
                            }).get();
                            var ob_others = $('input[name="ob_others_update[]"]').map(function() {
                                return $(this).val();
                            }).get();

                            // Prepare the form data
                            var formData = new FormData();

                            formData.append('trid', trid);
                            formData.append('rao_id', rao_id);
                            formData.append('period_covered', period_covered);
                            // Append AP data
                            formData.append('rao_ap_data_id', JSON.stringify(rao_ap_data_id));
                            formData.append('ap_counterUpdate', JSON.stringify(ap_counter));
                            formData.append('ap_date_data', JSON.stringify(ap_date_data));
                            formData.append('ap_reference', JSON.stringify(ap_reference));
                            formData.append('ap_particulars', JSON.stringify(ap_particulars));
                            formData.append('ap_salary', JSON.stringify(ap_salary));
                            formData.append('ap_cash_gift', JSON.stringify(ap_cash_gift));
                            formData.append('ap_year_end', JSON.stringify(ap_year_end));
                            formData.append('ap_mid_year', JSON.stringify(ap_mid_year));
                            formData.append('ap_sri', JSON.stringify(ap_sri));
                            formData.append('ap_others', JSON.stringify(ap_others));

                            // Append OB data
                            formData.append('rao_ob_data_id', JSON.stringify(rao_ob_data_id));
                            formData.append('ob_counterUpdate', JSON.stringify(ob_counter));
                            formData.append('ob_date_data', JSON.stringify(ob_date_data));
                            formData.append('ob_reference', JSON.stringify(ob_reference));
                            formData.append('ob_particulars', JSON.stringify(ob_particulars));
                            formData.append('ob_salary', JSON.stringify(ob_salary));
                            formData.append('ob_cash_gift', JSON.stringify(ob_cash_gift));
                            formData.append('ob_year_end', JSON.stringify(ob_year_end));
                            formData.append('ob_mid_year', JSON.stringify(ob_mid_year));
                            formData.append('ob_sri', JSON.stringify(ob_sri));
                            formData.append('ob_others', JSON.stringify(ob_others));

                            if (period_covered != "") {
                                $.ajax({
                                    url: "update.php",
                                    type: "POST",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        console.log("Raw response data:", data);
                                        var json = JSON.parse(data);
                                        console.log("Statusasda:");
                                        var status = json.status; 
                                        var rao_id = json.rao_id; 
                                        var ap_total = json.ap_total; 
                                        var ob_total = json.ob_total; 
                                        var apbd_total = json.apbd_total; 

                                        
                                        console.log("Status:", json.status);
                                        console.log("RAO ID:", json.rao_id);
                                        console.log("AP Total:", json.ap_total);
                                        console.log("OB Total:", json.ob_total);
                                        console.log("APBD Total:", json.apbd_total);

                                        if (status == 'true') {
                                            table = $('#example').DataTable();
                                            // var button = '<td><div class="buttons"><a href="javascript:void();" data-id="' + rao_id + '" class="update-btn btn-sm editbtn"><i class="bx bx-sync"></i></a></div></td>';
                                            // // <a href="javascript:void();" data-id="${cashbook_id}" class="update-btn btn-sm editbtn"><i class="bx bx-sync"></i></a>
                                            // //             <a href="!#" data-cashbook_id="${cashbook_id}" class="delete-btn btn-sm deleteBtn"><i class="bx bxs-trash"></i></a>
                                            var button = `
                                                <td>
                                                    <div class="buttons">
                                                        <a href="javascript:void();" data-id="${rao_id}" class="update-btn btn-sm editbtn"><i class="bx bx-sync"></i></a>
                                                        <a href="!#" data-rao_id="${rao_id}" class="delete-btn btn-sm deleteBtn"><i class="bx bxs-trash"></i></a>
                                                    </div>
                                                </td>
                                            `;

                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([rao_id,period_covered, ap_total, ob_total, apbd_total, button]); // Update row with new data
                                            $('#exampleModal').modal('hide');
                                        } else {
                                            alert('Update failed');
                                        }
                                    }
                                });
                            } else {
                                alert('Fill all the required fields to Update');
                            }
                        });

                        $('#example').on('click', '.editbtn', function(event) {
                            var table = $('#example').DataTable();
                            var trid = $(this).closest('tr').attr('id');
                            var rao_id = $(this).data('id');
                            $('#updateUser').data('rao_id', rao_id);
                            $('#updateUser').data('trid', trid);

                            $('#exampleModal').modal('show');

                            // Clear previous input groups (if any)
                            $('.inp-group-ap-update').empty();
                            $('.inp-group-ob-update').empty();

                            // Reset counters when opening the modal
                            window.apCounterUpdate = 1;
                            window.obCounterUpdate = 1;

                            $.ajax({
                                url: "get_single_data.php",
                                data: { rao_id: rao_id },
                                type: 'post',
                                success: function(data) {
                                    var json = JSON.parse(data);

                                    if (json.error) {
                                        alert(json.error);
                                        return;
                                    }

                                    // Populate the 'Period Covered' field
                                    $('#period_covered_update').val(json.period_covered);

                                    if (typeof window.apCounterUpdate === 'undefined') {
                                        window.apCounterUpdate = document.querySelectorAll('.inp-group-ap-update .flex').length + 1;
                                    }
                                    // Populate the AP data (tb_rao_ap_data)
                                    if (json.related_data_ap && json.related_data_ap.length > 0) {
                                        json.related_data_ap.forEach(function(apItem, index) {
                                            var apInputGroup = `
                                            <div class="flex">
                                                <label>${window.apCounterUpdate}</label>
                                                <input type="hidden" name="ap_counterUpdate[]" value="${window.apCounterUpdate}">
                                                <input type="hidden" name="rao_ap_data_id[]" value="${apItem.rao_ap_data_id}">
                                                <input type="date" name="ap_date_data_update[]" value="${apItem.ap_ref_date}">
                                                <input type="text" name="ap_reference_update[]" value="${apItem.ap_ref_no}">
                                                <input type="text" name="ap_particulars_update[]" value="${apItem.ap_particulars}">
                                                <input type="number" name="ap_salary_update[]" value="${apItem.ap_salary}">
                                                <input type="number" name="ap_cash_gift_update[]" value="${apItem.ap_cash_gift}">
                                                <input type="number" name="ap_year_end_update[]" value="${apItem.ap_year_end}">
                                                <input type="number" name="ap_mid_year_update[]" value="${apItem.ap_mid_year}">
                                                <input type="number" name="ap_sri_update[]" value="${apItem.ap_sri}">
                                                <input type="number" name="ap_others_update[]" value="${apItem.ap_others}">
                                                <a href="#" class="delete" >x</a>
                                            </div>`;
                                            $('.inp-group-ap-update').append(apInputGroup);
                                            window.apCounterUpdate++;
                                        });
                                    }

                                    if (typeof window.obCounterUpdate === 'undefined') {
                                        window.obCounterUpdate = document.querySelectorAll('.inp-group-ob-update .flex').length + 1;
                                    }

                                    // Populate the OB data (tb_rao_ob_data)
                                    if (json.related_data_ob && json.related_data_ob.length > 0) {
                                        json.related_data_ob.forEach(function(obItem, index) {
                                            var obInputGroup = `
                                                <div class="flex">
                                                    <label>${window.obCounterUpdate}</label>
                                                    <input type="hidden" name="ob_counterUpdate[]" value="${window.obCounterUpdate}">
                                                    <input type="hidden" name="rao_ob_data_id[]" value="${obItem.rao_ob_data_id}">
                                                    <input type="date" name="ob_date_data_update[]" value="${obItem.ob_ref_date}">
                                                    <input type="text" name="ob_reference_update[]" value="${obItem.ob_ref_no}">
                                                    <input type="text" name="ob_particulars_update[]" value="${obItem.ob_particulars}">
                                                    <input type="number" name="ob_salary_update[]" value="${obItem.ob_salary}">
                                                    <input type="number" name="ob_cash_gift_update[]" value="${obItem.ob_cash_gift}">
                                                    <input type="number" name="ob_year_end_update[]" value="${obItem.ob_year_end}">
                                                    <input type="number" name="ob_mid_year_update[]" value="${obItem.ob_mid_year}">
                                                    <input type="number" name="ob_sri_update[]" value="${obItem.ob_sri}">
                                                    <input type="number" name="ob_others_update[]" value="${obItem.ob_others}">
                                                    <a href="#" class="delete">x</a>
                                                </div>`;
                                            $('.inp-group-ob-update').append(obInputGroup);
                                            window.obCounterUpdate++;
                                        });
                                    }

                                },
                                error: function() {
                                    alert('Error fetching data. Please try again.');
                                }
                            });
                            
                            // Reset counters when the modal is hidden
                            $('#exampleModal').on('hidden.bs.modal', function () {
                                window.apCounterUpdate = 1;
                                window.obCounterUpdate = 1;
                                $('.inp-group-ap-update').empty();
                                $('.inp-group-ob-update').empty();
                            });
                        });

                        $(document).on('click', '.deleteBtn', function(event) {
                            var table = $('#example').DataTable();
                            event.preventDefault();
                            var rao_id = $(this).data('rao_id');
                            console.log('RAO ID:', rao_id); 
                            if (confirm("Are you sure want to delete this rao Record ? ")) {
                                $.ajax({
                                    url: "delete.php",
                                    data: {
                                        rao_id: rao_id,
                                    },
                                    type: "post",
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        status = json.status;
                                        if (status == 'success') {
                                            $("#" + rao_id).closest('tr').remove();
                                        } else {
                                            alert('Failed');
                                            return;
                                        }
                                    }
                                });
                            } else {
                                return null;
                            }
                        })

                    </script>
                </section><!-- .home-->
                <!-- Modal -->
                <!-- Update RAO -->
                <section class="rao">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Report of Appropriations and Obligations (RAO)</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                            <div class="form-group" style="display: flex; justify-content: flex-start; align-items: center;">
                                <div style="margin-right: 15px;">
                                    <label for="period_covered" class="form-label" style="margin-right: 10px;">Period Covered:</label>
                                    <input type="number" id="period_covered_update" name="period_covered_update" max = "9999" min = 1700>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                            <div class="form-group">
                                <div class="wrap">
                                    <h3>Update Appropriations</h3>
                                    <a href="#" class="add_ap_update">+</a>
                                </div>
                                <div class="column-titles">
                                    <span>#</span>
                                    <span>Date</span>
                                    <span>Reference</span>
                                    <span>Particulars </span>
                                    <span>Salaries Wages</span>
                                    <span>Cash Gift P.E.I</span>
                                    <span>Year End Bonus</span>
                                    <span>Mid Year Pay</span>
                                    <span>S.R.I</span>
                                    <span>Others</span>
                                    <span>Action</span>
                                </div>

                                <div class="inp-group-ap-update">
                                    <!-- Populate in the form -->
                                    
                                </div>
                                
                                <!-- Dynamic Inputs Will Be Added Here -->
                            </div>

                            <div class="form-group">
                                <div class="wrap">
                                    <h3>Update Obligations</h3>
                                    <a href="#" class="add_ob_update">+</a>
                                </div>
                                <div class="column-titles">
                                    <span>#</span>
                                    <span>Date</span>
                                    <span>CHK/DV/PO No.</span>
                                    <span>Payee/ Particulars </span>
                                    <span>Salaries Wages</span>
                                    <span>Cash Gift P.E.I</span>
                                    <span>Year End Bonus</span>
                                    <span>Mid Year Pay</span>
                                    <span>S.R.I</span>
                                    <span>Others</span>
                                    <span>Action</span>
                                </div>

                                <div class="inp-group-ob-update">
                                    <!-- Populate in the form -->
                                    
                                </div>
                                
                                <!-- Dynamic Inputs Will Be Added Here -->
                            </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add RAO Record -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Report of Appropriations and Obligations (RAO)</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                            <div class="form-group" style="display: flex; justify-content: flex-start; align-items: center;">
                                <div style="margin-right: 15px;">
                                    <label for="period_covered" class="form-label" style="margin-right: 10px;">Period Covered:</label>
                                    <input type="number" id="period_covered" name="period_covered" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                            <div class="form-group">
                                <div class="wrap">
                                    <h3>Add Appropriations</h3>
                                    <a href="#" class="add_ap">+</a>
                                </div>
                                <div class="column-titles">
                                    <span>#</span>
                                    <span>Date</span>
                                    <span>Reference</span>
                                    <span>Particulars </span>
                                    <span>Salaries Wages</span>
                                    <span>Cash Gift P.E.I</span>
                                    <span>Year End Bonus</span>
                                    <span>Mid Year Pay</span>
                                    <span>S.R.I</span>
                                    <span>Others</span>
                                    <span>Action</span>
                                </div>

                                <div class="inp-group-ap">
                                    <!-- Populate in the form -->
                                    
                                </div>
                                
                                <!-- Dynamic Inputs Will Be Added Here -->
                            </div>

                            <div class="form-group">
                                <div class="wrap">
                                    <h3>Add Obligations</h3>
                                    <a href="#" class="add_ob">+</a>
                                </div>
                                <div class="column-titles">
                                    <span>#</span>
                                    <span>Date</span>
                                    <span>CHK/DV/PO No.</span>
                                    <span>Payee/ Particulars </span>
                                    <span>Salaries Wages</span>
                                    <span>Cash Gift P.E.I</span>
                                    <span>Year End Bonus</span>
                                    <span>Mid Year Pay</span>
                                    <span>S.R.I</span>
                                    <span>Others</span>
                                    <span>Action</span>
                                </div>

                                <div class="inp-group-ob">
                                    <!-- Populate in the form -->
                                    
                                </div>
                                
                                <!-- Dynamic Inputs Will Be Added Here -->
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </section>
    </body> 
    <script>
        //Today's Date Script
        // Set today's date to the input field with id="todayDate"
        document.getElementById('todayDate').value = new Date().toISOString().split('T')[0];
    </script>

    <script>
  document.addEventListener('DOMContentLoaded', function() {
    const periodCoveredInput = document.querySelector('#period_covered');
    const inpGroupAp = document.querySelector('.inp-group-ap');
    const inpGroupOb = document.querySelector('.inp-group-ob');

    // Function to format date as YYYY-MM-DD
    function formatDate(date) {
        return date.toISOString().split('T')[0];
    }

    // Function to parse date string to Date object
    function parseDate(dateString) {
        const [year, month, day] = dateString.split('-').map(Number);
        return new Date(year, month - 1, day);
    }

    // Function to update date inputs for a group
    function updateGroupDateInputs(group, inputName) {
        const selectedDate = new Date(periodCoveredInput.value);
        if (isNaN(selectedDate.getTime())) return;

        const year = selectedDate.getFullYear();
        const startOfYear = new Date(year, 0, 1);
        const endOfYear = new Date(year, 11, 31);

        const minDate = formatDate(startOfYear);
        const maxDate = formatDate(endOfYear);

        const dateInputs = group.querySelectorAll(`input[name="${inputName}"]`);
        dateInputs.forEach(input => {
            input.setAttribute('min', minDate);
            input.setAttribute('max', maxDate);

            // Add event listener for input changes
            input.addEventListener('change', function() {
                if (this.value) {
                    const currentDate = parseDate(this.value);
                    console.log(`${inputName} Date:`, currentDate);
                    if (currentDate < startOfYear || currentDate > endOfYear) {
                        console.log(`Date ${this.value} is outside the valid range for ${inputName} in year ${year}.`);
                        this.value = '';
                    }
                }
            });

            // Validate existing value
            if (input.value) {
                const currentDate = parseDate(input.value);
                console.log(`${inputName} Date:`, currentDate);
                if (currentDate < startOfYear || currentDate > endOfYear) {
                    console.log(`Date ${input.value} is outside the valid range for ${inputName} in year ${year}.`);
                    input.value = '';
                }
            }
        });
    }

    // Update date inputs for both AP and OB groups
    function updateDateInputs() {
        updateGroupDateInputs(inpGroupAp, 'ap_date_data[]');
        updateGroupDateInputs(inpGroupOb, 'ob_date_data[]');
    }

    // Event listener for period covered input change
    periodCoveredInput.addEventListener('change', updateDateInputs);

    // Add event listeners for adding new input groups
    document.querySelector('.add-ap').addEventListener('click', function(event) {
        event.preventDefault();
        add_ap_Input();
        updateDateInputs();
    });

    document.querySelector('.add-ob').addEventListener('click', function(event) {
        event.preventDefault();
        add_ob_Input();
        updateDateInputs();
    });

    // Initial call to set the correct date range
    updateDateInputs();

    // Mutation Observer to watch for dynamically added inputs
    const observerConfig = { childList: true, subtree: true };
    const observer = new MutationObserver(updateDateInputs);
    observer.observe(inpGroupAp, observerConfig);
    observer.observe(inpGroupOb, observerConfig);
});

    </script>
    <script>
        let apCounter = 1;

        document.querySelector('.add_ap').addEventListener('click', function(event) {
        event.preventDefault();
        add_ap_Input();
    });

        //dynamic input group
                // Remove an input group
        function remove_ap_Input(event) {
            event.preventDefault(); 
            event.stopPropagation(); // Prevent default link behavior
            if (confirm("Are you sure you want to remove this row?")) {
                // If the user confirms, remove the row
                event.target.parentElement.remove();
                update_ap_Counter();
            }
        }

        // Function to update the counters after a row is removed
        function update_ap_Counter() {
            const rows = document.querySelectorAll(".inp-group-ap .flex");
            let updatedCounter = 1;  // Start counter from 1 or any other base

            rows.forEach(function(row) {
                const label = row.querySelector("label");
                const hiddenInput = row.querySelector("input[type='hidden']");

                // Update the label text and hidden input value to match the new counter
                label.textContent = updatedCounter;
                hiddenInput.value = updatedCounter;

                updatedCounter++;  // Increment counter for the next row
            });

            // Update global counter to match the number of rows
            apCounter = updatedCounter;
        }

        // Add a new input group
        function add_ap_Input() {
            const newGroup = document.createElement("div");
            newGroup.classList.add("flex");

            const counter = document.createElement("label");
            counter.textContent = apCounter;

            const hiddenCounter = document.createElement("input");
            hiddenCounter.type = "hidden";
            hiddenCounter.name = "ap_counter[]";
            hiddenCounter.id = "ap_counter";
            hiddenCounter.value = apCounter;

            const date_data = document.createElement("input");
            date_data.type = "date";
            date_data.name = "ap_date_data[]";
            date_data.id = "ad_date_data";
            date_data.required = true;

            const reference = document.createElement("input");
            reference.type = "text";
            reference.name = "ap_reference[]";
            reference.id = "ap_reference";
            reference.required = false;

            const particulars = document.createElement("input");
            particulars.type = "text";
            particulars.name = "ap_particulars[]";
            particulars.id = "ap_particulars";
            particulars.required = false; 

            const ap_salary = document.createElement("input");
            ap_salary.type = "number";
            ap_salary.name = "ap_salary[]";
            ap_salary.id = "ap_salary";
            ap_salary.required = false;
            ap_salary.step = 0.001;
            ap_salary.min = 0.001;

            const ap_cash_gift = document.createElement("input");
            ap_cash_gift.type = "number";
            ap_cash_gift.name = "ap_cash_gift[]";
            ap_cash_gift.id = "ap_cash_gift";
            ap_cash_gift.required = false;
            ap_cash_gift.step = 0.001;
            ap_cash_gift.min = 0.001;

            const ap_year_end = document.createElement("input");
            ap_year_end.type = "number";
            ap_year_end.name = "ap_year_end[]";
            ap_year_end.id = "ap_year_end";
            ap_year_end.required = false;
            ap_year_end.step = 0.001;
            ap_year_end.min = 0.001;

            const ap_mid_year = document.createElement("input");
            ap_mid_year.type = "number";
            ap_mid_year.name = "ap_mid_year[]";
            ap_mid_year.id = "ap_mid_year";
            ap_mid_year.required = false;
            ap_mid_year.step = 0.001;
            ap_mid_year.min = 0.001;

            const ap_sri = document.createElement("input");
            ap_sri.type = "number";
            ap_sri.name = "ap_sri[]";
            ap_sri.id = "ap_sri";
            ap_sri.required = false;
            ap_sri.step = 0.001;
            ap_sri.min = 0.001;

            const ap_others = document.createElement("input");
            ap_others.type = "number";
            ap_others.name = "ap_others[]";
            ap_others.id = "ap_others";
            ap_others.required = false;
            ap_others.step = 0.001;
            ap_others.min = 0.001;


            // Create remove button
            const removeButton = document.createElement("a");
            removeButton.href = "#";
            removeButton.textContent = "X";
            removeButton.classList.add("delete");
            removeButton.onclick = remove_ap_Input;

            // Append elements to the new group
            newGroup.appendChild(counter);
            newGroup.appendChild(hiddenCounter);
            newGroup.appendChild(date_data);
            newGroup.appendChild(reference);
            newGroup.appendChild(particulars);
            newGroup.appendChild(ap_salary);
            newGroup.appendChild(ap_cash_gift);
            newGroup.appendChild(ap_year_end);
            newGroup.appendChild(ap_mid_year);
            newGroup.appendChild(ap_sri);
            newGroup.appendChild(ap_others);
            newGroup.appendChild(removeButton);

            // Add the new group to the form
            document.querySelector(".inp-group-ap").appendChild(newGroup);
            apCounter++;
        }
    </script>

    <script>
        let obCounter = 1;

        document.querySelector('.add_ob').addEventListener('click', function(event) {
        event.preventDefault();
        add_ob_Input();
    });

        //dynamic input group
                // Remove an input group
        function remove_ob_Input(event) {
            event.preventDefault(); 
            event.stopPropagation(); // Prevent default link behavior
            if (confirm("Are you sure you want to remove this row?")) {
                // If the user confirms, remove the row
                event.target.parentElement.remove();
                update_ob_Counter();
                console.log(obCounter);
            }
        }

        function update_ob_Counter() {
            const rows = document.querySelectorAll(".inp-group-ob .flex");
            let updatedCounter = 1;  // Start counter from 1 or any other base

            rows.forEach(function(row) {
                const label = row.querySelector("label");
                const hiddenInput = row.querySelector("input[type='hidden']");

                // Update the label text and hidden input value to match the new counter
                label.textContent = updatedCounter;
                hiddenInput.value = updatedCounter;

                updatedCounter++;  // Increment counter for the next row
            });

            // Update global counter to match the number of rows
            obCounter = updatedCounter;
        }

        // Add a new input group
        function add_ob_Input() {
            const newGroup = document.createElement("div");
            newGroup.classList.add("flex");

            const counter = document.createElement("label");
            counter.textContent = obCounter;

            const hiddenCounter = document.createElement("input");
            hiddenCounter.type = "hidden";
            hiddenCounter.name = "ob_counter[]";
            hiddenCounter.id = "ob_counter";
            hiddenCounter.value = obCounter;

            const date_data = document.createElement("input");
            date_data.type = "date";
            date_data.name = "ob_date_data[]";
            date_data.id = "ob_date_data";
            date_data.required = true;

            const reference = document.createElement("input");
            reference.type = "text";
            reference.name = "ob_reference[]";
            reference.id = "ob_reference";
            reference.required = false;

            const particulars = document.createElement("input");
            particulars.type = "text";
            particulars.name = "ob_particulars[]";
            particulars.id = "ob_particulars"
            particulars.required = false; 

            const ob_salary = document.createElement("input");
            ob_salary.type = "number";
            ob_salary.name = "ob_salary[]";
            ob_salary.id = "ob_salary"
            ob_salary.required = false;
            ob_salary.step = 0.001;
            ob_salary.min = 0.001;

            const ob_cash_gift = document.createElement("input");
            ob_cash_gift.type = "number";
            ob_cash_gift.name = "ob_cash_gift[]";
            ob_cash_gift.id = "ob_cash_gift";
            ob_cash_gift.required = false;
            ob_cash_gift.step = 0.001;
            ob_cash_gift.step = 0.001;

            const ob_year_end = document.createElement("input");
            ob_year_end.type = "number";
            ob_year_end.name = "ob_year_end[]";
            ob_year_end.id = "ob_year_end";
            ob_year_end.required = false;
            ob_year_end.step = 0.001;
            ob_year_end.min = 0.001;

            const ob_mid_year = document.createElement("input");
            ob_mid_year.type = "number";
            ob_mid_year.name = "ob_mid_year[]";
            ob_mid_year.id = "ob_mid_year";
            ob_mid_year.required = false;
            ob_mid_year.step = 0.001;
            ob_mid_year.min = 0.001;

            const ob_sri = document.createElement("input");
            ob_sri.type = "number";
            ob_sri.name = "ob_sri[]";
            ob_sri.id = "ob_sri";
            ob_sri.required = false;
            ob_sri.step = 0.001;
            ob_sri.min = 0.001;

            const ob_others = document.createElement("input");
            ob_others.type = "number";
            ob_others.name = "ob_others[]";
            ob_others.id = "ob_others";
            ob_others.required = false;
            ob_others.step = 0.001;
            ob_others.min = 0.001;

            // Create remove button
            const removeButton = document.createElement("a");
            removeButton.href = "#";
            removeButton.textContent = "X";
            removeButton.classList.add("delete");
            removeButton.onclick = remove_ob_Input;

            // Append elements to the new group
            newGroup.appendChild(counter);
            newGroup.appendChild(hiddenCounter);
            newGroup.appendChild(date_data);
            newGroup.appendChild(reference);
            newGroup.appendChild(particulars);
            newGroup.appendChild(ob_salary);
            newGroup.appendChild(ob_cash_gift);
            newGroup.appendChild(ob_year_end);
            newGroup.appendChild(ob_mid_year);
            newGroup.appendChild(ob_sri);
            newGroup.appendChild(ob_others);
            newGroup.appendChild(removeButton);

            // Add the new group to the form
            document.querySelector(".inp-group-ob").appendChild(newGroup);
            obCounter++;
        }
    </script>

    <script>

    document.querySelector('.add_ap_update').addEventListener('click', function(event) {
        event.preventDefault();
        add_ap_Input_update();
    });

    $(document).on('click', '.delete', function(event) {
        remove_ap_Input_Update(event);
        event.stopPropagation(); 
    });

        //dynamic input group
                // Remove an input group
        function remove_ap_Input_Update(event) {
            event.preventDefault();
            event.stopPropagation();  // Prevent default link behavior
            if (confirm("Are you sure you want to remove this row?")) {
                // If the user confirms, remove the row
                $(event.target).closest('.flex').remove();
                update_ap_Counter_update();
            }
        }

        // Function to update the counters after a row is removed
        function update_ap_Counter_update() {
            const rows = document.querySelectorAll(".inp-group-ap-update .flex");
            let updatedCounter = 1;  // Start counter from 1 or any other base

            rows.forEach(function(row) {
                const label = row.querySelector("label");
                const hiddenInput = row.querySelector("input[name='ap_counterUpdate[]']");

                // Update the label text and hidden input value to match the new counter
                label.textContent = updatedCounter;
                hiddenInput.value = updatedCounter;

                updatedCounter++;  // Increment counter for the next row
            });

            // Update global counter to match the number of rows
            apCounterUpdate = updatedCounter;
        }

        // Add a new input group
        function add_ap_Input_update() {
            const newGroup = document.createElement("div");
            newGroup.classList.add("flex");

            const counter = document.createElement("label");
            counter.textContent = apCounterUpdate;

            const hiddenCounter = document.createElement("input");
            hiddenCounter.type = "hidden";
            hiddenCounter.name = "ap_counterUpdate[]";
            hiddenCounter.id = "ap_counterUpdate";
            hiddenCounter.value = apCounterUpdate;

            const hidden_id = document.createElement("input");
            hidden_id.type = "hidden";
            hidden_id.name = "rao_ap_data_id[]";
            hidden_id.required = false;

            const date_data = document.createElement("input");
            date_data.type = "date";
            date_data.name = "ap_date_data_update[]";
            date_data.id = "ad_date_data_update";
            date_data.required = true;

            const reference = document.createElement("input");
            reference.type = "text";
            reference.name = "ap_reference_update[]";
            reference.id = "ap_reference_update";
            reference.required = false;

            const particulars = document.createElement("input");
            particulars.type = "text";
            particulars.name = "ap_particulars_update[]";
            particulars.id = "ap_particulars_update";
            particulars.required = false; 

            const ap_salary = document.createElement("input");
            ap_salary.type = "number";
            ap_salary.name = "ap_salary_update[]";
            ap_salary.id = "ap_salary_update";
            ap_salary.required = false;
            ap_salary.step = 0.001;
            ap_salary.min = 0.001;

            const ap_cash_gift = document.createElement("input");
            ap_cash_gift.type = "number";
            ap_cash_gift.name = "ap_cash_gift_update[]";
            ap_cash_gift.id = "ap_cash_gift_update";
            ap_cash_gift.required = false;
            ap_cash_gift.step = 0.001;
            ap_cash_gift.min = 0.001;

            const ap_year_end = document.createElement("input");
            ap_year_end.type = "number";
            ap_year_end.name = "ap_year_end_update[]";
            ap_year_end.id = "ap_year_end_update";
            ap_year_end.required = false;
            ap_year_end.step = 0.001;
            ap_year_end.min = 0.001;

            const ap_mid_year = document.createElement("input");
            ap_mid_year.type = "number";
            ap_mid_year.name = "ap_mid_year_update[]";
            ap_mid_year.id = "ap_mid_year_update";
            ap_mid_year.required = false;
            ap_mid_year.step = 0.001;
            ap_mid_year.min = 0.001;

            const ap_sri = document.createElement("input");
            ap_sri.type = "number";
            ap_sri.name = "ap_sri_update[]";
            ap_sri.id = "ap_sri_update";
            ap_sri.required = false;
            ap_sri.step = 0.001;
            ap_sri.min = 0.001;

            const ap_others = document.createElement("input");
            ap_others.type = "number";
            ap_others.name = "ap_others_update[]";
            ap_others.id = "ap_others_update";
            ap_others.required = false;
            ap_others.step = 0.001;
            ap_others.min = 0.001;


            // Create remove button
            const removeButton = document.createElement("a");
            removeButton.href = "#";
            removeButton.textContent = "X";
            removeButton.classList.add("delete");

            // Append elements to the new group
            newGroup.appendChild(counter);
            newGroup.appendChild(hiddenCounter);
            newGroup.appendChild(hidden_id);
            newGroup.appendChild(date_data);
            newGroup.appendChild(reference);
            newGroup.appendChild(particulars);
            newGroup.appendChild(ap_salary);
            newGroup.appendChild(ap_cash_gift);
            newGroup.appendChild(ap_year_end);
            newGroup.appendChild(ap_mid_year);
            newGroup.appendChild(ap_sri);
            newGroup.appendChild(ap_others);
            newGroup.appendChild(removeButton);

            // Add the new group to the form
            document.querySelector(".inp-group-ap-update").appendChild(newGroup);
            apCounterUpdate++;
        }
    </script>

<script>
    document.querySelector('.add_ob_update').addEventListener('click', function(event) {
        event.preventDefault();
        add_ob_Input_update();
    });
    // $(document).on('click', '.delete', function(event) {
    //     remove_ob_Input_Update(event);
    //     event.stopPropagation(); 
    // });


    function remove_ob_Input_Update(event) {
        event.preventDefault();
        event.stopPropagation();  // Prevent default link behavior
        if (confirm("Are you sure you want to remove this row?")) {
            // If the user confirms, remove the row
            $(event.target).closest('.flex').remove();
            update_ob_Counter_update();
        }
    }

    console.log("Event object:", event);
    function update_ob_Counter_update() {
        const rows = document.querySelectorAll(".inp-group-ob-update .flex");
        let updatedCounter = 1;  // Start counter from 1 or any other base

        rows.forEach(function(row) {
            const label = row.querySelector("label");
            const hiddenInput = row.querySelector("input[name='ob_counterUpdate[]']");

            // Update the label text and hidden input value to match the new counter
            label.textContent = updatedCounter;
            hiddenInput.value = updatedCounter;

            updatedCounter++;  // Increment counter for the next row
        });

        // Update global counter to match the number of rows
        obCounterUpdate = updatedCounter;
    }

        // Add a new input group
        function add_ob_Input_update() {
            const newGroup = document.createElement("div");
            newGroup.classList.add("flex");

            const counter = document.createElement("label");
            counter.textContent = obCounterUpdate;

            const hiddenCounter = document.createElement("input");
            hiddenCounter.type = "hidden";
            hiddenCounter.name = "ob_counterUpdate[]";
            hiddenCounter.id = "ob_counterUpdate";
            hiddenCounter.value = obCounterUpdate;

            const hidden_id = document.createElement("input");
            hidden_id.type = "hidden";
            hidden_id.name = "rao_ob_data_id[]";
            hidden_id.required = false;

            const date_data = document.createElement("input");
            date_data.type = "date";
            date_data.name = "ob_date_data_update[]";
            date_data.id = "ob_date_data_update";
            date_data.required = true;

            const reference = document.createElement("input");
            reference.type = "text";
            reference.name = "ob_reference_update[]";
            reference.id = "ob_reference_update";
            reference.required = false;

            const particulars = document.createElement("input");
            particulars.type = "text";
            particulars.name = "ob_particulars_update[]";
            particulars.id = "ob_particulars_update"
            particulars.required = false; 

            const ob_salary = document.createElement("input");
            ob_salary.type = "number";
            ob_salary.name = "ob_salary_update[]";
            ob_salary.id = "ob_salary_update"
            ob_salary.required = false;
            ob_salary.step = 0.001;
            ob_salary.min = 0.001;

            const ob_cash_gift = document.createElement("input");
            ob_cash_gift.type = "number";
            ob_cash_gift.name = "ob_cash_gift_update[]";
            ob_cash_gift.id = "ob_cash_gift_update";
            ob_cash_gift.required = false;
            ob_cash_gift.step = 0.001;
            ob_cash_gift.min = 0.001;

            const ob_year_end = document.createElement("input");
            ob_year_end.type = "number";
            ob_year_end.name = "ob_year_end_update[]";
            ob_year_end.id = "ob_year_end_update";
            ob_year_end.required = false;
            ob_year_end.step = 0.001;
            ob_year_end.min = 0.001;

            const ob_mid_year = document.createElement("input");
            ob_mid_year.type = "number";
            ob_mid_year.name = "ob_mid_year_update[]";
            ob_mid_year.id = "ob_mid_year_update";
            ob_mid_year.required = false;
            ob_mid_year.step = 0.001;
            ob_mid_year.min = 0.001;

            const ob_sri = document.createElement("input");
            ob_sri.type = "number";
            ob_sri.name = "ob_sri_update[]";
            ob_sri.id = "ob_sri_update";
            ob_sri.required = false;
            ob_sri.step = 0.001;
            ob_sri.min = 0.001;

            const ob_others = document.createElement("input");
            ob_others.type = "number";
            ob_others.name = "ob_others_update[]";
            ob_others.id = "ob_others_update";
            ob_others.required = false;
            ob_others.step = 0.001;
            ob_others.min = 0.001;


            // Create remove button
            const removeButton = document.createElement("a");
            removeButton.href = "#";
            removeButton.textContent = "X";
            removeButton.classList.add("delete");

            // Append elements to the new group
            newGroup.appendChild(counter);
            newGroup.appendChild(hiddenCounter);
            newGroup.appendChild(hidden_id);
            newGroup.appendChild(date_data);
            newGroup.appendChild(reference);
            newGroup.appendChild(particulars);
            newGroup.appendChild(ob_salary);
            newGroup.appendChild(ob_cash_gift);
            newGroup.appendChild(ob_year_end);
            newGroup.appendChild(ob_mid_year);
            newGroup.appendChild(ob_sri);
            newGroup.appendChild(ob_others);
            newGroup.appendChild(removeButton);

            // Add the new group to the form
            document.querySelector(".inp-group-ob-update").appendChild(newGroup);
            obCounterUpdate++;
        }
    </script>
</html>
