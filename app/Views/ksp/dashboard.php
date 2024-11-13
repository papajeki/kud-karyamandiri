<?php $this->extend('layout_ksp') ?>
<?php $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Card untuk produk dengan penjualan tertinggi -->
        <div class="col-lg-4 p-4" style="border-radius: 8px;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Jumlah Peminjam
                </div>
                <div class="card-body">
                    <P></P>
                    <p>Jumlah Peminjam Aktif : <?= $peminjam ?? 0; ?> Orang</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 p-4" style="border-radius: 8px;">
            <div class="card">
                <div class="card-header text-white" style="background-color: #02BCF5;">
                    Nilai Pinjaman Aktif
                </div>
                <div class="card-body">
                    <P></P>
                    <p>Total niali pinjaman : Rp <?= number_format($totalpinjaman,0,',','.') ?? 0; ?></p>
                </div>
            </div>
        </div>
</div>
<?php $this->endsection() ?>