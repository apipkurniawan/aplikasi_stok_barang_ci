<?php

class M_detail_terima extends CI_Model {
	protected $_table = 'detail_terima';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_no_terima($no_terima){
		$this->db->select('detail_terima.*, barang.satuan'); 		
		$this->db->from('detail_terima'); 		
		$this->db->join('barang', 'barang.kode_barang = detail_terima.kode_barang'); 		
		$query = $this->db->get();		
		return $query->result();
	}

	public function hapus($no_terima){
		return $this->db->delete($this->_table, ['no_terima' => $no_terima]);
	}
}