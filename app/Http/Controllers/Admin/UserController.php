<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Models\Role;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\DeleteRequest;
use Datatables;
use JsValidator;


class UserController extends AdminController {
    protected $validationRules = [
        'name' => 'required|max:255',
        'username' => 'required|unique:users',
        'email' => 'required|email|unique',
        'password' => 'required',
        'password_confirmation' => 'required'
    ];

    protected $messages = array(
        'name.required' => 'É preciso preencher o nome',
        'username.required' => 'É preciso preencher o nome de usuário',
        'username.unique:users' => 'Este nome de usário já se encontra cadastrado no sistema',
        'email.required' => 'É preciso preencher o e-mail',
        'password.required' => 'É preciso preencher o campo de senha',
        'password_confirmation.required' => 'É preciso preencher o campo de confirmação de senha',
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
        $user = new User();
        $user->name = $request->name;
		$user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->confirmation_code = str_random(32);
        $user->confirmed = $request->confirmed;
        $user->save();
        if (!empty($request->role_list)) {
            $role = array($request->role_list);
        } else {
            $role = [3];
        }

        $this->syncRoles($user, $role);

        flash()->success('Cadastro salvo com sucesso!');

        return redirect('admin/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */

    public function getEdit($id) {
        $user = User::find($id);
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
            $roles = [3];
        }

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $user->password = bcrypt($password);
            }
        }

        $user->save();
        $this->syncRoles($user, $roles);

        flash()->success('Cadastro salvo com sucesso!');

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
        $user= User::find($id);
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
