<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticularsTypes extends Model
{
    
    use SoftDeletes;

    protected $fillable = array(
		'description'
	);

	public function particulars() {
  		return $this->hasMany('App\Models\particulars');
  	}
}
