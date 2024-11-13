<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <!-- Icon section with larger size -->
                        <div class="me-3"> <!-- Adds space between icon and text -->
                            <i class="fa-solid fa-user fa-3x"></i> <!-- Increased icon size -->
                        </div>
                        
                        <!-- Text and Button section -->
                        <div class="d-flex flex-column flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold"> <?= $anggota['surename'] ?> </span>
                                
                                <!-- Form for pelunasan -->
                                <form action="<?= base_url('/waserda/pelunasan/' . $anggota['id_anggota']) ?>" method="post">
                                    <button type="submit" class="btn btn-primary btn-sm">Pelunasan</button>
                                </form>

                            </div>
                            <span class="text-muted"> <?= $anggota['kelompok_tani'] ?> </span>
                            <span class="text-muted">Total Tagihan: <?= $creditsSummary['hitung_akhir'] ?? '0' ?> </span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nilai Tagihan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($creditsDetails)): ?>
                    <?php $index = 0; ?>
                    <?php foreach($creditsDetails as $row): ?>
                    <tr onclick="window.location='<?= base_url('waserda/kasir/receipt/' . $row['id_penjualan']); ?>';" style="cursor: pointer;">
                        <td><?= ++$index ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['total_belanja'] ?></td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                    <?php endforeach ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Data tidak tersedia</td>
                    </tr>
                <?php endif ?>
            </tbody>
            </table>
        </div>
    </div>
<?= $this->endSection() ?>
