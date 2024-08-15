<h1>Laporan Keuangan</h1>

<canvas id="financialChart" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('financialChart').getContext('2d');

    var financialData = <?= json_encode($financialData) ?>;

    var dates = [];
    var totalBeli = [];
    var totalJual = [];

    financialData.forEach(function(item) {
        dates.push(item.tanggal);
        totalBeli.push(item.total_beli);
        totalJual.push(item.total_jual);
    });

    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [
                {
                    label: 'Uang Keluar (Pembelian Stok)',
                    data: totalBeli,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'Uang Masuk (Penjualan)',
                    data: totalJual,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: false
                }
            ]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
