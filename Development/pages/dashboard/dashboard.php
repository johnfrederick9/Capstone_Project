<?php
include "../../sidebar.php";
include "../../head.php";
include "../../database.php";
include "dashboard_code.php";
?>
<body>
<section class="home">
    <div class="text">Dashboard</div>
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

                    </div>
                </div>
                <div>
            </section>
        </div>
    </div><!--dashboard-->
</section>
</body>
</html>
