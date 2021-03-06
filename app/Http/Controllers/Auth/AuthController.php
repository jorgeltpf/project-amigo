<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Cria um novo usuário com papel de cliente após ser feita validação do seu login
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        // Transação para o salvamento simultâneo do usuário, pessoa e papel
        $user = [];
        \DB::beginTransaction();
        try {
            $person = \App\Models\Person::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'people_type' => '1',
                //'cpf' => '999999991',
                // 'phone' => '99999',
                // 'cell_phone' => '999999',
                // 'street' => 'Teste Admin',
                // 'street_number' => '1',
                // 'cep' => '97010340',
                // 'neighborhood' => 'Teste',
                // 'complement' => 'Teste',
                // 'city' => 'Teste',
                // 'state' => 'RS',
                // 'country' => 'Brasil'
            ]);

            $user = User::create([
                'person_id' => $person->id,
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'confirmation_code' => str_random(32),
                'confirmed' => 1
            ]);

            // Perfil padrão do cliente = 4
            $clientRole = [4];
            $user->roles()->sync([$user->id => ['role_id' => $clientRole]]);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->error('Ocorreu um erro!');
        }
        return $user;
    }


}
