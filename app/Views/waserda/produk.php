<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>

<div class="d-flex" style="margin:1em;">
    <!-- search -->
    <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="border-radius: 12em;">
        <button class="btn btn-outline-success" type="submit" style="border-radius: 12em;">Search</button>
    </form>

    <button class="btn btn-primary" type="submit" style="margin-inline-start: auto;">Edit Transaksi</button>
</div>

<div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Produk</th>
      <th scope="col">Kode Barcode</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Harga Jual</th>
      <th scope="col">Jumlah Stok</th>
      <th scope="col" style="text-align:center;">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Give mawar</td>
      <td>69696969</td>
      <td>Rp.69240</td>
      <td>Rp.70000</td>
      <td>700</td>
      <td>
        <div class="d-flex" style="justify-content: center;gap:1em;">
        <button class="btn btn-primary">
            <span>Tambahkan</span>
        </button>
        <button class="btn btn-secondary">
            <span>Tambahkan</span>
        </button>
        <button class="btn btn-danger">
            <span>Tambahkan</span>
        </button>
        </div>
      </td>
    </tr>
  </tbody>
</table>
</div>


<?= $this->endSection() ?>