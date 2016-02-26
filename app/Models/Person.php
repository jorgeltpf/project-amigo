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

	protected $dates = ['deleted_at'];

	protected $guarded = [
		'id',
		'created_at',
		'update_at'
	];

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

    private $rules = array(
		'cpf=>required|min:11'
	);

    public function user() {
    	return $this->belongsTo('App\User');
    }

	public function setUserIdAttribute($value){
		$this->attributes['user_id'] = $value == "null" ? null : $value;
	}

    // Envia o tel sem máscara
    public function setPhoneAttribute($value) {
        $this->attributes['phone'] = trim(preg_replace('~[\\\\/:*?"<>|()-]~', '', $value));
    }

    // Busca o tel já com máscara
    public function getPhoneAttribute($value) {
        if (is_null($value))
            return null;
        else
            return "(".substr($value, 0, 2).") ".substr($value, 2, 4)."-".substr($value, 6);
    }

    public function setCellPhoneAttribute($value) {
        $this->attributes['cell_phone'] = trim(preg_replace('~[\\\\/:*?"<>|()-]~', '', $value));
    }

    // Busca o cel já com máscara
    public function getCellPhoneAttribute($value) {
        if (is_null($value))
            return null;
        else
            return "(".substr($value, 0, 2).") ".substr($value, 2, 4)."-".substr($value, 6);
    }

    public function setCepAttribute($value) {
        $this->attributes['cep'] = trim(preg_replace('~[\\\\/:*?"<>|()-]~', '', $value));
    }

    // Busca o Cep já com máscara
    public function getCepAttribute($value) {
        if (is_null($value))
            return null;
        else
            return substr($value, 0, 5)."-".substr($value, 5);
    }

    // Envia o cnpj sem máscara
    public function setCpfAttribute($value) {
        $this->attributes['cpf'] = trim(preg_replace('~[\\\\/:*?"<>.|()-]~', '', $value));
    }
}