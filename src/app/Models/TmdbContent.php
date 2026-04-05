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
        'countries',     // 制作国
        'release_year',  // 公開年
        'runtime',       // 上映時間
        'is_coming_soon' // フラグ
    ];

    protected $casts = [
        'cast' => 'array',
        'countries' => 'array',
        'release_date' => 'date',
        'is_coming_soon' => 'boolean',
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
