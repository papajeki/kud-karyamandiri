<?= $this->extend('layout_kelompok') ?>
<?= $this->section('content') ?>
<div>
    <div class="row m-5">
        <div class="col col-lg-6 shadow">
            <form method="post" action="<?= base_url('/kelompok/gaji/'.$anggota['id_anggota']) ?>">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hasil kg</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalHasilPanen = 0; ?>
                        <?php if(!empty($panen_lalu)): ?>
                            <?php foreach ($panen_lalu as $row):
                                 $totalHasilPanen += $row['hasil_panen']; ?>
                                
                            <tr>
                                <td><?= $row['tanggal_panen'] ?></td>
                                <td><?= $row['berat_panen'] ?></td>
                                <td><?= $row['harga_tbs'] ?></td>
                                <td><?= number_format($row['hasil_panen'], 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                        <tr>
                            <td colspan="3">Total</td>
                            <td><?= number_format($totalHasilPanen, 0, ',', '.' )?></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Detail</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 1; ?>
                        <?php if(!empty($creditsSummary['hitung_akhir'])): ?>
                        <tr>
                            <td><?= $index ++;?></td>
                            <td>WASERDA</td>
                            <td>Rp <?= number_format($creditsSummary['hitung_akhir'], 0, ',', '.') ?? '0'; ?></td>
                        </tr>
                        <?php endif ?>
                        <?php if(!empty($potongan)): ?>
                            <?php foreach($potongan as $pot): ?>
                        <tr>
                            <td><?= $index ++; ?></td>
                            <td><?= $pot['deskripsi'] ?></td>
                            <td>Rp <?= number_format($pot['nominal'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach ?>
                        <?php endif ?>
                        <tr>
                            <td colspan="2"><strong>Total</strong></td>
                            <td><strong>Rp <?= number_format($total_nominal, 0, ',', '.') ?></strong></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table">
                    <tr>
                        <th></th>
                        <th>Gaji-Potongan</th>
                        <th>Gaji Bersih</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= number_format($totalHasilPanen, 0, ',','.') ?> - <?= number_format($total_nominal, 0, ',', '.') ?></td>
                        <td><strong>Rp <?=number_format($totalHasilPanen - $total_nominal, 0, ',', '.' )?></strong></td>
                    </tr>
                </table>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection() ?>
