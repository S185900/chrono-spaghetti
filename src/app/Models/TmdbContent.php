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

    // 作品に紐づくカテゴリー（タグ）
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // 作品に紐づく全てのユーザーのログ（詳細画面で自分のログを出す用）
    public function movieLogs()
    {
        return $this->hasMany(MovieLog::class);
    }
}
