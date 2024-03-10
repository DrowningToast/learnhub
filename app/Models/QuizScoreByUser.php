<?php

namespace App\Models;

// Models
use App\Models\Users;
use App\Models\Quizzes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizScoreByUser extends Model
{
    protected $table = "quiz_score_by_user";

    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'answer_data',
        'submitted_at',
        'score',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quizzes::class, 'quiz_id', 'id');
    }
}
