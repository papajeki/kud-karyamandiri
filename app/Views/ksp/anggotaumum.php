<?= $this->extend('layout_ksp') ?>
<?= $this->section('content') ?>
<div class="d-flex" style="margin:1em;">
    <!-- search -->
    <form class="d-flex" action="<?= base_url('ksp/anggotaumum')?>" method="get">
        <input class="form-control me-2" type="search" name="q" placeholder="Search" aria-label="Search" style="border-radius: 12em;" value="<?= isset($_GET['q']) ? esc($_GET['q']) : '' ?>">
        <button class="btn btn-outline-success" type="submit" style="border-radius: 12em;">Search</button>
    </form>

    <button class="btn btn-primary" type="submit" style="margin-inline-start: auto;">
        <a href="<?= base_url('ksp/tambahanggota')?>" style="text-decoration:none; color:white;">Tambah Anggota</a></button>
</div>

<?= $this->include('components/daftaranggotaksp') ?>
<?= $this->endsection() ?>