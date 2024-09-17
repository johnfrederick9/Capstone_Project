// <script src="assets/js/chart.js"></script>


document.addEventListener('DOMContentLoaded', function () {
    const ctxBar = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
            datasets: [{
                label: 'Data',
                data: [30, 20, 40, 35, 50, 60, 55, 70, 45, 65, 80, 90],
                backgroundColor: '#44c95a',
                borderColor: '#44c95a',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
    const doughnutChart = new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: {
            labels: ['Blotter', 'Request', 'Yearly'],
            datasets: [{
                label: 'Reports',
                data: [40, 32, 28],
                backgroundColor: ['#44c95a', '#fbc02d', '#7986cb'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    const ctxLine = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023'],
            datasets: [{
                label: 'Yearly',
                data: [10, 20, 30, 40, 50, 60, 70, 80],
                backgroundColor: 'rgba(68, 201, 90, 0.2)',
                borderColor: '#44c95a',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
