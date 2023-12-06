<?php

use Dompdf\Dompdf;

class Pengeluaran extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->data['aktif'] = 'pengeluaran';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_detail_keluar', 'm_detail_keluar');
		$this->load->model('M_detail_produk', 'm_detail_produk');
	}

	public function index(){
		$this->data['title'] = 'Transaksi Pengeluaran';
		$this->data['all_pengeluaran'] = $this->m_pengeluaran->getDataRelasi();
		$this->data['no'] = 1;

		$this->load->view('pengeluaran/lihat', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Transaksi';
		$this->data['all_barang'] = $this->m_pengeluaran->getDataBarangProduk();

		$this->load->view('pengeluaran/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_barang_keluar = count($this->input->post('nama_barang_hidden'));

		$data_keluar = [
			'no_keluar' => $this->input->post('no_keluar'),
			'tgl_keluar' => $this->input->post('tgl_keluar'),
			'jam_keluar' => $this->input->post('jam_keluar'),
			'kode_petugas' => $this->input->post('kode_petugas'),
		];

		$data_detail_keluar = [];

		for($i = 0; $i < $jumlah_barang_keluar; $i++){
			array_push($data_detail_keluar, ['no_keluar' => $this->input->post('no_keluar')]);
			$data_detail_keluar[$i]['kode_barang'] = explode(" - ", $this->input->post('nama_barang_hidden')[$i])[1];
			$data_detail_keluar[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_keluar[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
			$data_detail_keluar[$i]['keterangan'] = $this->input->post('keterangan_hidden')[$i];
		}

		if ($this->m_pengeluaran->tambah($data_keluar) && $this->m_detail_keluar->tambah($data_detail_keluar)) {
			for ($i=0; $i < $jumlah_barang_keluar ; $i++) { 
				// cek mana yg produk dan barang		
				if ($this->input->post('category_hidden')[$i] === 'barang') {
					// klo kategori barang : 
					// - update stok ke tabel barang
					$this->m_barang->min_stok($data_detail_keluar[$i]['jumlah'], $data_detail_keluar[$i]['kode_barang']) or die('gagal min stok');
				} else {
					// // klo kategori produk :
					// // - cek ada berapa bahan baku -> m_detail_produk(kode_produk)
					// $kode_produk = $data_detail_keluar[$i]['kode_barang'];
					// $detail_bahan_baku = $this->m_detail_produk->get_kode_bahan_baku($kode_produk);
					// for ($i=0; $i < count($detail_bahan_baku); $i++) { 
					// 	// - cek stok bahan baku tersedia -> m_barang(kode_barang)
					// 	$stok_bahan_baku_tersedia = $this->m_barang->get_stok_barang($detail_bahan_baku[$i]);
					// 	// - cek stok bahan baku terjual -> m_detail_produk(kode_produk, kode_barang)
					// 	$qty = $this->m_detail_produk->get_formula_bahan_baku($kode_produk, $detail_bahan_baku[$i]);
						
					// 	$stok_bahan_baku_terjual = intval($data_detail_keluar[$i]['jumlah']) * intval($qty);

					// 	$total = intval($stok_bahan_baku_tersedia[0]->stok) - intval($stok_bahan_baku_terjual);

					// 	// - update stok sesuai formula detail produk dan jumlahnya
					// 	$this->m_barang->min_stok($total, $detail_bahan_baku[$i]) or die('gagal min stok');
					// }
				}

			}
			$this->session->set_flashdata('success', 'Invoice <strong>Pengeluaran</strong> Berhasil Dibuat!');
			redirect('pengeluaran');
		}
	}

	public function detail($no_keluar){
		$this->data['title'] = 'Detail Pengeluaran';
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['no'] = 1;

		$this->load->view('pengeluaran/detail', $this->data);
	}

	public function hapus($no_keluar){
		if($this->m_pengeluaran->hapus($no_keluar) && $this->m_detail_keluar->hapus($no_keluar)){
			$this->session->set_flashdata('success', 'Invoice Pengeluaran <strong>Berhasil</strong> Dihapus!');
			redirect('pengeluaran');
		} else {
			$this->session->set_flashdata('error', 'Invoice Pengeluaran <strong>Gagal</strong> Dihapus!');
			redirect('pengeluaran');
		}
	}

	public function get_all_barang(){
		$data = $this->m_barang->lihat_nama_barang($_POST['nama_barang']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('pengeluaran/keranjang');
	}

	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_pengeluaran'] = $this->m_pengeluaran->getDataRelasi();
		$this->data['title'] = 'Laporan Data Pengeluaran';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('pengeluaran/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_keluar){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['title'] = 'Laporan Detail Pengeluaran';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('pengeluaran/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}