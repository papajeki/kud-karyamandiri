<div class="" style="width:100%;">
  <nav class="navbar navbar-expand-lg shadow-sm d-flex flex-row" style="width:100%;">
    <h1 style="padding-left:1.5rem;">Situs Terpadu KUD Karya Mandiri</h1>
    <div class="ms-auto me-2 d-flex" style="align-items:center;" >
      <?= $this->include('svg/person') ?>
      <h2 style="padding-left:1rem; padding-right: 1rem;"><?php echo($surename) ?></h2>
        <form action="<?= base_url('logout') ?>" method="post" onsubmit="return confirm('Are You Sure Logout?')">
        <button class="btn btn-danger" style="border-radius:5px; ">Logout</button>
        </form>
    </div>
  </nav>
</div>