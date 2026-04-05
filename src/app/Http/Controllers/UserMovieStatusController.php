<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMovieStatus;
use Illuminate\Support\Facades\Auth;

class UserMovieStatusController extends Controller
{
    public function bookmark(Request $request)
    {
        // バリデーション：tmdb_idが必須
        $request->validate([
            'tmdb_content_id' => 'required|exists:tmdb_contents,tmdb_id',
            'note' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        // 保存または更新（1人1映画1ステータス）
        UserMovieStatus::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'tmdb_content_id' => $request->tmdb_content_id,
            ],
            [
                'status' => 'bookmark', // ステータスをbookmarkに設定
            ]
        );

        // archive-indexへ遷移。クエリパラメータで「bookmarkタブ」を指定
        return redirect()->route('archive.index', ['tab' => 'bookmark'])
                         ->with('message', 'ブックマークに保存しました！');
    }

    public function updateTags(Request $request, $id)
    {
        // TMDB IDから作品を取得
        $movie = \App\Models\TmdbContent::where('tmdb_id', $id)->firstOrFail();
        
        // 中間テーブル (category_tmdb_content) を更新
        // ※TmdbContentモデルにcategories()リレーションがある前提です
        $movie->categories()->sync($request->category_ids);

        return back()->with('success', 'カテゴリーを更新しました');
    }

    public function update(Request $request, $id)
    {

        // バリデーション
        $request->validate([
            'user_comment' => 'nullable|string',
            'rating'       => 'nullable|integer|min:1|max:5',
        ]);

        \App\Models\UserMovieStatus::where('user_id', auth()->id())
            ->where('tmdb_content_id', $id)
            ->update([
                'user_comment' => $request->user_comment,
                'rating' => $request->rating,
                'status' => 'watched',
            ]);

        return redirect()->route('archive.index', ['tab' => 'watched'])
                 ->with('success', 'LOGを保存し、Watchedリストに移動しました。');
    }
}