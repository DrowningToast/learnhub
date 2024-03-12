<?php

namespace App\Models;

// Models
use App\Models\Files;
use App\Models\Courses;

use App\Models\Quizzes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapters extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'durationInMinutes',
        'video_src',
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }

    public function quizz()
    {
        return $this->hasOne(Quizzes::class, 'chapter_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(Files::class, 'chapter_id', 'id');
    }
}
