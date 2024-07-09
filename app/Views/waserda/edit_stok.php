<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>

<div class ="container mt-5">
<h2>Edit data Produk <?php echo $nama_barang ?></h2>
   <form action="<?= base_url('/waserda/update_stok/' . $stok['id_stok']) ?>" method="post">

    <div class="form-group">
        <label for="kuantitas">Jumlah Produk</label>
        <input type="number" class="form-control" id="kuantitas" name="kuantitas" value="<?php echo($stok['kuantitas']) ?>">
    </div>
    <div class="form-group">
        <label for="harga_beli">Harga Beli</label>
        <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?php echo($stok['harga_beli']) ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<?= $this->endSection() ?>