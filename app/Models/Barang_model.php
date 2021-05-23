<?php namespace App\Models;

use CodeIgniter\Model;

class Barang_model extends Model{
    protected $table 		= 'barang';
	protected $primaryKey 	= 'id';
    protected $allowedFields = ['kode', 'nama_barang', 'harga'];

    // Listing
	public function listing(){
		$this->select('*');
		$this->orderBy('id','ASC');
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