<?php
include "../../sidebar.php";
include "../../head.php";
include "../../database.php";
include "dashboard_code.php";
include 'reports_code.php';
?>
<body>
<section class="home">
    <div class="dashboard">
        <div class="dashboard-container">
            <header class="dashboard-header"></header>
            <section class="dashboard-content">
                <div class="section-top">
                    <div class="stats">
                        <div class="stat-card">
                            <h3><?php echo $residents_count; ?></h3>
                            <p>Residents</p>
                        </div>
                        <div class="stat-card">
                            <h3><?php echo $employee_count; ?></h3>
                            <p>Employees</p>
                        </div>
                        <div class="stat-card">
                            <h3><?php echo $document_count; ?></h3>
                            <p>Documents</p>
                        </div>
                        <div class="stat-card">
                            <h3><?php echo $project_count; ?></h3>
                            <p>Projects</p>
                        </div>
                        <div class="stat-card">
                            <h3><?php echo $certificate_count; ?></h3>
                            <p>Certificates</p>
                        </div>
                        <div class="stat-card">
                            <h3><?php echo $inventory_count; ?></h3>
                            <p>Inventory</p>
                        </div>
                        <div class="stat-card">
                            <h3><?php echo $financial_count; ?></h3>
                            <p>Financial</p>
                        </div>
                        <div class="stat-card">
                            <h3>0</h3>
                            <p>Household</sp>
                        </div>
                        <button href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#ReportsModal" class="add-popup">Graph Reports</button>
                    </div>
                </div>
                <div>
            </section>
        </div>
    </div><!--dashboard-->
</section>
            <!-- Reports -->
<!-- Add Resident -->
<section class="report-content">
<div class="modal fade" id="ReportsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Make the modal wide -->
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
</div>
</body>
<?php include 'chart_report.php';?>
</html>
