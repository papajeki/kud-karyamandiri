<?= $this->extend('layout_kelompok') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Input Gaji Anggota</h2>
    <H3>Kelompok : <?= $pengurus ?></H3>
    <form action="<?= base_url('/kelompok/panen') ?>" method="post">
<!--    <div class="form-group mt-2">
        <label for="anggota" class="form-label">Kelompok</label>
        <div class="col-sm-6">
        <select class="form-select" aria-label="default select example"  id="anggota" name="anggota" required>
                <option value="Bejo">MM1</option>
                <option value="Minto">MM2</option>
        </select>
        </div>
        </div> -->
        <div class="form-group mt-2">
        <label for="anggota" class="form-label">Anggota</label>
        <div class="col-sm-6">
        <select class="form-select" aria-label="default select example"  id="anggota" name="anggota" required>
        <option value="null" selected>Pilih Anggota</option>
                <?php foreach ($anggota as $value): ?>
                <option value="<?= esc($value['id_anggota']) ?>"><?= $value['surename'] ?></option>
                <?php endforeach ?>
        </select>
        </div>
        </div>
        <div class="form-group mt-2">
            <label for="tanggal_timbang">Tanggal ditimbang</label>
            <div class="col-sm-2">
            <input type="date" class="form-control" id="tanggal_timbang" name="tanggal_timbang" required>
            </div>
        </div>
        <div class="form-group mt-2">
        <label for="hasil">Input Hasil Kebun Kg</label>
        <div class="col-sm-6">
        <input type="number" class="form-control" id="hasil" name="hasil" required>
        </div>
        </div>
        <div class="form-group mt-2">
        <label for="harga">Input Harga Sawit</label>
        <div class="col-sm-6">
        <input type="number" class="form-control" id="harga" name="harga" required>
        </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
    </form>
</div>
<?= $this->endsection() ?>