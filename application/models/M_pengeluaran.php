<?php

class M_pengeluaran extends CI_Model {
	protected $_table = 'pengeluaran';

	public function lihat(){
		$this->db->from($this->_table.' as p');
		$this->db->join('detail_keluar as dk','p.no_keluar=dk.no_keluar');
		$query=$this->db->get();
		return $query->result();
		// return $this->db->get($this->_table)->result();
	} 

	public function getDataRelasi() {
		$sql="SELECT dk.no_keluar, b.nama_barang, dk.jumlah, u.nama, p.tgl_keluar, p.jam_keluar, dk.keterangan FROM `pengeluaran` p INNER JOIN `detail_keluar` dk ON p.no_keluar = dk.no_keluar INNER JOIN `barang` b ON dk.kode_barang = b.kode_barang INNER JOIN `pengguna` u ON u.kode = p.kode_petugas";    
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