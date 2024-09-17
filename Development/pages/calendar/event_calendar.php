<?php
include '../../sidebar.php';
include '../../head.php';
require '../../database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $event_name = $_POST['event_name'] ?? '';
    $event_location = $_POST['event_location'] ?? '';
    $event_type = $_POST['event_type'] ?? '';
    $event_start = $_POST['event_start'] ?? '';
    $event_end = $_POST['event_end'] ?? '';

    // Debugging: Output captured form data
    echo "<pre>";
    echo "Event Name: $event_name\n";
    echo "Event Location: $event_location\n";
    echo "Event Type: $event_type\n";
    echo "Event Start: $event_start\n";
    echo "Event End: $event_end\n";
    echo "</pre>";

    // Validate and sanitize the input
    $event_name = $conn->real_escape_string($event_name);
    $event_location = $conn->real_escape_string($event_location);
    $event_type = $conn->real_escape_string($event_type);
    $event_start = $conn->real_escape_string($event_start);
    $event_end = $conn->real_escape_string($event_end);

    // Check if required fields are not empty
    if (!empty($event_name) && !empty($event_location) && !empty($event_type) && !empty($event_start) && !empty($event_end)) {
        // Insert data into database
        $sql = "INSERT INTO tb_event (event_name, event_location, event_type, event_start, event_end)
                VALUES ('$event_name', '$event_location', '$event_type', '$event_start', '$event_end')";

        if ($conn->query($sql) === TRUE) {
            
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: All fields are required.";
    }

    $conn->close();
}
?>

<html>
<body>
    <section class="home">
        <div class="calendar-event">
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
                            <div class="goto">
                                <input type="text" placeholder="mm/yyyy" class="date-input" />
                                <button class="goto-btn">Go</button>
                            </div>
                            <button class="today-btn">Today</button>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="label">Event Calendar</div>
                    <div class="today-date">
                        <div class="event-day">Wed</div>
                        <div class="event-date">12th June 2024</div>
                    </div>
                    <div class="events"></div>
                    <div class="add-event-wrapper">
                        <div class="add-event-header">
                            <div class="title">Add Event</div>
                        </div>
                        <form action="" method="post">
                            <div class="add-event-body">
                                <div class="add-event-input">
                                    <label for="event-name">Event Name:</label>
                                    <input type="text" name="event_name" placeholder="Enter Event Name" class="event-name" required />
                                </div>

                                <div class="add-event-input">
                                    <label for="event-location">Event Location:</label>
                                    <input type="text" name="event_location" placeholder="Enter Event Location" required />
                                </div>

                                <div class="add-event-input">
                                    <label for="event-type">Event Type:</label>
                                    <input type="text" name="event_type" placeholder="Enter Event Type" required />
                                </div>

                                <div class="add-event-input">
                                    <label for="event-start">Event Start:</label>
                                    <input type="time" name="event_start" class="event-time-from" required />

                                    <label for="event-end">Event End:</label>
                                    <input type="time" name="event_end" class="event-time-to" required />
                                </div>
                            </div>
                            <div class="add-event-footer">
                                <button type="submit" class="add-event-btn">Add Event</button>
                            </div>
                        </form>
                    </div>
                </div>
                <button class="add-event">
                    <i class="bx bx-plus"></i>
                </button>
            </div>
        </div>
                <!----===== Calendar JS ===== -->
                <script src="../../assets/js/calendar.js"></script>
    </section>
</body>
</html>
