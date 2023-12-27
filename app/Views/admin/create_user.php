<?= $this->extend('testerlayout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Buat Akun Baru</h2>
    <form action="<?=base_url('/admin/simpan')?>" method="post">
        <div class="form-group">
            <label for="username">UserName (Untuk Login)</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="surename">Nama Lengkap</label>
            <input type="text" class="form-control" id="surename" name="surename">
        </div>
        <div class="form-group">
            <label for="roles">Posisi Kerja</label>
            <select class="form-select" aria-label="Default select example" id="roles" name="roles">
                <option selected>Open this select menu</option>
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
                <option value="ksp">KSP</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </form>


<?= $this->endsection() ?>