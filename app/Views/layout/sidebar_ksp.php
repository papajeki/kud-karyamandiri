<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width:200px; height:50em;">
    <a href="<?= base_url('/index') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="<?= base_url('image/logokoperasi.png') ?>" class="me-2" width="40" height="40">
        <span style="font: size 12px;">Karya Mandiri</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto d-flex" style="gap: 2px;">
        <li class="nav-item navItem">
            <a style="text-decoration:none;color:white;" href="<?= base_url('/ksp') ?>"
            class="nav-link <?= ($_SERVER['REQUEST_URI']==="/ksp")? 'active' : '' ?>"><i class="fa-solid fa-house" style="color: #ffffff;"></i>
                Beranda
            </a>
        </li>
        <li class="nav-item navItem">
        <a style="text-decoration:none;color:white;" href="<?= base_url('/ksp/anggota') ?>"
            class="nav-link <?= ($_SERVER['REQUEST_URI']==="/ksp/anggota")? 'active' : '' ?>"><i class="fa-solid fa-user-large" style="color: #ffffff;"></i>
                Anggota
            </a>
        </li>
        <li class="ms-1"><button style="text-decoration:none;color:white;" class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
        <i class="fa-solid fa-wallet" style="color: #ffffff;"></i>
          Tabungan</button>
        <div class="collapse show" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li class="nav-item navItem ms-3"> <a href="<?=base_url('/ksp/tabungan_kapling') ?> " style="text-decoration:none;color:white;" 
            class="nav-link <?= ($_SERVER['REQUEST_URI']==="/ksp/tabungan_kapling")? 'active' : '' ?>"
            >
            Tabungan Kapling
            </a></li>
            <li class="nav-item navItem ms-3"><a style="text-decoration:none;color:white;" href="<?=base_url('/ksp/tabungan_umum') ?>" class="link-dark rounded<?php
            if($_SERVER['REQUEST_URI'] ==="/ksp/tabungan_umum"){
              echo ' nav-link active';
            }else{
              echo ' nav-link';
            }
          ?>">Tabungan Umum</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item navItem">
        <a href="<?=base_url('/ksp/pinjaman') ?>"
        class="nav-link <?= ($_SERVER['REQUEST_URI'] === "/ksp/pinjaman") ? 'active' : '' ?>"
        style="text-decoration:none;color:white;"
        ><i class="fa-solid fa-money-bill" style="color: #ffffff;"></i>
          Pinjaman
        </a>
      </li>
      <li class="nav-item navItem">
            <a href="<?= base_url('/ksp/pengaturan') ?>" 
            class="nav-link <?=($_SERVER['REQUEST_URI'] === "/ksp/pengaturan") ? 'active' : '' ?>"
            style="text-decoration: none; color:white;"><i class="fa-solid fa-gear" style="color: #ffffff;"></i>
          Pengaturan</a>
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
