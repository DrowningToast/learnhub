<?php

namespace App\Models;

// Models
use App\Models\Courses;
use App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'course_id',
        'amount',
        'stripe_ref_id',
    ];

    public function fromUser()
    {
        return $this->belongsTo(Users::class, 'from_user_id', 'id');
    }

    public function toUser()
    {
        return $this->belongsTo(Users::class, 'to_user_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }
}
