<?= $this->extend('testerlayout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Buat Akun Baru</h2>
    <form id="create-user" action="<?= base_url('/admin/simpan') ?>" method="post">
        <div class="form-group">
            <label for="username">UserName (Untuk Login)</label>
            <input type="text" class="form-control" id="username" name="username" required>
            <div class="invalid-feedback">
                Username Tidak Boleh Mengandung spasi
            </div>
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

    <script>
        document.getElementById('create-user').addEventListener('submit', function(event) {
            var username = document.getElementById('username').value;
            if (/\s/.test(username)) {
                event.preventDefault();
                var feedback = document.querySelector('#username ~ .invalid-feedback');
                feedback.style.display = 'block'; // Tampilkan pesan kesalahan
                document.getElementById('username').classList.add('is-invalid');
            } else {
                document.getElementById('username').classList.remove('is-invalid');
                var feedback = document.querySelector('#username ~ .invalid-feedback');
                feedback.style.display = 'none';
            }
        });
    </script>

<?= $this->endSection() ?>
