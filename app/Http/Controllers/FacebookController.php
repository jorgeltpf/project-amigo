<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Socialize;
use Auth;
 
class FacebookController extends Controller {
 
    /**
     *
     */
    public function login() {
            
        return \Socialize::with('facebook')->scopes(['email'])->redirect();

    }
 
    public function pageFacebook() {

       	$user = \Socialize::with('facebook')->user();
        $db_user = User::where('email','=',$user['email'])->get();
        if (empty($db_user['email'])) {
            dd($user);
            //return view('users/create', compact('user'));
       	   //Auth::create($user);
        } else {
            echo 'nada';
        }
        return $user->getEmail();
    }
 
}