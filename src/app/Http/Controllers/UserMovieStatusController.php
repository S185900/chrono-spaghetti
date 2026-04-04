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
}