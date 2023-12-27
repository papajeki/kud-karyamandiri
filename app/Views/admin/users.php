<?= $this->extend('testerlayout') ?>
<?= $this->section('content') ?>

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
      <th scope="col">Username</th>
      <th scope="col">Surename</th>
      <th scope="col">Roles</th>
	  <th scope="col">Action</th>
	  <th scope="col"><a href="<?=base_url('/admin/create_user')?>">Create Account</a></th>
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
					<div>
						<button>Edit</button>
						<button>Hapus</button>
					</div>
				</td>
		
			</tr>		
			<?php endforeach; ?>
	<?php endif; ?>
   
    
  </tbody>
</table>


<?= $this->endsection() ?>