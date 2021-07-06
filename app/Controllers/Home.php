<?php

namespace App\Controllers;

// Load Model
use App\Models\Barang_model;
// End Load Model

class Home extends BaseController{
	public function panggil_barang(){
		$model = new Barang_model();
		$barang = $model->listing();
		$data = [
			'barang'	=> $barang
		];
		return view('panggil_barang', $data);
	}

	public function panggil_tampilan(){
		$model = new Barang_model();
		$barang = $model->listing();
		$data = [
			'barang'	=> $barang
		];
		render_page('layout','header', $data);
		render_content('/','panggil_tampilan', $data);
		render_page('layout','footer', $data);
	}

	public function detail_barang($id){
		$model = new Barang_model();
		$barang = $model->read($id);
		$data = [
			'barang'	=> $barang
		];
		render_page('layout','header', $data);
		render_content('/','detail_barang', $data);
		render_page('layout','footer', $data);
	}

	//Fungsi Tambah Data
	public function tambah(){
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != "POST"){
			return redirect()->to(base_url());
		} else {
			$kode = filter_var($this->request->getVar('kode'), FILTER_SANITIZE_STRING);
			$nama_brg = filter_var($this->request->getVar('nama_brg'), FILTER_SANITIZE_STRING);
			$harga = filter_var($this->request->getVar('harga'), FILTER_SANITIZE_NUMBER_INT);
			$gambar = $this->request->getFile('gambar');

			$namagambar 	= $gambar->getName();
            $gambar->move(WRITEPATH . '../img/',$namagambar);

			$data = [
				'kode'			=> $kode,
				'nama_barang'	=> $nama_brg,
				'harga'			=> $harga,
				'gambar'		=> $namagambar
			];

			$model = new Barang_model();
			$cek = $model->check_code($kode);

			if($cek){
				session()->setFlashdata('error', 'Kode produk sudah ada.');
			} else {
				$model->tambah($data);		
				session()->setFlashdata('success', 'Data berhasil ditambah.');		
			}
			return redirect()->to(base_url());
		}
	}

	//Fungsi Get Data
	public function getData($code){
		$model = new Barang_model();
		$brg = $model->check_code($code);

		$data = [
			'data'		=> $brg
		];
		return view('data', $data);
	}

	//Fungsi Edit Data
	public function edit(){
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "POST"){
			$id = filter_var($this->request->getVar('id'), FILTER_SANITIZE_STRING);
			$kode = filter_var($this->request->getVar('kode'), FILTER_SANITIZE_STRING);
			$nama_brg = filter_var($this->request->getVar('nama_brg'), FILTER_SANITIZE_STRING);
			$harga = filter_var($this->request->getVar('harga'), FILTER_SANITIZE_NUMBER_INT);

			$data = [
				'id'			=> $id,
				'kode'			=> $kode,
				'nama_barang'	=> $nama_brg,
				'harga'			=> $harga
			];

			$model = new Barang_model();
			$edit = $model->edit($data);

			session()->setFlashdata('success', 'Data berhasil diperbarui.');
			return redirect()->to(base_url());
		} else {
			return redirect()->to(base_url());
		}
	}

	//Fungsi Hapus Data
	public function hapus($id){
		$model = new Barang_model();
		$model->hapus($id);

		session()->setFlashdata('success', 'Data berhasil dihapus.');
		return redirect()->to(base_url());
	}
}
