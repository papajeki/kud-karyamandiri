<?= $this->extend('layout_ksp') ?>
<?= $this->section('content') ?>

<div class="container pt-5">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <i class="fa-solid fa-user" style="margin-right: 10px;"></i>
                    <h3><?= esc($simpanan['surename']) ?></h3>
                </div>
                <div class="card-body">
                    <p>Nomor Handphone: <?= esc($simpanan['handphone']) ?></p>
                    <p>Saldo: <?= esc(number_format($simpanan['saldo'], 0, ',', '.')) ?></p>
                    <p>Status: <?= esc($simpanan['status']) ?></p>
                    <p>Jenis Tabungan: <?= esc($simpanan['jenis_tabungan']) ?></p>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('ksp/simpan_transaksi/' .$simpanan['id_tabungan']) ?>"><button class="btn btn-success">Deposit</button></a>
                    <a href="<?= base_url('ksp/tarik_transaksi/' .$simpanan['id_tabungan']) ?>"><button class="btn btn-danger">Tarik tunai</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-5">
    <?= $this->include('components/daftarriwayat') ?>
    </div>
</div>

<?= $this->endsection() ?>