document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: window.salesData.map(data => data.month_year),
            datasets: [{
                label: 'Monthly Sales',
                data: window.salesData.map(data => data.total_sales),
                backgroundColor: '#9a23fc',
                borderColor: '#030303',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        font: {
                            family: 'Poppins, sans-serif',
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            family: 'Poppins, sans-serif',
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            family: 'Poppins, sans-serif', 
                        }
                    }
                }
            }
        }
    });
});