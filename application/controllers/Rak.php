
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_rak','mr');
	}

	public function index()
	{
	if($this->session->userdata('level')){
		$data['rak']= $this->mr->ambilrak();
	//	$data['jml']= $this->mr->ambilJumlah();
		$data['konten']='v_rak';
		$this->load->view('template', $data);
	}else{
			redirect('Login','refresh');
	}
		
	}

	public function search(){
		$keyword = $this->input->post('keyword');
		$data['products']=$this->mr->carirak($keyword);
		$data['konten']='search2';
		$this->load->view('template', $data);
	}

	public function tambah(){

		$this->mr->tambah();
		redirect('rak','refresh');
	}


	public function tampil_ubah_rak($kode_rak){

		$data =  $this->mr->tampil_ubah_rak($kode_rak);
		echo json_encode($data);

	}


	public function update(){
			if($this->mr->update()){
					$this->session->set_flashdata('pesan', 'sukses ubah data ');
			}else{

				$this->session->set_flashdata('pesan', 'gagal ubah data ');
			}
			redirect('rak','refresh');
				

	}


	public function hapus($kode_rak){
	if($this->mr->hapus($kode_rak)){

		$this->session->set_flashdata('pesan', 'anda berhasil menghapus data rak');
			redirect('rak','refresh');

	}else{

		$this->session->set_flashdata('pesan', 'anda gagal menghapus data rak');
			redirect('rak','refresh');

	}
}
}

/* End of file rak.php */
/* Location: ./application/controllers/rak.php */

?>