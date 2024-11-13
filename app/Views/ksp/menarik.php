<?= $this->extend('layout_ksp') ?>
<?= $this->section('content') ?>
<div class="container pt-5">
    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <i class="fa-solid fa-user" style="margin-right: 10px;"></i>
                    <h3>Halaman Penarikan</h3>
                </div>
                <div class="card-body">
                    <p>Nama <?= esc($person['surename']) ?></p>
                    <form action="<?= base_url('ksp/tarik_transaksi/' .$buku['id_tabungan']) ?>" method="post">
                    <div class="mb-2">
                    <label for="jumlah">Nominal Menarik</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="masukkan nominal uang" required>
                    </div>
                    <div class="mb-2">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Tuliskan deskripsi">
                    </div>
                    <div class="mb-2">
                    <label for="password">konfirmasi Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="masukkan sandi" required>
                    </div>
                    <button class="btn btn-success" type="submit">Tarik Tunai</button>
                    </form>
                    <?php if(session()->getFlashdata('msg')):?>
                    <div class="card-footer">
                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?>
                    </div>
                    </div>
                <?php endif;?>
                </div>
            </div>
        </div>
    </div>
<?= $this->endsection() ?>