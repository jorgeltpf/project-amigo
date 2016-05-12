<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParticularType extends Model {
    use SoftDeletes;

    protected $fillable = array(
		'description'
	);

	public function particulars() {
  		return $this->hasMany('App\Models\Particular');
  	}
}
