<?php
include '../../sidebar.php';
include '../../head.php';
include 'event_code.php';
require '../../database.php';
?>
<style>
/* Days container styling */
.label {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.event-table {
  width: 100%;
  border-collapse: collapse;
}

.event-table th, .event-table td {
  padding: 10px;
  text-align: left;
  border: 1px solid #ddd;
}

.event-table th {
  background-color: #007bff;
  color: white;
}

.event-table tr:nth-child(even) {
  background-color: #f2f2f2;
}

.event-table tr:hover {
  background-color: #e0e0e0;
}

.days {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
}

/* Day styling */
.day {
  padding: 10px;
  text-align: center;
  cursor: pointer;
  border-radius: 5px;
  transition: all 0.3s ease;
}

/* Disabled days (outside current month) */
.day.disabled {
  color: #bfbfbf; /* Grey out the days outside the current month */
  cursor: default; /* No pointer cursor on disabled days */
}

/* Hover effect only for days in the current month */
.day:not(.disabled):hover {
  background-color: #e0e0e0;
}

/* Active selected day styling */
.day.active {
  background-color: #007bff;
  color: white;
  border-radius: 5px;
  border: 2px solid #0056b3; /* Border for active date */
}

/* Style for today's date */
.day.today {
  background-color: #e0e0e0;
  color: white;
  border-radius: 5px;
  border: 2px solid #0056b3;
}

/* Hover effect for today's date */
.day.today:not(.disabled):hover {
  background-color: #ffc107; /* Darker shade when hovering */
  cursor: pointer; /* Pointer cursor on hover */
}

/* Today button styling */
.today-btn {
  margin-top: 10px;
  padding: 5px 10px;
  cursor: pointer;
  border: none;
  background-color: #007bff;
  color: white;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.today-btn:hover {
  background-color: #0056b3;
}
</style>
<body>
    <section class="home">
        <section class="calendar-event">
            <div class="container">
            <div class="left">
                <div class="calendar">
                    <div class="month">
                        <i class='bx bx-chevron-left prev'></i>
                        <div class="date">June 2024</div>
                        <i class='bx bx-chevron-right next'></i>
                    </div>
                    <div class="weekdays">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="days"></div>
                    <div class="goto-today">
                        <button class="today-btn">Today</button>
                    </div>
                </div>
            </div>
            <div class="right">
            <table id="example" class="table-table">         
              <thead>
                  <tr>
                      <th>Event Name</th>
                      <th>Location</th>
                      <th>Type</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
          </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                // DataTable initialization
                var table = $('#example').DataTable({
                    "fnCreatedRow": function(nRow, aData, iDataIndex) {
                        $(nRow).attr('data-event-id', aData[0]); // Set row data attribute to event ID
                    },
                    'serverSide': true,
                    'processing': true,
                    'paging': true,
                    'order': [],
                    'ajax': {
                        'url': 'fetch_data.php',
                        'type': 'POST',
                    },
                    "columnDefs": [{
                        "orderable": false,
                        "targets": [4] // Adjust index as needed for columns that shouldn’t be sortable
                    }]
                });
            });
               $(document).on('submit', '#updateUser', function(e) {
                            e.preventDefault();
                            //var tr = $(this).closest('tr');
                            var document_name = $('#nameField').val();
                            var document_date = $('#dateField').val();
                            var document_info = $('#infoField').val();
                            var document_type = $('#typeField').val();
                            var trid = $('#trid').val();
                            var document_id = $('#document_id').val();
                            if (document_name != '' && document_date != '' && document_info != '' && document_type != '') {
                                $.ajax({
                                    url: "update.php",
                                    type: "post",
                                    data: {
                                        document_name: document_name,
                                        document_date: document_date,
                                        document_info: document_info,
                                        document_type: document_type,
                                        document_id: document_id
                                    },
                                    success: function(data) {
                                        var json = JSON.parse(data);
                                        var status = json.status;
                                        if (status == 'true') {
                                            table = $('#example').DataTable();
                                            var checkbox = '<input type="checkbox" class="row-checkbox" value="' +document_id+'">';
                                            var button = '<td><div class= "buttons"> <a href="javascript:void(0);" data-id="'+ document_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a><a href="javascript:void(0);" onclick="openViewModal(' + document_id +');" class="view-btn btn-sm viewbtn"><i class="bx bx-show"></i></div></td>';
                                            var row = table.row("[id='" + trid + "']");
                                            row.row("[id='" + trid + "']").data([checkbox, document_name, document_date, document_info, document_type, button]);
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
                        $(document).on('submit', '#UpdateForm', function(e) {
                        e.preventDefault();
                        
                        // Get values from the modal form fields
                        var event_name = $('#Fieldname').val();
                        var event_location = $('#Fieldlocation').val();
                        var event_type = $('#Fieldtype').val();
                        var event_start = $('#Fieldstart').val();
                        var event_end = $('#Fieldend').val();
                        var trid = $('#trid').val();
                        var event_id = $('#event_id').val();

                        // Ensure all fields are filled
                        if (event_name !== '' && event_location !== '' && event_type !== '' && event_start !== '' && event_end !== '') {
                            $.ajax({
                                url: "update.php",
                                type: "post",
                                data: {
                                    event_name: event_name,
                                    event_location: event_location,
                                    event_type: event_type,
                                    event_start: event_start,
                                    event_end: event_end,
                                    event_id: event_id
                                },
                                success: function(data) {
                                    var json = JSON.parse(data);
                                    var status = json.status;
                                    
                                    if (status === 'true') {
                                        table = $('#example').DataTable();
                                        // Update the specific row in the DataTable
                                        var row = table.row("[id='" + trid + "']");
                                        row.data([event_name, event_location, event_type, event_start, event_end]);

                                        // Hide the modal after updating
                                        $('#eventUser').modal('hide');
                                    } else {
                                        alert('Update failed');
                                    }
                                }
                            });
                        } else {
                            alert('Please fill all required fields');
                        }
                    });
                $('#example tbody').on('click', 'tr', function() {
                var table = $('#example').DataTable();
                var data = table.row(this).data();
                
                if (data) {
                    var event_id = $(this).data('id'); // Ensure this matches your event_id index
                    $('#eventUser').modal('show'); // Show the update modal

                    $.ajax({
                        url: "get_single_data.php",
                        type: 'post',
                        data: { event_id: event_id },
                        success: function(data) {
                            var json = JSON.parse(data);
                            $('#Fieldname').val(json.event_name);
                            $('#Fieldlocation').val(json.event_location);
                            $('#Fieldtype').val(json.event_type);
                            $('#Fieldstart').val(json.event_start);
                            $('#Fieldend').val(json.event_end);
                            $('#event_id').val(event_id);
                            $('#trid').val(trid);
                        }
                    });
                }
            });
</script>

        </section>
    </section>
     <!-- Modal for Updating Event -->
     <div class="modal fade" id="eventUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Event</h5>
                <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="UpdateForm" method="POST" action="">
                <input type="hidden" name="event_id" id="event_id" value="">
                <input  name="trid" id="trid" value="">
                <div class="form-group">
                    <label for="event_name">Event Name:</label>
                    <input type="text" id="Fieldname" name="event_name" required>
                </div>
                <div class="form-group">
                    <label for="event_location">Event Location:</label>
                    <input type="text" id="Fieldlocation" name="event_location" required>
                </div>
                <div class="form-group">
                    <label for="event_type">Event Type:</label>
                    <input type="text" id="Fieldtype" name="event_type" required>
                </div>
                <div class="form-group">
                    <label for="event_start">Event Start:</label>
                    <input type="date" id="Fieldstart" name="event_start">
                </div>
                <div class="form-group">
                    <label for="event_end">Event End:</label>
                    <input type="date" id="Fieldend" name="event_end">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn primary-btn">Update Event</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    <!-- Modal for Adding Event -->
    <section class="event">
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm" method="POST" action="">
                <div class="form-group">
                    <label for="event_name">Event Name:</label>
                    <input type="text" id="event_name" name="event_name" required>
                </div>
                <div class="form-group">
                    <label for="event_location">Event Location:</label>
                    <input type="text" id="event_location" name="event_location" required>
                </div>
                <div class="form-group">
                    <label for="event_type">Event Type:</label>
                    <input type="text" id="event_type" name="event_type" required>
                </div>
                <div class="form-group">
                    <label for="event_start">Event Start:</label>
                    <input type="date" id="event_start" name="event_start" readonly>
                </div>
                <div class="form-group">
                    <label for="event_end">Event End:</label>
                    <input type="date" id="event_end" name="event_end" readonly>
                </div>
                <div class="modal-footer">
                    <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="save_event" value="true">
                    <button type="submit" class="btn primary-btn">Save Event</button>
                    </form>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </section>
    <script src="../../assets/js/calendar.js"></script>
</body>
</html>
