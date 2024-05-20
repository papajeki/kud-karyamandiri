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
      <th scope="col">#</th>
      <th style="text-align:center;" scope="col">Periode</th>
      <th scope="col">Harga</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
        <td class="d-flex" style="justify-content:space-evenly;">
            <span>07-11-2023</span>
            <span>13-11-2023</span>
        </td>
      <td>Rp.2.100/kg</td>
    </tr>
    <tr>
      <th scope="row">1</th>
        <td class="d-flex" style="justify-content:space-evenly;">
            <span>07-11-2023</span>
            <span>13-11-2023</span>
        </td>
      <td>Rp.2.100/kg</td>
    </tr>
    <tr>
      <th scope="row">1</th>
        <td class="d-flex" style="justify-content:space-evenly;">
            <span>07-11-2023</span>
            <span>13-11-2023</span>
        </td>
      <td>Rp.2.100/kg</td>
    </tr>
  </tbody>
</table>

<?= $this->endsection() ?>