
Inventaris Barang Sarpra<br>
_________________________________<br>
No Nota    	 : <?= $ts->kode_transaksi?><br>
nama Petugas : <?= $ts->nama_user?><br>
Tanggal      : <?= $ts->tanggal_peminjaman?>

	<table border="1px solid black" style="border-collapse: collapse;">
		<tr>
			<th>No</th>
			<th>Nama Barang</th>
			<!-- <th>Harga</th> -->
			<th>Jumlah</th>
			<!-- <th>Subtotal</th> -->
		</tr>
		<?php $no=0; foreach($dts as $dts):$no++?>
		<tr>
			<td> <?= $no?></td>
			<td> <?= $dts->nama_barang?></td>
			<!-- <td> <?= number_format($dts->harga)?></td> -->
			<td> <?= $dts->jumlah?></td>

			<!-- <td> <?= number_format($dts->harga*$dts->jumlah)?></td> -->
		</tr>
		<?php endforeach?>
		<!-- <tr>
			<td colspan="2">Total</td>
			<td colspan="3"><?= $ts->total?>
		</tr> -->
	</table>

	<script type="text/javascript">
		window.print();
		location.href="<?= base_url('index.php/Transaksi')?>";
	</script>