<?php
include '../../sidebar.php';
include '../../head.php';
include 'event_code.php';
require '../../database.php';
?>
<style>
/* Days container styling */
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
        </section>
    </section>

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
