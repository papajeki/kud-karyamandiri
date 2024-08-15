<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Card untuk produk dengan penjualan tertinggi -->
        <div class="col-lg-4 p-4" style="border-radius: 8px;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Top Penjualan
                </div>
                <div class="card-body">
                    <P><?= isset($topsell['nama_barang']) ? $topsell['nama_barang'] : 'Tidak ada data' ?></P>
                    <p>Nilai Penjualan : Rp<?= number_format($topsell['total_penjualan'], 2, ',', '.') ?></p>
                </div>
            </div>
        </div>
        <!-- Bagian untuk laporan keuangan -->
        <div class="col-lg-8 p-4" style="background-color: wheat; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h3 class="text-center mb-4">Laporan Keuangan 30 Hari Terakhir</h3>
            <?= $this->include('components/chart/pengeluaranpemasukan') ?> 
        </div>
    </div>
</div>

<?= $this->endSection() ?>
