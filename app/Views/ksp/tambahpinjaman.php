<?= $this->extend('layout_ksp') ?>
<?= $this->section('content') ?>
<div class="container pt-5">
    <h2>Tambahkan Pinjaman</h2>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="<?= base_url('/ksp/tambah_pinjaman') ?>" method="post" enctype="multipart/form-data" id="loanForm">
                <div class="mb-3">
                    <label for="id_anggota" class="form-label">Pilih Anggota</label>
                    <select class="form-select" aria-label="Pilih Peminjam" id="id_anggota" name="id_anggota">
                        <option value="null" selected>Pilih Peminjam</option>
                        <?php foreach($anggota as $member): ?>
                            <option value="<?= esc($member['id_anggota']) ?>"><?= esc($member['surename']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nominal_pinjaman" class="form-label">Nominal Pinjaman</label>
                    <select class="form-select" name="nominal_pinjaman" id="nominal_pinjaman">
                        <option value="null" selected>Pilih Nominal Pinjaman</option>
                        <?php foreach($nilai_pinjam as $nilai): ?>
                            <option value="<?= esc($nilai['nilai_pinjaman']) ?>"><?= esc(number_format($nilai['nilai_pinjaman'], 0,',','.')) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="angsuran" class="form-label">Lama Angsuran</label>
                    <select class="form-select" name="angsuran" id="angsuran">
                        <option value="null" selected>Pilih Lama Angsuran</option>
                        <?php foreach($tempo as $nilaitempo): ?>
                            <option value="<?= esc($nilaitempo['tempo']) ?>"><?= esc($nilaitempo['tempo']) ?> Bulan</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bunga" class="form-label">Bunga %</label>
                    <input type="number" class="form-control" id="bunga" name="bunga" value="1" readonly>
                </div>
                <div class="mb-3">
                    <label for="bukti_disetujui" class="form-label">Upload Bukti Persetujuan PDF</label>
                    <input class="form-control" type="file" id="bukti_disetujui" name="bukti_disetujui" required>
                    <div class="invalid-feedback" id="fileError" style="display: none;">
                        File harus berjenis .doc atau .pdf.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Pinjaman</button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('loanForm').addEventListener('submit', function(event) {
    var fileInput = document.getElementById('bukti_disetujui');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.doc|\.docx|\.pdf)$/i;
    var maxSize = 4 * 1024 * 1024; // 4MB in bytes

    // Check file extension
    if (!allowedExtensions.exec(filePath)) {
        event.preventDefault();
        document.getElementById('fileError').innerText = 'File harus berjenis .doc, .docx, atau .pdf.';
        document.getElementById('fileError').style.display = 'block';
        fileInput.classList.add('is-invalid');
    } 
    // Check file size
    else if (fileInput.files[0].size > maxSize) {
        event.preventDefault();
        document.getElementById('fileError').innerText = 'Ukuran file maksimal 4MB.';
        document.getElementById('fileError').style.display = 'block';
        fileInput.classList.add('is-invalid');
    } 
    // If both checks pass, remove error states
    else {
        fileInput.classList.remove('is-invalid');
        document.getElementById('fileError').style.display = 'none';
    }
});
</script>

<?= $this->endSection() ?>
