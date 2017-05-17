<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BalanceIn extends Model
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
		'amount',
		'type', 
		'mod_user',
	];
	
	public function balance_in_transaction()
    {
        return $this->hasMany('App\Models\BalanceInTransaction','id_balance_in','id');
    }
	
	public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }
}
