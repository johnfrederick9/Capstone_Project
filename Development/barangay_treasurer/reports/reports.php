<?php
include '../sidebar.php';
include '../../head.php';
require '../database.php';
include '../../pages/reports/reports_code.php';
?>
<html>
 <body>
  <section class="home">
  <div class="text">Reports</div>
        <div class="report">
            <div class="report-container">
            <header class="report-header">
            </header>
            <section class="report-content">
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
            </section>
        </div>
        </div><!--report-->
        <?php include '../../pages/reports/chart_report.php';?>
  </section>
  </body>
</html>