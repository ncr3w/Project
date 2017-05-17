<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
	use LaratrustUserTrait;
	Use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone' , 'date_of_birth' , 'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function address()
    {
        return $this->hasMany('App\Models\Address','id_user','id');
    }
	
	public function balance_in()
    {
        return $this->hasMany('App\Models\BalanceIn','id_user','id');
    }
	
	public function balance_out()
    {
        return $this->hasMany('App\Models\BalanceOut','id_user','id');
    }
}
