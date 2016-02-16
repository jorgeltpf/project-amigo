<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Establishment;
use App\Models\Product;

class OrdersController extends Controller {

	public function index() {
		$establishments = Establishment::all();
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
		// print_r($stab);
		$title = "Selecione um local";
		$menu_name = 'Tipos';
		return view('orders.index',
			compact('title', 'menu_name', 'categoryItems', 'carouselItems', 'stab'));
	}

	/**
	 *	Visão do carrinho de compras do cliente
	 *	@param int $id id do produto selecionado
	 */
	public function shopping_cart_view($id) {
		$products = Product::all();
		return view('orders.shopping_cart_view', compact('products'));
	}
}