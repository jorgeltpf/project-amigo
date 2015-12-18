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

       	$data = \Socialize::with('facebook')->user();
        //dd($user['id']);
        $db_user = User::where('email','=',$data['email'])->count();
        
        if ($db_user == 0) {
            //registrar
            $user_name = explode('@',  $data['email']);

            $user = new User();
            $user['name'] = $data['name']; 
            $user['username'] = $user_name[0]; 
            $user['email'] = $data['email'];
            $user['password'] = bcrypt($data['id']);
            $user['avatar'] = 'https://graph.facebook.com/v2.5/'.$data['id'].'/picture?width=1920';
            $user['confirmation_code'] = str_random(32);
            $user->save();
         } 

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['id']])) {//autenticação
            return redirect('home');
        }else{
            return 'Este e-mail não foi registrado pelo facebook!';
        }
    }
 
}