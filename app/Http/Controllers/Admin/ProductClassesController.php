<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\ProductClass;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Datatables;
use JsValidator;

class ProductClassesController extends AdminController {
    protected $validationRules = [
        'description' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        return view('admin.productclasses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $validator = JsValidator::make($this->validationRules);
        return view('admin.productclasses.create', compact('validator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
        $productClasses = new ProductClass();

        $productClasses['description']      = $request->description;

        $productClasses->save();
        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/productclasses');
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
        $productClasses = ProductClass::find($id);
        return view('admin.productclasses.edit', compact('productClasses', 'validator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $productClasses = ProductClass::find($id);
        $productClasses['description']      = $request->description;

        $productClasses->update();
        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/productclasses');
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
        $productClasses = $id;
        return view('admin/productclasses/delete', compact('productClasses'));
    }

    public function postDelete(Request $request, $id) {
        $productClasses = ProductClass::find($id);
        $productClasses->delete();
    }

    public function data() {


        $productClasses = ProductClass::whereNull('product_classes.deleted_at')
            ->orderBy('product_classes.description', 'DESC')
            ->select(array('product_classes.id', 'product_classes.description'));

        return Datatables::of($productClasses)
            ->add_column('actions',
                '<a href="{{{ URL::to(\'admin/productclasses/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                <a href="{{{ URL::to(\'admin/productclasses/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->remove_column('id')
            ->make();
    }
}
