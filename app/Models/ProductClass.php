<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Helpers;

class ProductClass extends Model {
	use SoftDeletes;

    protected $fillable = array(
		'description'
	);
	
	public function products() {
    	return $this->hasMany('App\Models\Product');
    }


}