<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// Load Model
use App\Models\Barang_model;
use App\Models\Pelanggan_model;
// End Load Model

class Api extends ResourceController{
    use ResponseTrait;
    
    //Fungsi Ambil Semua Data
	public function getData(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != "GET"){
            $data = [
                "reason"    => "Method tidak diizinkan"
            ];
            return $this->respond($data);
        }
		$model = new Pelanggan_model();
		$data = $model->findAll();
        return $this->respond($data, 200);
	}

    // Fungsi Ambil 1 Data
    public function show($id = null){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != "GET"){
            $data = [
                "reason"    => "Method tidak diizinkan"
            ];
            return $this->respond($data);
        }
        $model = new Pelanggan_model();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('Data tidak ditemukan');
        }
    }

    // Fungsi Tambah Data
    public function create(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != "POST"){
            $data = [
                "reason"    => "Method tidak diizinkan"
            ];
            return $this->respond($data);
        }
        $model = new Pelanggan_model();
        $data = $this->request->getPost();
        $model->tambah($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data disimpan'
            ]
        ];
         
        return $this->respondCreated($response, 201);
    }

    // Fungsi Update Data
    public function update($id = null){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != "POST"){
            $data = [
                "reason"    => "Method tidak diizinkan"
            ];
            return $this->respond($data);
        }
        $model = new Pelanggan_model();
        $data = $this->request->getPost();
        // Insert to Database
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data diupdate'
            ]
        ];
        return $this->respond($response);
    }

    // delete product
    public function delete($id = null){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != "DELETE"){
            $data = [
                "reason"    => "Method tidak diizinkan"
            ];
            return $this->respond($data);
        }
        $model = new Pelanggan_model();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data dihapus'
                ]
            ];
             
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('Data tidak ditemukan');
        }
         
    }
}