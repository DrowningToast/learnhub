<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
