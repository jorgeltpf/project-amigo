<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Product extends Model {
	use SoftDeletes;

    protected $fillable = array(
		'product_type_id',
		'name',
		'description',
		'price'
	);


public function product_types()
  {
    return $this->hasOne('App\Models\ProductType');
  }

}
