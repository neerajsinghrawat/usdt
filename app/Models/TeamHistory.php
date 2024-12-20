<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PreventDemoModeChanges;

class TeamHistory extends Model
{

	protected $table = 'team_history';

	public function referreduser()
	{
		return $this->belongsTo(User::class, 'referred_by');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
	

}


