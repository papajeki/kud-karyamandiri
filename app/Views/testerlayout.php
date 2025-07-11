<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Protal Berita Codeigniter</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
</head>

<body>

	
	<div class="d-flex">
		<?= $this->include('layout/sidebar') ?>
		<div style="width: 100%;">
			<header class="jumbotron jumbotron-fluid">
				<div class="d-flex">
					<?= $this->include('layout/navbar') ?>
				</div>
			</header>
			<?= $this->renderSection('content') ?>
		</div>
		
	</div>
	
	<!-- Jquery dan Bootsrap JS -->
	<script src="<?= base_url('js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

</body>

</html>