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

        $establishments = Establishment::count();
        $products = Product::count();
        $promotions = Promotion::count();
        $users = User::count();
		return view('admin.dashboard.index',  compact('title',
            'users', 'establishments', 'products', 'promotions'));
	}
}