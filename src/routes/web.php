<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ComingSoonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\UserMovieStatusController;

/*
|--------------------------------------------------------------------------
| 1. 公開ルート (認証不要・SNS認証)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check() ? redirect()->route('archive.index') : redirect()->route('login');
});

// SNS認証 (Google)
Route::prefix('auth/google')->group(function () {
    Route::get('/redirect', [SocialiteController::class, 'redirect'])->name('auth.google');
    Route::get('/callback', [SocialiteController::class, 'callback'])->name('auth.google.callback');
});

/*
|--------------------------------------------------------------------------
| 2. 認証必須ルート (auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::view('/email-verification', 'auth.email-verification')->name('verification.notice');

    /*
    |--------------------------------------------------------------------------
    | 3. メール認証済みのみ許可 (verified)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['verified'])->group(function () {

        // --- 観測ログ (Archive) ---
        Route::prefix('archive')->group(function () {
            Route::get('/', [ArchiveController::class, 'index'])->name('archive.index');
            Route::get('/{id}', [ArchiveController::class, 'show'])->name('archive.show');
            Route::post('/{id}/record', [ArchiveController::class, 'storeRecord'])->name('archive.record.store');
            Route::post('/archive/update/{id}', [UserMovieStatusController::class, 'update'])->name('user.movie.update');
        });

        // --- カミングスーン (Coming Soon) ---
        Route::prefix('comingsoon')->group(function () {
    
            // 1. 最優先：具体的なアクション（POST送信など）を一番上に
            Route::post('/user-movie-status/bookmark', [UserMovieStatusController::class, 'bookmark'])
                ->name('user.movie.bookmark');

            // 2. 次点：固定のパス（一覧画面など）
            Route::get('/', [ComingSoonController::class, 'index'])->name('coming.index');

            // 3. 最後：ワイルドカード（変数）を含むもの
            // これを最後に書くことで、上のどれにも当てはまらなかった場合だけここに来る
            Route::get('/{id}', [ComingSoonController::class, 'show'])->name('coming.show');
        });

        // --- カテゴリー (Category) ---
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::get('/{slug}', [CategoryController::class, 'show'])->name('category.show');
        });

        // --- マイページ (My Page) ---
        Route::prefix('mypage')->group(function () {
            Route::get('/', [MypageController::class, 'show'])->name('mypage.show');
            Route::get('/edit', [MypageController::class, 'edit'])->name('mypage.edit');
            Route::post('/edit', [MypageController::class, 'update'])->name('mypage.update');
        });

        // --- 友達招待 (Invite) ---
        Route::get('/invite', [InviteController::class, 'index'])->name('invite.show');

    });

});