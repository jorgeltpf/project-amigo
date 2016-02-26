<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Carbon\Carbon;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, EntrustUserTrait, SoftDeletes; // add this trait to your user model

    protected $dates = ['created_at, deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'confirmation_code',
        // Person
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
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Função para deletar em cascata a pessoa
     * associada com o usuário deletado
     */
    protected static function boot() {
        parent::boot();

        static::deleting(function($user) {
            $user->person()->delete();
        });
    }

	public function articles()
	{
		return $this->hasMany('App\Article');
	}

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function person() {
        return $this->hasOne('App\Models\Person');
    }

    /**
    *   Retorna uma lista com o perfil associado ao usuário
    *   @return array
    */

    public function getRoleListAttribute()
    {
        return $this->roles->lists('id')->toArray();
    }

    public function setCreatedAtAttribute($date) {
        $this->attributes['created_at'] =  Carbon::parse($date);
    }

    public function getCreatedAtAttribute($date) {
        if (is_null($date))
            return null;
        else
            return Carbon::parse($date)->format('d/m/Y H:i:s');
    }
}
