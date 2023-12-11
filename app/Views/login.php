<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Tambahkan link CSS Bootstrap 5 yang sesuai -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
</head>
<body style="background-color: #1B9C85; margin-top:70px;">
    <div class="container card shadow-lg" style="background-color: #FFE194;">
        <div class="row justify-content-center mb-2">
                   <!-- <div class="card-header">
                        <h3 class="card-title text-center">Login</h3>
                    </div> -->
                        <div class="col-md-6 mt-2 mb-2">
                        <H1 class="">Selamat datang di situs terpadu Koperasi Unit Desa Karya Mandiri</h1>
                        <img src="<?= base_url('image/logokoperasi.png') ?>" alt="Deskripsi gambar" class="img-fluid mt-4">
                        </div>
                        <div class="col-md-4">
                            <h4 class="text-center" style="margin-top:60px;">Masuk Akun</h4>
                        <form method="post" action="<?= base_url('login_process') ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" style="border-radius:10px" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" style="border-radius:10px" id="password" name="password" required>
                            </div>
                            <div class="text-center">
                            <button type="submit" class="btn btn-primary mx-auto w-50" style="border-radius:10px">Login</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
    <!-- Tambahkan link JavaScript Bootstrap 5 yang sesuai -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>