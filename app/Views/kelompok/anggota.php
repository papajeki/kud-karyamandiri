<?= $this->extend('layout_kelompok') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="table-responsive">
                <table class="table text-center table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Anggota</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($anggota)): ?>
                            <?php $index =1; ?>
                        <?php foreach ($anggota as $row): ?>
                        <tr>
                            <td><?= $index++ ?></td>
                            <td><?= esc($row['surename']); ?></td>
                            <td><button onclick="location.href='<?=base_url('kelompok/detail_anggota/' .$row['id_anggota']) ?>'" type="submit" class="btn btn-primary">Hasil Kebun</button></td>
                        </tr>
                        <?php endforeach ?>
                        <?php endif ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>