<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Particular extends Model {
  use SoftDeletes;

  protected $fillable = array(
		'description',
		'particular_type_id'
	);

	public function particular_types() {
		return $this->belongsToMany('App\Models\ParticularType');
	}

	public function establishments() {
		return $this->belongsToMany('App\Models\Establishment');
	}
}
