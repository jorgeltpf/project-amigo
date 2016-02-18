<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Input;
use App\Models\ProductType;
use App\Models\ProductClass;

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
        $product_types_list = ProductType::join('product_species', 'product_types.product_specie_id','=','product_species.id')
                                            ->selectRaw("CONCAT(product_types.description,' - ', product_species.description) as description, product_types.id")
                                            ->lists('description', 'id');
        $product_types_list = $product_types_list->sort();
        $product_classes_list = ProductClass::lists('description', 'id');
        $product_classes_list = $product_classes_list->sort();
        return view('admin.products.create', compact('product_types_list', 'validator', 'product_classes_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
        $product = new Product();

        $product['name']             = $request->name;
        $product['price']            = $request->price;
        $product['description']      = $request->description;
        $product['product_type_id']  = $request->product_type_id;
        $product['product_class_id']  = $request->product_class_id;

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $validator = JsValidator::make($this->validationRules);
        $products = Product::find($id);
        $product_types_list = ProductType::join('product_species', 'product_types.product_specie_id','=','product_species.id')
                                            ->selectRaw("CONCAT(product_types.description,' - ', product_species.description) as description, product_types.id")
                                            ->lists('description', 'id');
        $product_types_list = $product_types_list->sort();
        $product_classes_list = ProductClass::lists('description', 'id');
        $product_classes_list = $product_classes_list->sort();
        return view('admin.products.edit', compact('products', 'validator', 'product_types_list', 'product_classes_list'));
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
        $product['name']             = $request->name;
        $product['price']            = $request->price;
        $product['description']      = $request->description;
        $product['product_type_id']  = $request->product_type_id;
        $product['product_class_id']  = $request->product_class_id;

        $product->update();
        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id) {
        $products = $id;
        return view('admin/products/delete', compact('products'));
    }

    public function postDelete(Request $request, $id) {
        $products = Product::find($id);
        $products->delete();
    }

    public function data() {
        $product = Product::whereNull('products.deleted_at')
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
}
