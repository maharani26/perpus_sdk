<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_barang','mbk');
		$this->load->model('M_transaksi','mts');
	}



	public function index()
	{

	if($this->session->userdata('level')){


		$data['konten']="v_transaksi";
		$data['barang']=$this->mbk->ambilbarang();
		$this->load->view('template', $data, FALSE);
	}else{
			redirect('Login','refresh');
	}
	}


	public function transaksi(){
		if($this->input->post('pinjam')){

			$this->form_validation->set_rules('pembeli', 'pembeli', 'trim|required');
			$this->form_validation->set_rules('tanggal_pengembalian', 'tanggal_pengembalian', 'trim|required');

			if ($this->form_validation->run() == TRUE ) {
			
			if($this->mts->cekstok() == 1){


				$id_nota = $this->mts->simpan_db();

				if($id_nota){

					$this->session->set_flashdata('pinjam', 'Transaksi '.$this->input->post('pembeli').' berhasil');
					$data['dts']=$this->mts->ambil_dts($id_nota);
					$data['ts']= $this->mts->ambil_ts($id_nota);

					$pinjam = $this->input->post('pinjam');

					// $total = $this->cart->total();
					// $kembali =  $bayar - $total;
					
					// $this->session->set_flashdata('kembali', $kembali );
					$nama=$this->input->post('pembeli');
					$this->session->set_flashdata('pembeli', $nama);
					$this->cart->destroy();
					$this->load->view('nota', $data);
					
				}
				else{

					$nama=$this->input->post('pembeli');
					$this->session->set_flashdata('pembeli', $nama);
					$this->session->set_flashdata('pinjam', 'anda gagal bertransaksi');
					redirect('transaksi','refresh');

				}

			}else{

				
				$nama=$this->input->post('pembeli');
				$this->session->set_flashdata('pembeli', $nama);
				$this->session->set_flashdata('pinjam', 'Mohon maaf barang anda tidak mencukupi');
				redirect('transaksi','refresh');
			}

			}else{

				$nama=$this->input->post('pembeli');
				$this->session->set_flashdata('pembeli', $nama);
				$this->session->set_flashdata('pinjam', validation_errors());
				redirect('transaksi','refresh');

			}

		}else{

			for($i=0;$i<count($this->cart->contents());$i++){
				$data = array(
					'rowid' => $this->input->post('rowid')[$i],
					'qty'   => $this->input->post('banyak')[$i]
					);$this->cart->update($data);
			}

			$nama=$this->input->post('pembeli');

			$this->session->set_flashdata('pembeli', $nama);

			redirect('Transaksi','refresh');

		}

	}

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */

?>