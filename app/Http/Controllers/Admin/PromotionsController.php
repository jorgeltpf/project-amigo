<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\Establishment;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\AdminController;

use Datatables;
use JsValidator;

class PromotionsController extends AdminController {
    protected $validationRules = [
        'name' => 'required',
        'initial_period' => 'required',
        'final_period' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $promotions = Promotion::all();
        return view('admin.promotions.index', compact('promotions'));
    }

    private function createPromotion($request) {
        $promotion = Promotion::create($request);

        $this->syncProducts($promotion, $request['products_list']);

        return $promotion;
    }

    private function syncProducts(Promotion $promotion, array $products) {
        $promotion->products()->sync($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $validator = JsValidator::make($this->validationRules);        
        $establishments_list = Establishment::lists('name', 'id');
        $products_list = Product::lists('name', 'id');
        return view('admin.promotions.create', compact('establishments_list','products_list', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//         $promotions = new Promotion();
        $input = Input::all();
// dd($input);
        $input['establishment_id'] = $input['establishments_list'];

        $this->createPromotion($input);
        // $input['establishment_id'] = $input['establishments_list'];
        // $input['product_id'] = $input['products_list'];
        // Promotion::create($input);

        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/promotions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $validator = JsValidator::make($this->validationRules);
        $promotions = Promotion::with('Products')->find($id);
        $establishments_list = Establishment::lists('name', 'id');
        $products_list = Product::lists('name', 'id');
        return view('admin.promotions.edit', compact('promotions', 'validator', 'establishments_list', 'products_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $promotions = Promotion::find($id);
        // $input = Input::all();
        // dd($request);
        $promotions->update($request->all());

        $this->syncProducts($promotions, $request->input('products_list'));

        return redirect('admin/promotions/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDelete($id) {
        $promotions = $id;
        return view('admin/promotions/delete', compact('promotions'));
    }

    public function postDelete($id) {
        $promotions = Promotion::find($id);
        $promotions->products()->detach();
        $promotions->delete();
        flash()->success('Promoção excluída com sucesso!');
    }

    public function data() {
        $promotion = Promotion::join('establishments', 'promotions.establishment_id', '=', 'establishments.id')
            ->orderBy('promotions.id', 'DESC')
            ->select(array('promotions.id', 'promotions.name', 'establishments.name',
               'promotions.initial_period', 'promotions.final_period'));

        return Datatables::of($promotion)
            ->add_column('actions',
                '<a href="{{{ URL::to(\'admin/promotions/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                <a href="{{{ URL::to(\'admin/promotions/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->remove_column('id')
            ->make();
    }

}
