<?php
// Estabelecimentos na visão do ADMIN

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Models\Establishment;
use App\Models\Person;
use Illuminate\Support\Facades\Input;
use App\Models\WeekDay;
use App\Http\Requests;
use App\Http\Requests\Admin\EstablishmentsRequest;
use App\Http\Requests\Admin\EstablishmentsEditRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Controllers\Controller;
use Datatables;
use JsValidator;

use App\User;

class EstablishmentsController extends AdminController {
    protected $validationRules = [
        'name' => 'required|max:255',
        'cnpj' => 'required',
        // 'email' => 'required|email|unique:users',
        'email' => 'required|email',
        'phone' => 'required',
        'cell_phone' => 'required',
        'cep' => 'required',
        'street' => 'required',
        'neighborhood' => 'required',
        'street_number' => 'required',
        'complement' => 'required',
        'city' => 'required',
        'country' => 'required'
    ];

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
        $validator = JsValidator::make($this->validationRules);
        $owner = "";
        if (\Auth::check()) {
            $users = User::orderBy('id')->get();
            foreach ($users as $user) {
                $owner[$user['id']] = $user['name'];
            }
        }
        return view('admin.establishments.create', compact('validator', 'owner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $establishments = new Establishment();

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
        $establishments['neighborhood'] = $request->neighborhood;
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

        // $establishments = Establishment::create($establishments);

        $establishments->save();

        if (Input::hasFile('image')) {
            $destinationPath = public_path() . '/images/establishments/'.$establishments->id.'/';
            Input::file('image')->move($destinationPath, $image);
        }

        $weekdays = $request->weekday;
        $this->syncWeekDays($establishments, $weekdays);

        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/establishments');
    }

    /**
     * Função para salvar os dias da semana com o estabelecimento
     */

    public function syncWeekDays(Establishment $establishments, array $weekdays) {
        if (!empty($weekdays)) {
            $timeOn = "";
            $timeOff = "";
            $saveWeek = array();
            $aux = 0;
            foreach ($weekdays as $key => $numbers) {
                $timeKeys = array_keys(array_filter($numbers));
                foreach ($timeKeys as $day_key => $days) {
                    if (!empty($days)) {
                        if (strpos($days,'time_on') !== false) {
                            $saveWeek[$aux][$this->setShift(substr($days, -2, 1))]['shift'] = $this->setShift(substr($days, -2, 1));
                            $saveWeek[$aux][$this->setShift(substr($days, -2, 1))]['time_on'] = $numbers[$days];
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
                $teste[$aux] = $saveWeek[$aux];
                $establishments->weekdays()->attach($saveWeek[$aux]);
                $aux += 1;
            }
        }
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
            case '1':
                $shift = 1;
                break;
            case 't':
            case '2':
                $shift = 2;
                break;
            case 'n':
            case '3':
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
        $est = $this->findEstablishmentIds($id);
        return view('admin.establishments.show', compact('est'));
    }

    /**
     * Retorno o id dos estabelecimentos vinculados
     * com o usuário logado
     *
     * @param mixed $id 
     * @return array
     */
    public function findEstablishmentIds($id) {
        $establishmentIds = Establishment::whereHas('people', function ($q) use ($id) {
            $q->where('user_id', '=', $id);
        })->select(['establishments.id'])->get();
        return $establishmentIds;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $validator = JsValidator::make($this->validationRules);
        $establishments = Establishment::find($id);
        $owner = "";
        if (\Auth::check()) {
            $users = User::orderBy('id')->get();
            foreach ($users as $user) {
                $owner[$user['id']] = $user['name'];
            }
        }
        $weekdays = $establishments->weekdays->toArray();

        // $weekdays = WeekDay::whereHas('establishments', function($q) use ($id) {
        //     $q->where('establishment_id', '=', $id);
        // })->get();
        $adjustWeeks = [];
        // Migué
        $weekdays = array_reverse($weekdays);

        foreach ($weekdays as $key => $value) {
            $adjustWeeks[$value['pivot']['week_day_id']]['id'] = $value['id'];
            $adjustWeeks[$value['pivot']['week_day_id']]['name'] = $value['name'];
            $adjustWeeks[$value['pivot']['week_day_id']]['establishment_id'] = $value['pivot']['establishment_id'];
            $adjustWeeks[$value['pivot']['week_day_id']]['week_day_id'] = $value['pivot']['week_day_id'];
            $adjustWeeks[$value['pivot']['week_day_id']]['days'][$value['pivot']['shift']]['shift'] = $value['pivot']['shift'];
            $adjustWeeks[$value['pivot']['week_day_id']]['days'][$value['pivot']['shift']]['time_on'] = $value['pivot']['time_on'];
            $adjustWeeks[$value['pivot']['week_day_id']]['days'][$value['pivot']['shift']]['time_off'] = $value['pivot']['time_off'];
        }
        return view('admin.establishments.edit', compact('establishments', 'adjustWeeks', 'validator', 'owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $establishments = Establishment::find($id);
        $except = ['_method', 'weekday'];

        $input = array_except(Input::all(), $except);

        if (!empty($request['weekday'])) {
            $weekdays = $establishments->weekdays()->detach();
            $this->syncWeekDays($establishments, $request['weekday']);
        }

        $image = "";
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $image = sha1($filename . time()) . '.' . $extension;
        }
        $input['image'] = $image;
        $establishments->update($input);

        flash()->success('Cadastro editado com sucesso!');

        return redirect('admin/establishments');
    }

    public function getDelete($id) {
        $establishments = $id;
        return view('admin/establishments/delete', compact('establishments'));
    }

    public function postDelete(DeleteRequest $request, $id) {
        $establishments = Establishment::find($id);
        $establishments->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $establishments = Establishment::findOrFail($id);

        $establishments->delete();

        flash()->success('Estabelecimento excluído com sucesso!');

        return view('admin/establishments/index');
    }

    /**
     * Recuperação dos dados para enviar para o datatable da listagem da index
     */
    public function data() {
        if (\Auth::user()->hasRole('establishment')) {
            $establishmentIds = Establishment::whereHas('people', function ($q) {
                $q->where('user_id', '=', \Auth::user()->id);
            })->select(['establishments.id'])->get();

            $establishment = Establishment::whereNull('establishments.deleted_at')
                ->whereIn('id', [$establishmentIds[0]['id']])
                ->orderBy('establishments.id', 'DESC')
                ->select(array('establishments.id', 'establishments.name', 'establishments.phone',
                'establishments.email', 'establishments.cep'));
        } elseif (\Auth::user()->hasRole('admin')) {
            $establishment = Establishment::whereNull('establishments.deleted_at')
                ->orderBy('establishments.id', 'DESC')
                ->select(array('establishments.id', 'establishments.name', 'establishments.phone',
                'establishments.email', 'establishments.cep'));
        }

        return Datatables::of($establishment)
            ->add_column('actions',
                '<a href="{{{ URL::to(\'admin/establishments/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                <a href="{{{ URL::to(\'admin/establishments/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->remove_column('id')
            ->make();
    }
}
