<?php

namespace App\Models;

// Models
use App\Models\Users;
use App\Models\Courses;
use App\Models\Chapters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgressByUserByCourse extends Model
{

    protected $table = "progress_by_user_by_course";

    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'chapter_id',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapters::class, 'chapter_id', 'id');
    }
}
