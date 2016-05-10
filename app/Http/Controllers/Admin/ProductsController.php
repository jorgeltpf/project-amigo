<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Input;
use App\Models\ProductType;
use App\Models\Establishment;
use App\Http\Requests\Admin\ProductEditRequest;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Datatables;
use JsValidator;

class ProductsController extends AdminController {
    protected $validationRules = [
        'name' => 'required',
        'price' => 'required',
        'description' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $validator = JsValidator::make($this->validationRules);
        $product_types_list = ProductType::selectRaw("product_types.description, product_types.id")
                                            ->lists('description', 'id');
        $product_types_list = $product_types_list->sort();
        $establishments_list = Establishment::selectRaw("CONCAT(establishments.name,' - ', establishments.city) as name, establishments.id")
                                            ->lists('name', 'id');
        $establishments_list = $establishments_list->sort();
        return view('admin.products.create', compact('product_types_list', 'validator', 'establishments_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
        $product = new Product();

        $product['name']              = $request->name;
        $product['price']             = $request->price;
        $product['ingredients']       = $request->ingredients;
        $product['product_type_id']   = $request->product_type_id;
        if (\Entrust::hasRole('admin')) {
            $product['establishment_id']  = $request->establishment_id;
        } elseif (\Entrust::hasRole('establishment', 'establishment_operator')) {
            $product['establishment_id'] = session('establishment');
        }

        $product->save();
        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, ProductEditRequest $request) {
        $validator = JsValidator::make($this->validationRules);
        $products = Product::find($id);
        $product_types_list = ProductType::selectRaw("product_types.description, product_types.id")
                                            ->lists('description', 'id');
        $product_types_list = $product_types_list->sort();
        $establishments_list = Establishment::selectRaw("CONCAT(establishments.name,' - ', establishments.city) as name, establishments.id")
                                            ->lists('name', 'id');
        $establishments_list = $establishments_list->sort();
        return view('admin.products.edit', compact('products', 'validator', 'product_types_list', 'establishments_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $product = Product::find($id);
        $product['name']              = $request->name;
        $product['price']             = $request->price;
        $product['ingredients']       = $request->ingredients;
        $product['product_type_id']   = $request->product_type_id;
        if (\Entrust::hasRole('admin')) {
            $product['establishment_id'] = $request->establishment_id;
        } elseif (\Entrust::hasRole('establishment', 'establishment_operator')) {
            $product['establishment_id'] = session('establishment');
        }

        $product->update();
        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/products');
    }

    public function getDelete($id) {
        $products = $id;
        return view('admin/products/delete', compact('products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postDelete(Request $request, $id) {
        $products = Product::find($id);
        $products->delete();
    }

    public function data() {
        $product = [];
        if (\Entrust::hasRole('admin')) {
            $product = Product::whereNull('products.deleted_at')
                ->orderBy('products.id', 'DESC')
                ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
                ->select(array('products.id', 'products.name', 'product_types.description','products.price'));
        } elseif (\Entrust::hasRole('establishment', 'establishment_operator')) {
            $product = Product::whereNull('products.deleted_at')
                ->whereIn('products.establishment_id', [session('establishment')])
                ->orderBy('products.id', 'DESC')
                ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
                ->select(array('products.id', 'products.name', 'product_types.description','products.price'));
        }

        return Datatables::of($product)
            ->add_column('actions',
                '<a href="{{{ URL::to(\'admin/products/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                <a href="{{{ URL::to(\'admin/products/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->remove_column('id')
            ->make();
    }
}
