<?php
// Estabelecimentos na visão do CLIENTE

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

	public function index() {
		$establishments = Establishment::paginate(10);
		$categoryItems = [1, 2, 3, 4];
		$carouselItems = [1, 2, 3, 4];
		$stab = array();
		foreach ($establishments as $key => $value) {
			$stab[$key]['id'] = $value['id'];
			$stab[$key]['name'] = $value['name'];
			$stab[$key]['phone'] = $value['phone'];
			$stab[$key]['street'] = $value['street'];
			$stab[$key]['street_number'] = $value['street_number'];
			$stab[$key]['cep'] = $value['cep'];
			$stab[$key]['neighborhood'] = $value['neighborhood'];
			$stab[$key]['complement'] = $value['complement'];
			$stab[$key]['image'] = $value['id'].'/'.$value['image'];
		}
		$title = "Selecione um restaurante";
		$menu_name = 'Tipos';
		return view('establishments.index',
			compact('establishments', 'title', 'menu_name', 'categoryItems', 'carouselItems', 'stab'));
	}

	public function view_establishment($id) {
		$stab = Establishment::find($id);
		$products = Product::where('establishment_id', '=', $id)->paginate(10);
		$stab['image'] = $stab['id'].'/'.$stab['image'];
		$title = $stab['name'];
		$menu_name = "";
		$categoryItems = [
			"Cardápio",
			"Especialidades",
			"Endereços",
			"Contatos"
		];
		return view('establishments.view_establishment',
			compact('stab', 'products', 'title', 'menu_name', 'categoryItems', 'carouselItems'));
	}


}