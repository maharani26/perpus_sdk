<div class="main-content">
<h1> Peminjaman</h1>
<?php if($this->session->flashdata('pesan')): ?>
	<div class="alert alert-warning"><?= $this->session->flashdata('pesan') ?></div>
		<?php endif?>
			<div class="row">
				<div class="col-md-8">
				<table class="table table-hover table-stripped"> 
					<thead>
						<tr>
							<td>No</td>
							<td>Nama Barang</td>
							<!-- <td>Tahun</td> -->
							<td>Kategori</td>
							<!-- <td>Harga</td> -->
							<td>Gambar</td>
							<!-- <td>Penerbit</td>
							<td>Penulis</td> -->
							<td>Stok</td>
							<td></td><td></td>
						</tr>
					</thead>
					<tbody>
						<?php $no = 0; foreach($barang as $bk): $no++;?>

				<tr>
					<td><?=$no?></td>
					</td><td><?=$bk->nama_barang?></td>
					<td><?=$bk->nama_kategori?></td>
					<td><img src="<?=base_url('assets/gambar/'.$bk->cover)?>" style="width:40px;"></td>
					<td><?=$bk->stok?></td>
					<td> <a href="<?=base_url('index.php/Cart/tambah_cart/'.$bk->kode_barang)?>" class="btn btn-primary">pilih</a></td>
				</tr>
				<?php endforeach?>
			</tbody>	
		</table>
	</div>
	<div class="col-md-4">
	<form action="<?= base_url('index.php/Transaksi/transaksi')?>" method="post">
		<table class="table table-stripped table-hover"> 
			<tr>
				<td colspan="2">Nama Peminjam</td>
				<td colspan="4">
				<input type="text" name="pembeli" value="<?=$this->session->flashdata('pembeli');?>"></td></tr>
			<tr>
				<th>No</th>
				<th>nama_barang</th>
				<th>Jumlah</th>
				<!-- <th>Harga</th>
				<th>Subtotal</th><th></th> -->
			</tr>

			<?php $no = 0; foreach($this->cart->contents() as $ct): $no++;?>
				<input type="hidden" name="kode_barang[]" value="<?=$ct['id']?>">
				<input type="hidden" name="rowid[] " value="<?=$ct['rowid']?>">
				<tr>
					<td><?=$no?></td>
					</td><td><?=$ct['name']?></td>
					<td><input type="number" name="banyak[]" value="<?=$ct['qty']?>" style="width:60px;"></td>
					<!-- <td><?=number_format($ct['price'])?></td>
					<td><?=number_format($ct['subtotal'])?> -->
					<td> <a href="<?=base_url('index.php/Cart/hapus_cart/'.$ct['rowid'])?>" onclick="return confirm('Apakah Anda yakin Ingin Menghapus?')" class="btn btn-danger">x</a></td>
				</tr>
			<?php endforeach?>
				<!-- <tr>
					<td colspan="2">Total</td>
					<td colspan="4"><?= number_format($this->cart->total())?></td>
				</tr> -->
				<tr>
					<td colspan="2">Tanggal Pengembalian</td>
					<td colspan="4"><input type="date" id="tgl" name="tanggal_pengembalian"></td>
				</tr>
				<!-- <tr>
					<td colspan="2">Kembali</td>
					<td colspan="4"><input type="number" value="<?= $this->session->flashdata('kembali') ?>" name="kembaliu"></td>
				</tr> -->
				<tr>
					<td colspan="2"><input type="submit" value="pinjam" name="pinjam" class="btn btn-success"></td>
					<td colspan="2"><a href="<?=base_url('index.php/Cart/hapus_semua_cart')?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Menghapus?')">Hapus Cart</a></td>
					<td colspan="2"><input type="submit" value="update_qty" name="update_qty" class="btn btn-primary"></td>
				</tr>
			</table>
		</form>
		</div>
</div>
</div>
</div>
</div>
</div>