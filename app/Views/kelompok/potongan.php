<?= $this->extend('layout_kelompok') ?>
<?= $this->section('content') ?>

<div class="container pt-5">
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
    <h2 class="text-center">Daftar Potongan</h2>
        <!-- Tambah Data Button -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
    </div>
    <div class="table-responsive mx-auto" style="width: 50%;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Deskripsi</th>
                    <th>Nominal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($potongan)): ?>
                    <?php $currentPage = $pager->getCurrentPage(); ?>
                    <?php $perPage = $pager->getPerPage(); ?>
                    <?php foreach ($potongan as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1 + ($currentPage - 1) * $perPage ?></td>
                            <td><?= $row['deskripsi'] ?></td>
                            <td><?= $row['nominal'] ?></td>
                            <td>
                                <!-- Perlu di Edit -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $row['id_potongan_kelompok'] ?>" data-deskripsi="<?= $row['deskripsi'] ?>" data-nominal="<?= $row['nominal'] ?>">Edit</button>
                                <a href="<?= base_url('kelompok/hapus_potongan/' . $row['id_potongan_kelompok']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No data found</td>
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
            <form action="<?=base_url('kelompok/tambahpotongan') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Potongan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="number" class="form-control" id="nominal" name="nominal" required>
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
            <form action="<?= base_url('kelompok/edit_potongan') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Potongan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="editdeskripsi" name="deskripsi" required>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="number" class="form-control" id="editnominal" name="nominal" required>
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
        var deskripsi = button.getAttribute('data-deskripsi');
        var nominal = button.getAttribute('data-nominal');

        var modalBodyInputId = editModal.querySelector('#editId');
        var modalBodyInputDeskripsi = editModal.querySelector('#editdeskripsi');
        var modalBodyInputNominal = editModal.querySelector('#editnominal');

        modalBodyInputId.value = id;
        modalBodyInputDeskripsi.value = deskripsi;
        modalBodyInputNominal.value = nominal
    });
</script>
<?= $this->endSection() ?>
