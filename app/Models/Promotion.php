<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Promotion extends Model {
    protected $fillable = array(
    	'name',
		'establishment_id',
		'product_id',
		'initial_period',
		'final_period',
		'discount'
	);

    public function establishments() {
        return $this->belongsTo('App\Models\Establishment', 'establishment_id');
    }

    public function products() {
        return $this->belongsToMany('App\Models\Product');
    }

	public function getEstablishmentsListAttribute() {
		return $this->establishments->lists('id');
	}

	public function getProductsListAttribute() {
		return $this->products->lists('id')->toArray();
	}

	public function getDiscountAttribute($discount) {
		return convertCurrency($discount);
	}

	public function setDiscountAttribute($discount) {
		$this->attributes['discount'] = convertCurrencyDB($discount);
	}

	public function getInitialPeriodAttribute($date) {
		return convertDate($date);
	}

	// public function setInitialPeriodAttribute($date) {
	// 	return convertDateDB($date);
	// }

	public function getFinalPeriodAttribute($date) {
		return convertDate($date);
	}

	// public function setFinalPeriodAttribute($date) {
	// 	return convertDateDB($date);
	// }
}
