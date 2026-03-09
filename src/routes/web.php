<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// 認証系
Route::get('/log/index', function () {
    return view('log.log-index');
})->middleware(['auth', 'verified'])->name('log.index');

Route::view('/email-verification', 'auth.email-verification')->name('verification.notice');

// レイアウト確認用（開発が終わったら消してもOK）
Route::view('/first-header', 'layouts.first-header')->name('first-header');


