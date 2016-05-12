<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Particular;
use App\Models\ParticularType;

use App\Http\Requests;
use App\Http\Controllers\AdminController;

use Datatables;
use JsValidator;

class ParticularsController extends AdminController {
    protected $validationRules = [
        'description' => 'required',
        'particular_type_list[]' => 'required',
    ];

    protected $messages = array(
        'description.required' => 'É preciso preencher a descrição da característica',
        'particular_type_list[].required' => 'É preciso selecionar o tipo da característica',
    );

	public function index() {
		return view('admin.particulars.index');
	}


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $validator = JsValidator::make($this->validationRules);
        $particular_types_list = ParticularType::selectRaw("particular_types.description, particular_types.id")
                                            ->lists('description', 'id');
        $particular_types_list = $particular_types_list->sort();
        return view('admin.particulars.create', compact('particular_types_list', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $particulars = new Particular();

        $particulars['description'] = $request->description;
        $particulars['particular_type_id'] = $request->particular_type_id;

        $particulars->save();
        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/particulars');
    }

   /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $validator = JsValidator::make($this->validationRules);
        $particulars = Particular::find($id);
        $particular_types_list = ParticularType::selectRaw("particular_types.description, particular_types.id")
                                            ->lists('description', 'id');
        $particular_types_list = $particular_types_list->sort();
        return view('admin.particulars.edit', compact('particulars', 'validator', 'particular_types_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $particular = Particular::find($id);
        $particular['description'] = $request->description;
        $particular['particular_type_id']   = $request->particular_type_id;

        $particular->update();
        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/particulars');
    }

    public function getDelete($id) {
        $particulars = $id;
        return view('admin/particulars/delete', compact('particulars'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postDelete(Request $request, $id) {
        $particulars = Particular::find($id);
        $particulars->delete();
    }

    public function data() {
    $particular = [];
    if (\Entrust::hasRole('admin')) {
        $particular = Particular::join('particular_types', 'particulars.particular_type_id', '=', 'particular_types.id')
            ->select(array('particulars.id', 'particulars.description', 'particular_types.description as particular_types'))
            ->orderBy('particulars.id', 'DESC');
    }

    return Datatables::of($particular)
        ->add_column('actions',
            '<a href="{{{ URL::to(\'admin/particulars/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
            <a href="{{{ URL::to(\'admin/particulars/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
            <input type="hidden" name="row" value="{{$id}}" id="row">'
        )
        ->remove_column('id')
        ->make();
    }
}

