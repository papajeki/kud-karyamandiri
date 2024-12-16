<div class="d-flex flex-column flex-shrink-0 p-3 text-white" style="background-color: #1B9C85;width:200px; height:50em;">
  <a href="<?= base_url('/index') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <img src="<?= base_url('image/logokoperasi.png') ?>" class="me-2" width="40" height="40">
    <span style="font-size: 14px;">Karya Mandiri</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto" style="gap: 2px;">
    <li class="nav-item navItem">
      <a href="<?= base_url('/admin') ?>"
        class="nav-link <?= ($_SERVER['REQUEST_URI'] === "/admin") ? 'active' : '' ?>"
        style="text-decoration:none;color:white;">
        <i class="fa-solid fa-house" style="color: #ffffff;"></i> Beranda
      </a>
    </li>
    <li class="nav-item navItem">
      <a href="<?= base_url('/admin/users') ?>"
        class="nav-link <?= ($_SERVER['REQUEST_URI'] === "/admin/users") ? 'active' : '' ?>"
        style="text-decoration:none;color:white;"> <i class="fa-solid fa-users" style="color: #ffffff;"></i>
        Karyawan
      </a>
    </li>
  </ul>
  <hr>
  <button class="btn btn-secondary" id="sidebar-close-button"><i class="fas fa-times"></i> Close</button>
</div>

<style>
  .navItem a:hover,
  .navItem a.active {
    background-color: #0d6efd !important;
    border-radius: 0.25rem;
  }
</style>
