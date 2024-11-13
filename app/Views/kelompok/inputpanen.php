<?= $this->extend('layout_kelompok') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Input Gaji Anggota</h2>
    <?php if (!empty($kelompok)): ?>
        <h3>Kelompok : <?= $kelompok['kelompok_tani'] ?></h3>
    <?php endif ?>
    
    <form action="<?= base_url('/kelompok/panen') ?>" method="post">
        <div class="form-group mt-2">
            <label for="anggota" class="form-label">Anggota</label>
            <div class="col-sm-6">
                <select class="form-select" id="anggota" name="anggota" required onchange="updateKelompok()">
                    <option value="null" selected>Pilih Anggota</option>
                    <?php foreach ($anggota as $value): ?>
                        <option value="<?= esc($value['id_anggota']) ?>" data-kelompok="<?= esc($value['id_kelompok']) ?>">
                            <?= esc($value['surename']) ?>
                        </option>
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

        <!-- Hidden input for id_kelompok -->
        <input type="hidden" name="id_kelompok" id="id_kelompok" value="">

        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
    </form>
</div>

<!-- Script to update id_kelompok based on selected anggota -->
<script>
    function updateKelompok() {
        var anggotaSelect = document.getElementById('anggota');
        var selectedOption = anggotaSelect.options[anggotaSelect.selectedIndex];
        var kelompokId = selectedOption.getAttribute('data-kelompok');
        
        document.getElementById('id_kelompok').value = kelompokId;
    }
</script>

<?= $this->endSection() ?>
