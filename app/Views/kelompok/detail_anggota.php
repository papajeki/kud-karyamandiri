<?= $this->extend('layout_kelompok') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
<div class="col-12 col-lg-5">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <i class="fa-solid fa-user" style="margin-right: 10px;"></i>
                    <h5>Profile Anggota</h5>     
                    <button class="btn btn-primary" type="submit" style="margin-inline-start: auto;">
                    <a href="<?= base_url('kelompok/gaji/' .$anggota['id_anggota'])?>" style="text-decoration:none; color:white;">Gajian</a></button>
                    <button class="btn btn-primary" type="submit" style="margin-inline-start: auto;">
                    <a href="<?= base_url('kelompok/riwayat_gaji/' .$anggota['id_anggota'])?>" style="text-decoration:none; color:white;">Histori</a></button>
                </div>
                <div class="card-body">
                <p>Nama : <?= $anggota['surename'] ?></p>
                <p>Kelompok : <?= $anggota['kelompok_tani'] ?></p>
                </div>
            </div>
</div>
    <div class="row mt-5">
        <div class="card m-2 col-lg-5">
                <div class="card-header d-flex align-items-center">
                    <h5><?= $currentMonth ?></h5>
                </div>
                <div class="card-body">
                    <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hasil (kg)</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($panen)): ?>
                            <?php foreach($panen as $row): ?>
                        <tr>
                        <td><?= $row['tanggal_panen'] ?></td>
                        <td><?= $row['berat_panen'] ?></td>
                        <td><?= $row['harga_tbs'] ?></td>
                        </tr>
                        <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="card m-2 col-lg-5">
                <div class="card-header d-flex align-items-center">
                    <h5><?= $previousMonth ?></h5>
                </div>
                <div class="card-body">
                    <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hasil (kg)</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($panen_lalu)): ?>
                            <?php foreach($panen_lalu as $row): ?>
                        <tr>
                        <td><?= $row['tanggal_panen'] ?></td>
                        <td><?= $row['berat_panen'] ?></td>
                        <td><?= $row['harga_tbs'] ?></td>
                        </tr>
                        <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
<?= $this->endsection() ?>