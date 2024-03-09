<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'chapter_id',
        'file_name',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapters::class, 'chapter_id', 'id');
    }
}
