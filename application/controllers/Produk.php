<?php

use Dompdf\Dompdf;

class Produk extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'produk';
		$this->load->model('M_produk', 'm_produk');
		$this->load->model('M_detail_produk', 'm_detail_produk');
		$this->load->model('M_barang', 'm_barang');
	}

	public function index(){
		$this->data['title'] = 'Data Produk';
		$this->data['all_produk'] = $this->m_produk->lihat();
		$this->data['no'] = 1;

		$this->load->view('produk/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'kasir'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Tambah Produk';
		$this->data['all_bahan_baku'] = $this->m_barang->lihat_bahan_baku();

		$this->load->view('produk/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'kasir'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$jumlah_bahan_baku = count($this->input->post('bahan_baku_hidden'));

		$data_produk = [
			'kode_produk' => $this->input->post('kode_produk'),
			'nama_produk' => $this->input->post('nama_produk'),
			'satuan' => $this->input->post('satuan_produk')
		];

		$data_detail_produk = [];

		for($i = 0; $i < $jumlah_bahan_baku; $i++){
			array_push($data_detail_produk, ['kode_produk' => $this->input->post('kode_produk')]);
			$data_detail_produk[$i]['kode_barang'] = explode(" - ", $this->input->post('bahan_baku_hidden')[$i])[1];
			$data_detail_produk[$i]['qty'] = $this->input->post('qty_hidden')[$i];
		}

		if($this->m_produk->tambah($data_produk) && $this->m_detail_produk->tambah($data_detail_produk)){
			$this->session->set_flashdata('success', 'Data Produk <strong>Berhasil</strong> Ditambahkan!');
			redirect('produk');
		} else {
			$this->session->set_flashdata('error', 'Data Produk <strong>Gagal</strong> Ditambahkan!');
			redirect('produk');
		}
	}

	public function ubah($kode_produk){
		if ($this->session->login['role'] == 'kasir'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Ubah Produk';
		$this->data['produk'] = $this->m_produk->lihat_id($kode_produk);

		$this->load->view('produk/ubah', $this->data);
	}

	public function proses_ubah($kode_produk){
		if ($this->session->login['role'] == 'kasir'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'kode_produk' => $this->input->post('kode_produk'),
			'nama_produk' => $this->input->post('nama_produk')
		];

		if($this->m_produk->ubah($data, $kode_produk)){
			$this->session->set_flashdata('success', 'Data Produk <strong>Berhasil</strong> Diubah!');
			redirect('produk');
		} else {
			$this->session->set_flashdata('error', 'Data Produk <strong>Gagal</strong> Diubah!');
			redirect('produk');
		}
	}

	public function hapus($kode_produk){
		if ($this->session->login['role'] == 'kasir'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}
		
		if($this->m_produk->hapus($kode_produk) && $this->m_detail_produk->hapus($kode_produk)){
			$this->session->set_flashdata('success', 'Data Produk <strong>Berhasil</strong> Dihapus!');
			redirect('produk');
		} else {
			$this->session->set_flashdata('error', 'Data Produk <strong>Gagal</strong> Dihapus!');
			redirect('produk');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_produk'] = $this->m_produk->lihat();
		$this->data['title'] = 'Laporan Data Produk';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('produk/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Produk Tanggal ' . date('d F Y'), array("Attachment" => false));
		
	}

	public function keranjang_produk() {
		$this->load->view('produk/keranjang');
	}
	
	public function detail($kode_produk){
		$this->data['title'] = 'Detail Produk';
		$this->data['produk'] = $this->m_produk->lihat_id($kode_produk);
		$this->data['all_detail_produk'] = $this->m_detail_produk->getDataRelasi($kode_produk);
		$this->data['no'] = 1;

		$this->load->view('produk/detail', $this->data);
	}
}