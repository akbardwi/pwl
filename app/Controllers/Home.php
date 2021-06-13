<?php

namespace App\Controllers;

// Load Model
use App\Models\Barang_model;
use App\Models\Pelanggan_model;
// End Load Model

class Home extends BaseController{
	public function index()	{
		// $model = new Pelanggan_model();
		$plggn = json_decode(file_get_contents(base_url("api/getData")), true);
		$data = [
			'pelanggan'	=> $plggn
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
			$nama_plggn = filter_var($this->request->getVar('nama_plggn'), FILTER_SANITIZE_STRING);
			$alamat = filter_var($this->request->getVar('alamat'), FILTER_SANITIZE_STRING);
			$no_telp = filter_var($this->request->getVar('no_telp'), FILTER_SANITIZE_NUMBER_INT);
			$kota = filter_var($this->request->getVar('kota'), FILTER_SANITIZE_STRING);

			$data = [
				'kode'			=> $kode,
				'nama_plggn'	=> $nama_plggn,
				'alamat'		=> $alamat,
				'no_telp'		=> $no_telp,
				'kota'			=> $kota
			];

			$model = new Pelanggan_model();
			$cek = $model->check_code($kode);

			if($cek){
				session()->setFlashdata('error', 'Kode produk sudah ada.');
			} else {
				// $model->tambah($data);			

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, base_url("api/create"));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				$result = curl_exec($ch);
				$json_result = json_decode($result, true);
				if($json_result['status'] == 201){
					session()->setFlashdata('success', 'Data berhasil disimpan.');
				}				
			}
			return redirect()->to(base_url());
		}
	}

	//Fungsi Get Data
	public function getData($code){
		$model = new Pelanggan_model();
		$plggn = $model->check_code($code);

		$data = [
			'data'		=> $plggn
		];
		return view('data', $data);
	}

	//Fungsi Edit Data
	public function edit(){
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "POST"){
			$id = filter_var($this->request->getVar('id'), FILTER_SANITIZE_STRING);
			$kode = filter_var($this->request->getVar('kode'), FILTER_SANITIZE_STRING);
			$nama_plggn = filter_var($this->request->getVar('nama_plggn'), FILTER_SANITIZE_STRING);
			$alamat = filter_var($this->request->getVar('alamat'), FILTER_SANITIZE_STRING);
			$no_telp = filter_var($this->request->getVar('no_telp'), FILTER_SANITIZE_NUMBER_INT);
			$kota = filter_var($this->request->getVar('kota'), FILTER_SANITIZE_STRING);

			$data = [
				'id'			=> $id,
				'kode'			=> $kode,
				'nama_plggn'	=> $nama_plggn,
				'alamat'		=> $alamat,
				'no_telp'		=> $no_telp,
				'kota'			=> $kota
			];

			$model = new Pelanggan_model();
			// $edit = $model->edit($data);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, base_url("api/update/".$id));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$result = curl_exec($ch);
			$json_result = json_decode($result, true);

			if($json_result['status'] != 200){
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
	public function hapus($id){
		$model = new Pelanggan_model();
		// $model->hapus($kode);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, base_url("api/delete/".$id));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		$result = curl_exec($ch);
		$json_result = json_decode($result, true);

		session()->setFlashdata('success', 'Data berhasil dihapus.');
		return redirect()->to(base_url());
	}
}
