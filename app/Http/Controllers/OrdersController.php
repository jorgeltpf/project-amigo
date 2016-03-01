<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Order;
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
		// print_r($stab);
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
		$order = new Order();
		$item_orders = [];

		$order['person_id'] = $request['person_id'];
		$order['establishment_id'] = $request['establishment_id'];
		$order['total_amount'] = $request['total_amount'];
		$order['street'] = $request['street'];
		$order['street_number'] = $request['street_number'];
		$order['complement'] = $request['complement'];
		$order['state'] = 'RS';
		$order['country'] = 'Brasil';

		$order->save();

		$order = Order::create([
			'person_id' => $request['person_id'],
			'establishment_id' => $request['establishment_id'],
			'total_amount' => $request['total_amount'],
			'street' => $request['street'],
			'street_number' => $request['street_number'],
			'complement' => $request['complement'],
			'cep' => $request['cep'],
			'state' => 'RS',
			'country' => 'Brasil'
		]);

		$item_orders['amount'] = $item_orders['total_amount'] = $request['total_amount'];
		$item_orders['quantity'] = 1;
		$item_orders['product_id'] = $request['product_id'];

		$order->item_orders()->attach($item_orders);

		flash()->success('Cadastro salvo com sucesso!');

        // return redirect('admin/establishments');
	}
}