<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>
<div class="container mt-5 md-2">
    <h2>Tambahkan Produk Baru</h2>
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

<?= $this->endSection() ?>