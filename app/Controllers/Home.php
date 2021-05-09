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
}
