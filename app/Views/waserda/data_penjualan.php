<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>

<div class="d-flex" style="margin:1em;">
    <!-- search -->
    <form class="d-flex" style="margin-inline-start: auto;">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="border-radius: 12em;">
        <button class="btn btn-outline-success" type="submit" style="border-radius: 12em;">Search</button>
    </form>
</div>

<div class="container-sm shadow border border-primary">
    <span class="h3">Daftar Transaksi </span>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Nomor Struk</th>
                <th scope="col">Nama Petugas</th>
                <th scope="col" style="text-align: right;">Nilai Transaksi</th>
            </tr>
            </thead>
        <tbody>
            <tr>
                <th scope="row">20-05-2024 : 09:30</th>
                <td>2024052004</td>
                <td>Dewi Yuliyati</td>
                <td style="text-align: right;">Rp 30.0000</td>
            </tr>
            <tr>
                <th scope="row">20-05-2024 : 09:20</th>
                <td>2024052003</td>
                <td>Dewi Yuliyati</td>
                <td style="text-align: right;">Rp 150.000</td>
            </tr>
            <tr>
                <th scope="row">20-05-2024 : 09:16</th>
                <td>2024052002</td>
                <td>Dewi Yuliyati</td>
                <td style="text-align: right;">Rp 36.000</td>
            </tr>
            <tr>
                <th scope="row">20-05-2024 : 09:10</th>
                <td>2024052001</td>
                <td>Dewi Yuliyati</td>
                <td style="text-align: right;">Rp 74.000</td>
            </tr>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>