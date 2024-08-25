<div>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Nama Barang</th>
            <th scope="col">Tanggal Penyetokan</th>
            <th scope="col">Kuantitas</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Terjual</th>
            <th scope="col">Aaction</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($stokdata)): ?>
        <?php foreach ($stokdata as $stok): ?>
                <tr>
                    <td><?= $stok['nama_barang']; ?></td>
                    <td><?= $stok['tanggal']; ?></td>
                    <td><?= $stok['kuantitas']; ?></td>
                    <td><?= number_format( $stok['harga_beli'], 0, ',','.'); ?></td>
                    <td><?= $stok['terjual']; ?></td>
                    <td>
                    <div class="d-flex" style="gap:1em; justify-content: center;">
                        <form action="<?= base_url('/waserda/edit_stok/' .$stok['id_stok']) ?>" method="post">
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

<div class="modal fade" id="addStokModal" tabindex="-1" aria-labelledby="addStokModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStokModalLabel">Tambah Stok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="stokForm" action="<?= base_url('/waserda/restok') ?>" method="post">
                    <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">
                    <div class="mb-3">
                        <label for="kuantitas" class="form-label">Kuantitas</label>
                        <input type="number" class="form-control" id="kuantitas" name="kuantitas" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label">Harga Beli</label>
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli" min="100" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Stok Barang</button>
                </form>
            </div>
        </div>
    </div>
</div>
