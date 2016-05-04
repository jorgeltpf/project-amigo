<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Models\Establishment;
use App\Models\Product;
use App\Models\Promotion;

class DashboardController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

	public function index() {
        $title = "Dashboard";
        $establishments = [];
        $users = [];
        if (\Entrust::hasRole('admin')) {
            $establishments = Establishment::count();
            $users = User::count();
        } elseif (\Entrust::hasRole('establishment')) {
            $establishments = Establishment::where('establishments.id', '=', session('establishment'))->count();
            $users = User::userEstablishments(session('establishment'))->count();
        }
        $products = Product::count();
        $promotions = Promotion::count();
		return view('admin.dashboard.index',  compact('title',
            'users', 'establishments', 'products', 'promotions'));
	}
}