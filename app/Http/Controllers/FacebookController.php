<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Socialize;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
 
class FacebookController extends Controller {
 
    /**
     *
     */
    public function login() {
            
        return \Socialize::with('facebook')->scopes(['email'])->redirect();

    }
 
    public function pageFacebook() {

       	$user = \Socialize::with('facebook')->user();
        //dd($user['id']);
        $db_user = User::where('email','=',$user['email'])->get();
        if (empty($db_user[0]['email'])) {
            //registrar
            dd($user);
            $user_name = explode('@',  $user['email']);
            $data = ['name' => $user['name'], 
                    'username' => $username[0], 
                    'email' => $user['email'], 
                    'password' => bcrypt($user['id']), 
                    'avatar' => $user['avatar_original'],
                    'confirmation_code' => str_random(32),];
            dd($data);
         } 

        if (Auth::attempt(['email' => $db_user[0]['email'], 'password' => $user['id']])) {
            return redirect('home');
        }else{
            return 'Este e-mail não foi registrado pelo facebook!';
        }
    }
 
}