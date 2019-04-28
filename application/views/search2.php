<div class="main-content">
	<div class="container-fluid">
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h1>Rak Barang</h1>

				<form action="<?=base_url('index.php/Rak/search')?>" method="post">
					<input type="text" name="keyword" />
					<input type="submit"  value="search" />
				</form>

				<?php if($this->session->flashdata('pesan')): ?>
				<div class="alert alert-warning"><?= $this->session->flashdata('pesan') ?></div>
				<?php endif?>

				<?php if($this->session->userdata('level')=="admin")
				{?> <a href="#tambah" class="btn btn-primary" data-toggle="modal" style="float: right;">Tambah</a>
				<?php }?>

	<table class="table table-hover table-stripped"> 
		<thead>
			<tr>
				<td>No</td>
				<td>Kode rak</td>
				<td>Nama rak</td>
				<!-- <td>Nama Barang</td>
				<td>Jumlah Stok</td>
				<td></td><td></td> -->
				
			</tr>
		</thead>
		<tbody>
		<?php $no = 0; 
		foreach($products as $kt): $no++;?>
			<tr>
				<td><?=$no?></td>
				<td><?=$kt->kode_rak?></td>
				<td><?=$kt->nama_rak?></td>
				<!-- <td><?=$kt->nama_barang?></td>	
				<td><?=$kt->stok?></td>	 -->
				<td><?php if($this->session->userdata('level')=="admin"){?> 
				<a href="#ubah" data-toggle="modal" onclick="edit(<?=$kt->kode_rak?>)"  class="btn btn-success">Edit</a><?php 
				} else { 		
					// echo "Kasir"; 
					}?></td>
				<td><?php if($this->session->userdata('level')=="admin"){?>
				<a href="<?=base_url('index.php/rak/hapus/'.$kt->kode_rak)?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus?')" >Hapus</a><?php 
				} else { 
					// echo "Kasir";
					 }?></td>
			</tr>
			<?php endforeach?>
		</tbody>	
	</table>

<div class="modal fade" id="tambah" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Tambah rak</h4>
			</div>	
			<div class="modal-body">
			<form action="<?=base_url('index.php/rak/tambah')?>" method="post" enctype="multipart/form-data">
				<label>Nama rak</label>
				<input type="text" name="nama_rak" class="form-control" placeholder=""><br>
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
						<h4 class="modal-title">Edit rak</h4>
					</div>
					<div class="col-md-6">
						<button class="btn " data-dismiss = "modal" style="float: right; ">X</button>
					</div>
				</div>
			</div>	
			<div class="modal-body">
				<form action="<?=base_url('index.php/rak/update')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="kode_rak" required id="kode_rak" >
						<table>
							<tr>
								<td>Nama rak</td>
								<td><input type="text" name="nama_rak" required  id="nama_rak" style="margin-left: 20px;"></td>
							</tr>
						</table>
						<center><input type="submit" name="tambah" value="Ubah" class="btn btn-primary" style="margin-top: 30px;"></center>
					</form>
				</div>	
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>

<script >

function edit(kode_rak){
	$.ajax({
	type:"post",
	url:"<?=base_url()?>index.php/rak/tampil_ubah_rak/"+kode_rak,
	dataType:"json",
	success:function(data){
	$("#kode_rak").val(data.kode_rak);
	$("#nama_rak").val(data.nama_rak);

	}
});
}
</script>