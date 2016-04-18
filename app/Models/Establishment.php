<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Establishment extends Model {
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = array(
		'name',
		'cnpj',
		'phone',
		'cell_phone',
		'email',
		'street',
		'street_number',
		'complement',
		'city',
		'state',
		'country',
		'delivery_max_time',
		'cep'
	);

    private $rules = array(
		'cnpj=>required|min:14'
	);

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
    public function setCnpjAttribute($value) {
        $this->attributes['cnpj'] = trim(preg_replace('~[\\\\/:*?"<>.|()-]~', '', $value));
    }

    public function weekdays() {
        return $this->belongsToMany('App\Models\WeekDay')->withPivot('time_on', 'time_off', 'shift');
    }

    public function promotions() {
        return $this->hasMany('App\Models\Establishment', 'establishment_id');
    }

    public function orders() {
        return $this->hasMany('App\Models\Order');
    }
    
    public function products() {
        return $this->hasMany('App\Models\Product');
    }

    public function people() {
        return $this->belongsToMany('App\Models\Person');
    }
}
