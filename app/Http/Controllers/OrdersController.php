<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Establishment;
use App\Article;

class OrdersController extends Controller {

	public function index() {
		$establishments = Establishment::all();
		$categoryItems = array();
		$carouselItems = [1, 2, 3, 4];
		$stab = array();
		foreach ($establishments as $key => $value) {
			$stab[$key]['name'] = $value['name'];
			$stab[$key]['phone'] = $value['phone'];
			$stab[$key]['street'] = $value['street'];
			$stab[$key]['image'] = $value['id'].'/'.$value['image'];
		}
		print_r($stab);
		$title = "Pedidos";
		$menu_name = '1';
		return view('orders.index',
			compact('title', 'menu_name', 'categoryItems', 'carouselItems', 'stab'));
	}
}