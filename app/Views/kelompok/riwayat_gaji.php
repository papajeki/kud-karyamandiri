<?= $this->extend('layout_kelompok') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <p>Nama Anggota: <?= $anggota['surename'] ?></p>
                </div>
                <div class="card-body">
                    <p>Kelompok Tani: <?= $kelompok['kelompok_tani'] ?></p>
                    <p>Nomor Handphone: <?= $anggota['handphone'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive mx-auto" style="width: 80%;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kelompok</th>
                        <th>Hasil Panen</th>
                        <th>Potongan Kelompok</th>
                        <th>Potongan Waserda</th>
                        <th>Gaji Bersih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gaji as $item): ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($item['tanggal_penyaluran'])) ?></td>
                            <td><?= $kelompok['kelompok_tani'] ?></td>
                            <td>Rp <?= number_format($item['total_hasil_panen'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item['total_potongan'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item['total_credits'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item['total_gaji_bersih'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            <?= $pager->links('default', 'bootstrap_pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
