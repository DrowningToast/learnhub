<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicInfos extends Model
{
    use HasFactory;

    protected $fillable = [
        'school',
        'institute',
        'campus',
        'year',
    ];
}
