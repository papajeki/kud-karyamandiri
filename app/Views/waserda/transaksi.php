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
      <th scope="col">Harga</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Give mawar</td>
      <td>69696969</td>
      <td>Rp.69240</td>
      <td>
        <input type="number" name="inputJumlah" id="inputJumlah" placeholder="1">
      </td>
      <td>
        <button class="btn btn-primary">
            <span>Tambahkan</span>
        </button>
      </td>
    </tr>
  </tbody>
</table>
</div>

<div class="d-flex">
    <div style="margin-inline-start: auto;">
        <div class="p-4 d-flex justify-content-center" style="background-color: green; min-width:12em;">
            <span style="font-size:18px; font-weight:bold;">Total Harga</span>
        </div>
        <div style="background-color: grey;min-height:10em;">
            <br>
        </div>
    </div>
</div>

<?= $this->endSection() ?> 