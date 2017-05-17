<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
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
		'id_brand',
		'id_division',
		'id_photo',
		'product_name',
		'gender',
		'article',
		'alias',
		'color',
		'retail_price',
		'number_sold',
		'avg_price_new',
		'avg_price_used',
		'number_of_view',
		'release_date',
		'mod_user',
	];
	
	public function brand()
	{
		return $this->belongsTo('App\Models\Brand','id_brand');
	}
	
	public function division()
	{
		return $this->belongsTo('App\Models\Division','id_division');
	}
	
	public function photo()
	{
		return $this->hasOne('App\Models\Photo','id','id_photo');
	}
}
