<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
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
		'id_ticket_detail', 
		'id_ticket_solution', 	
		'id_user',	
		'id_staff',		
		'status',
		'comment',
		'mod_user',
	];
	
	public function ticket_detail()
    {
        return $this->belongsTo('App\Models\TicketDetail','id_ticket_detail');
    }
	
	public function ticket_solution()
    {
        return $this->belongsTo('App\Models\TicketSolution','id_ticket_solution');
    }
	
	public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }
	
	public function staff()
    {
        return $this->belongsTo('App\User','id_staff');
    }
	
	public function comments()
	{
		return $this->hasMany('App\Models\TicketComment', 'id_ticket');
	}	
	
	public function scopeOpen($query) {
		return $query->where(function($q) {
				$q->where('status','=', 0)->orWhere('status','=',1);
			});		
	}	

	public function scopeClosed($query)
	{
		return $query->where('status',2);
	}
}
