<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Http\Request;

class PagesController extends Controller {

	public function welcome() {
		return view('pages.welcome');
	}

	public function about() {
		$title = "Sobre";
		$menu_name = "Sobre";
		$categoryItems = ['1','2','3','4'];
		$carouselItems = ['1','2','3','4'];
		$stab = ['1','2','3','4'];
		return view('pages.about', compact('title', 'menu_name', 'categoryItems', 'carouselItems', 'stab'));
	}

	public function contact() {
		return view('pages.contact');
	}

	public function people() {
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
			return view('pages.people', compact('title', 'menu_name', 'categoryItems', 'stab', 'user'));
		}
		return view('pages.home');
	}
}
