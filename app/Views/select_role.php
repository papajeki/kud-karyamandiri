<?= $this->extend('layout_select_role') ?>
<?= $this->section('content') ?>


	<div class="container d-flex" style="min-height:100vh;justify-content:center; align-items:center; gap:2em;">
		<!--Menu pemilihan dashboard-->

		<?php if($role === 'admin'){ ?>
			<a href="/admin" class="d-flex" style="
				justify-content:center;
				align-items:center;
				min-height:12em;
				min-width:16em;
				background-color:#00D1FF;
				width:fit-content;
				text-decoration:none;
			">
				<span style="font-weight:bold; color:white;">Super Admin</span>
			</a>
		<?php }?>

		<?php if($role === 'kasir' || $role == 'admin'){ ?>
			<a href="/waserda" class="d-flex" style="
				justify-content:center;
				align-items:center;
				min-height:12em;
				min-width:16em;
				background-color:#008E46;
				width:fit-content;
				text-decoration:none;
			">
				<span style="font-weight:bold; color:white;">WASERDA</span>
			</a>
		<?php }?>

		<?php if($role === 'ksp' || $role == 'admin'){ ?>
		<a href="" class="d-flex" style="
			justify-content:center;
			align-items:center;
			min-height:12em;
			min-width:16em;
			background-color:#1D1B1B;
			width:fit-content;
			text-decoration:none;
		">
			<span style="font-weight:bold; color:white;">Simpan Pinjam</span>
		</a>
		<?php }?>

		<?php if($role === 'petani' || $role == 'admin'){ ?>
		<a href="" class="d-flex" style="
			justify-content:center;
			align-items:center;
			min-height:12em;
			min-width:16em;
			background-color:#D9D9D9;
			width:fit-content;
			text-decoration:none;
		">
			<span style="font-weight:bold; color:white;">Kelompok Tani</span>
		</a>
		<?php }?>
	</div>

<?= $this->endSection() ?>