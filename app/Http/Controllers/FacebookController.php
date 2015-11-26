<?php
 
namespace App\Http\Controllers;
 
class FacebookController extends Controller {
 
    /**
     *
     */
    public function login() {
        \Socialize::with('facebook')->scopes(['email'])->redirect();

    }
 
    public function pageFacebook() {
       	$user = \Socialize::with('facebook')->user();

       	dd($user);

        return $user->getEmail();
    }
 
}