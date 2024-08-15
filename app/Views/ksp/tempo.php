<?= $this->extend('layout_ksp') ?>
<?= $this->section('content') ?>

<div class="container pt-5">
    <h2 class="text-center">Daftar Tempo Pinjaman</h2>
        <!-- Tambah Data Button -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
    </div>
    <div class="table-responsive mx-auto" style="width: 50%;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Durasi Tempo</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tempo)): ?>
                    <?php $currentPage = $pager->getCurrentPage(); ?>
                    <?php $perPage = $pager->getPerPage(); ?>
                    <?php foreach ($tempo as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1 + ($currentPage - 1) * $perPage ?></td>
                            <td><?= $row['tempo'] ?> Bulan</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $row['id_durasi_tempo'] ?>" data-tempo="<?= $row['tempo'] ?>">Edit</button>
                                <a href="<?= base_url('ksp/hapus_tempo/' . $row['id_durasi_tempo']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center">No data found</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        <?= $pager->links('default', 'bootstrap_pagination') ?>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('ksp/tambah_tempo') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Durasi Tempo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tempo" class="form-label">Durasi Tempo</label>
                        <input type="number" class="form-control" id="tempo" name="tempo" required>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('ksp/edit_tempo') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Durasi Tempo Pinjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="edittempo" class="form-label">Durasi Tempo</label>
                        <input type="number" class="form-control" id="edittempo" name="tempo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Handle edit modal show event
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var tempo = button.getAttribute('data-tempo');

        var modalBodyInputId = editModal.querySelector('#editId');
        var modalBodyInputTempo = editModal.querySelector('#edittempo');

        modalBodyInputId.value = id;
        modalBodyInputTempo.value = tempo;
    });
</script>
<?= $this->endSection() ?>


