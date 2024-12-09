<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PreventDemoModeChanges;

class UserCoinAudit extends Model
{

	protected $table = 'user_coin_audit';
}