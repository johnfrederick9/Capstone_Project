<?php
include "../../sidebar.php";
include "../../head.php";
include "../../database.php";
include "dashboard_code.php";
include 'reports_code.php';
?>
<style>
.calendar-navigation {
display: flex;
justify-content: center;
align-items: center;
margin-bottom: 5px;
}

.calendar-navigation h3 {
    margin: 0 20px;
    font-size: 1.5em;
}

.calendar-container .bx {
    font-size: 1.8em;
    cursor: pointer;
    color: #030303;
}

.calendar-container .bx:hover {
    color: #44c95a;
}

/* Calendar Container */
.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);  /* 7 columns for the days of the week */
    gap: 5px;
    padding: 10px;
}

.calendar-day {
    font-weight: bold;
    text-align: center;
    padding: 5px 0;
    background-color: #f0f0f0;
    border-radius: 5px;
}

/* Calendar Date Styling */
.calendar-date {
    text-align: center;
    padding: 10px;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    transition: background-color 0.3s ease;
}

/* Hover effect on all dates */
.calendar-date:hover {
    background-color: #f5f5f5;
}

/* Styling for dates with events */
.calendar-date.has-event {
    background-color: #cce5ff;
    border-color: #007bff;
    font-weight: bold;
    cursor: pointer; /* Pointer cursor for clickable dates */
}

/* Hover effect on dates with events */
.calendar-date.has-event:hover {
    background-color: #80bdff;
}

</style>
<body>
    <section class="home">
        <div class="dashboard">
            <div class="dashboard-container">
                <header class="dashboard-header"></header>
                <section class="dashboard-content">

                    <!-- Top Section: Status Cards -->
                    <div class="section-top">
                        <div class="stats">
                            <div class="stat-card">
                                <div class="stat-content">
                                    <div class="icon">
                                        <i class='bx bxs-user-plus '></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3><?php echo $residents_count; ?></h3>
                                        <p>Residents</p>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-content">
                                    <div class="icon">
                                        <i class="bx bx-group "></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3><?php echo $employee_count; ?></h3>
                                        <p>Employees</p>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-content">
                                    <div class="icon">
                                        <i class='bx bxs-folder '></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3><?php echo $document_count; ?></h3>
                                        <p>Documents</p>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-content">
                                    <div class="icon">
                                        <i class='bx bxs-chalkboard '></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3><?php echo $project_count; ?></h3>
                                        <p>Projects</p>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-content">
                                    <div class="icon">
                                        <i class='bx bxs-certification '></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3><?php echo $certificate_count; ?></h3>
                                        <p>Certificates</p>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-content">
                                    <div class="icon">
                                        <i class='bx bxs-briefcase '></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3><?php echo $inventory_count; ?></h3>
                                        <p>Inventory</p>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-content">
                                    <div class="icon">
                                        <i class='bx bxs-wallet '></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3><?php echo $financial_count; ?></h3>
                                        <p>Financial</p>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="stat-card">
                                <div class="stat-content">
                                    <div class="icon">
                                        <i class='bx bxs-home '></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3>0</h3>
                                        <p>Household</p>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                    </div>

                    <!-- Bottom Section: Calendar and Graph Report Button -->
                    <div class="section-bottom">
                    <div class="calendar-container">
                        <div class="calendar-header">
                            <h2>Calendar View</h2>
                        </div>
                        <div id="calendar">
                            <div class="calendar-navigation">
                                <i class='bx bx-left-arrow-circle' id="prevMonth"></i>
                                <h3>June</h3>
                                <i class='bx bx-right-arrow-circle' id="nextMonth"></i>
                            </div>
                            <div class="calendar-grid">
                                <div class="calendar-day">S</div>
                                <div class="calendar-day">M</div>
                                <div class="calendar-day">T</div>
                                <div class="calendar-day">W</div>
                                <div class="calendar-day">T</div>
                                <div class="calendar-day">F</div>
                                <div class="calendar-day">S</div>
                                <div class="calendar-date">1</div>
                                <!-- Add more dates as needed -->
                            </div>
                        </div>
                    </div>
                       <div class="graph-report-button">
                            <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#ReportsModal" class="add-popup">Resident Graph Reports</button>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </section>
    <?php include 'chart_report.php'; ?>

    <!-- Calendar JS -->
    <script src="../../assets/js/calendar(dashboard).js"></script>
</body>
</html>
