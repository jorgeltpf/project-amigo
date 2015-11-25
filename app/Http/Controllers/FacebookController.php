<?php
 
namespace App\Http\Controllers;
 
class FacebookController extends Controller
{
 
    public function login()
    {
        return \Socialize::with('facebook')->redirect();
    }
 
    public function pageFacebook()
    {
       	$user = \Socialize::with('facebook')->user();
       	dd($user);
        return $user->getEmail();
    }
 
}