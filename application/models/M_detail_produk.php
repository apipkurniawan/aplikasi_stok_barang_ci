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
		return $query->row();
	}
}