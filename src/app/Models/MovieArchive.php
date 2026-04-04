<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieArchive extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tmdb_content_id', 'watched_at', 'rating', 'comment'];

    public function user() { return $this->belongsTo(User::class); }
    public function tmdbContent() { return $this->belongsTo(TmdbContent::class); }
}
