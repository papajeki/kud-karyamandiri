<?= $this->extend('layout_ksp') ?>
<?= $this->section('content') ?>
<div class="container pt-5">
    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <i class="fa-solid fa-user" style="margin-right: 10px;"></i>
                    <h3>Pembayaran</h3>
                </div>
                <div class="card-body">
                    <p>Nama <?= ($anggota['surename'])?></p>
                    <form action="<?= base_url('ksp/pembayaran/' .$pinjaman['id_pinjaman']) ?>" method="post">
                    <div class="mb-2">
                    <label for="nominal_pembayaran" class="form-label">Nominal Pembayaran</label>
                    <input type="number" class="form-control" id="nominal_pembayaran" name="nominal_pembayaran" value="<?= $pinjaman['tagihan'] ?>" required title="Silakan isi kolom ini dengan benar">
                    </div>
                    <div class="mb-2">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Tuliskan deskripsi">
                    </div>
                    <div class="mb-2">
                    <label for="password">konfirmasi Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="masukkan sandi" required>
                    </div>
                    <button class="btn btn-success" type="submit">Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endsection() ?>