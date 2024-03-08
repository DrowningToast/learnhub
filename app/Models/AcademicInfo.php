<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'school',
        'institute',
        'campus',
        'year',
    ];
}