<div class="main-content">
	<div class="container-fluid">
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h1>Petugas Jaga</h1>
				<?php if($this->session->flashdata('pesan')): ?>
				<div class="alert alert-warning"><?= $this->session->flashdata('pesan') ?></div>
				<?php endif?>
				<?php if($this->session->userdata('level')=="admin"){?>
					<a href="#tambah" class="btn btn-primary" data-toggle="modal" style="float: right;">Tambah</a>
				<?php }?>

			<table class="table table-hover table-stripped"> 
				<thead>
					<tr>
						<td>No</td>
						<td>ID User</td>
						<td>Nama</td>
						<td>Username</td>
						<td>Password</td>
						<td>Level</td>
						<td></td><td></td>
					</tr>
				</thead>
				<tbody>
				<?php $no = 0; foreach($user as $sr): $no++;?>
					<tr>
						<td><?=$no?></td>
						<td><?=$sr->kode_user?></td>
						<td><?=$sr->nama_user?></td>
						<td><?=$sr->username?></td>
						<td><?=$sr->password?></td>
						<td><?=$sr->level?></td>
						<td><?php if($this->session->userdata('level')=="admin"){
							?> <a href="#ubah" data-toggle="modal" onclick="edit(<?=$sr->kode_user?>)"  class="btn btn-success">Edit</a><?php 
						} else { 		
							echo "Kasir"; }?></td>
						<td><?php if($this->session->userdata('level')=="admin"){
							?><a href="<?=base_url('index.php/Kasir/hapus/'.$sr->kode_user)?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus')">Hapus</a><?php 
						} else { 
							echo "Kasir"; }?></td>
					</tr>
					<?php endforeach?>
				</tbody>	
			</table>
		</div>
	</div>
	</div>
</div>



<div class="modal fade" id="tambah" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Tambah Petugas</h4>
			</div>
		<div class="modal-body">
		<form action="<?=base_url('index.php/Kasir/tambah')?>" method="post">
			<label>Nama</label>
			<input type="text" name="nama_user" class="form-control" placeholder=""> <br>
			<label>Username</label>
			<input type="text" name="username" class="form-control" placeholder=""> <br>
			<label>Password</label>
			<input type="text" name="password" class="form-control" palceholder=""><br>
			<input type="hidden" name="level" style="margin-left: 20px;"></td>

			<center><input type="submit" name="tambah" value="tambah" class="btn btn-success" style="margin-top: 30px;"></center>
		</form>
	</div>	
</div>
</div>
</div>

<div class="modal fade" id="ubah" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-md-6">
						<h4 class="modal-title">Edit Petugas</h4>
					</div>
					<div class="col-md-6">
					<button class="btn " data-dismiss = "modal" style="float: right; ">X</button>
					</div>
				</div>
				<div class="modal-body">
				<form action="<?=base_url('index.php/Kasir/update')?>" method="post" >
			
						<td><input type="hidden" name="kode_user" required id="kode_user"></td>
							<tr>
								<td>Nama</td>
								<td><input type="text" name="nama_user" required id="nama_user" class="form-control"></td>
							</tr>
							<tr>
								<td>Username</td>
								<td><input type="text" name="username" required id="username" class="form-control"></td>
							</tr>
							<tr>
								<td>Password</td>
								<td><input type="text" name="password" id="password" required class="form-control"></td>
							</tr>
						<td><input type="hidden" name="level"  required id="level" style="margin-left: 20px;"></td>	
		
				<center><input type="submit" name="tambah" value="Ubah" class="btn btn-primary" style="margin-top: 30px;"></center>
			</form>
		</div>	
	</div>
	</div>
</div>

<script >
function edit(kode_user){
	$.ajax({
	type:"post",
	url:"<?=base_url()?>index.php/Kasir/tampil_ubah_user/"+kode_user,
	dataType:"json",
	success:function(data){
	$("#kode_user").val(data.kode_user);
	$("#nama_user").val(data.nama_user);
	$("#username").val(data.username);
	$("#password").val(data.password);
	$("#level").val(data.level);
	}
});
}
</script>