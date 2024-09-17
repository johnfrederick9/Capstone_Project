<?php
include '../../head.php';
include '../../sidebar.php';
?>
<body>
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
                            var resident_firstname = $('#resident_firstname').val();
                            var resident_middlename = $('#resident_middlename').val();
                            var resident_lastname = $('#resident_lastname').val();
                            var resident_maidenname = $('#resident_maidenname').val();
                            var resident_sex = $('#resident_sex').val();
                            var resident_suffixes = $('#resident_suffixes').val();
                            var resident_address = $('#resident_address').val();
                            var resident_educationalattainment = $('#resident_educationalattainment').val();
                            var resident_birthdate = $('#resident_birthdate').val();
                            var resident_age = $('#resident_age').val();
                            var resident_status = $('#resident_status').val();
                            var resident_householdrole = $('#resident_householdrole').val();
                            var household_id = $('#household_id').val();
                            if (resident_firstname != '' && resident_middlename != '' && resident_lastname != '' && resident_maidenname != '' && resident_sex != '' && resident_suffixes != '' && resident_address != '' && resident_educationalattainment != '' && resident_birthdate != '' && resident_age != '' && resident_status != '' && resident_householdrole != '' && household_id != '') {
                                $.ajax({
                                    url: "add.php",
                                    type: "post",
                                    data: {
                                        resident_firstname: resident_firstname,
                                        resident_middlename: resident_middlename,
                                        resident_lastname: resident_lastname,
                                        resident_maidenname: resident_maidenname,
                                        resident_sex: resident_sex,
                                        resident_suffixes: resident_suffixes,
                                        resident_address: resident_address,
                                        resident_educationalattainment: resident_educationalattainment,
                                        resident_birthdate: resident_birthdate,
                                        resident_age: resident_age,
                                        resident_status: resident_status,
                                        resident_householdrole: resident_householdrole,
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
                            var resident_firstname = $('#fnameField').val();
                            var resident_middlename = $('#minameField').val();
                            var resident_lastname = $('#lnameField').val();
                            var resident_maidenname = $('#manameField').val();
                            var resident_sex = $('#sexField').val();
                            var resident_suffixes = $('#suffixesField').val();
                            var resident_address = $('#addressField').val();
                            var resident_educationalattainment = $('#educField').val();
                            var resident_birthdate = $('#birthField').val();
                            var resident_age = $('#ageField').val();
                            var resident_status = $('#statusField').val();
                            var resident_householdrole = $('#roleField').val();
                            var household_id = $('#idField').val();
                            var trid = $('#trid').val();
                            var resident_id = $('#resident_id').val();
                            if (resident_firstname != '' && resident_middlename != '' && resident_lastname != '' && resident_maidenname != '' && resident_sex != '' && resident_suffixes != '' && resident_address != '' && resident_educationalattainment != '' && resident_birthdate != '' && resident_age != '' && resident_status != '' && resident_householdrole != '' && household_id != '') {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: {
                                        resident_firstname: resident_firstname,
                                        resident_middlename: resident_middlename,
                                        resident_lastname: resident_lastname,
                                        resident_maidenname: resident_maidenname,
                                        resident_sex: resident_sex,
                                        resident_suffixes: resident_suffixes,
                                        resident_address: resident_address,
                                        resident_educationalattainment: resident_educationalattainment,
                                        resident_birthdate: resident_birthdate,
                                        resident_age: resident_age,
                                        resident_status: resident_status,
                                        resident_householdrole: resident_householdrole,
                                        household_id: household_id,
                                        resident_id: resident_id
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        if (status == 'true') {
                                            table = $('#example').DataTable();
                                            var button = '<td><div class= "buttons"> <a href="javascript:void();" data-id="'+ resident_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([resident_id, resident_firstname, resident_middlename, resident_lastname, resident_maidenname, resident_address, resident_educationalattainment, resident_birthdate, resident_age, resident_status, button]);
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
                        var resident_id = $(this).data('id');
                        $('#exampleModal').modal('show');

                        $.ajax({
                            url: "get_single_data.php",
                            data: {
                                resident_id: resident_id
                            },
                            type: 'post',
                            success: function(data) {
                                var json = JSON.parse(data);
                                $('#fnameField').val(json.resident_firstname);
                                $('#lnameField').val(json.resident_lastname);
                                $('#manameField').val(json.resident_maidenname);
                                $('#minameField').val(json.resident_middlename);
                                $('#sexField').val(json.resident_sex);
                                $('#suffixesField').val(json.resident_suffixes);
                                $('#addressField').val(json.resident_address);
                                $('#educField').val(json.resident_educationalattainment);
                                $('#birthField').val(json.resident_birthdate);
                                $('#ageField').val(json.resident_age);
                                $('#statusField').val(json.resident_status);
                                $('#roleField').val(json.resident_householdrole);
                                $('#idField').val(json.household_id);
                                $('#resident_id').val(resident_id);
                                $('#trid').val(trid);
                            }
                        })
                    });
                    </script>
                </section><!-- .home-->
                <!-- Modal -->
                <!-- Update Resident -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Resident</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updateUser">
                                <input type="hidden" name="resident_id" id="resident_id" value="">
                                <input type="hidden" name="trid" id="trid" value="">
                                <div class="add">
                            <div class="form-grid">
                            <div class="input-wrapper">
                                <label for="Last Name" class="input-label">Last Name:</label>
                                <input type="text" placeholder="Last Name" id="lnameField" name="resident_lastname" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="First Name" class="input-label">First Name:</label>
                                <input type="text" placeholder="First Name" id="fnameField" name="resident_firstname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Middle Name" class="input-label">Middle Name:</label>
                                <input type="text" placeholder="Middle Name" id="minameField" name="resident_middlename" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Maiden Name" class="input-label">Maiden Name:</label>
                                <input type="text" placeholder="Maiden Name" id="manameField" name="resident_maidenname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Sex" class="input-label">Sex:</label>
                                <select id="sexField" class="input-field" name="resident_sex" require>
                                <option value="" disabled selected>Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="Suffixes" class="input-label">Suffixes:</label>
                                <select id="suffixesField" class="input-field" name="resident_suffixes" require>
                                    <option value="None">None</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                </select>
                            </div>

                            <div class="input-wrapper address">
                            <label for="" class="input-label">Address and Educational Attainment:</label>
                                <input type="text" placeholder= "Address" id="addressField" name="resident_address" class="input-field" require>
                                <select id="educField" name="resident_educationalattainment" class="input-field" require>
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
                                <input type="date" id="birthField" name="resident_birthdate" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="status" class="input-label">Status:</label>
                                <select id="statusField" class="input-field" name="resident_status" require>
                                    <option value="" disabled selected>Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="age" class="input-label">Age:</label>
                                <input type="number" placeholder="Age" id="ageField" name="resident_age" class="input-field" require>
                            </div>
                            
                            <div class="input-wrapper">
                                <label for="householdrole" class="input-label">Household Role:</label>
                                <input type="text" placeholder="Household Role" id="roleField" name="resident_householdrole" class="input-field" require>
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
            <!-- Add Resident -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Resident</h5>
                            <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" action="">
                            <div class="add">
                            <div class="form-grid">
                            <div class="input-wrapper">
                                <label for="Last Name" class="input-label">Last Name:</label>
                                <input type="text" placeholder="Last Name" id="resident_lastname" name="resident_lastname" class="input-field" require>
                            </div>
                            <div class="input-wrapper">
                                <label for="First Name" class="input-label">First Name:</label>
                                <input type="text" placeholder="First Name" id="resident_firstname" name="resident_firstname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Middle Name" class="input-label">Middle Name:</label>
                                <input type="text" placeholder="Middle Name" id="resident_middlename" name="resident_middlename" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Maiden Name" class="input-label">Maiden Name:</label>
                                <input type="text" placeholder="Maiden Name" id="resident_maidenname" name="resident_maidenname" class="input-field">
                            </div>
                            <div class="input-wrapper">
                                <label for="Sex" class="input-label">Sex:</label>
                                <select id="resident_sex" class="input-field" name="resident_sex" require>
                                <option value="" disabled selected>Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="Suffixes" class="input-label">Suffixes:</label>
                                <select id="resident_suffixes" class="input-field" name="resident_suffixes" require>
                                    <option value="None">None</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                </select>
                            </div>

                            <div class="input-wrapper address">
                            <label for="" class="input-label">Address and Educational Attainment:</label>
                                <input type="text" placeholder= "Address" id="resident_address" name="resident_address" class="input-field" require>
                                <select id="resident_educationalattainment" name="resident_educationalattainment" class="input-field" require>
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
                                <input type="date" id="resident_birthdate" name="resident_birthdate" class="input-field" require>
                            </div>

                            <div class="input-wrapper">
                                <label for="status" class="input-label">Status:</label>
                                <select id="resident_status" class="input-field" name="resident_status" require>
                                    <option value="" disabled selected>Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label for="age" class="input-label">Age:</label>
                                <input type="number" placeholder="Age" id="resident_age" name="resident_age" class="input-field" require>
                            </div>
                            
                            <div class="input-wrapper">
                                <label for="householdrole" class="input-label">Household Role:</label>
                                <input type="text" placeholder="Household Role" id="resident_householdrole" name="resident_householdrole" class="input-field" require>
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
