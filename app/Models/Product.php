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
		'name',
		'description',
		'price'
	);

    public function product_types() {
    	return $this->belongsTo('App\Models\ProductType');
    }

	public function promotions() {
    	return $this->hasMany('App\Models\Promotion');
  	}

	//public function getProductTypesListAttribute() {
		//return $this->product_types->lists('id');
	//}

	public function getPriceAttribute($price) {
		return convertCurrency($price);
	}

	public function setPriceAttribute($price) {
	 	$this->attributes['price'] = convertCurrencyDB($price);
	}

}
