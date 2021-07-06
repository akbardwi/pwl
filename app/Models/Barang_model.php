<?php namespace App\Models;

use CodeIgniter\Model;

class Barang_model extends Model{
    protected $table 		= 'barang';
	protected $primaryKey 	= 'id';
    protected $allowedFields = ['kode', 'nama_barang', 'harga', 'gambar'];

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
		// $this->where('kode',$data['kode']);
		// $this->replace($data);
		$this->update($data['id'], $data);
	}
	
	// Delete
	public function hapus($id){
		$this->where('id',$id);
		$this->delete();
	}

	//Read
    public function read($id){
		$this->select('*');
		$this->where(['id' => $id]);
		$query = $this->get();
		return $query->getRowArray();
	}
}