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
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
</script>