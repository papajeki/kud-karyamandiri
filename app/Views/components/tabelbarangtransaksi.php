<table class="table" id="product-table">
    <thead>
        <tr>
            <th scope="col">Nama Produk</th>
            <th scope="col">Kode Barcode</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($result)): ?>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['barcode']; ?></td>
                    <td><?= $row['harga_jual']; ?></td>
                    <td>
                        <input type="number" name="quantity[<?= $row['id_barang']; ?>]" value="1" min="1" class="form-control quantity" data-price="<?= $row['harga_jual']; ?>" style="width: 5em;">
                    </td>
                    <td>
                        <button class="btn btn-secondary btn-add-to-cart" data-id="<?= $row['id_barang']; ?>" style="border-radius: 5px;" type="button">Tambahkan</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No products found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
