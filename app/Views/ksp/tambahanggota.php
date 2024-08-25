<?= $this->extend('layout_ksp') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Tambahkan Anggota Baru</h2>
    <form action="<?= base_url('/ksp/tambahanggota') ?>" method="post">
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="number" class="form-control" id="nik" minlength="16" name="nik" required>
        </div>
        <div class="form-group">
            <label for="surename">Nama Lengkap</label>
            <input type="text" class="form-control" id="surename" name="surename" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="kelompok_tani">Kelompok</label>
            <select class="form-select" aria-label="Default select example" id="kelompok_tani" name="kelompok_tani">
                <option value="null" selected>Pilih Kelompok Tani</option>
            <?php foreach ($kelompok as $nilai): ?>
                <option value="<?= esc($nilai['kelompok_tani']) ?>"><?= ($nilai['kelompok_tani']) ?></option>
            <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="handphone">No. HP</label>
            <input type="number" class="form-control" id="handphone" name="handphone">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<?= $this->endsection() ?>
