<div class="" style="width:100%;">
    <nav class="navbar navbar-expand-lg shadow-sm d-flex flex-row" style="width:100%;">
        <button class="btn btn-secondary" id="sidebar-toggle-button" data-bs-toggle="collapse" data-bs-target="#sidebarcollapse"> <i class="fas fa-bars"></i></button>
        <h1 style="padding-left:1.5rem;">Situs Terpadu KUD Karya Mandiri</h1>
        <div class="ms-auto me-2 d-flex" style="align-items:center;">
            <?= $this->include('svg/person') ?>
            <h2 style="padding-left:1rem; padding-right: 1rem;"><?php echo(session('surename')) ?></h2>
            <form action="<?= base_url('logout') ?>" method="post" onsubmit="return confirm('Are You Sure Logout?')">
                <button class="btn btn-danger" style="border-radius:5px;">Logout</button>
            </form>
        </div>
    </nav>
</div>
