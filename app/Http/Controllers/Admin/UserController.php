<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Models\Role;
use App\Models\Person;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\DeleteRequest;
use Datatables;
use JsValidator;


class UserController extends AdminController {
    protected $validationRules = [
        'name' => 'required|max:255',
        // 'username' => 'required|unique:users',
        'email' => 'required|email|unique',
        'password' => 'required',
        'password_confirmation' => 'required',
        'cpf' => 'required',
        'phone' => 'required',
        'cell_phone' => 'required',
        'cep' => 'required',
        'street' => 'required',
        'neighborhood' => 'required',
        'street_number' => 'required',
        'complement' => 'required',
        'city' => 'required'
    ];

    protected $messages = array(
        'name.required' => 'É preciso preencher o nome',
        'username.required' => 'É preciso preencher o nome de usuário',
        'username.unique:users' => 'Este nome de usário já se encontra cadastrado no sistema',
        'email.required' => 'É preciso preencher o e-mail',
        'password.required' => 'É preciso preencher o campo de senha',
        'password_confirmation.required' => 'É preciso preencher o campo de confirmação de senha',
        'cpf.required' => 'É preciso preencher o cpf',
        'phone.required' => 'É preciso preencher o seu telefone',
        'cell_phone.required' => 'É preciso preencher o seu celular',
        'cep.required' => 'É preciso preencher o seu cep',
        'neighborhood.required' => 'É preciso preencher o bairro',
        'street.required' => 'É preciso preencher a sua rua',
        'street_number.required' => 'É preciso preencher o número',
        'complement.required' => 'É preciso preencher o complemento',
        'city.required' => 'É preciso preencher a sua cidade'
    );

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */

    public function index() {
        // Show the page
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function getCreate() {
        $roles = Role::lists('display_name', 'id');
        $validator = JsValidator::make($this->validationRules, $this->messages);
        return view('admin.users.create_edit', compact('roles', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */

    public function postCreate(UserRequest $request) {
        $user = new User (
            $request->except(
                'password','confirmation_code',
                'cpf', 'phone', 'cell_phone', 'neighborhood',
                'street', 'street_number', 'cep', 'complement',
                'city', 'country', 'people_type'
            )
        );
        $user->password = bcrypt($request->password);
        $user->confirmation_code = str_random(32);
        $user->confirmed = $request->confirmed;

        if ($user->save()) {
            if (!empty($request->role_list)) {
                $role = array($request->role_list);
            } else {
                // Papel de Op do Est [3] ou Cliente [4]?????
                $role = [4];
            }

            $this->syncRoles($user, $role);

            $person = Person::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
                'people_type' => $request->people_type,
                'cpf' => $request->cpf,
                'phone' => $request->phone,
                'cell_phone' => $request->cell_phone,
                'street' => $request->street,
                'street_number' => $request->street_number,
                'cep' => $request->cep,
                'neighborhood' => $request->neighborhood,
                'complement' => $request->complement,
                'city' => $request->city,
                'state' => 'RS',
                'country' => 'Brasil'
            ]);

            flash()->success('Cadastro salvo com sucesso!');
        } else {
            flash()->error('Ocorreu um erro ao salvar o cadastro!');
        }

        return redirect('admin/users');
    }

    /**
     * Show the form for editing the user.
     *
     * @param $user
     * @return Response
     */

    public function getEdit($id) {
        $user = User::with('Person')->findOrFail($id);
        $roles = Role::lists('display_name', 'id');
        $validator = JsValidator::make($this->validationRules, $this->messages);
        return view('admin.users.create_edit', compact('user', 'roles', 'validator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */

    public function postEdit(UserEditRequest $request, $id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->confirmed = $request->confirmed;

        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($request->role_list)) {
            $roles = array($request->role_list);
        } else {
            $clientRole = 4;
            $roles = [$clientRole];
        }

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $user->password = bcrypt($password);
            }
        }

        if ($user->save()) {
            $this->syncRoles($user, $roles);

            // Update People
            $person = $user->person->update($request->all());

            flash()->success('Cadastro salvo com sucesso!');
        } else {
            flash()->error('Ocorreu um erro!');
        }



        return redirect('admin/users');
    }

    private function syncRoles(User $user, array $roles) {
        $user->roles()->sync($roles);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function getDelete($id) {
        $user = User::find($id);
        // Show the page
        return view('admin.users.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id) {
        $user= User::findOrFail($id);
        $user->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data() {
        $users = User::select(
            array(
                'users.id',
                'users.name',
                'users.email',
                'users.confirmed',
                'users.created_at'
            )
        );

        return Datatables::of($users)
            ->edit_column('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '@if ($id!="1")<a href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                @endif')
            ->remove_column('id')
            ->make();
    }

}
