<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ItemOrder extends Model {

	protected $fillable = [
		'order_id',
		'product_id',
		'amount',
		'total_amount',
		'quantity'
	];

	/**
     * Get the order that owns the item orders.
     */
    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function product() {
    	return $this->belongsTo('App\Models\Product');
    }

	public function getAmountAttribute($amount) {
		return convertCurrency($amount);
	}

	public function setAmountAttribute($amount) {
	 	$this->attributes['amount'] = convertCurrencyDB($amount);
	}

	public function getTotalAmountAttribute($amount) {
		return convertCurrency($amount);
	}

	public function setTotalAmountAttribute($amount) {
	 	$this->attributes['total_amount'] = convertCurrencyDB($amount);
	}
}