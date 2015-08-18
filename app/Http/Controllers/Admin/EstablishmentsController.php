<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Models\Establishment;
use App\Models\WeekDay;
use App\Http\Requests;
use App\Http\Requests\Admin\EstablishmentsRequest;
use App\Http\Requests\Admin\EstablishmentsEditRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Controllers\Controller;
use Datatables;

class EstablishmentsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $establishments = Establishment::all();
        return view('admin.establishments.index', compact('establishments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // $states = \State->states();
        // $weekdays = array(
        //     '0' => 'Domingo',
        //     '1' => 'Segunda',
        //     '2' => 'Terça',
        //     '3' => 'Quarta',
        //     '4' => 'Quinta',
        //     '5' => 'Sexta',
        //     '6' => 'Sábado'
        // );
        // $weekdays = \DB::table('week_days')->select('id', 'name')->get();
        // $weekdays = WeekDay::all();
        return view('admin.establishments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $establishments = new Establishment();
        // dd($request->all());
        // $establishments = $request->all();
        $establishments['status'] = true;
        $establishments['name'] = $request->name;
        $establishments['cnpj'] = $request->cnpj;
        $establishments['email'] = $request->email;
        $establishments['delivery_max_time'] = $request->delivery_max_time;
        $establishments['street'] = $request->street;
        $establishments['street_number'] = $request->street_number;
        $establishments['complement'] = $request->complement;
        $establishments['street_number'] = $request->street_number;
        $establishments['city'] = $request->city;
        $establishments['state'] = $request->state;
        $establishments['country'] = $request->country;
        $establishments['phone'] = $request->phone;
        $establishments['cell_phone'] = trim(preg_replace('~[\\\\/:*?"<>|()-]~', ' ', $request->cell_phone));
        $establishments['cep'] = trim(preg_replace('~[\\\\/:*?"<>|()-]~', ' ', $request->cep));
        var_dump($request);
        // $establishments = Establishment::create($establishments);

        // $establishments->save();
        // return redirect('establishments');
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
        $establishments = Establishment::find($id);
        return view('admin/establishments/edit', compact($establishments));
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

    /**
     * Recuperação dos dados para enviar para o datatable da listagem da index
     */
    public function data()
    {
        $establishment = Establishment::whereNull('establishments.deleted_at')
            ->orderBy('establishments.id', 'DESC')
            ->select(array('establishments.id', 'establishments.name', 'establishments.phone',
            'establishments.email', 'establishments.cep'));

        return Datatables::of($establishment)
            ->add_column('actions',
                '<a href="{{{ URL::to(\'admin/establishments/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                <a href="{{{ URL::to(\'admin/establishments/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->remove_column('id')
            ->make();
    }
}
