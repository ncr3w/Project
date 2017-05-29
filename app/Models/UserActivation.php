<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserActivation extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'user_activations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
    'id_user',
    'token',
    'mod_user',
	];

	public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }

    public function id_user()
    {
        $temp = $this->belongsTo('App\User','id_user');
        return $temp->id;
    }
}
