<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Transaksi extends CI_Model {

	public function cekstok(){
		$ck=1;
		for($i=0;$i<count($this->cart->contents());$i++){
			$stok = $this->db->where('kode_barang', $this->input->post('kode_barang')[$i])->get('barang')->row()->stok;
			$qty = $this->input->post('banyak')[$i];
			$cek = $stok - $qty;
			if($cek < 0){
				$cc = 0;
			}else{
				$cc = 1;
			}
			$ck = $cc*$ck;
		}
		return $ck;
	}

	public function simpan_db()
	{
			for($i=0;$i<count($this->cart->contents());$i++){
			$stok = $this->db->where('kode_barang', $this->input->post('kode_barang')[$i])->get('barang')->row()->stok;
			$qty = $this->input->post('banyak')[$i];
			$sisa = $stok - $qty;
			$u_stok = array('stok' => $sisa, );
			$this->db->where('kode_barang', $this->input->post('kode_barang')[$i])->update('barang', $u_stok);
			}

			$s_transaksi = array('kode_user'   =>  $this->session->userdata('kode_user'),
								'nama_pembeli' =>$this->input->post('pembeli'),
								// 'total' 	   =>$this->cart->total(),
								'tanggal_peminjaman' => date('Y-m-d'),
								'status' => 'Belum Kembali',
								'tanggal_pengembalian' => $this->input->post('tanggal_pengembalian'),
							);

			$this->db->insert('transaksi', $s_transaksi);
			$ts=$this->db->order_by('kode_transaksi', 'desc')
						->where('nama_pembeli',$this->input->post('pembeli'))
						->limit(1)
						->get('transaksi')
						->row();

			for($i=0;$i<count($this->cart->contents());$i++){
			$s_dttransaski[] = array('kode_transaksi' => $ts->kode_transaksi,
									 'kode_barang'	  =>$this->input->post('kode_barang')[$i],
									 'jumlah'         => $this->input->post('banyak')[$i]);
			}
				$db = $this->db->insert_batch('detail_transaksi', $s_dttransaski);
				if ($db){
					return $ts->kode_transaksi;
				} else {
					return 0;
				}
			}

		public function ambil_dts($kode_transaksi){

			return $this->db->join('barang', 'barang.kode_barang = detail_transaksi.kode_barang')
						->where('kode_transaksi',$kode_transaksi)
						->get('detail_transaksi')
						->result();
		}	

		public function ambil_ts($kode_transaksi){
			return $this->db->join('user', 'user.kode_user = transaksi.kode_user')
						->where('kode_transaksi',$kode_transaksi)
						->get('transaksi')
						->row();
		}
		public function ambil_semua(){
				return $this->db->join('user', 'user.kode_user = transaksi.kode_user')
						->get('transaksi')
						->result();
		}
	
		public function ambil_peminjaman(){
			return $this->db->join('user', 'user.kode_user = transaksi.kode_user')
							
							->get('transaksi')
							->result();
							
		}
		
		public function ambil_pengembalian(){
			return $this->db->join('user', 'user.kode_user = transaksi.kode_user')
					->join('detail_transaksi', 'detail_transaksi.kode_transaksi = transaksi.kode_transaksi')
					->join('barang', 'barang.kode_barang = detail_transaksi.kode_barang')
					->where('transaksi.status', 'Belum Kembali')
					->get('transaksi')
					->result();
			}

	
public function ubah_pengembalian($id){

	$getKodeBarang = $this->db
				->select('*')
				->join('detail_transaksi', 'detail_transaksi.kode_transaksi = transaksi.kode_transaksi')
				->where('transaksi.kode_transaksi',$id)
				->get('transaksi')
				->row();

				
	$stok = $this->db
				->select('*')
				->where('barang.kode_barang', $getKodeBarang->kode_barang)
				->get('barang')
				->row();
		
	$data = array(
        'status' => 'Sudah Kembali',
	);
	$this->db->where('kode_transaksi', $id)->update('transaksi', $data);
		
	$data1 = array(
        'stok'  => ($stok->stok) + ($getKodeBarang->jumlah)
	);
	$this->db->where('kode_barang', $stok->kode_barang)->update('barang', $data1);

}}

/* End of file M_Transaksi.php */
/* Location: ./application/models/M_Transaksi.php */

?>