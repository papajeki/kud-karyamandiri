<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width:200px; height:50em;">
    <a href="<?= base_url('/index') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <img src="<?= base_url('image/logokoperasi.png') ?>" class="me-2" width="40" height="40">
      <span style="font: size 12px;">Karya Mandiri</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto d-flex" style="gap: 2px;">
      <li class="nav-item navItem">
        <a href="<?=base_url('/waserda') ?>"
        class="nav-link <?= ($_SERVER['REQUEST_URI'] === "/waserda") ? 'active' : '' ?>"
        style="text-decoration:none;color:white;"
        ><i class="fa-solid fa-house" style="color: #ffffff;"></i>
          Beranda
        </a>
      </li>
      <li class="nav-item navItem">
        <a href="<?=base_url('/waserda/kasir') ?> " style="text-decoration:none;color:white;" 
          class="nav-link <?= ($_SERVER['REQUEST_URI']==="/waserda/kasir")? 'active' : '' ?>"
           ><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i>
          Kasir Waserda
        </a>
      </li>
      <li class="nav-item navItem"> 
        <a href="<?=base_url('/waserda/barang') ?>" style="text-decoration:none;color:white;" 
        class="nav-link <?= ($_SERVER['REQUEST_URI']=== "/waserda/barang") ? 'active' : ''?>"><i class="fa-solid fa-boxes-stacked" style="color: #ffffff;"></i>
          Data Barang
        </a>
      </li>
      <li class="nav-item navItem ms-1"><button style="text-decoration:none;color:white;" class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
      <i class="fa-solid fa-receipt" style="color: #ffffff;"></i>
          Data Penjualan</button>
        <div class="collapse show" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li class="nav-item navItem ms-3"><a style="text-decoration:none;color:white;" href="<?=base_url('/waserda/data_penjualan') ?>" class="link-dark rounded<?php
            if($_SERVER['REQUEST_URI'] ==="/waserda/data_penjualan"){
              echo ' nav-link active';
            }else{
              echo ' nav-link';
            }
          ?>">Penjualan</a></li>
            <li class="nav-item navItem ms-3"><a style="text-decoration:none;color:white;" href="<?=base_url('/waserda/report') ?>" class="link-dark rounded<?php
            if($_SERVER['REQUEST_URI'] ==="/waserda/report"){
              echo ' nav-link active';
            }else{
              echo ' nav-link';
            }
          ?>">Laporan Penjualan</a></li>
            <li class="nav-item navItem ms-3"><a style="text-decoration:none;color:white;" href="<?=base_url('/waserda/labapenjualan') ?>" class="link-dark rounded<?php
            if($_SERVER['REQUEST_URI'] ==="/waserda/labapenjualan"){
              echo ' nav-link active';
            }else{
              echo ' nav-link';
            }
          ?>">Laporan Laba</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item navItem">
        <a href="<?=base_url('/waserda/credits') ?>"
        class="nav-link <?= ($_SERVER['REQUEST_URI'] === "/waserda/credits") ? 'active' : '' ?>"
        style="text-decoration:none;color:white;"
        ><i class="fa-solid fa-credit-card" style="color: #ffffff;"></i>
          Kredit Belanja
        </a>
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
  