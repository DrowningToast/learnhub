<?php

namespace App\Models;


// Models
use App\Models\Users;
use App\Models\Reviews;
use App\Models\Chapters;
use App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'cover_image_src',
        'buy_price',
        'buy_point',
        'discount_percent',
        'hidden',
        'lecturer_id',
        'category_id',
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

    public function scopeFilter($query, array $filters)
    {
        if ($filters['title'] ?? false) {
            $query->where('title', 'like', '%' . request('title') . '%');
        }

        if (($filters['categoryId'] ?? false) && $filters['categoryId'] !== 'ทั้งหมด') {
            $query->where('category_id', '=', request('categoryId'));
        }
    }

}
