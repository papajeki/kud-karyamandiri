<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h1>Pilih Rentan waktu Laporan</h1>

    <!-- Date Range Form for Sales Report -->
    <form id="dateRangeForm" method="post">
        <div class="mb-3">
            <label for="start_date" class="form-label">Tanggal Awal</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Tanggal Akhir</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>

    <!-- Sales Report Table -->
    <div id="salesReportSection" class="mt-5">
        <?php if (isset($salesReport)): ?>
            <h3>Laporan Penjualan <?= $start_date ?> to <?= $end_date ?></h3>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Terjual</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($salesReport)): ?>
                        <?php foreach ($salesReport as $item): ?>
                            <tr>
                                <td><?= $item['id_barang'] ?></td>
                                <td><?= $item['nama_barang'] ?></td>
                                <td><?= $item['total_jumlah'] ?></td>
                                <td><?= $item['total_earnings'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No sales data found for the selected date range</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
