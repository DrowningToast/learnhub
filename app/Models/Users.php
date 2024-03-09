<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RoleEnum;
use App\Models\Courses;
use App\Models\Reviews;
use App\Models\Credentials;
use App\Models\AcademicInfos;
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
        'phone',
        'first_name',
        'last_name',
        'points',
        'role',
        'credential_id',
        'academic_id',
        'bankName',
        'accountNumber',
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
        'role' => RoleEnum::class,
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
        return $this->belongsTo(AcademicInfos::class, 'academic_id', 'id');
    }

    public function credentials()
    {
        return $this->belongsTo(Credentials::class, 'credential_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'user_id', 'id');
    }

    // Handle profile_image_src to the default image if it's null
    public function withDefaultPortrait() {
        $this->profile_image_src = $this->profile_image_src ? $this->profile_image_src : asset('images/icons/DefaultPortrait.jpg');
        return $this;
    }
}
