<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>
<div class="container mt-5 md-2">
    <h2>Tambahkan Stok Produk</h2>
        <form action="<?= base_url('/waserda/create_barang') ?>" method="post">
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>
            <div class="form-group">
                <label for="barcode">Barcode</label>
                <input type="text" class="form-control" id="barcode" name="barcode" required>
            </div>
            <div class="form-group">
                <label for="harga_jual">Harga Jual</label>
                <input type="text" class="form-control" id="harga_jual" name="harga_jual" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>


<div class="modal fade" id="addStokModal" tabindex="-1" aria-labelledby="addStokModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStokModalLabel">Add New Stok</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="stokForm" action="<?= base_url('/stok/insert_stok') ?>" method="post">
                            <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">
                            <div class="mb-3">
                                <label for="kuantitas" class="form-label">Kuantitas</label>
                                <input type="number" class="form-control" id="kuantitas" name="kuantitas" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga_beli" class="form-label">Harga Beli</label>
                                <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Stok</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>

<?= $this->endSection() ?>