<?php

namespace App\Models;

// Models
use App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quizzes extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'quiz_data',
        'full_score',
        'expired_at',
        'chapter_id',
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }
}
