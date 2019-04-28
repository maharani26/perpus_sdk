
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	public function ambilbarang(){
			$ambilbarang = $this->db->join('kategori', 'kategori.kode_kategori = barang.kode_kategori')
									->join('rak','rak.kode_rak = barang.kode_rak')
									->get('barang')->result();
	
			return $ambilbarang;
	}

	public function caribarang($keyword){
		$ambilbarang = $this->db->join('kategori', 'kategori.kode_kategori = barang.kode_kategori')
								->join('rak','rak.kode_rak = barang.kode_rak')
								->like('nama_barang',$keyword)
								->or_like('kode_barang', $keyword)
								->or_like('nama_kategori', $keyword)
								->or_like('nama_rak', $keyword)
								->get('barang')->result();

		return $ambilbarang;
}

	public function ambilrak(){
		$ambilbarang = $this->db->get('rak')->result();

		return $ambilbarang;
}
	public function ambilkategori(){

			$ambilkategori = $this->db->get('kategori')->result();

			return $ambilkategori;
	}

	public function tambah($nama_file){

	if($nama_file == ""){

			$tambah = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'kode_kategori' => $this->input->post('kategori'),
				'kode_rak' => $this->input->post('rak'),
				'stok' => $this->input->post('stok'), );

	}else{

		$tambah = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'kode_kategori' => $this->input->post('kategori'),
				'kode_rak' => $this->input->post('rak'),
				'cover' => $nama_file,
				'stok' => $this->input->post('stok'),
				 );


	}
	return $this->db->insert('barang', $tambah);
	}

public function tampil_ubah_barang($kode_barang){
		return $this->db->join('kategori', 'kategori.kode_kategori = barang.kode_kategori')->where('kode_barang',$kode_barang)->get('barang')->row();

	}



public function update(){
			$ubah = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'kode_kategori' => $this->input->post('kategori'),
				'kode_rak' => $this->input->post('rak'),
				'stok' => $this->input->post('stok'), );

			return $this->db->where('kode_barang',$this->input->post('kode_barang'))->update('barang', $ubah);

}


public function update_ft($nama_file){
				$ubah = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'kode_kategori' => $this->input->post('kategori'),
				'cover' => $nama_file,
				'stok' => $this->input->post('stok'), );

		return $this->db->where('kode_barang',$this->input->post('kode_barang'))->update('barang', $ubah);





}


public function hapus($kode_barang ){
	return $this->db->where('kode_barang',$kode_barang)->delete('barang');
}




public function ambilbarangcart($kode_barang){
	return $this->db->where('kode_barang',$kode_barang )->get('barang')->row();
	

}

}

/* End of file M_barang.php */
/* Location: ./application/models/M_barang.php */

?>