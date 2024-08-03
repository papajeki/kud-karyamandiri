<div class="container mt-5">
    <h2>Daftar Anggota dan Tabungan</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Nomor Handphone</th>
                <th scope="col">Saldo Tabungan</th>
                <th scope="col">Status Tabungan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($result)): ?>
                <?php foreach ($result as $row): ?>
            <tr>
                <td><?= esc($row['surename']); ?></td>
                <td><?= esc($row['handphone']); ?></td>
                <td><?= esc(number_format($row['saldo'], 0, ',', '.')); ?></td>
                <td><?= esc($row['status']); ?></td>
                <td><form action="<?= base_url('ksp/tabungan_detail/' .$row['id_tabungan']) ?>" method="post">
                    <button onclick="" class="btn btn-success" style="border-radius: 5px;" type="submit">Detail</button>
                </form></td>
            </tr>
                <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="4">No data found</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
            <?= $pager->links('group1', 'bootstrap_pagination'); ?>
    </div>
</div>