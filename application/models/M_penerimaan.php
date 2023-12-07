<?php

class M_penerimaan extends CI_Model {
	protected $_table = 'penerimaan';

	public function lihat(){
		$this->db->from($this->_table.' as p');
		$this->db->join('detail_terima as dt','p.no_terima=dt.no_terima');
		$query=$this->db->get();
		return $query->result();
		// return $this->db->get($this->_table)->result();
	} 

	public function getDataRelasi() {
		$sql="SELECT dt.no_terima, b.nama_barang, dt.jumlah, u.nama as 'user', s.nama as 'supplier', p.tgl_terima, p.jam_terima FROM `penerimaan` p INNER JOIN `detail_terima` dt ON p.no_terima = dt.no_terima INNER JOIN `barang` b ON dt.kode_barang = b.kode_barang INNER JOIN `pengguna` u ON u.kode = p.kode_petugas INNER JOIN `supplier` s ON s.kode_supplier = p.kode_supplier;";    
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_no_terima($no_terima){
		$this->db->select('penerimaan.*, pengguna.nama as user, supplier.nama as supplier'); 		
		$this->db->from('penerimaan'); 		
		$this->db->join('pengguna', 'pengguna.kode = penerimaan.kode_petugas'); 		
		$this->db->join('supplier', 'supplier.kode_supplier = penerimaan.kode_supplier'); 		
		$this->db->where('no_terima', $no_terima);
		$query = $this->db->get(); 		
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($no_terima){
		return $this->db->delete($this->_table, ['no_terima' => $no_terima]);
	}
}