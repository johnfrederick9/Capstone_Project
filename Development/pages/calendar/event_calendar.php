<?php
include '../../sidebar.php';
include '../../head.php';
include 'event_code.php';
require '../../database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <title>Event Calendar</title>
    <style>
        /* Add basic styling for modal and calendar */
        /* ... Your styles here ... */
    </style>
</head>
<body>
    <section class="home">
        <div class="calendar-event">
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
                        <div class="goto">
                            <input type="text" placeholder="mm/yyyy" class="date-input" />
                            <button class="goto-btn">Go</button>
                        </div>
                        <button class="today-btn">Today</button>
                    </div>
                </div>
            </div>
        </div>
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
