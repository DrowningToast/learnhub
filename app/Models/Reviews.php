<?php

namespace App\Models;

// Models
use App\Models\Users;
use App\Models\Courses;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'rating',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }
}
