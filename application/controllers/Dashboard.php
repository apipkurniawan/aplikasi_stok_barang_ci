<?php

class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'dashboard';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_supplier', 'm_supplier');
		$this->load->model('M_produk', 'm_produk');
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_penerimaan', 'm_penerimaan');
		$this->load->model('M_pengguna', 'm_pengguna');
		$this->load->model('M_toko', 'm_toko');
	}

	public function index(){
		$this->data['title'] = 'Halaman Dashboard';
		$this->data['jumlah_barang'] = $this->m_barang->jumlah_non_bahan_baku();
		$this->data['jumlah_bahan_baku'] = $this->m_barang->jumlah_bahan_baku();
		$this->data['jumlah_supplier'] = $this->m_supplier->jumlah();
		$this->data['jumlah_produk'] = $this->m_produk->jumlah();
		$this->data['jumlah_pengeluaran'] = $this->m_pengeluaran->jumlah();
		$this->data['jumlah_penerimaan'] = $this->m_penerimaan->jumlah();
		$this->data['jumlah_pengguna'] = $this->m_pengguna->jumlah();
		$this->data['toko'] = $this->m_toko->lihat();
		$this->load->view('dashboard', $this->data);
	}
}