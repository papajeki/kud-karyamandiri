<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kode Barcode</th>
                <th scope="col">Harga Jual</th>
                <th scope="col" style="text-align:center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($result)): ?>
                <?php foreach ($result as $index => $row): ?>
                <tr>
                    <th scope="row"><?= $index + 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage(); ?></th>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['barcode']; ?></td>
                    <td><?= $row['harga_jual']; ?></td>
                    <td>
                        <div class="d-flex" style="gap:1em; justify-content: center;">
                            <button class="btn btn-primary edit-button" style="border-radius: 5px;" 
                                    data-bs-toggle="modal" data-bs-target="#editModal" 
                                    data-id="<?= $row['id_barang']; ?>"
                                    data-nama="<?= $row['nama_barang']; ?>"
                                    data-barcode="<?= $row['barcode']; ?>"
                                    data-harga="<?= $row['harga_jual']; ?>">
                                Edit Data Produk
                            </button>
                            <form action="<?= base_url('/waserda/stok_barang/' .$row['id_barang']) ?>" method="post">
                                <button onclick="" class="btn btn-success" style="border-radius: 5px;" type="submit">Stok Barang</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Pagination Links -->
<div class="d-flex justify-content-center">
    <?= $pager->links() ?>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="post">
                    <input type="hidden" name="id_barang" id="id_barang">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                    </div>
                    <div class="mb-3">
                        <label for="barcode" class="form-label">Kode Barcode</label>
                        <input type="text" class="form-control" id="barcode" name="barcode">
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<!-- JavaScript to populate and handle the modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = button.getAttribute('data-id');
                var nama = button.getAttribute('data-nama');
                var barcode = button.getAttribute('data-barcode');
                var harga = button.getAttribute('data-harga');

                document.getElementById('editForm').action = '<?= base_url('/waserda/edit_harga_produk/'); ?>' + id;
                document.getElementById('id_barang').value = id;
                document.getElementById('nama_barang').value = nama;
                document.getElementById('barcode').value = barcode;
                document.getElementById('harga_jual').value = harga;
            });
        });
    });
</script>