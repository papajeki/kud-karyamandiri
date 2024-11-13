<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Koperasi Unit Desa Karya Mandiri</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
</head>

<body>

	<!-- Layout tampilan web, atas dan konten -->
	<div class="d-flex">
		<!--sidebar dimatikan  -->
		<div style="width: 100%; ">
			<header class="jumbotron jumbotron-fluid">
				<div class="d-flex">
					<?= $this->include('layout/navbar') ?>
				</div>
			</header>
			<div style="width: 100%; background-color:#1B9C85;">
			<?= $this->renderSection('content') ?>
			</div>
		</div>
		
	</div>
	
	<!-- Jquery dan Bootsrap JS -->
	<script src="<?= base_url('js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

</body>

</html>