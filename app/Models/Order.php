<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Order extends Model {
	use SoftDeletes;

	protected $fillable = [
		'status',
		'total_amount',
		'street',
		'street_number',
		'complement',
		// 'city',
		'state',
		'country',
		'cep'
	];

	/**
	 * One To Many Order 1 -> Item Orders N
	 * Get item orders from order
	 */

    public function item_orders() {
        return $this->hasMany('App\Models\ItemOrder');
    }

    public function establishment() {
        return $this->belongsTo('App\Models\Establishment');
    }
}