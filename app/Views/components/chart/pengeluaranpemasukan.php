<h1>Laporan Keuangan</h1>

<div class="row">
    <!-- Grafik Pembelian -->
    <div class="col-md-6">
        <h2>Grafik Pembelian</h2>
        <canvas id="purchaseChart" width="200" height="100"></canvas>
    </div>

    <!-- Grafik Penjualan -->
    <div class="col-md-6">
        <h2>Grafik Penjualan</h2>
        <canvas id="salesChart" width="200" height="100"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ambil data dari server
    var financialData = <?= json_encode($financialData) ?>;

    var dates = [];
    var totalBeli = [];
    var totalJual = [];

    // Memproses data
    financialData.forEach(function(item) {
        dates.push(item.tanggal);
        totalBeli.push(item.total_beli);
        totalJual.push(item.total_jual);
    });

    // Grafik Pembelian
    var purchaseCtx = document.getElementById('purchaseChart').getContext('2d');
    var purchaseChart = new Chart(purchaseCtx, {
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

    // Grafik Penjualan
    var salesCtx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [
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
