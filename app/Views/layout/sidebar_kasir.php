<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width:200px; height:50em;">
    <a href="<?= base_url('/index') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <img src="<?= base_url('image/logokoperasi.png') ?>" class="me-2" width="40" height="40">
      <span style="font: size 12px;">Karya Mandiri</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto d-flex" style="gap: 2px;">
      <li 
      class="nav-item navItem">
        <a style="text-decoration:none;color:white;" href="<?=base_url('/waserda') ?>"
          <?php
            if($_SERVER['REQUEST_URI'] ==="/waserda"){
              echo 'class="nav-link active"';
            }else{
              echo 'class="nav-link"';
            }
          ?>
        >
          Beranda
        </a>
      </li>
      <li>
        <a style="text-decoration:none;color:white;" href="<?=base_url('/waserda/kasir') ?> "
        <?php
            if($_SERVER['REQUEST_URI'] ==="/waserda/kasir"){
              echo 'class="nav-link active"';
            }else{
              echo 'class="nav-link"';
            }
          ?>
           >
          Kasir Waserda
        </a>
      </li>
      <li> 
        <a style="text-decoration:none;color:white;" href="<?=base_url('/waserda/barang') ?>" 
        <?php
            if($_SERVER['REQUEST_URI'] ==="/waserda/barang"){
              echo 'class="nav-link active"';
            }else{
              echo 'class="nav-link"';
            }
          ?>
          >
          Data Barang
        </a>
      </li>
      <li class="mb-1"><button style="text-decoration:none;color:white;" class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
          Data Penjualan</button>
        <div class="collapse" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li class="ms-3"><a style="text-decoration:none;color:white;" href="<?=base_url('/waserda/data_penjualan') ?>" class="link-dark rounded<?php
            if($_SERVER['REQUEST_URI'] ==="/waserda/data_penjualan"){
              echo ' nav-link active';
            }else{
              echo ' nav-link';
            }
          ?>">Penjualan</a></li>
            <li class="ms-3"><a style="text-decoration:none;color:white;" href="<?=base_url('/waserda/report') ?>" class="link-dark rounded<?php
            if($_SERVER['REQUEST_URI'] ==="/waserda/report"){
              echo ' nav-link active';
            }else{
              echo ' nav-link';
            }
          ?>">Updates</a></li>
            <li class="ms-3"><a style="text-decoration:none;color:white;" href="#" class="link-dark rounded">Reports</a></li>
          </ul>
        </div>
      </li>
    </ul>
    <button class="btn btn-secondary" id="sidebar-close-button"><i class="fas fa-times"></i> Close</button>
    <hr>
  </div>

  <style>
    .navItem:hover{
        background-color: #0d6efd !important;
        border-radius: 0.25rem;
    }
  </style>
  