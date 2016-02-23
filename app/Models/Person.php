<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Helpers;

class Person extends Model {
	use SoftDeletes;

	// Identificar a tabela people
	protected $table = 'people';

	protected $hidden = [
		'user_id'
	];

    protected $fillable = array(
		'name',
		'user_id',
		'email',
		'phone',
		'cell_phone',
		'street',
		'street_number',
		'complement',
		'city',
		'state',
		'country',
		'cep',
		'cpf',
		'people_type'
	);

    public function user() {
    	return $this->hasOne('App\Models\User');
    }

	public function setUserIdAttribute($value){
		$this->attributes['user_id'] = $value == "null" ? null : $value;
	}
}