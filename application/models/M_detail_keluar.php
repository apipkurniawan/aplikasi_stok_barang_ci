<?php

class M_detail_keluar extends CI_Model {
	protected $_table = 'detail_keluar';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_no_keluar($no_keluar){
		$sql="SELECT dk.*, 
		(
			CASE 
				WHEN dk.category = 'barang' THEN b.satuan
				WHEN dk.category = 'produk' THEN p.satuan
			END
		) AS satuan,
		(
			CASE 
				WHEN dk.category = 'barang' THEN b.nama_barang
				WHEN dk.category = 'produk' THEN p.nama_produk
			END
		) AS nama_barang
		FROM detail_keluar dk
		LEFT JOIN `barang` b ON b.kode_barang = dk.kode_barang
		LEFT JOIN `produk` p ON p.kode_produk = dk.kode_barang
		WHERE dk.no_keluar = ? ";
		$query = $this->db->query($sql, array($no_keluar));
		return $query->result(); 	
	}

	public function hapus($no_keluar){
		return $this->db->delete($this->_table, ['no_keluar' => $no_keluar]);
	}
}