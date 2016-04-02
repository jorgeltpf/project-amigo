<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Order;
use App\Models\ItemOrder;
use App\Models\Establishment;
use App\Models\Product;
use App\Models\PaymentType;

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
		$title = "Selecione um local";
		$menu_name = 'Tipos';
		return view('orders.index',
			compact('title', 'menu_name', 'categoryItems', 'carouselItems', 'stab'));
	}

	/**
	 *	Visão dos pagamentos dos pedidos
	 *	@param int $id id do pedido
	 */
	public function payments_index($id) {
		$orders = Order::findOrFail($id)->with('item_orders')->get();
		$result = [];
		foreach($orders as $items) {
			if (empty($result['total'])) {
				$result['total'] = 0;
			}
			if (empty($result['qtd'])) {
				$result['qtd'] = 0;
			}
			$result['total'] += $items['total_amount'];
			$result['qtd'] += $items['quantity'];
		}
		$payment_types = PaymentType::all();
		return view('orders.payments_index', compact('result','orders', 'payment_types'));
	}

	/**
	 *	Visão dos pagamentos dos pedidos
	 *	@param int $id id do pedido
	 */
	public function order_payments($id) {
		$orders = Order::find($id);

	}

	/**
	 *	Visão do carrinho de compras do cliente
	 *	@param int $id id do produto selecionado
	 */
	public function shopping_cart_view($id) {
		$products = Product::all();
		return view('orders.shopping_cart_view', compact('products'));
	}

	public function getCreate() {

	}

	public function postCreate(Request $request) {
		// dd($request->all());
		$order = new Order();
		$item_orders = [];

		// Available alpha caracters
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		// generate a pin based on 2 * 7 digits + a random character
		$pin = mt_rand(1000000, 9999999)
    	. mt_rand(1000000, 9999999)
    	. $characters[rand(0, strlen($characters) - 1)];
		if (\Auth::check()) {
			$person = \Auth::user()->person;

			$order['user_id'] = $person->user_id;
			$order['number'] = 1023456782;
			$order['establishment_id'] = $request['establishment_id'];
			$order['total_amount'] = $request['price'];
			$order['street'] = $person->street;
			$order['street_number'] = $person->street_number;
			$order['complement'] = $person->complement;
			$order['cep'] = $person->cep;
			$order['state'] = 'RS';
			$order['country'] = 'Brasil';
			$order['status'] = 1;
			$order->save();

			$item_orders = new ItemOrder();
			$item_orders['amount'] = $request['price'];
			$item_orders['total_amount'] = $request['price'];
			$item_orders['quantity'] = 1;
			$item_orders['product_id'] = $request['product_id'];
			$item_orders['order_id'] = $order['id'];

			$order->item_orders()->save($item_orders);

			flash()->success('Cadastro salvo com sucesso!');
        	return redirect('item_orders/');
		} else {
			flash()->error('Usuário não autorizado!');
			return redirect('orders/'.$request['id'].'/view_establishments/');
		}

	}
}