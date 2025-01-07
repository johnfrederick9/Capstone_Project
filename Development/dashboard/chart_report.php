<div class="carousel-container">
    <!-- Carousel Wrapper -->
    <div class="carousel-slides">
        <!-- Slide 1: Residents Educational Attainment -->
        <div class="carousel-item active">
            <div class="chart-wrapper">
                <h5>Residents Educational Attainment Distribution</h5>
                <canvas id="educationBarChart"></canvas>
            </div>
        </div>

        <!-- Slide 2: Residents Age Distribution -->
        <div class="carousel-item">
            <div class="chart-wrapper">
                <h5>Residents Age Distribution</h5>
                <canvas id="ageHistogramChart"></canvas>
            </div>
        </div>

        <!-- Slide 3: Employees Educational Attainment -->
        <div class="carousel-item">
            <div class="chart-wrapper">
                <h5>Employees Educational Attainment Distribution</h5>
                <canvas id="employeeEducationBarChart"></canvas>
            </div>
        </div>

        <!-- Slide 4: Employees Age Distribution -->
        <div class="carousel-item">
            <div class="chart-wrapper">
                <h5>Employees Age Distribution</h5>
                <canvas id="employeeAgeHistogramChart"></canvas>
            </div>
        </div>

        <!-- Slide 5: Blotter Status -->
        <div class="carousel-item">
            <div class="chart-wrapper">
                <h5>Blotter Status Distribution</h5>
                <canvas id="blotterStatusLineChart"></canvas>
            </div>
        </div>

        <!-- Slide 6: Project Status -->
        <div class="carousel-item">
            <div class="chart-wrapper">
                <h5>Project Status Distribution</h5>
                <canvas id="projectStatusLineChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fetch data from PHP
    var educationalData = <?php echo json_encode($educational_data ?? []); ?>;
    var ageData = <?php echo json_encode($age_data ?? []); ?>;
    var employeeEducationalData = <?php echo json_encode($employee_educational_data ?? []); ?>;
    var employeeAgeData = <?php echo json_encode($employee_age_data ?? []); ?>;
    var blotterStatusData = <?php echo json_encode($blotter_status ?? []); ?>;
    var projectStatusData = <?php echo json_encode($project_status ?? []); ?>;

       // Chart 1: Educational Attainment Bar Chart
       if (educationalData && educationalData.length > 0) {
        var eduLabels = educationalData.map(e => e.resident_educationalattainment);
        var eduData = educationalData.map(e => e.count);

        var ctxEdu = document.getElementById('educationBarChart').getContext('2d');
        new Chart(ctxEdu, {
            type: 'bar',
            data: {
                labels: eduLabels,
                datasets: [{
                    label: 'Number of Residents',
                    data: eduData,
                    backgroundColor: 'rgba(73, 196, 91, 0.5)',
                    borderColor: 'rgba(14, 230, 45)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
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
                }
            }
        });
    }

    // Chart 2: Age Distribution Histogram
    if (ageData && ageData.length > 0) {
        var ageLabels = ageData.map(e => e.age_range);
        var ageCounts = ageData.map(e => e.count);

        var ctxAge = document.getElementById('ageHistogramChart').getContext('2d');
        new Chart(ctxAge, {
            type: 'bar',
            data: {
                labels: ageLabels,
                datasets: [{
                    label: 'Number of Residents',
                    data: ageCounts,
                    backgroundColor: 'rgba(11, 236, 45, 0.5)',
                    borderColor: 'rgba(14, 230, 45)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
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
                            text: 'Age Range'
                        }
                    }
                }
            }
        });
    }
    // Chart 3: Employees Educational Attainment Bar Chart
    if (employeeEducationalData && employeeEducationalData.length > 0) {
        var empEduLabels = employeeEducationalData.map(e => e.employee_educationalattainment);
        var empEduData = employeeEducationalData.map(e => e.count);

        var ctxEmpEdu = document.getElementById('employeeEducationBarChart').getContext('2d');
        new Chart(ctxEmpEdu, {
            type: 'bar',
            data: {
                labels: empEduLabels,
                datasets: [{
                    label: 'Number of Employees',
                    data: empEduData,
                    backgroundColor: 'rgba(117, 255, 99, 0.5)',
                    borderColor: 'rgba(22, 187, 0, 0.5)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Employees'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Educational Attainment'
                        }
                    }
                }
            }
        });
    }

    // Chart 4: Employees Age Distribution Histogram
    if (employeeAgeData && employeeAgeData.length > 0) {
        var empAgeLabels = employeeAgeData.map(e => e.age_range);
        var empAgeCounts = employeeAgeData.map(e => e.count);

        var ctxEmpAge = document.getElementById('employeeAgeHistogramChart').getContext('2d');
        new Chart(ctxEmpAge, {
            type: 'bar',
            data: {
                labels: empAgeLabels,
                datasets: [{
                    label: 'Number of Employees',
                    data: empAgeCounts,
                    backgroundColor: 'rgba(89, 192, 75, 0.5)',
                    borderColor: 'rgba(0, 255, 34, 0.5)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Employees'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Age Range'
                        }
                    }
                }
            }
        });
    }

    // Chart 3: Blotter Status Line Graph
    if (blotterStatusData && blotterStatusData.length > 0) {
        var blotterLabels = blotterStatusData.map(e => e.blotter_status);
        var blotterCounts = blotterStatusData.map(e => e.count);

        var ctxBlotter = document.getElementById('blotterStatusLineChart').getContext('2d');
        new Chart(ctxBlotter, {
            type: 'line',
            data: {
                labels: blotterLabels,
                datasets: [{
                    label: 'Blotter Cases',
                    data: blotterCounts,
                    backgroundColor: 'rgba(54, 235, 84, 0.2)',
                    borderColor: 'rgb(54, 235, 136)',
                    borderWidth: 2,
                    tension: 0.4 // Makes the line smoother
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Cases'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Blotter Status'
                        }
                    }
                }
            }
        });
    }

    // Chart 4: Project Status Line Chart
    if (projectStatusData && projectStatusData.length > 0) {
        var projectLabels = projectStatusData.map(e => e.project_status);
        var projectCounts = projectStatusData.map(e => e.count);

        var ctxProject = document.getElementById('projectStatusLineChart').getContext('2d');
        new Chart(ctxProject, {
            type: 'line',
            data: {
                labels: projectLabels,
                datasets: [{
                    label: 'Project Status',
                    data: projectCounts,
                    backgroundColor: 'rgba(115, 255, 102, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2,
                    tension: 0.4 // Smoothens the line
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Projects'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Project Status'
                        }
                    }
                }
            }
        });
    }

    // Carousel Functionality
    let currentIndex = 0;
    const slides = document.querySelector('.carousel-slides');
    const items = document.querySelectorAll('.carousel-item');

    function updateCarousel() {
        const offset = -currentIndex * 100;
        slides.style.transform = `translateX(${offset}%)`;
    }

    const interval = setInterval(() => {
        currentIndex = (currentIndex + 1) % items.length;
        updateCarousel();
    }, 5000);

    slides.addEventListener('click', (event) => {
        const clickX = event.clientX;
        const containerWidth = slides.offsetWidth;
        clearInterval(interval);

        if (clickX < containerWidth / 2) {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
        } else {
            currentIndex = (currentIndex + 1) % items.length;
        }

        updateCarousel();
    });
});
</script>
