<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMovieStatus extends Model
{
    // テーブル名が複数形（user_movie_statuses）であることを明示
    protected $table = 'user_movie_statuses';

    // 一括保存（updateOrCreateなど）を許可するカラムを指定
    protected $fillable = [
        'user_id',
        'tmdb_content_id',
        'status',
        'user_comment',
        'rating',
    ];
}