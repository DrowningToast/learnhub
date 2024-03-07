<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Courses;
use App\Models\Reviews;
use App\Models\Credentials;
use App\Models\AcademicInfo;

// Models
use App\Models\CourseByUser;
use App\Models\Transactions;
use App\Models\QuizScoreByUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'profile_image_src',
        'email',
        'phone_number',
        'first_name',
        'last_name',
        'points'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function spendingTransactions()
    {
        return $this->hasMany(Transactions::class, 'from_user_id', 'id');
    }

    public function receivingTransactions()
    {
        return $this->hasMany(Transactions::class, 'to_user_id', 'id');
    }

    public function quizScores()
    {
        return $this->hasMany(QuizScoreByUser::class, 'user_id', 'id');
    }

    public function ownedCourses()
    {
        return $this->hasMany(Courses::class, 'lecturer_id', 'id');
    }

    public function enrolledCourses()
    {
        return $this->hasMany(CourseByUser::class, 'user_id', 'id');
    }

    public function academicInfo()
    {
        return $this->belongsTo(AcademicInfo::class, 'academic_id', 'id');
    }

    public function credentials()
    {
        return $this->belongsTo(Credentials::class, 'credential_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'user_id', 'id');
    }
}
