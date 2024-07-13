<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>

<div class="d-flex" style="margin:1em;">
    <!-- search -->
    <form class="d-flex" style="margin-inline-start: auto;">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="border-radius: 12em;" name="q" value="<?= $searchQuery ?>">
        <button class="btn btn-outline-success" type="submit" style="border-radius: 12em;">Search</button>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Transaksi Kasir</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nomor Struk</th>
                    <th>Total Belanja</th>
                    <th>Nama Petugas</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($result)): ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?= $row['tanggal']; ?></td>
                            <td><?= $row['struk']; ?></td>
                            <td><?= $row['total_belanja']; ?></td>
                            <td><?= $row['nama_petugas']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No transactions found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            <?= $pager->links('group1', 'bootstrap_pagination'); ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
