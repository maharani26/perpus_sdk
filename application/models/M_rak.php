<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rak extends CI_Model {
	
	public function ambilrak()
	{
		$ambilrak = $this->db->select('*')->from('rak')->get()->result();
		return $ambilrak;
	}
	public function ambilbarang()
	{
		$ambilrak = $this->db->get('barang')->result();
		return $ambilrak;
	}

	public function carirak($keyword)
	{
		$ambilrak = $this->db->like('kode_rak',$keyword)
							 ->or_like('nama_rak', $keyword)
							 ->get('rak')
							 ->result();
		return $ambilrak;
	}

	public function tambah(){
		$tambah = array(
		'nama_rak' => $this->input->post('nama_rak'),);	
		return $this->db->insert('rak', $tambah);
	}

	public function tampil_ubah_rak($kode_rak)
	{
		return $this->db->where('kode_rak',$kode_rak)->get('rak')->row();
	}

	public function update()
	{
		$ubah = array(
			'nama_rak' => $this->input->post('nama_rak'),);
			return $this->db->where('kode_rak',$this->input->post('kode_rak'))->update('rak', $ubah);
	}

	public function hapus($kode_rak )
	{
		return $this->db->where('kode_rak',$kode_rak)->delete('rak');
	}
}

/* End of file M_rak.php */
/* Location: ./application/models/M_rak.php */
?>