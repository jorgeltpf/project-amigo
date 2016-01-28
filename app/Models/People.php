<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Helpers;

class People extends Model {
	use SoftDeletes;

    protected $fillable = array(
		'name',
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
}