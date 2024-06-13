<div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Produk</th>
      <th scope="col">Kode Barcode</th>
      <th scope="col">Harga Jual</th>
      <th scope="col" style="text-align:center;">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php if (!empty($result)): ?>
			<?php foreach ($result as $index => $row): ?>
    <tr>
      <th scope="row"><?= $index+1; ?></th>
      <td><?= $row['nama_barang']; ?></td>
      <td><?= $row['barcode']; ?></td>
      <td><?= $row['harga_jual']; ?></td>
      <td>
        <div class="d-flex" style="gap:1em; justify-content: center;">
        <form action="<?= base_url('/waserda/edit_harga_produk/' .$row['id_barang']) ?>" method="post">
        <button class="btn btn-primary" style="border-radius: 5px;" type="submit">Edit</button>
        </form>
        <form action="<?= base_url('/waserda/edit_produk/' .$row['id_barang']) ?>" method="post">
        <button class="btn btn-secondary" style="border-radius: 5px;" type="submit">Edit Barang</button>
        </form>
      </div>
      </td>
    </tr>
    <?php endforeach; ?>
	<?php endif; ?>
   
  </tbody>
</table>
</div>