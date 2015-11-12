<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpecie extends Model
{
	protected $fillable = [
		'description'
	];

	public function product_types() {
    	return $this->hasMany('App\Models\ProductType');
    }

}