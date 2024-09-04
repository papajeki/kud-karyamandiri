<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi Unit Desa Karya Mandiri</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.bundle.min.css') ?>" />
    <style>
        .collapse-horizontal {
            position: relative;
            width: 200px;
            transition: width 0.35s ease;
        }

        .collapse-horizontal.collapsing {
            width: 0;
        }

        .collapse-horizontal:not(.show) {
            width: 0;
        }

        .collapse-horizontal.show {
            width: 200px;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="collapse collapse-horizontal show" id="sidebarcollapse">
            <?= $this->include('layout/sidebar_kelompok') ?>
        </div>
        <div style="width: 100%;">
            <header class="jumbotron jumbotron-fluid">
                <div class="d-flex">
                    <?= $this->include('layout/navbar_admin') ?>
                </div>
            </header>
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarcollapse').on('shown.bs.collapse', function () {
                $('#sidebar-toggle-button').hide();
            });

            $('#sidebarcollapse').on('hidden.bs.collapse', function () {
                $('#sidebar-toggle-button').show();
            });

            $('#sidebar-close-button').on('click', function () {
                $('#sidebarcollapse').collapse('hide');
            });
        });
        $(document).ready(function () {
            $('[data-bs-toggle="popover"]').popover();
        });
    </script>
</body>

</html>
