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
                    "aTargets": [0,1,2,3,4,5,6,7,8,9,10]
                }],
                // Event that triggers when the table is redrawn (pagination or search)
                "drawCallback": function() {
                    updateCheckboxStates();
                }
            });

            // Update checkbox state on page draw
            function updateCheckboxStates() {
                // Iterate through each row checkbox
                $('.row-checkbox').each(function() {
                    var id = $(this).val();
                    // If the ID is in the selected array, keep it checked
                    if (selectedIds.includes(id)) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
            }
                    // Print function (same as your original code)
                    function printContentFromPage(url, ids = '') {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: { ids: ids },
                    success: function(response) {
                        var iframe = document.createElement('iframe');
                        iframe.style.position = 'absolute';
                        iframe.style.width = '0px';
                        iframe.style.height = '0px';
                        iframe.style.border = 'none';
                        document.body.appendChild(iframe);

                        var doc = iframe.contentWindow.document;
                        doc.open();
                        doc.write(response);
                        doc.close();

                        iframe.contentWindow.focus();
                        iframe.contentWindow.print();

                        document.body.removeChild(iframe);
                    },
                    error: function() {
                        showAlert("Failed to load print content.", "alert-danger");
                    }
                });
            }

            // Select all checkboxes
            $('#selectAll').click(function() {
                var checkedStatus = this.checked;
                $('.row-checkbox').each(function() {
                    $(this).prop('checked', checkedStatus);

                    // Add or remove IDs from selectedIds array
                    var id = $(this).val();
                    if (checkedStatus) {
                        if (!selectedIds.includes(id)) {
                            selectedIds.push(id);
                        }
                    } else {
                        selectedIds = [];
                    }
                });
            });

            // Individual checkbox change event
            $('#example').on('change', '.row-checkbox', function() {
                var id = $(this).val();
                if ($(this).is(':checked')) {
                    if (!selectedIds.includes(id)) {
                        selectedIds.push(id);
                    }
                } else {
                    selectedIds = selectedIds.filter(item => item !== id);
                }
            });

            // Print selected rows
            $('.print-btn').click(function() {
                if (selectedIds.length > 0) {
                    var idsString = selectedIds.join(',');
                    printContentFromPage('print_selected.php', idsString);
                } else {
                    showAlert("Please select at least one row to print.", "alert-danger");
                }
            });

            // Print all rows
            $('.print-all-btn').click(function() {
                printContentFromPage('print_all.php');
            });

            // Function to show alert
            function showAlert(message, alertClass) {
                var alertDiv = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' + message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                alertDiv.css({
                    "position": "fixed",
                    "top": "10px",
                    "right": "10px",
                    "z-index": "9999",
                    "background-color": alertClass === "alert-danger" ? "#f8d7da" : "#d4edda",
                    "border-color": alertClass === "alert-danger" ? "#f5c6cb" : "#c3e6cb"
                });
                $("body").append(alertDiv);
                setTimeout(function() {
                    alertDiv.alert('close');
                }, 900);
            }
        });
            $(document).on('submit', '#addUser', function(e) {
                e.preventDefault();
                console.log("Add form submitted");

                var item_name = $('#itemname').val();
                var item_description = $('#itemdescription').val();
                var item_brand = $('#itembrand').val();
                var item_serialNo = $('#itemserialNo').val();
                var item_custodian = $('#itemcustodian').val();
                var item_count = $('#itemcount').val();
                var item_price = $('#itemprice').val();
                var item_year = $('#itemyear').val();
                var item_status = $('#itemstatus').val();
                var lendable_count = $('#lendablecount').val();

                if (item_name != '' && item_description != '' && item_count != '' && item_status != '' && item_custodian != '' && item_price != '' && lendable_count != '') {
                    $.ajax({
                        url: "add.php",
                        type: "post",
                        data: {
                            item_name: item_name,
                            item_description: item_description,
                            item_brand: item_brand,
                            item_serialNo: item_serialNo,
                            item_custodian: item_custodian,
                            item_count: item_count,
                            item_price: item_price,
                            item_year: item_year,
                            item_status: item_status,
                            lendable_count: lendable_count
                        },
                        success: function(data) {
                            console.log("Response:", data);
                            var json = JSON.parse(data);
                            var status = json.status;
                            console.log("Status:", status);

                            if (status == 'true') {
                                mytable = $('#example').DataTable();
                                mytable.draw();
                                $('#addUserModal').modal('hide');
                                showAlert("Item Added successfully.", "alert-success");
                                $('#addUser')[0].reset();  // Clear the form fields
                            } else {
                                showAlert("Failed to add item.", "alert-danger");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", error);
                        }
                    });
                } else {
                    showAlert("Fill all the required fields", "alert-danger");
                }
            });

            $(document).on('submit', '#updateUser', function(e) {
                e.preventDefault();
                //var tr = $(this).closest('tr');
                

                var item_name = $('#nameField').val();
                var item_description = $('#descriptionField').val();
                var item_brand = $('#brandField').val();
                var item_serialNo = $('#serialNoField').val();
                var item_custodian = $('#custodianField').val();
                var item_count = $('#countField').val();
                var item_price = $('#priceField').val();
                var item_year = $('#yearField').val();
                var item_status = $('#statusField').val();
                var lendable_count = $('#lendablecountField').val();

                var trid = $('#trid').val();
                var item_id = $('#item_id').val();

                console.log(trid);

                if (item_name != '' && item_description != '' && item_count != '' && item_status != '' && item_custodian != '' && item_price != '' && lendable_count != '') {
                    $.ajax({
                        url: "update.php",
                        type: "post",
                        data: {
                            item_name: item_name,
                            item_description: item_description,
                            item_brand: item_brand,
                            item_serialNo: item_serialNo,
                            item_custodian: item_custodian,
                            item_count: item_count,
                            item_price: item_price,
                            item_year: item_year,
                            item_status: item_status,
                            lendable_count: lendable_count,
                            item_id: item_id
                        },
                        success: function(data) {
                            console.log("Raw response data:", data);
                            var json = JSON.parse(data);
                            var status = json.status;
                            var available_count = json.available_count;
                            var item_amount = json.item_amount;

                            if (status == 'true') {
                                table = $('#example').DataTable();
                                var checkbox = '<td><input type="checkbox" class="row-checkbox" value="'+item_id+'"></td>';
                                var button = '<td><div class="dropdown"><button class="action-btn" onclick="toggleDropdown(this)">ACTIONS <i class="bx bx-chevron-down"></i></button><div class="dropdown-menu"><a href="javascript:void(0);" data-id="${employee_id}" class="dropdown-item update-btn editbtn"><i class="bx bx-edit"></i></a><a href="javascript:void(0);" data-id="${employee_id}" class="dropdown-item delete-btn deleteBtn"><i class="bx bx-trash"></i></a></div></div></td>';
                                var row = table.row("[id='" + trid + "']");
                                row.row("[id='" + trid + "']").data([item_id, checkbox, item_name, item_serialNo, item_custodian, item_count, item_price, item_amount, item_year, lendable_count, available_count , button]);
                                $('#exampleModal').modal('hide');
                                showAlert("Item update successfully.", "alert-success");
                            } else {
                                showAlert("Failed to Update item.", "alert-danger");
                            }
                        }
                    });
                } else {
                    showAlert("Fill all the required fields", "alert-danger");
                }
            });
            $('#example').on('click', '.editbtn ', function(event) {
            var table = $('#example').DataTable();
            var trid = $(this).closest('tr').attr('id');
            var item_id = $(this).data('id');
            $('#exampleModal').modal('show');

            $.ajax({
                url: "get_single_data.php",
                data: {
                    item_id: item_id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#nameField').val(json.item_name);
                    $('#descriptionField').val(json.item_description);
                    $('#brandField').val(json.item_brand); 
                    $('#serialNoField').val(json.item_serialNo); 
                    $('#custodianField').val(json.item_custodian); 
                    $('#countField').val(json.item_count);
                    $('#priceField').val(json.item_price); 
                    $('#yearField').val(json.item_year); 
                    $('#statusField').val(json.item_status);
                    $('#lendablecountField').val(json.lendable_count); 
                    $('#item_id').val(item_id);
                    $('#trid').val(trid); 
                }
            })
        });
        $(document).on('click', '.deleteBtn', function(event) {
        event.preventDefault();
        var item_id = $(this).data('id'); // Get item ID from data attribute
        var table = $('#example').DataTable();

        // Open the modal
        $('#deleteConfirmationModal').modal('show');

        // Handle the confirmation
        $('#confirmDeleteBtn').off('click').on('click', function() {
        $.ajax({
            url: "delete.php",
            type: "POST",
            data: { item_id: item_id },
            success: function(response) {
            var json = JSON.parse(response);
            if (json.status === 'success') {
                // Remove the row from DataTable
                table.row($(event.target).closest('tr')).remove().draw();
            } else {
                showAlert("Deletion Field", "alert-danger");
            }
            // Close the modal
            $('#deleteConfirmationModal').modal('hide');
            }
        });
        });
    });
    // Function to show alert
    function showAlert(message, alertClass) {
        var alertDiv = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' + message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        alertDiv.css({
            "position": "fixed",
            "top": "10px",
            "right": "10px",
            "z-index": "9999",
            "background-color": alertClass === "alert-danger" ? "#f8d7da" : "#d4edda",
            "border-color": alertClass === "alert-danger" ? "#f5c6cb" : "#c3e6cb"
        });
        $("body").append(alertDiv);
        setTimeout(function() { alertDiv.alert('close'); }, 900);
    }
    $(document).ready(function() {
    $('#example').on('click', '.viewbtn', function(event) {
        var table = $('#example').DataTable();
        var item_id = $(this).data('id');
        
        // Debugging: Check if item_id is found
        console.log("item ID:", item_id);
        
        if (!item_id) {
            console.error("item ID is not defined.");
            alert("item ID is missing. Please try again.");
            return;
        }

        $('#viewModal').modal('show');
        $.ajax({
            url: "fetch_details.php",
            data: {
                item_id: item_id
            },
            type: 'post',
            success: function(data) {
                console.log("AJAX data response:", data);
                try {
                    var json = JSON.parse(data);
                    $('#view_name').text(json.item_name || "N/A");
                    $('#view_description').text(json.item_description || "N/A");
                    $('#view_brand').text(json.item_brand || "N/A");
                    $('#view_SerialNo').text(json.item_serialNo || "N/A");
                    $('#view_custodian').text(json.item_custodian || "N/A");
                    $('#view_count').text(json.item_count || "N/A");
                    $('#view_price').text(json.item_price || "N/A");
                    $('#view_year').text(json.item_year || "N/A");
                    $('#view_status').text(json.item_status || "N/A");
                    $('#view_lendable').text(json.lendable_count || "N/A");
                } catch (e) {
                    console.error("JSON parsing error:", e);
                    alert("An error occurred while processing the data.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", error);
                alert("Failed to fetch details: " + error);
            }
        });
    });
});
</script>
<script>
 function toggleDropdown(button) {
    // Get the dropdown menu associated with the button
    var dropdownMenu = button.nextElementSibling;
    
    // Get the icon element in the button
    var icon = button.querySelector('i');

    // Toggle the display of the dropdown menu
    if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
        dropdownMenu.style.display = "flex"; // Show the menu as flex (horizontal layout)
        icon.classList.remove('bx-chevron-down');
        icon.classList.add('bx-chevron-up');
    } else {
        dropdownMenu.style.display = "none"; // Hide the menu
        icon.classList.remove('bx-chevron-up');
        icon.classList.add('bx-chevron-down');
    }
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.action-btn') && !event.target.closest('.dropdown')) {
        var dropdowns = document.getElementsByClassName("dropdown-menu");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "flex") {
                openDropdown.style.display = "none";

                // Reset the icon to down-arrow for each open button
                var icon = openDropdown.previousElementSibling.querySelector('i');
                icon.classList.remove('bx-chevron-up');
                icon.classList.add('bx-chevron-down');
            }
        }
    }
}
</script>
<script>
    // Add event listener for the Enter key when the modal is open
document.addEventListener('keydown', function(event) {
    const modalOpen = document.getElementById('deleteConfirmationModal').classList.contains('show');
    if (modalOpen && event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('confirmDeleteBtn').click();
    }
});
</script>