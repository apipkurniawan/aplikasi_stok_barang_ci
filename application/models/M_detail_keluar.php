<?php

class M_detail_keluar extends CI_Model {
	protected $_table = 'detail_keluar';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_no_keluar($no_keluar){
		$this->db->select('detail_keluar.*, barang.satuan'); 		
		$this->db->from('detail_keluar'); 		
		$this->db->join('barang', 'barang.kode_barang = detail_keluar.kode_barang'); 		
		$query = $this->db->get();		
		return $query->result(); 	
	}

	public function hapus($no_keluar){
		return $this->db->delete($this->_table, ['no_keluar' => $no_keluar]);
	}
}