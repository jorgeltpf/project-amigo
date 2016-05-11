<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Particulars extends Model
{
    use SoftDeletes;

    protected $fillable = array(
		'description',
		'particular_type_id'
	);
	public function item_orders() {
  		return $this->belongTo('App\Models\ParticularsTypes');
  	}

  	public function establishments() {
  		return $this->hasMany('App\Models\Establishment');
  	}
}
