<?php 

// header("Content-type: application/octet-stream");

// header("Content-Disposition: attachment; filename=peminjaman.xls");

// header("Pragma: no-cache");

// header("Expires: 0");

?>
<h1>Laporan Transaksi Perpustakaan</h1><br>
Tanggal   : <?=date('Y-m-d')?><br>
	<table border="1px solid black" style="border-collapse: collapse;">
		<thead>
			<tr>
				<td>No</td>
				<td>No Nota</td>
				<td>Nama Petugas</td>
				<td>Nama Peminjam</td>
				<td>tanggal pinjam</td>
				<td>tanggal kembali</td>
			</tr>
		</thead>
		<tbody>
		<?php $no = 0; 
		foreach($ts as $ts): $no++;?>
			<tr>
				<td><?=$no?></td>
				<td><?=$ts->kode_transaksi?></td>
				<td><?=$ts->nama_user?></td>
				<td><?=$ts->nama_pembeli?></td>
				<!-- <td><?=$ts->total?></td>
				<td><?=$ts->tanggal_beli?></td> -->
				<td><?=$ts->tanggal_peminjaman?></td>
				<td><?=$ts->tanggal_pengembalian?></td>
			</tr>
			<?php endforeach?>
			Pencetak  : <?=$this->session->userdata('nama_user') ?> <br>

			<script type="text/javascript">
				window.print();
				// location.href="<?= base_url('index.php/Histori')?>";
			</script>