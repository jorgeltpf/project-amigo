<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Models\Establishment;
use Illuminate\Support\Facades\Input;
use App\Models\WeekDay;
use App\Http\Requests;
use App\Http\Requests\Admin\EstablishmentsRequest;
use App\Http\Requests\Admin\EstablishmentsEditRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Controllers\Controller;
use Datatables;

class EstablishmentsController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $establishments = Establishment::all();
        return view('admin.establishments.index', compact('establishments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
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
    public function store(Request $request) {
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
        $establishments['cell_phone'] = $request->cell_phone;
        $establishments['cep'] = $request->cep;

        $image = "";
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $image = sha1($filename . time()) . '.' . $extension;
        }
        $establishments['image'] = $image;

        // dd($establishments);
        // $establishments = Establishment::create($establishments);

        $establishments->save();

        if (Input::hasFile('image')) {
            $destinationPath = public_path() . '/images/establishments/'.$establishments->id.'/';
            Input::file('image')->move($destinationPath, $image);
        }

        $weekdays = $request->weekday;
        // $weekdays['establishment_id'] = $establishments->id;

        $this->syncWeekDays($establishments, $weekdays);
        return redirect('admin/establishments');
    }

    public function syncWeekDays(Establishment $establishments, array $weekdays) {
        if (!empty($weekdays)) {
            $timeOn = "";
            $timeOff = "";
            $saveWeek = array();
            $aux = 0;
            foreach ($weekdays as $key => $numbers) {
                $timeKeys = array_keys($numbers);
                foreach ($timeKeys as $day_key => $days) {
                    // $teste[$aux][] = explode('_',$day_key);
                    // $saveWeek[$aux][]['week_day_id'] = $numbers['day'];
                    // $saveWeek[$aux][]['establishment_id'] = $establishments['id'];
                    if (!empty($days)) {
                        if (strpos($days,'time_on') !== false) {
                            $saveWeek[$aux][$this->setShift(substr($days, -2, 1))]['time_on'] = $numbers[$days];
                            $saveWeek[$aux][$this->setShift(substr($days, -2, 1))]['shift'] = $this->setShift(substr($days, -2, 1));
                            $saveWeek[$aux][$this->setShift(substr($days, -2, 1))]['week_day_id'] = $numbers['day'];
                            $saveWeek[$aux][$this->setShift(substr($days, -2, 1))]['establishment_id'] = $establishments['id'];
                        }
                        elseif (strpos($days,'time_off') !== false) {
                            $saveWeek[$aux][$this->setShift(substr($days, -2, 1))]['shift'] = $this->setShift(substr($days, -2, 1));
                            $saveWeek[$aux][$this->setShift(substr($days, -2, 1))]['time_off'] = $numbers[$days];
                            $saveWeek[$aux][$this->setShift(substr($days, -2, 1))]['week_day_id'] = $numbers['day'];
                            $saveWeek[$aux][$this->setShift(substr($days, -2, 1))]['establishment_id'] = $establishments['id'];
                        }
                    }
                }

                $establishments->weekdays()->sync($saveWeek[$aux]);
                $aux += 1;
            }
        }

        // $establishments->weekdays()->sync($saveWeek);
        // $establishments->weekdays()->saveMany($saveWeek);
    }

    /**
     * Função que converte as letras dos turnos em números
     * 1 = manhã
     * 2 = tarde
     * 3 = noite
     */

    public function setShift($value) {
        $shift = "";
        switch ($value) {
            case 'm':
                $shift = 1;
                break;
            case 't':
                $shift = 2;
                break;
            case 'n':
                $shift = 3;
                break;
         }
         return $shift;
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
    public function edit($id) {
        $establishments = Establishment::find($id);

        $weekdays = $establishments->weekdays->toArray();

        // $weekdays = WeekDay::whereHas('establishments', function($q) use ($id) {
        //     $q->where('establishment_id', '=', $id);
        // })->get();
        $adjustWeeks = [];
        foreach ($weekdays as $key => $value) {
            $adjustWeeks[$value['pivot']['week_day_id']]['id'] = $value['id'];
            $adjustWeeks[$value['pivot']['week_day_id']]['name'] = $value['name'];
            $adjustWeeks[$value['pivot']['week_day_id']]['establishment_id'] = $value['pivot']['establishment_id'];
            $adjustWeeks[$value['pivot']['week_day_id']]['week_day_id'] = $value['pivot']['week_day_id'];
            $adjustWeeks[$value['pivot']['week_day_id']]['days'][$value['pivot']['shift']]['shift'] = $value['pivot']['shift'];
            $adjustWeeks[$value['pivot']['week_day_id']]['days'][$value['pivot']['shift']]['time_on'] = $value['pivot']['time_on'];
            $adjustWeeks[$value['pivot']['week_day_id']]['days'][$value['pivot']['shift']]['time_off'] = $value['pivot']['time_off'];

            // $adjustWeeks[$value['pivot']['week_day_id']]['days'][$aux]['shift'] = $value['pivot']['shift'];
            // $adjustWeeks[$value['pivot']['week_day_id']]['days'][$aux]['time_on'] = $value['pivot']['time_on'];
            // $adjustWeeks[$value['pivot']['week_day_id']]['days'][$aux]['time_off'] = $value['pivot']['time_off'];
        }
dd($adjustWeeks);
        return view('admin.establishments.edit', compact('establishments', 'adjustWeeks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    /**
     * Recuperação dos dados para enviar para o datatable da listagem da index
     */
    public function data() {
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
