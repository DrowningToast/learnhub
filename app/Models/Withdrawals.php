<?php

namespace App\Models;

// Models
use App\Models\Banks;
use App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function scopeFilter($query, array $filters)
    {
        if (($filters['statusId'] ?? false) && $filters['statusId'] !== 'ALL') {
            $query->where('status_id', $filters['statusId']);
        }
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(Banks::class, 'bank_id', 'id');
    }
}
