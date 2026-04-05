<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Models\Movie; // 今後モデルを使う場合はこちらをインポート

class ArchiveController extends Controller
{
    /**
     * アーカイブ一覧画面
     */
    public function index(Request $request)
    {
        // URLの ?tab=... を取得。指定がなければデフォルトは 'watched'
        $currentTab = $request->query('tab', 'watched');
        $user = auth()->user();

        $movies = \App\Models\UserMovieStatus::where('user_id', $user->id)
            ->where('status', $currentTab) 
            ->join('tmdb_contents', 'user_movie_statuses.tmdb_content_id', '=', 'tmdb_contents.tmdb_id')
            ->select('tmdb_contents.*', 'user_movie_statuses.created_at as log_date')
            ->get();

        return view('archive.archive-index', compact('currentTab', 'movies'));
    }

    /**
     * アーカイブ詳細画面
     */
    public function show($id)
    {
        // 送られてきたID（TMDB ID）を元にDBから作品情報を取得
        $movie = \App\Models\TmdbContent::where('tmdb_id', $id)->firstOrFail();

        // ログインユーザーのこの作品に対するステータス（感想やスコアなど）も取得
        $status = \App\Models\UserMovieStatus::where('user_id', auth()->id())
                    ->where('tmdb_content_id', $id)
                    ->first();

        $categories = \App\Models\Category::all();

        return view('archive.archive-detail', compact('movie', 'status', 'categories'));
    }
}
