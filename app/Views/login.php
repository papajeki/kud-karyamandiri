<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Tambahkan link CSS Bootstrap 5 yang sesuai -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
</head>
<body class="d-flex" style="background-color: #1B9C85; margin-top:70px;">
    <div class="card shadow-lg d-flex flex-row" style="width:75%;margin-left:auto;margin-right:auto; height:80vh;">
        <div class="d-flex" style="background-color: #FFE194;width:50%;">
            <div class="d-flex flex-column" style="margin:auto;">
                <img width="200px;"  src="<?= base_url('image/logokoperasi.png') ?>" alt="Deskripsi gambar" class="img-fluid mt-4" style="margin-left:auto;margin-right:auto;">
                <H4 style="text-align:center;">Koperasi Unit Desa Karya Mandiri</h4>
                <!--pesan error jika ada -->
                <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                <?php endif;?>
                </div>
            </div>
        <div class="d-flex" style="width:50%;">
            <form class="justify-items-center"action="<?= base_url('/login/auth')?>" method="post"  style="margin:auto;">
            <h5 style="text-align:center;">Login Akun</h5>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" style="border-radius:10px" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="InputForPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" style="border-radius:10px" id="InputForPassword" required>
                </div>
                <div class="text-center">
                <button type="submit" name="login" class="btn btn-primary mx-auto w-50" style="border-radius:10px">Login</button>
                </div>
            </form>
        </div>
    </div>
        
    <!-- Tambahkan link JavaScript Bootstrap 5 yang sesuai -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>