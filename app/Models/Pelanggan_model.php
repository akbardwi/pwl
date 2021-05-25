<?php namespace App\Models;

use CodeIgniter\Model;

class Pelanggan_model extends Model{
    protected $table 		= 'pelanggan';
	protected $primaryKey 	= 'id';
    protected $allowedFields = ['kode', 'nama_plggn', 'alamat', 'no_telp', 'kota'];

    // Listing
	public function listing(){
		$this->select('*');
		$this->orderBy('kode','ASC');
		$query = $this->get();
		return $query->getResultArray();
	}

	// Cek Kode Produk
	public function check_code($code){
		$this->select('*');
		$this->where('kode',$code);
		$query = $this->get();
		return $query->getRowArray();
	}

	// Tambah Data
	public function tambah($data){
		$this->save($data);
	}

	// Edit
	public function edit($data){
		$this->where('kode',$data['kode']);
		$this->replace($data);
	}
	
	// Delete
	public function hapus($kode){
		$this->where('kode',$kode);
		$this->delete();
	}
}