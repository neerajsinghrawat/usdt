<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PreventDemoModeChanges;

class UserCoinAudit extends Model
{

	protected $table = 'user_coin_audit';

	// Add fillable fields for mass assignment
	protected $fillable = [
		'user_id',
		'type',
		'amount', // Example field
		'created_at',
		'updated_at',
	];

	/**
	 * Define the inverse of the relationship with User.
	 */
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}


    protected $casts = [
        'approved_date' => 'datetime',
    ];
}


