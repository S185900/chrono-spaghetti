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

        if ($currentTab === 'bookmark') {
            // user_movie_statuses テーブルから status が 'bookmark' のものを取得
            // tmdb_contents テーブルと結合（join）して作品情報も一緒に持ってくる
            $movies = \App\Models\UserMovieStatus::where('user_id', $user->id)
                ->where('status', 'bookmark')
                ->join('tmdb_contents', 'user_movie_statuses.tmdb_content_id', '=', 'tmdb_contents.tmdb_id')
                ->select('tmdb_contents.*', 'user_movie_statuses.created_at as bookmarked_at')
                ->get();
        } else {
            // Watched タブ用のデータ（今はまだ空のコレクションにしておく）
            $movies = collect();
        }

        // viewに $currentTab を渡す
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

        // 現時点では表示確認用にダミーデータを渡す
        // $movie = (object)[
        //     'id' => $id,
        //     'title' => 'プロジェクト・ヘイル・メアリー',
        //     'director' => 'フィル・ロード',
        //     'cast' => ['ライアン・ゴズリング', 'ザンドラ・ヒュラー'],
        //     'release_date' => \Carbon\Carbon::parse('2026-03-15'),
        //     'poster_path' => '/v0vXUceGPREVeLM6YVDX38F3.jpg', // TMDBなどのパス
        //     'overview' => '孤立無援の宇宙船で目覚めた男が、人類を救うために未知の相棒と協力するSF大作。',
        //     'category' => 'SF MOVIE ARCHIVE'
        // ];

        return view('archive.archive-detail', compact('movie', 'status'));
    }
}
