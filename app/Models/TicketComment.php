<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketComment extends Model
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
		'id_ticket',
		'id_user',
		'comment',
		'mod_user',
	];
	
	public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }
	
	public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket','id_ticket');
    }
}
