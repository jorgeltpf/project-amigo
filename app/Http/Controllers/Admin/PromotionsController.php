<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\Establishment;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\PromotionGetEditRequest;

use Datatables;
use JsValidator;
use Validator;

class PromotionsController extends AdminController {
    protected $validationRules = [
        'name' => 'required',
        'discount' => 'required',
        'products_list[]' => 'required',
        'establishments_list[]' => 'required',
        'initial_period' => 'required|date_format:"d/m/Y"|before_equal:final_period',
        'final_period' => 'required|date_format:"d/m/Y"|after_equal:initial_period'
    ];

    protected $messages = array(
        'name.required' => 'É preciso preencher o nome da promoção',
        'discount.required' => 'É preciso preencher o desconto da promoção',
        'initial_period.required' => 'É preciso preencher a data inicial da promoção',
        'final_period.required' => 'É preciso preencher a data final da promoção',
        'initial_period.before' => 'A data inicial precisa ser menor que a data final',
        'final_period.after' => 'A data final precisa ser maior que a data inicial',
        'products_list[].required' => 'É preciso selecionar produto(s) que compõe a promoção',
        'establishments_list[]' => 'É preciso selecionar um estabelecimento que compõe a promoção',
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $promotions = Promotion::all();
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Função que cria uma nova promoção e em seguida salva os produtos 
     * que estão associados a promoção (n:n)
     */
    private function createPromotion($request) {
        $promotion = Promotion::create($request);
        $this->syncProducts($promotion, $request['products_list']);
        return $promotion;
    }

    /**
     * Função para o salvamento das promoções em conjunto com os produtos, 
     * visto que existe um relacionamento n:n
     */
    private function syncProducts(Promotion $promotion, array $products) {
        $promotion->products()->sync($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $validator = JsValidator::make($this->validationRules, $this->messages);        
        $establishments_list = Establishment::lists('name', 'id');
        if (\Entrust::hasRole('admin')) {
            $products_list = Product::lists('name', 'id');
        } elseif (\Entrust::hasRole('establishment', 'establishment_operator')) {
            $products_list = Product::whereIn('products.establishment_id', [session('establishment')])->lists('name', 'id');
        }
        return view('admin.promotions.create', compact('establishments_list','products_list', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//      $promotions = new Promotion();
        // dd(str_replace("_equal", "", $this->validationRules['initial_period']));
        // NECESSITA DE MELHORIAS NA FORMA DE VALIDAÇÃO
        // $this->validationRules['initial_period'] = str_replace("_equal", "", $this->validationRules['initial_period']);
        // $this->validationRules['final_period'] = str_replace("_equal", "", $this->validationRules['final_period']);
        // $validation = Validator::make($request->all(), $this->validationRules);
        $input = Input::all();

        // if ($validation->fails()) {
        //     flash()->error('Selecione produtos para a produção!');
        //     return redirect()->back()->withErrors($validation->errors());
            
        // }
        if (\Entrust::hasRole('admin')) {
            $input['establishment_id'] = $input['establishments_list'];
        } elseif (\Entrust::hasRole('establishment', 'establishment_operator')) {
            $input['establishment_id'] = session('establishment');
        }
        $this->createPromotion($input);
        flash()->success('Cadastro salvo com sucesso!');
        return redirect('admin/promotions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PromotionGetEditRequest $request) {
        $validator = JsValidator::make($this->validationRules, $this->messages);
        $promotions = Promotion::with('Products')->find($id);
        $establishments_list = Establishment::lists('name', 'id');
        if (\Entrust::hasRole('admin')) {
            $products_list = Product::lists('name', 'id');
        } elseif (\Entrust::hasRole('establishment', 'establishment_operator')) {
            $products_list = Product::whereIn('products.establishment_id', [session('establishment')])->lists('name', 'id');
        }
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
        if (\Entrust::hasRole('establishment', 'establishment_operator')) {
            $request['establishment_id'] = session('establishment');
        }
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
    }

    public function data() {
        $promotion = [];
        if (\Entrust::hasRole('admin')) {
            $promotion = Promotion::join('establishments', 'promotions.establishment_id', '=', 'establishments.id')
                ->select(array('promotions.id', 'promotions.name', 'establishments.name as establishments',
                   'promotions.initial_period', 'promotions.final_period'))
                ->orderBy('promotions.id', 'DESC');
        } elseif (\Entrust::hasRole('establishment', 'establishment_operator')) {
            $promotion = Promotion::join('establishments', 'promotions.establishment_id', '=', 'establishments.id')
                ->select(array('promotions.id', 'promotions.name', 'establishments.name as establishments',
                   'promotions.initial_period', 'promotions.final_period'))
                ->orderBy('promotions.id', 'DESC')
                ->whereIn('promotions.establishment_id', [session('establishment')]);
        }

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
