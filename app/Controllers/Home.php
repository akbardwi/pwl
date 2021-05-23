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

	//Fungsi Tambah Data
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

	//Fungsi Get Data
	public function getData($code){
		$model = new Barang_model();
		$barang = $model->check_code($code);

		$data = [
			'data'		=> $barang
		];
		return view('data', $data);
	}

	//Fungsi Edit Data
	public function edit(){
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "POST"){
			$id = filter_var($this->request->getVar('id'), FILTER_SANITIZE_STRING);
			$kode = filter_var($this->request->getVar('kode'), FILTER_SANITIZE_STRING);
			$nama_barang = filter_var($this->request->getVar('nama_barang'), FILTER_SANITIZE_STRING);
			$harga = filter_var($this->request->getVar('harga'), FILTER_SANITIZE_STRING);

			$data = [
				'id'			=> $id,
				'kode'			=> $kode,
				'nama_barang'	=> $nama_barang,
				'harga'			=> $harga
			];

			$model = new Barang_model();
			$edit = $model->edit($data);

			if($edit){
				session()->setFlashdata('error', 'Gagal memperbarui data.');
			} else {		
				session()->setFlashdata('success', 'Data berhasil diperbarui.');
			}
			return redirect()->to(base_url());
		} else {
			return redirect()->to(base_url());
		}
	}

	//Fungsi Hapus Data
	public function hapus($kode){
		$model = new Barang_model();
		$model->hapus($kode);

		session()->setFlashdata('success', 'Data berhasil dihapus.');
		return redirect()->to(base_url());
	}
}
