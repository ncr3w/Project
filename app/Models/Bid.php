<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bid extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at','bid_date','expired_date'];	

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'id_user',
		'id_product',
		'id_address',
    	'amount',
 		'bid_date',
 		'expired_date',
 		'size',
		'status',
		'type', 
		'mod_user',
	];
	
	public function product()
	{
		return $this->belongsTo('App\Models\Product','id_product');
	}
	
	public function user()
	{
		return $this->belongsTo('App\User','id_user');
	}
	
	public function address()
	{
		return $this->belongsTo('App\Models\Address','id_address');
	}
	
}
