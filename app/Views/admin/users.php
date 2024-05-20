<?= $this->extend('testerlayout') ?>
<?= $this->section('content') ?>

<div class="d-flex" style="padding:1em;">	<button class="btn btn-success" style="border-radius:15px; margin-inline-start:auto">
			<a href="<?=base_url('/admin/create_user')?>" style="text-decoration:none; color:white;">
			Create Account</a>
		</button>
</div>

<!-- <div class="container col-md-12">
<div class="row">
			<div class="col-md-12 my-2 card">
				<div class="card-body">
				</div>
			</div>
			<div class="col-md-12 my-2 card">
				<div class="card-body">
				</div>
			</div>
			<div class="col-md-12 my-2 card">
				<div class="card-body">
				</div>
			</div>
			<div class="col-md-12 my-2 card">
				<div class="card-body">
				</div>
			</div>
		</div>
	</div> --><table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col" style="text-align: center;">Username</th>
      <th scope="col" style="text-align: center;">Surename</th>
      <th scope="col"style="text-align: center;">Roles</th>
	  <th scope="col"style="text-align: center;">Action</th>
    </tr>
  </thead>
  <tbody>
	<?php if (!empty($result)): ?>
			<?php foreach ($result as $index => $row): ?>
			<tr>
				<th scope="row"><?= $index+1;?></th>
				<td><?= $row['username'];?></td>
				<td><?= $row['surename'];?></td>
				<td><?= $row['roles'];?></td>
				<td>
					<div class="d-flex" style="gap:1em; justify-content:center;">
						<button class="btn btn-primary" style="border-radius: 10px;">Edit</button>
						<form action="<?= base_url('/admin/delete/' . $row['id']) ?>" method="post" onsubmit="return confirm('Are you sure?')">
						<button class="btn btn-danger" style="border-radius: 10px;" type="submit">Hapus</button>
						</form>
					</div>
				</td>
		
			</tr>		
			<?php endforeach; ?>
	<?php endif; ?>
   
    
  </tbody>
</table>


<?= $this->endsection() ?>