<?php

use Illuminate\Support\Facades\Route;

// 認証系
// 1. localhost/ にアクセスした時の処理
Route::get('/', function () {
    // ログイン済みなら一覧へ、未ログインならログイン画面へ
    return auth()->check()
        ? redirect()->route('log.index')
        : redirect()->route('login');
});

// 2. ログイン後のトップページ（ログイン必須）
Route::get('/log/index', function () {
    return view('log.log-index');
})->middleware(['auth', 'verified'])->name('log.index');

Route::view('/email-verification', 'auth.email-verification')->name('verification.notice');


