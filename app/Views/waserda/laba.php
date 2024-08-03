<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Laporan Laba</h2>

    <!-- Filter Form -->
    <form action="<?= base_url('/waserda/labapenjualan') ?>" method="get" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <select name="bulan" class="form-select">
                    <option value="" disabled selected>Pilih Bulan</option>
                    <?php foreach (range(1, 12) as $month): ?>
                        <option value="<?= $month ?>" <?= (isset($_GET['bulan']) && $_GET['bulan'] == $month) ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $month, 1)) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <select name="tahun" class="form-select">
                    <option value="" disabled selected>Pilih Tahun</option>
                    <?php for ($i = date('Y'); $i >= 2000; $i--): ?>
                        <option value="<?= $i ?>" <?= (isset($_GET['tahun']) && $_GET['tahun'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?= base_url('/waserda/labapenjualan') ?>" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <a href="<?= base_url('export-excel?bulan=' . (isset($_GET['bulan']) ? $_GET['bulan'] : '') . '&tahun=' . (isset($_GET['tahun']) ? $_GET['tahun'] : '')) ?>" class="btn btn-success mb-3">Export to Excel</a>


    <!-- Table Data -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Stok</th>
                <th>Nama Barang</th>
                <th>Kuantitas</th>
                <th>Harga Beli</th>
                <th>Total Modal</th>
                <th>Terjual</th>
                <th>Harga Jual</th>
                <th>Pendapatan</th>
                <th>Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($laba)) : ?>
                <?php $index = 0; ?>
                <?php foreach ($laba as $row): ?>
                    <tr>
                        <td><?= ++$index; ?></td>
                        <td><?= $row['id_stok'] ?></td>
                        <td><?= $row['nama_barang'] ?></td>
                        <td><?= $row['total_kuantitas'] ?></td>
                        <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                        <td><?= number_format($row['total_modal'], 2, ',', '.') ?></td>
                        <td><?= $row['total_terjual'] ?></td>
                        <td><?= number_format($row['harga_jual'], 2, ',', '.') ?></td>
                        <td><?= number_format($row['total_pendapatan'], 2, ',', '.') ?></td>
                        <td><?= number_format($row['total_keuntungan'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No data available</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
