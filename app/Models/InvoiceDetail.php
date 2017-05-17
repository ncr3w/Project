<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
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
		'id_ask',
		'id_bid',
		'id_address',
		'id_shipping',
		'id_invoice',
		'start_date',
		'end_date',
		'receipt',
		'receipt_in_date',
		'payment_date',
		'arrival_date',
		'status',
		'type',
		'shipping_cost',
		'mod_user',
	];
	
	public function invoices()
    {
        return $this->belongsTo('App\Models\Invoice','id_invoice');
    }
	
	public function ask()
    {
        return $this->belongsTo('App\Models\Ask','id_ask');
    }
	
	public function shipping()
    {
        return $this->belongsTo('App\Models\Shipping','id_shipping');
    }
}
