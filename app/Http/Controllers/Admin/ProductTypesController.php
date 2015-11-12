<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\ProductType;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Datatables;
use JsValidator;
use App\Models\ProductSpecie;

class ProductTypesController extends AdminController {
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
        return view('admin.producttypes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $validator = JsValidator::make($this->validationRules);
        $product_species_list = ProductSpecie::lists('description', 'id');
        $product_species_list = $product_species_list->sort();
        return view('admin.producttypes.create', compact('validator', 'product_species_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
        $productTypes = new ProductType();

        $productTypes['description']      = $request->description;
        $productTypes['product_specie_id']  = $request->product_specie_id;
        $productTypes->save();
        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/producttypes');
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
        $productTypes = ProductType::find($id);
        $product_species_list = ProductSpecie::lists('description', 'id');
        $product_species_list = $product_species_list->sort();
      
        return view('admin.producttypes.edit', compact('productTypes', 'validator', 'product_species_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $productTypes = ProductType::find($id);
        $productTypes['description']      = $request->description;
        $productTypes['product_specie_id']      = $request->product_specie_id;
        $productTypes->update();
        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/producttypes');
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
        $productTypes = $id;
        return view('admin/producttypes/delete', compact('productTypes'));
    }

    public function postDelete(Request $request, $id) {
        $productTypes = ProductType::find($id);
        $productTypes->delete();
    }

    public function data() {


        $productTypes = ProductType::whereNull('product_types.deleted_at')
            ->orderBy('product_types.id', 'DESC')
            ->join('product_species', 'product_types.product_specie_id', '=', 'product_species.id')
            ->select(array('product_types.id', 'product_types.description', 'product_species.description as specie'));

        return Datatables::of($productTypes)
            ->add_column('actions',
                '<a href="{{{ URL::to(\'admin/producttypes/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                <a href="{{{ URL::to(\'admin/producttypes/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->remove_column('id')
            ->make();
    }
}
