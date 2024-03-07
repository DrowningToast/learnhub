<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawals extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_id',
        'account_name',
        'amount',
        'status_id', // 1: REQUESTED 2: APPROVED 3: DECLINED
    ];
}
