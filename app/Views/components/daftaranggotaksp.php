<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nama Anggota</th>
                <th scope="col">NIK</th>
                <th scope="col">Kelompok Tani</th>
                <th scope="col">Nomor handphone</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($result)): ?>
                <?php foreach ($result as $anggota): ?>
            <tr>
                <td><?= $anggota['surename']; ?></td>
                <td><?= $anggota['nik']; ?></td>
                <td><?= $anggota['kelompok_tani']; ?></td>
                <td><?= $anggota['handphone']; ?></td>
                <td><div class="d-flex" style="gap:1em; justify-content: center;">
                            <button class="btn btn-primary edit-button" style="border-radius: 5px;" 
                                    data-bs-toggle="modal" data-bs-target="#editModal" 
                                    data-id="<?= $anggota['id_anggota']; ?>"
                                    data-nama="<?= $anggota['surename']; ?>"
                                    data-nik="<?= $anggota['nik']; ?>"
                                    data-kelompok="<?= $anggota['kelompok_tani']; ?>"
                                    data-hp="<?=  $anggota['handphone']; ?>">
                                Edit Data
                            </button></div></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
            <?= $pager->links('group1', 'bootstrap_pagination'); ?>
        </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="post">
                    <input type="hidden" name="id_anggota" id="id_anggota">
                    <div class="mb-3">
                        <label for="surename" class="form-label">Nama Anggota</label>
                        <input type="text" class="form-control" id="surename" name="surename">
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik">
                    </div>
                    <div class="mb-3">
                        <label for="kelompok_tani" class="form-label">Kelompok Tani</label>
                        <select class="form-select" aria-label="Default select example" id="kelompok_tani" name="kelompok_tani">
                        <?php foreach ($kelompok as $nilai): ?>
                        <option value="<?= esc($nilai['kelompok_tani']) ?>"><?= ($nilai['kelompok_tani']) ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="handphone" class="form-label">No handphone</label>
                        <input type="text" class="form-control" id="handphone" name="handphone">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        var editButtons = document.querySelectorAll('.edit-button');
        editButtons.forEach(function(button){
            button.addEventListener('click', function() {
                var id = button.getAttribute('data-id');
                var nama = button.getAttribute('data-nama');
                var nik = button.getAttribute('data-nik');
                var kelompok = button.getAttribute('data-kelompok');
                var hp = button.getAttribute('data-hp');

                document.getElementById('editForm').action = '<?= base_url('/ksp/edit_anggota/'); ?>' + id;
                document.getElementById('id_anggota').value = id;
                document.getElementById('surename').value = nama;
                document.getElementById('nik').value = nik;
                document.getElementById('kelompok_tani').value = kelompok;
                document.getElementById('handphone').value = hp;
            });
        });
    });
</script>
