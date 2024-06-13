<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>

<div class ="container mt-5">
<h2>Edit data Produk <?php echo $barang['nama_barang'] ?></h2>
   <form action="<?= base_url('/waserda/update_barang/' . $barang['id_barang']) ?>" method="post">

    <div class="form-group">
        <label for="nama_barang">Nama Produk</label>
        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo($barang['nama_barang']) ?>">
    </div>
    <div class="form-group">
        <label for="barcode">Barcode</label>
        <input type="text" class="form-control" id="barcode" name="barcode" value="<?php echo($barang['barcode']) ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<?= $this->endSection() ?>