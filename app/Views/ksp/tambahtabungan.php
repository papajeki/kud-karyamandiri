<?= $this->extend('layout_ksp') ?>
<?= $this->section('content') ?>

<div class="container pt-5">
    <h2>Tambahkan Tabungan</h2>
    <div class="row">
        <div class="container">
        <form action="<?= base_url('/ksp/bukutabungan') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="id_anggota">Pilih Anggota</label>
                <select class="form-select" aria-label="default select example" id="id_anggota" name="id_anggota" onchange="toggleJenisTabungan()">
                    <option value="null" selected>Pilih Anggota</option>
                    <?php foreach($anggota as $member): ?>
                        <option value="<?= esc($member['id_anggota']) ?>" data-kelompok="<?= esc($member['id_kelompok']) ?>"><?= esc($member['surename']) ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if(isset($validation) && $validation->hasError('id_anggota')): ?>
                    <div class="text-danger"><?= $validation->getError('id_anggota') ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group" id="jenisTabunganGroup" style="display: none;">
                <label for="jenis_tabungan">Jenis Tabungan</label>
                <select class="form-select" aria-label="default select example" id="jenis_tabungan" name="jenis_tabungan">
                    <option value="tabungan umum">Tabungan Umum</option>
                    <option value="tabungan kapling">Tabungan Kapling</option>
                </select>
                <?php if(isset($validation) && $validation->hasError('jenis_tabungan')): ?>
                    <div class="text-danger"><?= $validation->getError('jenis_tabungan') ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="saldo">Saldo</label>
                <input type="number" class="form-control" id="saldo" name="saldo" required>
                <?php if(isset($validation) && $validation->hasError('saldo')): ?>
                    <div class="text-danger"><?= $validation->getError('saldo') ?></div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Tabungan</button>
        </form>
        </div>
    </div>
</div>

<script>
function toggleJenisTabungan() {
    var anggotaSelect = document.getElementById('id_anggota');
    var selectedOption = anggotaSelect.options[anggotaSelect.selectedIndex];
    var kelompokTani = selectedOption.getAttribute('data-kelompok');

    var jenisTabunganGroup = document.getElementById('jenisTabunganGroup');
    if (kelompokTani && kelompokTani !== 'null') {
        jenisTabunganGroup.style.display = 'block';
    } else {
        jenisTabunganGroup.style.display = 'none';
    }
}
</script>

<?= $this->endsection() ?>
