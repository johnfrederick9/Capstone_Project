<div class="carousel-container">
    <!-- Carousel Wrapper -->
    <div class="carousel-slides">
        <!-- Slide 1: Educational Attainment -->
        <div class="carousel-item active">
            <div class="chart-wrapper">
                <h5>Residents Educational Attainment Distribution</h5>
                <canvas id="educationBarChart"></canvas>
            </div>
        </div>

        <!-- Slide 2: Age Distribution -->
        <div class="carousel-item">
            <div class="chart-wrapper">
                <h5>Residents Age Distribution</h5>
                <canvas id="ageHistogramChart"></canvas>
            </div>
        </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Defensive checks for PHP data
    var educationalData = <?php echo json_encode($educational_data ?? []); ?>;
    var ageData = <?php echo json_encode($age_data ?? []); ?>;
    var sexData = <?php echo json_encode($sex_data ?? []); ?>;

    // Chart 1: Educational Attainment Bar Chart
    if (educationalData.length > 0) {
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
    if (ageData.length > 0) {
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
                            text: 'Age Range'
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
        const offset = -currentIndex * 100; // Calculate offset for transform
        slides.style.transform = `translateX(${offset}%)`;
    }

    // Automatically change slides
    const interval = setInterval(() => {
        currentIndex = (currentIndex + 1) % items.length;
        updateCarousel();
    }, 5000); // Change slide every 5 seconds

    // Handle user clicks on charts
    slides.addEventListener('click', (event) => {
        const clickX = event.clientX;
        const containerWidth = slides.offsetWidth;
        clearInterval(interval); // Stop automatic cycling on user interaction

        if (clickX < containerWidth / 2) {
            // Left side clicked
            currentIndex = (currentIndex - 1 + items.length) % items.length;
        } else {
            // Right side clicked
            currentIndex = (currentIndex + 1) % items.length;
        }

        updateCarousel();
    });
});
</script>
