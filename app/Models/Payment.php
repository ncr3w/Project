<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
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
			'id_balance_in',
			'id_invoice',
			'amount',
			'method',
			'status',
			'mod_user',
	];
	
	public function balance_in()
    {
        return $this->belongsTo('App\Models\BalanceIn','id_balance_in','id');
    }
	
	public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    }
	
	public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice','id_invoice','id');
    }
	
	public function proof()
    {
        return $this->hasOne('App\Models\PaymentProof','id_payment','id');
    }
}
