<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width:200px; height:50em;">
    <a href="<?= base_url('/index') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <img src="<?= base_url('image/logokoperasi.png') ?>" class="me-2" width="40" height="40">
      <span style="font: size 12px;">Karya Mandiri</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto d-flex" style="gap: 2px;">
      <li 
      class="nav-item navItem">
        <a style="text-decoration:none;color:white;" href="<?=base_url('/admin') ?>"
          <?php
            if($_SERVER['REQUEST_URI'] ==="/admin"){
              echo 'class="nav-link active"';
            }else{
              echo 'class="nav-link"';
            }
          ?>
        >
          Beranda
        </a>
      </li>
      <li class="nav-item navItem">
        <a style="text-decoration:none;color:white;" href="<?=base_url('/admin/users') ?> "
        <?php
            if($_SERVER['REQUEST_URI'] ==="/admin/users"){
              echo 'class="nav-link active"';
            }else{
              echo 'class="nav-link"';
            }
          ?>
           >
          Daftar Karyawan
        </a>
      </li>
      <li class="nav-item navItem">
        <a style="text-decoration:none;color:white;" href="<?=base_url('/admin/harga_tbs') ?>" 
        <?php
            if($_SERVER['REQUEST_URI'] ==="/admin/harga_tbs"){
              echo 'class="nav-link active"';
            }else{
              echo 'class="nav-link"';
            }
          ?>
          >
          Harga Sawit
        </a>
      </li>
    </ul>
    <hr>
  </div>

  <style>
    .navItem:hover{
        background-color: #0d6efd !important;
        border-radius: 0.25rem;
    }
  </style>