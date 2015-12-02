<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Socialize;
use Auth;
 
class GitHubController extends Controller {
 
    /**
     *
     */
    public function login() {
            
        return \Socialize::with('github')->redirect();

    }
 
    public function pageGitHub() {

       	$user = \Socialize::with('github')->user();

       	dd($user);

        return $user->getEmail();
    }
 
}