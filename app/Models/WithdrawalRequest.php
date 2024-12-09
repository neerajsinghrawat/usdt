<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $table = 'withdrawal_requests'; // Specify table name

    protected $fillable = [
        'user_id', 'type', 'comments', 'start_date', 'approved_date', 'transaction_type', 'action', 'amount'
    ];



    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
