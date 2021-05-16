<?php

namespace App\Controllers;

// Load Model
use App\Models\Barang_model;
// End Load Model

class Home extends BaseController{
	public function index()	{
		$model = new Barang_model();
		$data = [
			'barang'	=> $model->listing()
		];
		return view('index', $data);
	}

	public function tambah(){
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != "POST"){
			return redirect()->to(base_url());
		} else {
			$kode = filter_var($this->request->getVar('kode'), FILTER_SANITIZE_STRING);
			$nama_barang = filter_var($this->request->getVar('nama_barang'), FILTER_SANITIZE_STRING);
			$harga = filter_var($this->request->getVar('harga'), FILTER_SANITIZE_STRING);

			$data = [
				'kode'			=> $kode,
				'nama_barang'	=> $nama_barang,
				'harga'			=> $harga
			];

			$model = new Barang_model();
			$cek = $model->check_code($kode);

			if($cek){
				session()->setFlashdata('error', 'Kode produk sudah ada.');
			} else {
				$model->tambah($data);			
				session()->setFlashdata('success', 'Data berhasil disimpan.');
			}
			return redirect()->to(base_url());
		}
	}
}
