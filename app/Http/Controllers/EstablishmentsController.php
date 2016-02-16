<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Establishment;
use App\Models\Product;

class EstablishmentsController extends Controller {

	public function __construct() {
		$this->middleware('auth', [ 'except' => [ 'index', 'show' ] ]);
	}

	public function show($id) {
		$stab = $establishments = Establishment::find($id);
		$products = Product::all();
		$stab['image'] = $stab['id'].'/'.$stab['image'];
		$menu_name = $title = $establishments['name'];
		$categoryItems = [
			"Cardápio",
			"Especialidades",
			"Endereços",
			"Contatos"
		];
		return view('orders.view_establishments',
			compact('establishments', 'stab', 'products', 'title', 'menu_name', 'categoryItems', 'carouselItems'));
	}


}