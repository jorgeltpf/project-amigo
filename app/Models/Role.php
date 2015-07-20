<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $fillable = [
		'name',
		'display_name',
		'description'
	];

	public function users()
	{
		return $this->belongsToMany('App\User');
	}

	public function permissions()
	{
		return $this->belongsToMany('App\Models\Permission');
	}

}