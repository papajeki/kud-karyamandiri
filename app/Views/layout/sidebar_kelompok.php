<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width:200px; height:50em;">
    <a href="<?= base_url('/index') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <img src="<?= base_url('image/logokoperasi.png') ?>" class="me-2" width="40" height="40">
      <span style="font: size 12px;">Karya Mandiri</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto d-flex" style="gap: 2px;">
      <li class="nav-item navItem">
        <a href="<?=base_url('/kelompok') ?>"
        class="nav-link <?= ($_SERVER['REQUEST_URI'] === "/kelompok") ? 'active' : '' ?>"
        style="text-decoration:none;color:white;"
        ><i class="fa-solid fa-house" style="color: #ffffff;"></i>
          Beranda
        </a>
      </li>
      <li class="nav-item navItem">
        <a href="<?=base_url('/kelompok/anggota') ?> " style="text-decoration:none;color:white;" 
          class="nav-link <?= ($_SERVER['REQUEST_URI']==="/kelompok/anggota")? 'active' : '' ?>"
           ><i class="fa-solid fa-suitcase" style="color: #ffffff;"></i>
          Anggota
        </a>
      </li>
      <li class="nav-item navItem"> 
        <a href="<?=base_url('/kelompok/panen') ?>" style="text-decoration:none;color:white;" 
        class="nav-link <?= ($_SERVER['REQUEST_URI']=== "/kelompok/panen") ? 'active' : ''?>"><i class="fa-solid fa-boxes-stacked" style="color: #ffffff;"></i>
          Panen
        </a>
      </li>
      <li class="nav-item navItem">
        <a href="<?= base_url('/kelompok/potongan') ?>" style="text-decoration: none; color:white;" class="nav-link <?= ($_SERVER['REQUEST_URI']==="/kelompok/potongan") ? 'active' : '' ?>"><i class="fa-solid fa-money-check-dollar" style="color: #ffffff;"></i> Potongan</a>
      </li>
    </ul>
    <button class="btn btn-secondary" id="sidebar-close-button"><i class="fas fa-times"></i> Close</button>
    <hr>
  </div>

  <style>
  .navItem a:hover,
  .navItem a.active {
    background-color: #0d6efd !important;
    border-radius: 0.25rem;
    }
  </style>
  