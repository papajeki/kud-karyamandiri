<?= $this->extend('testerlayout') ?>;
<?= $this->section('content') ?>

<div class="d-flex" style="padding:1em;">	<button class="btn btn-success" style="border-radius:15px; margin-inline-start:auto">
			<a href="<?=base_url('/admin/input_harga_sawit')?>" style="text-decoration:none; color:white;">
			Update Harga</a>
		</button>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col" style="text-align: center;">Tanggal Awal Berlaku</th>
      <th scope="col" style="text-align: center;">Tanggal Akhir Berlaku</th>
      <th scope="col"style="text-align: center;">Harga</th>
    </tr>
  </thead>
  <tbody>
	<?= $this->include('components/listhargasawit') ?>
  </tbody>
</table>

<?= $this->endsection() ?>