<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Input;


use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Datatables;
class ProductsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function data() {


        $product = Product::whereNull('products.deleted_at')
            ->orderBy('products.id', 'DESC')
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->select(array('products.id', 'products.name', 'product_types.description','products.price'));

        return Datatables::of($product)
            ->add_column('actions',
                '<a href="{{{ URL::to(\'admin/products/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                <a href="{{{ URL::to(\'admin/products/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->remove_column('id')
            ->make();
    }
}
