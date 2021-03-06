<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class ClientsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (\Auth::check()) {
            $user = \Auth::user();
            // $user = User::find($userId);
            $title = 'Meus Dados';
            $menu_name = 'Meus Dados';
            $categoryItems = [
                'Dados cadastrais',
                'Meus pedidos',
                'Meus endereços',
                'Minhas avaliações'
            ];
            $stab = ['1','2','3','4'];
            return view('clients.index', compact('title', 'menu_name', 'categoryItems', 'stab', 'user'));
        }
        return view('pages.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update do cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $client = User::find($id);
        $client->name = $request->name;

        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;
        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $client->password = bcrypt($password);
            }
        }

        $client->save();

        flash()->success('Cadastro salvo com sucesso!');

        return redirect('clients');
    }

    public function store(Request $request) {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function requests($id) {

    }
}
