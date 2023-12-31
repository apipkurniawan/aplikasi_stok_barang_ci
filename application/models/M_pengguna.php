<?php

class M_pengguna extends CI_Model{
	protected $_table = 'pengguna';

	public function lihat() {
		$this->db->select('pengguna.*, role_akses.deskripsi'); 		
		$this->db->from('pengguna'); 		
		$this->db->join('role_akses', 'role_akses.kode_role = pengguna.kode_role'); 		
		$query = $this->db->get(); 		
		return $query->result(); 	
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($id){
		$query = $this->db->get_where($this->_table, ['kode' => $id]);
		return $query->row();
	}

	public function lihat_username($username){
		$query = $this->db->get_where($this->_table, ['username' => $username]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode' => $id]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id){
		return $this->db->delete($this->_table, ['kode' => $id]);
	}
}