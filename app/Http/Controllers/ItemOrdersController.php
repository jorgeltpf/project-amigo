<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Datatables;
use JsValidator;

use App\Models\Establishment;
use App\Models\Product;
use App\Models\Order;
use App\Models\ItemOrder;

class ItemOrdersController extends Controller {

	public function index() {
		$item_orders = Establishment::where('id', 1)->with("orders.item_orders.product")->get();
		// $item_orders = Establishment::find(1)->with("orders.item_orders.product")->get();
		// $item_orders = Order::find(4)->with('Establishment')->get();
		// $item_orders = Order::find(4)->item_orders()->with("Product")->get();
		// $item_orders = ItemOrder::->where('order_id', 4)->get();
		// dd($item_orders[0]['orders'][0]['item_orders']);
		return view('item_orders.index', compact('item_orders'));
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