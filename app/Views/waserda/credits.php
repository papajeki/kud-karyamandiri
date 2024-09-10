<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
    <div class="row justify-content-center"> <!-- Center the row horizontally -->
        <div class="col-lg-10">
            <div class="table-responsive">
                <table class="table table-hover text-center"> <!-- Center text inside the table -->
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Anggota</th>
                            <th scope="col">Kelompok</th>
                            <th scope="col">Total Credits</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($credits)) : ?>
                        <?php $index = 0; ?>
                        <?php foreach ($credits as $row): ?>
                        <tr onclick="window.location='<?= base_url('waserda/credits/credits_detail/' . $row['id_anggota']); ?>';" style="cursor: pointer;">
                            <td><?= ++$index ?></td>
                            <td><?= esc($row['surename']) ?></td>
                            <td><?= esc($row['kelompok_tani']) ?></td>
                            <td><?= esc($row['total_credits']) ?></td>
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
