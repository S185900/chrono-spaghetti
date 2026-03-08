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
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/email-verification', 'auth.email-verification')->name('verification.notice');

// レイアウト確認用（開発が終わったら消してもOK）
Route::view('/first-header', 'layouts.first-header')->name('first-header');


Route::get('/', function () {
    return view('welcome');
});
