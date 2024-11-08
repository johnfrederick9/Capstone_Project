<?php
include '../../sidebar.php';
include '../../head.php';
require '../../database.php';
?>
<style>

.days {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
}

/* Day styling */
.calendar-event .day {
  padding: 10px;
  text-align: center;
  cursor: pointer;
  border-radius: 5px;
  transition: all 0.3s ease;
}

.calendar-event .dataTables_filter{
    margin-top: 15px;
}

.calendar-event .pagination{
    display:none;
}

.calendar-event .dataTables_filter label, .dataTables_info{
    color:black;
}


/* Disabled days (outside current month) */
.calendar-event .day.disabled {
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
                    <th>#</th>
                      <th>Event Name</th>
                      <th>Location</th>
                      <th>Type</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Buttons</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
          </table>
        </div>
        <?php include 'function.php'?>
        </section>
    </section>
    <section class="event">
    <!-- Modal for Updating Event -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Event</h5>
                <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateUser" method="POST" action="">
                <input type="hidden" name="event_id" id="event_id" value="">
                <input  type="hidden" name="trid" id="trid" value="">
                <div class="form-group">
                    <label for="event_name">Event Name:</label>
                    <input type="text" id="Fieldname" name="event_name" require>
                </div>
                <div class="form-group">
                    <label for="event_location">Event Location:</label>
                    <input type="text" id="Fieldlocation" name="event_location" require>
                </div>
                <div class="form-group">
                    <label for="event_type">Event Type:</label>
                    <input type="text" id="Fieldtype" name="event_type" require>
                </div>
                <div class="form-group">
                    <label for="event_start">Event Start:</label>
                    <input type="date" id="Fieldstart" name="event_start" readonly>
                </div>
                <div class="form-group">
                    <label for="event_end">Event End:</label>
                    <input type="date" id="Fieldend" name="event_end" readonly>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn primary-btn">Update Event</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
     <!-- Add Modal -->
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUser" method="POST" action="">
                    <div class="form-group">
                        <label for="event_name">Event Name:</label>
                        <input type="text" id="event_name" name="event_name" require>
                    </div>
                    <div class="form-group">
                        <label for="event_location">Event Location:</label>
                        <input type="text" id="event_location" name="event_location" require>
                    </div>
                    <div class="form-group">
                        <label for="event_type">Event Type:</label>
                        <input type="text" id="event_type" name="event_type" require>
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
                        <button type="submit" class="btn primary-btn">Save Event</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </section>
    <section class="delete-modal">
                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-body text-center">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Remove for you</h5>
                        <p>This data will be removed, Would you like to remove it ?</p>
                        <button type="button" class="btn btn-primary" id="confirmDeleteBtn">Remove</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../../assets/js/calendar.js"></script>
</body>
</html>
