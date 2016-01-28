<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\People;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Datatables;
use JsValidator;

class PeoplesController extends AdminController {

	public function index() {
	        //
	        return view('admin.peoples.index');
	}
}
