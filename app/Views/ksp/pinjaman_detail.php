<?= $this->extend('layout_ksp') ?>
<?= $this->section('content') ?>

<div class="container pt-5 px-3">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <i class="fa-solid fa-user" style="margin-right: 10px;"></i>
                    <h3><?= esc($pinjaman['surename']) ?></h3>
                    <a href="<?= base_url('ksp/pembayaran/' .$pinjaman['id_pinjaman']) ?>" style="margin-inline-start: auto;">
                        <button class="btn btn-success">Pembayaran</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 col-lg-5">
                            <p>NIK <?= esc($pinjaman['nik']) ?></p>
                            <p>No Handphone: <?= esc($pinjaman['handphone']) ?></p>
                            <p>Kelompok tani: <?= esc($pinjaman['kelompok_tani']) ?></p>
                            <p>Bukti Disetujui: <a href="<?= base_url('download/' . esc($pinjaman['bukti_disetujui'])) ?>">Download</a></p>

                        </div>
                        <div class="col-8 col-lg-5">
                            <p>Status Pinjaman: <?= esc($pinjaman['status']) ?></p>
                            <p>Nominal Pinjaman: <?= esc(number_format($pinjaman['nominal_pinjaman'], 0, ',', '.')) ?></p>
                            <p>Lama Pembayaran: <?= esc($pinjaman['angsuran']) ?> Bulan</p>
                            <p>Total Bunga: <?= esc(($pinjaman['nominal_pinjaman'] / 100) * $pinjaman['angsuran']) ?></p>
                            <p>Tagihan Perbulan: Rp <?= esc(number_format(($pinjaman['nominal_pinjaman'] + ($pinjaman['nominal_pinjaman'] * $pinjaman['bunga'] / 100 * $pinjaman['angsuran'])) / $pinjaman['angsuran'], 2, ',', '.')) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pt-5">
    <?= $this->include('components/daftarpembayaran') ?>
</div>
<?= $this->endSection() ?>
