<?php

class M_detail_produk extends CI_Model{
	protected $_table = 'detail_produk';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function ubah($data, $kode_produk){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_produk' => $kode_produk]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_produk){
		return $this->db->delete($this->_table, ['kode_produk' => $kode_produk]);
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($kode_produk){
		$query = $this->db->get_where($this->_table, ['kode_produk' => $kode_produk]);
		return $query->result();
	}

	public function getDataRelasi($kode_produk){
		$sql="SELECT dp.kode_produk, dp.kode_barang, b.nama_barang, dp.qty, dp.satuan FROM `detail_produk` dp INNER JOIN `barang` b ON dp.kode_barang = b.kode_barang WHERE dp.kode_produk = ?";    
		$query = $this->db->query($sql, array($kode_produk));
		return $query->result();
	}

	public function get_kode_bahan_baku($kode_produk){
		$query = $this->db->select('kode_barang');
		$query = $this->db->where(['kode_produk' => $kode_produk]);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_formula_bahan_baku($kode_produk, $kode_barang){
		$query = $this->db->select('qty');
		$query = $this->db->where(['kode_produk' => $kode_produk, 'kode_barang' => $kode_barang]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}
}