<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Helpers;

class Product extends Model {
	use SoftDeletes;

    protected $fillable = array(
		'product_type_id',
		'establishment_id',
		'name',
		'ingredients',
		'price',
		'image'
	);

	public function promotions() {
    	return $this->hasMany('App\Models\Promotion');
  	}

  	public function item_orders() {
  		return $this->hasMany('App\Models\ItemOrder');
  	}

	public function getPriceAttribute($price) {
		return convertCurrency($price);
	}

	public function setPriceAttribute($price) {
	 	$this->attributes['price'] = convertCurrencyDB($price);
	}
}
