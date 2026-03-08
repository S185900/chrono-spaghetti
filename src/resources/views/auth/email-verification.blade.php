@extends('layouts.first-header')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/email-verification.css')}}">
    <link rel="stylesheet" href="{{ asset('css/first-header.css')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

{{-- メール認証通知画面 --}}
@section('content')
<div class="auth-page-wrapper">

    <div class="main-logo-visual">
        <img class="main-logo" src="{{ asset('images/CHRONO_SPAGHETTI-logo.png') }}" alt="CHRONO SPAGHETTI">
    </div>

    <div class="email-verification-wrapper">
        <p class="email-verification-text">ご登録いただいたメールアドレスに認証メールを送信しました。</p>
        <p class="email-verification-text">メールの案内に従って、本登録を完了させてください。</p>
    </div>

    {{-- Tailwind「浮遊する光」ボタン --}}
    <div class="orange-button mt-8">
        <a href="{{ route('login') }}" 
        class="submit-btn 
                relative inline-block transform transition-all duration-500 ease-out
                hover:-translate-y-2 hover:scale-105 
                hover:shadow-[0_0_30px_rgba(255,140,0,0.6)] 
                active:scale-95 active:duration-75
                overflow-hidden group" 
        style="text-align: center; display: block; text-decoration: none;">

            {{-- 文字の部分を少し浮かせる演出 --}}
            <span class="relative z-10">ログインはこちら</span>

            {{-- マウスを乗せた時に一瞬光が走るエフェクト（おまけ） --}}
            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
        </a>
    </div>

    <div class="orange-nav">
        <a href="/" class="submit-nav">認証メールを再送する</a>
    </div>
</div>
@endsection