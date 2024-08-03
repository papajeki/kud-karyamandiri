<div class="container mt-5">
    <h2>Daftar Peminjam</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">No Handphone</th>
                <th scope="col">Nilai Pinjaman</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($result)): ?>
                <?php foreach ($result as $index => $row): ?>
                    <tr>
                        <td scope="row"><?= $index + 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage(); ?></td>
                        <td><?= $row['surename'] ?></td>
                        <td><?= $row['handphone'] ?></td>
                        <td>Rp. <?= number_format($row['nominal_pinjaman'], 0, ',', '.'); ?></td>
                        <td>
                            <?= $row['status'] ?>
                            <?php if ($row['notification']): ?>
                                <i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;" type="button" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Belum Bayar"></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form action="<?= base_url('ksp/pinjaman_detail/' . $row['id_pinjaman']) ?>" method="post">
                                <button class="btn btn-primary" style="border-radius: 5px;">Detail</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <?= $pager->links('group1', 'bootstrap_pagination'); ?>
    </div>
</div>
