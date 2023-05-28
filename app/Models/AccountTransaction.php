<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'date',
        'opening_balance',
        'total_debits',
        'total_credits',
        'closing_balance',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
