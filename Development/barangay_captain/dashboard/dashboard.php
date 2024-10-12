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
margin-bottom: 10px;
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

    <!-- Reports Modal -->
    <section class="report-content">
        <div class="modal fade" id="ReportsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reports</h5>
                        <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="section-top">
                            <div class="projects">
                                <div class="projects-header">
                                    <h2>Residents Educational Attainment Distribution</h2>
                                </div>
                                <div class="chart-area-container">
                                    <canvas id="educationBarChart"></canvas>
                                </div>
                            </div>
                            <div class="reports">
                                <h2>Residents Age Distribution</h2>
                                <canvas id="doughnutChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Calendar JS -->
    <script src="../../assets/js/calendar(dashboard).js"></script>
    <?php include 'chart_report.php'; ?>
</body>
</html>
