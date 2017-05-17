<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
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
		'id_address',
		'amount',
     	'date',
		'status',
		'mod_user',
	];
	
	public function user()
	{
		return $this->belongsTo('App\User','id_user');
	}
	
	public function address()
    {
        return $this->belongsTo('App\Models\Address','id_address');
    }
	
	public function invoice_details()
	{
		return $this->hasMany('App\Models\InvoiceDetail','id_invoice','id');
	}
	
	public function scopeInprogress($query)
	{
		return $query->where('status','<',4);
	}
	
	public function scopeSuccess($query)
	{
		return $query->where('status',4);
	}
	
	public function scopeFail($query)
	{
		return $query->where('status',5);
	}
}
