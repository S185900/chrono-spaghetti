<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmdbContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'tmdb_id',
        'media_type',
        'title',
        'poster_path',
        'release_date',
        'overview',
        'director',
        'cast'
    ];

    protected $casts = [
        'cast' => 'array',
        'release_date' => 'date',
    ];
}
