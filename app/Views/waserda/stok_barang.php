<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>

<div class="d-flex" style="margin:1em;">
    <!-- search -->
    <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="border-radius: 12em;">
        <button class="btn btn-outline-success" type="submit" style="border-radius: 12em;">Search</button>
    </form>

    <button class="btn btn-primary" type="submit" style="margin-inline-start: auto;" data-bs-toggle="modal" data-bs-target="#addStokModal">Tambah Stok</button>
</div>




<?= $this->include('components/daftarstokbarang') ?>
<?= $this->endSection() ?>