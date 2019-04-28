<div class="main-content">
	<div class="container-fluid">
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h1>Histori Peminjaman</h1>

				<a href="<?=base_url('index.php/Histori/cetak_laporan')?>" class="btn btn-success" style="float: right;">Print</a>
				<table class="table table-hover table-stripped"> 
				<?php if($this->session->userdata('level')=="admin"){?> 
					<thead>
						<tr>
							<td>No</td>
							<td>No Nota</td>
						<td>Nama Kasir</td>
						<td>Peminjam</td>
						<td>Tanggal Peminjaman</td>
						<td>Tanggal Pengembalian</td>
						<td>Status</td>
					</tr>
				</thead>		
				<tbody>
				<?php $no = 0; foreach($ts as $ts): $no++;?>
					<tr>
						<td><?=$no?></td>
						<td><?=$ts->kode_transaksi?></td>
						<td><?=$ts->nama_user?></td>
						<td><?=$ts->nama_pembeli?></td>
						<td><?=$ts->tanggal_peminjaman?></td>
						<td><?=$ts->tanggal_pengembalian?></td>
						<td><?=$ts->status?></td>
							<!-- <?php if($ts->status == "Belum Kembali"){ ?>
							<a class="btn btn-primary" href="<?= base_url('index.php/Histori/kembali/')?><?=$ts->kode_transaksi?>">Belum Kembali</a>
							<?php }else{ ?>
								Sudah Kembali</td>
							<?php } ?> -->
					</tr>
						<?php endforeach?>
				</tbody>
				<?php }else{
					?> 
					<thead>
						<tr>
						<td>No</td>
						<td>No Nota</td>
						<td>Peminjam</td>
						<td>Nama Barang</td>
						<td>Tanggal Peminjaman</td>
						<td>Tanggal Pengembalian</td>
						<td>Status</td>
					</tr>
				</thead>		
				<tbody>
				<?php $no = 0; foreach($pg as $ts): $no++;?>
					<tr>
						<td><?=$no?></td>
						<td><?=$ts->kode_transaksi?></td>
						<td><?=$ts->nama_pembeli?></td>
						<td><?=$ts->nama_barang?></td>
						<td><?=$ts->tanggal_peminjaman?></td>
						<td><?=$ts->tanggal_pengembalian?></td>
						<td>
							<a class="btn btn-primary" href="<?= base_url('index.php/Histori/kembali/')?><?=$ts->kode_transaksi?>">Belum Kembali</a>
					</tr>
						<?php endforeach?>
				</tbody>
				<?php
				 }?>	
				</table>	
			</div>
		</div>
	</div>
</div>