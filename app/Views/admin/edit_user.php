<?= $this->extend('testerlayout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Edit data User <?php echo $users['surename'] ?></h2>
    <form action="<?=base_url('/admin/update/'.$users['id'])?>" method="post">
        <div class="form-group">
            <label for="surename">Nama Lengkap</label>
            <input type="text" class="form-control" id="surename" name="surename" value="<?php echo $users['surename'] ?>">
        </div>
        <div class="form-group">
            <label for="roles">Posisi Kerja</label>
            <select class="form-select" aria-label="Default select example" id="roles" name="roles">
                <option selected><?php echo Strtoupper($users['roles']) ?></option>
                <option value="admin">ADMIN</option>
                <option value="kasir">KASIR</option>
                <option value="ksp">KSP</option>
                <option value="petani">Petani</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Password (Kosongkan jika tidak ingin diubah)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<?= $this->endSection() ?>
