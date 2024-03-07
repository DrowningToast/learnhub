<?php

namespace App\Models;


// Models
use App\Models\Users;
use App\Models\Reviews;
use App\Models\Chapters;
use App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover_image_src',
        'buy_price',
        'buy_point',
        'discount_percent',
        'hidden',
        'lecturer_id',
    ];

    public function lecturer()
    {
        return $this->belongsTo(Users::class, 'lecturer_id', 'id');
    }

    public function chapters()
    {
        return $this->hasMany(Chapters::class, 'course_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'course_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'course_id', 'id');
    }
}
