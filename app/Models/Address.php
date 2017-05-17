<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'id_user',
		'id_district',
		'address', 	
		'phone',
		'postal_code', 
		'mod_user',
	];	
	
	
	public function district()
	{
		return $this->belongsTo('App\Models\District','id_district');
	}	
	
	public function user()
	{
		return $this->belongsTo('App\User','id_user');
	}
	

}
