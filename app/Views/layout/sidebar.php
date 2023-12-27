<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width:200px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <img src="<?= base_url('image/logokoperasi.png') ?>" class="me-2" width="40" height="40">
      <span style="font: size 12px;">Karya Mandiri</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto d-flex" style="gap: 2px;">
      <li class="nav-item navItem">
        <a href="<?=base_url() ?>" class="nav-link active" aria-current="page">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Home
        </a>
      </li>
      <li>
        <a href="<?=base_url('/admin/users') ?>" class="nav-link text-white navItem">
          <svg class="bi me-2" width="16" height="16"><use xlink:href=""></use></svg>
          Data Users
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white navItem">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Orders
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white navItem">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Products
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white navItem">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Customers
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