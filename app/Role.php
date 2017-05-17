<?php

namespace App;

use Laratrust\LaratrustRole;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends LaratrustRole
{
	use SoftDeletes;
	
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'name',
		'display_name',
		'description',
	];
}
