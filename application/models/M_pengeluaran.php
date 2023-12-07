<?php

class M_pengeluaran extends CI_Model {
	protected $_table = 'pengeluaran';

	public function lihat(){
		$this->db->from($this->_table.' as p');
		$this->db->join('detail_keluar as dk','p.no_keluar=dk.no_keluar');
		$query=$this->db->get();
		return $query->result();
	} 

	public function getDataRelasi() {
		$sql="SELECT dk.no_keluar, 
		(
			CASE 
				WHEN dk.category = 'barang' THEN b.nama_barang
				WHEN dk.category = 'produk' THEN pr.nama_produk
			END) AS nama_barang,
		dk.jumlah, u.nama, p.tgl_keluar, p.jam_keluar, dk.keterangan 
		FROM `pengeluaran` p 
		INNER JOIN `detail_keluar` dk ON p.no_keluar = dk.no_keluar
		INNER JOIN `pengguna` u ON u.kode = p.kode_petugas
		LEFT JOIN `barang` b ON dk.kode_barang = b.kode_barang 
		LEFT JOIN `produk` pr ON dk.kode_barang = pr.kode_produk";    
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getDataBarangProduk() {
		$sql="SELECT b.kode_barang as 'kode_barang', b.nama_barang as 'nama_barang', b.satuan as 'satuan', b.stok as 'stok', 'barang' as 'category' FROM `barang` b WHERE b.bahan_baku = 'N' UNION SELECT p.kode_produk as 'kode_barang', p.nama_produk as 'nama_barang', p.satuan as 'satuan', 0 as 'stok', 'produk' as 'category' FROM `produk` p";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_no_keluar($no_keluar){
		return $this->db->get_where($this->_table, ['no_keluar' => $no_keluar])->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($no_keluar){
		return $this->db->delete($this->_table, ['no_keluar' => $no_keluar]);
	}
}