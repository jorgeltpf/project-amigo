<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
	protected $fillable = [
		'description',
		'product_specie_id'
	];

	public function products() {
    	return $this->hasMany('App\Models\Product');
    }


}