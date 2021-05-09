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
}