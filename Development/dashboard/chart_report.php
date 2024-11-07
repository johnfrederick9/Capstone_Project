   <!-- Event Modal -->
<section class="eventmodal">
 <div id="customAlert" class="modal fade">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2 id="eventName"></h2>
            <p id="eventLocation"></p>
            <p id="eventType"></p>
            <p id="eventDate"></p>
        </div>
    </div>
</section>

   <!-- Reports Modal -->
   <section class="report-content">
        <div class="modal fade" id="ReportsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Graph Report</h5>
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
<script>
        // Data for Educational Attainment Bar Chart
        var educationalData = <?php echo json_encode($educational_data); ?>;

        var labels = educationalData.map(function(e) {
            return e.resident_educationalattainment;
        });

        var data = educationalData.map(function(e) {
            return e.count;
        });

        var ctxBar = document.getElementById('educationBarChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: labels, // Educational Attainment as x-axis labels
                datasets: [{
                    label: 'Number of Residents',
                    data: data,
                    backgroundColor: 'rgba(73, 196, 91, 0.5)',
                    borderColor: 'rgba(14, 230, 45,)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Residents'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Educational Attainment'
                        }
                    }
                },
                responsive: true
            }
        });

        // Data for Age Distribution Doughnut Chart
        var ageData = <?php echo json_encode($age_data); ?>;

        var ageLabels = ageData.map(function(e) {
            return e.age_range;
        });

        var ageCounts = ageData.map(function(e) {
            return e.count;
        });

        var ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
        var doughnutChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ageLabels, // Age range as labels
                datasets: [{
                    label: 'Number of Residents',
                    data: ageCounts,
                    backgroundColor: [
                        'rgba(14, 230, 45, 0.4)',
                        'rgba(6, 161, 29, 0.4)',
                        'rgba(38, 209, 63, 0.4)',
                        'rgba(67, 247, 93, 0.4)'
                    ],
                    borderColor: [
                        'rgba(14, 230, 45)',
                        'rgba(6, 161, 29)',
                        'rgba(38, 209, 63)',
                        'rgba(67, 247, 93)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
</script>