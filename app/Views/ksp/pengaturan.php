<?= $this->extend('layout_ksp') ?>
<?= $this->section('content') ?>
<div class="container pt-5">
    <div class="row">
        <div class="card col-sm-6 mb-3">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                Pengaturan Nominal Pinjaman
                <a href="<?= base_url('ksp/pengaturan-nominal') ?>" class="btn btn-light btn-sm ms-auto">
                    <i class="fas fa-cog"></i>
                </a>
            </div>
            <div class="card-body">Primary card</div>
        </div>
        <div class="card col-sm-6 mb-3">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                Pengaturan Durasi Pinjaman
                <a href="<?= base_url('ksp/pengaturan-tempo') ?>" class="btn btn-light btn-sm ms-auto">
                    <i class="fas fa-cog"></i>
                </a>
            </div>
            <div class="card-body">Primary card</div>
        </div>
        <div class="card col-sm-6 mb-3">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                Pengaturan Kelompok Tani
                <a href="<?= base_url('ksp/pengaturan-kelompok') ?>" class="btn btn-light btn-sm ms-auto">
                    <i class="fas fa-cog"></i>
                </a>
            </div>
            <div class="card-body">Primary card</div>
        </div>
    </div>
</div>

<?= $this->endsection() ?>