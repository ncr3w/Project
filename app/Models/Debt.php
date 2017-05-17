<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debt extends Model
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
			'id_balance_out',
			'amount',
			'method',
			'status',
			'mod_user',
	];
	
	public function balance_out()
    {
        return $this->belongsTo('App\Models\BalanceOut','id_balance_out','id');
    }
}
