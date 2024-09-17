<?php
include '../../head.php';
include '../../sidebar.php';
?>
<body>
    <section class="home">  
        <div class="inventory">
                <div class="table-container">
                    <div class="table-header">
                    <div class="head">
                            <h1>Employee Table</h1>
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
                        <th><button class="print-all-btn" title="Print All">
                                <i class="bx bx-printer"></i>
                            </button>
                        </th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Maiden Name</th>
                        <th>Address</th>
                        <th>Educational Attainment</th>
                        <th>Birth Date</th>
                        <th>Age</th>
                        <th>Status</th>
                        <th>Update</th>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div><!-- .table-container-->
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
                                "aTargets": [10]
                            }]
                        });

                        $('#selectAll').click(function() {
                            var checkedStatus = this.checked;
                            $('.row-checkbox').each(function() {
                                $(this).prop('checked', checkedStatus);
                            });
                        });

                        // Function to trigger the print dialog with the loaded HTML content
                        function printContentFromPage(url, ids = '') {
                            $.ajax({
                                url: url,
                                type: 'GET',
                                data: { ids: ids }, // Pass IDs if needed (for print_selected.php)
                                success: function(response) {
                                    // Create an iframe to print the content
                                    var iframe = document.createElement('iframe');
                                    iframe.style.position = 'absolute';
                                    iframe.style.width = '0px';
                                    iframe.style.height = '0px';
                                    iframe.style.border = 'none';
                                    document.body.appendChild(iframe);

                                    // Write the content into the iframe
                                    var doc = iframe.contentWindow.document;
                                    doc.open();
                                    doc.write(response);
                                    doc.close();

                                    // Trigger print dialog
                                    iframe.contentWindow.focus();
                                    iframe.contentWindow.print();

                                    // Remove iframe after printing
                                    document.body.removeChild(iframe);
                                },
                                error: function() {
                                    alert('Failed to load print content.');
                                }
                            });
                        }

                        // Print selected rows
                        $('.print-btn').click(function() {
                            var selectedIds = [];
                            $('.row-checkbox:checked').each(function() {
                                selectedIds.push($(this).val());
                            });

                            if (selectedIds.length > 0) {
                                var idsString = selectedIds.join(',');
                                printContentFromPage('print_selected.php', idsString); // Load and print content from print_selected.php
                            } else {
                                alert('Please select at least one row to print.');
                            }
                        });

                        // Print all rows
                        $('.print-all-btn').click(function() {
                            printContentFromPage('print_all.php'); // Load and print content from print_all.php
                        });
                    });
                        $(document).on('submit', '#addUser', function(e) {
                            e.preventDefault();
                            var employee_firstname = $('#employee_firstname').val();
                            var employee_middlename = $('#employee_middlename').val();
                            var employee_lastname = $('#employee_lastname').val();
                            var employee_maidenname = $('#employee_maidenname').val();
                            var employee_sex = $('#employee_sex').val();
                            var employee_suffixes = $('#employee_suffixes').val();
                            var employee_address = $('#employee_address').val();
                            var employee_educationalattainment = $('#employee_educationalattainment').val();
                            var employee_birthdate = $('#employee_birthdate').val();
                            var employee_age = $('#employee_age').val();
                            var employee_status = $('#employee_status').val();
                            var employee_householdrole = $('#employee_householdrole').val();
                            var household_id = $('#household_id').val();
                            if (employee_firstname != '' && employee_middlename != '' && employee_lastname != '' && employee_maidenname != '' && employee_sex != '' && employee_suffixes != '' && employee_address != '' && employee_educationalattainment != '' && employee_birthdate != '' && employee_age != '' && employee_status != '' && employee_householdrole != '' && household_id != '') {
                                $.ajax({
                                    url: "add.php",
                                    type: "post",
                                    data: {
                                        employee_firstname: employee_firstname,
                                        employee_middlename: employee_middlename,
                                        employee_lastname: employee_lastname,
                                        employee_maidenname: employee_maidenname,
                                        employee_sex: employee_sex,
                                        employee_suffixes: employee_suffixes,
                                        employee_address: employee_address,
                                        employee_educationalattainment: employee_educationalattainment,
                                        employee_birthdate: employee_birthdate,
                                        employee_age: employee_age,
                                        employee_status: employee_status,
                                        employee_householdrole: employee_householdrole,
                                        household_id: household_id,
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        if (status == 'true') {
                                            mytable = $('#example').DataTable();
                                            mytable.draw();
                                            $('#addUserModal').modal('hide');
                                        } else {
                                            alert('failed');
                                        }
                                    }
                                });
                            } else {
                                alert('Fill all the required fields');
                            }
                        });
                        $(document).on('submit', '#updateUser', function(e) {
                            e.preventDefault();
                            //var tr = $(this).closest('tr');
                            var employee_firstname = $('#fnameField').val();
                            var employee_middlename = $('#minameField').val();
                            var employee_lastname = $('#lnameField').val();
                            var employee_maidenname = $('#manameField').val();
                            var employee_sex = $('#sexField').val();
                            var employee_suffixes = $('#suffixesField').val();
                            var employee_address = $('#addressField').val();
                            var employee_educationalattainment = $('#educField').val();
                            var employee_birthdate = $('#birthField').val();
                            var employee_age = $('#ageField').val();
                            var employee_status = $('#statusField').val();
                            var employee_householdrole = $('#roleField').val();
                            var household_id = $('#idField').val();
                            var trid = $('#trid').val();
                            var employee_id = $('#employee_id').val();
                            if (employee_firstname != '' && employee_middlename != '' && employee_lastname != '' && employee_maidenname != '' && employee_sex != '' && employee_suffixes != '' && employee_address != '' && employee_educationalattainment != '' && employee_birthdate != '' && employee_age != '' && employee_status != '' && employee_householdrole != '' && household_id != '') {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: {
                                        employee_firstname: employee_firstname,
                                        employee_middlename: employee_middlename,
                                        employee_lastname: employee_lastname,
                                        employee_maidenname: employee_maidenname,
                                        employee_sex: employee_sex,
                                        employee_suffixes: employee_suffixes,
                                        employee_address: employee_address,
                                        employee_educationalattainment: employee_educationalattainment,
                                        employee_birthdate: employee_birthdate,
                                        employee_age: employee_age,
                                        employee_status: employee_status,
                                        employee_householdrole: employee_householdrole,
                                        household_id: household_id,
                                        employee_id: employee_id
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        if (status == 'true') {
                                            table = $('#example').DataTable();
                                            var button = '<td><div class= "buttons"> <a href="javascript:void();" data-id="'+ employee_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([employee_id, employee_firstname, employee_middlename, employee_lastname, employee_maidenname, employee_address, employee_educationalattainment, employee_birthdate, employee_age, employee_status, button]);
                                            $('#exampleModal').modal('hide');
                                        } else {
                                            alert('failed');
                                        }
                                    }
                                });
                            } else {
                                alert('Fill all the required fields');
                            }
                        });
                        $('#example').on('click', '.editbtn ', function(event) {
                        var table = $('#example').DataTable();
                        var trid = $(this).closest('tr').attr('id');
                        // console.log(selectedRow);
                        var employee_id = $(this).data('id');
                        $('#exampleModal').modal('show');

                        $.ajax({
                            url: "get_single_data.php",
                            data: {
                                employee_id: employee_id
                            },
                            type: 'post',
                            success: function(data) {
                                var json = JSON.parse(data);
                                $('#fnameField').val(json.employee_firstname);
                                $('#lnameField').val(json.employee_lastname);
                                $('#manameField').val(json.employee_maidenname);
                                $('#minameField').val(json.employee_middlename);
                                $('#sexField').val(json.employee_sex);
                                $('#suffixesField').val(json.employee_suffixes);
                                $('#addressField').val(json.employee_address);
                                $('#educField').val(json.employee_educationalattainment);
                                $('#birthField').val(json.employee_birthdate);
                                $('#ageField').val(json.employee_age);
                                $('#statusField').val(json.employee_status);
                                $('#roleField').val(json.employee_householdrole);
                                $('#idField').val(json.household_id);
                                $('#employee_id').val(employee_id);
                                $('#trid').val(trid);
                            }
                        })
                    });

                    </script>
                </section><!-- .home-->
                <!-- Modal -->
                <!-- Update employee -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update employee</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="employee_id" id="employee_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                            <div class="add">
                            <div class="form-grid">
                            <div class="input-wrapper">
                                <label for="Last Name" class="input-label">Last Name:</label>
                                <input type="text" placeholder="Last Name" id="lnameField" name="employee_lastname" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="First Name" class="input-label">First Name:</label>
                                <input type="text" placeholder="First Name" id="fnameField" name="employee_firstname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Middle Name" class="input-label">Middle Name:</label>
                                <input type="text" placeholder="Middle Name" id="minameField" name="employee_middlename" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Maiden Name" class="input-label">Maiden Name:</label>
                                <input type="text" placeholder="Maiden Name" id="manameField" name="employee_maidenname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Sex" class="input-label">Sex:</label>
                                <select id="sexField" class="input-field" name="employee_sex" require>
                                <option value="" disabled selected>Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="Suffixes" class="input-label">Suffixes:</label>
                                <select id="suffixesField" class="input-field" name="employee_suffixes" require>
                                    <option value="None">None</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                </select>
                            </div>

                            <div class="input-wrapper address">
                            <label for="" class="input-label">Address and Educational Attainment:</label>
                                <input type="text" placeholder= "Address" id="addressField" name="employee_address" class="input-field" require>
                                <select id="educField" name="employee_educationalattainment" class="input-field" require>
                                    <option value="" disabled selected>Education Attainment</option>
                                    <option value="Elementary">Elementary</option>
                                    <option value="High School, Undergraduate">High School, Undergrad</option>
                                    <option value="High School, Graduate">High School, Graduate</option>
                                    <option value="College, Undergrad">College, Undergrad</option>
                                    <option value="Vocational">Vocational</option>
                                    <option value="Bacherlor's Degree">Bacherlor's Degree</option>
                                    <option value="Master's Degree">Master's Degree</option>
                                    <option value="Doctorate Degree">Doctorate Degree</option>
                                </select> 
                            </div>
                            
                            <div class="input-wrapper ">
                            <label for="birthdate" class="input-label">Birth Date:</label>
                                <input type="date" id="birthField" name="employee_birthdate" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="status" class="input-label">Status:</label>
                                <select id="statusField" class="input-field" name="employee_status" require>
                                    <option value="" disabled selected>Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="age" class="input-label">Age:</label>
                                <input type="number" placeholder="Age" id="ageField" name="employee_age" class="input-field" require>
                            </div>
                            
                            <div class="input-wrapper">
                                <label for="householdrole" class="input-label">Household Role:</label>
                                <input type="text" placeholder="Household Role" id="roleField" name="employee_householdrole" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="householdid" class="input-label">Household ID:</label>
                                <input type="Number" placeholder="Household ID" id="idField" name="household_id" class="input-field" disabled>
                            </div>
                        </div>
                        </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add employee -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add employee</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                            <div class="add">
                            <div class="form-grid">
                            <div class="input-wrapper">
                                <label for="Last Name" class="input-label">Last Name:</label>
                                <input type="text" placeholder="Last Name" id="employee_lastname" name="employee_lastname" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="First Name" class="input-label">First Name:</label>
                                <input type="text" placeholder="First Name" id="employee_firstname" name="employee_firstname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Middle Name" class="input-label">Middle Name:</label>
                                <input type="text" placeholder="Middle Name" id="employee_middlename" name="employee_middlename" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Maiden Name" class="input-label">Maiden Name:</label>
                                <input type="text" placeholder="Maiden Name" id="employee_maidenname" name="employee_maidenname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Sex" class="input-label">Sex:</label>
                                <select id="employee_sex" class="input-field" name="employee_sex" require>
                                <option value="" disabled selected>Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="Suffixes" class="input-label">Suffixes:</label>
                                <select id="employee_suffixes" class="input-field" name="employee_suffixes" require>
                                    <option value="None">None</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                </select>
                            </div>

                            <div class="input-wrapper address">
                            <label for="" class="input-label">Address and Educational Attainment:</label>
                                <input type="text" placeholder= "Address" id="employee_address" name="employee_address" class="input-field" require>
                                <select id="employee_educationalattainment" name="employee_educationalattainment" class="input-field" require>
                                    <option value="" disabled selected>Education Attainment</option>
                                    <option value="Elementary">Elementary</option>
                                    <option value="High School, Undergraduate">High School, Undergrad</option>
                                    <option value="High School, Graduate">High School, Graduate</option>
                                    <option value="College, Undergrad">College, Undergrad</option>
                                    <option value="Vocational">Vocational</option>
                                    <option value="Bacherlor's Degree">Bacherlor's Degree</option>
                                    <option value="Master's Degree">Master's Degree</option>
                                    <option value="Doctorate Degree">Doctorate Degree</option>
                                </select> 
                            </div>
                            
                            <div class="input-wrapper ">
                            <label for="birthdate" class="input-label">Birth Date:</label>
                                <input type="date" id="employee_birthdate" name="employee_birthdate" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="status" class="input-label">Status:</label>
                                <select id="employee_status" class="input-field" name="employee_status" require>
                                    <option value="" disabled selected>Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="age" class="input-label">Age:</label>
                                <input type="number" placeholder="Age" id="employee_age" name="employee_age" class="input-field" require>
                            </div>
                            
                            <div class="input-wrapper">
                                <label for="householdrole" class="input-label">Household Role:</label>
                                <input type="text" placeholder="Household Role" id="employee_householdrole" name="employee_householdrole" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="householdid" class="input-label">Household ID:</label>
                                <input type="Number" placeholder="Household ID" id="household_id" name="household_id" class="input-field" require>
                            </div>
                        </div>
                        </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </body> 
</html>
