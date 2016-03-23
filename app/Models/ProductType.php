<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
	protected $fillable = [
		'description'
	];

	public function products() {
    	return $this->hasMany('App\Models\Product');
    }


}