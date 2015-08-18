<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeekDay extends Model
{
	protected $fillable = [
		'id',
		'name'
	];

	public function establishments() {
		return $this->belongsToMany('App\Models\Establishment');
	}
}
