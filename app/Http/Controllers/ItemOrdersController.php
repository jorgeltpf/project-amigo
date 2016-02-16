<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Datatables;
use JsValidator;

use App\Models\Establishment;
use App\Models\Product;

class ItemOrdersController extends Controller {

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
		return view('item_orders.index',
			compact('title', 'menu_name', 'categoryItems', 'carouselItems', 'stab'));
	}

    public function data($id) {
        $product = Product::where('products.id', '=', intval($id))
            ->orderBy('products.id', 'DESC')
            ->join('product_classes', 'products.product_class_id', '=', 'product_classes.id')
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->select(array('products.id', 'products.name','product_classes.description as class', 'product_types.description','products.price'));

        return Datatables::of($product)
            ->add_column('actions',
                '<a href="{{{ URL::to(\'admin/products/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                <a href="{{{ URL::to(\'admin/products/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->remove_column('id')
            ->make();
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