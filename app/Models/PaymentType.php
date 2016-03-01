<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model {
	/**
	 *	1 - Cartão
	 *	2 - Dinheiro
	 *
	 */
	protected $fillable = [
		'id',
		'description',
		'type'
	];

	// public class order() {
	// 	return $this->belongsTo('App\Models\Order');
	// }

}