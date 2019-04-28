<div class="main-content">
	<div class="container-fluid">
		<div class="panel panel-headline">
			<div class="panel-heading">

			<!-- <div class="row"><div class="col-sm-6"><div class="dataTables_length" id="datatable_length"><label>Show <select name="datatable_length" aria-controls="datatable" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div> -->
				<h1>Daftar Barang Tersedia</h1>

				<form action="<?=base_url('index.php/Barang/search')?>" method="post">
					<input type="text" name="keyword" />
					<input type="submit"  value="search" />
				</form>

			<?php if($this->session->flashdata('pesan')): ?>

		<div class="alert alert-warning"><?= $this->session->flashdata('pesan') ?></div>

			<?php endif?>
		<!-- level user admin -->
		<?php if($this->session->userdata('level')=="admin"){?>
		<a href="#tambah" class="btn btn-primary" data-toggle="modal" style="float: right;">Tambah</a>
		<?php } ?>
			<table id="datatable" class="table table-striped table-bordered"
					<tr>
						<td>No</td>
						<td>Kode Barang</td>
						<td>Nama Barang</td>
						<!-- <td>Tahun</td> -->
						<td>Kategori</td>
						<!-- <td>Harga</td> -->
						<td>Gambar</td>
						<!-- <td>Penerbit</td> -->
						<!-- <td>Penulis</td> -->
						<td>Stok</td>
						<td>Nama Rak</td>
						<td></td><td></td>
					</tr>
				</thead>
				<tbody>
					<?php $no = 0; foreach($barang as $bk): $no++;?>
					
					<tr>

			<td><?=$no?></td>
			<td><?=$bk->kode_barang?></td>
			<td><?=$bk->nama_barang?></td>
			<td><?=$bk->nama_kategori?></td>
			<td><img src="<?=base_url('assets/gambar/'.$bk->cover)?>" style="width:40px;"></td>
			<td><?=$bk->stok?></td>
			<td><?=$bk->nama_rak?></td>

			<td><?php if($this->session->userdata('level')=="admin"){?> <a href="#ubah" data-toggle="modal" onclick="edit(<?=$bk->kode_barang?>)"  class="btn btn-success">Edit</a><?php }else{ }?></td>

			<td><?php if($this->session->userdata('level')=="admin"){?><a href="<?=base_url('index.php/barang/hapus/'.$bk->kode_barang)?>" onclick="return confirm('apakah anda yakin untuk menghapus')" class="btn btn-danger">Hapus</a><?php }else{ }?></td>
		</tr>
						<?php endforeach?>
				</tbody>	
			</table>

<div class="modal fade" id="tambah" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Tambah Barang</h4>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('index.php/barang/tambah')?>" method="post" enctype="multipart/form-data">
						<tr>
							<td>Nama Barang</td>
							<td><input type="text" name="nama_barang" class="form-control"></td>
						</tr>

						<tr>
							<td>Stok</td>
							<td><input type="number" name="stok" class="form-control"></td>
						</tr>

						<tr>
							<td>Kategori Barang</td>
							<td>
								<select name="kategori" class="form-control">
									<?php foreach ($kategori as $kt): ?>
										<option value="<?= $kt->kode_kategori?>" ><?= $kt->nama_kategori?></option>
									<?php endforeach?>	
								</select>
							</td>
						</tr>
						<tr>
							<td>Rak</td>
							<td>
								<select name="rak" class="form-control">
									<?php foreach ($rak as $kr): ?>
										<option value="<?= $kr->kode_rak?>" ><?= $kr->nama_rak?></option>
									<?php endforeach?>	
								</select>
							</td>
						</tr>

						<tr>
							<td>Gambar</td>
							<td><input type="file" name="cover"></td>
						</tr>

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
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Edit barang</h4>
				</div>
			</div>	
			<div class="modal-body">
				<form action="<?=base_url('index.php/barang/update')?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="kode_barang" required id="kode_barang" style="margin-left: 20px;">
						<tr>
							<td>Nama Barang</td>
							<td><input type="text" name="nama_barang"  required  id="nama_barang" class="form-control"></td>
						</tr>
						<tr>
							
						<tr>
							<td>Stok</td>
							<td><input type="number" name="stok" required  id="stok" class="form-control"></td>
						</tr>
						<tr>
						<td>Kategori</td>
							<td>
								<select name="kategori" required id="kategori"  class="form-control">
									<?php foreach ($kategori as $kt): ?>
										<option value="<?= $kt->kode_kategori?>" ><?= $kt->nama_kategori?></option>
									<?php endforeach?>	
								</select>
							</td>
						</tr>
						<tr>
						<td>Rak</td>
							<td>
								<select name="rak" required id="rak"  class="form-control">
									<?php foreach ($rak as $kr): ?>
										<option  value="<?= $kr->kode_rak?>" ><?= $kr->nama_rak?></option>
									<?php endforeach?>	
								</select>
							</td>
						</tr>

						<tr>
							<td>Gambar</td>
							<td><input type="file" name="cover"   id="cover"></td>
						</tr>
					<center><input type="submit" value="Edit" name="update" required  class="btn btn-primary" style="margin-top: 30px;"></center>
				</form>
			</div>	
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>

<script >
	function edit(kode_barang){
		$.ajax({
			type:"post",
			url:"<?=base_url()?>index.php/barang/tampil_ubah_barang/"+kode_barang,
			dataType:"json",
			success:function(data){
				$("#kode_barang").val(data.kode_barang);
				$("#nama_barang").val(data.nama_barang);
				$("#kategori").val(data.kode_kategori);
				$("#stok").val(data.stok);
				$("#stok").val(data.stok);	
			}
		});
	}
</script>