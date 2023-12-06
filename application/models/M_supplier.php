<?php

class M_supplier extends CI_Model{
	protected $_table = 'supplier';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($kode){
		$query = $this->db->get_where($this->_table, ['kode_supplier' => $kode]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $kode){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_supplier' => $kode]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode){
		return $this->db->delete($this->_table, ['kode_supplier' => $kode]);
	}
}