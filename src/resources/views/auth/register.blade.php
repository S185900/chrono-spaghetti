@extends('layouts.first-header')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css')}}">
    <link rel="stylesheet" href="{{ asset('css/first-header.css')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

{{-- 会員登録画面 --}}
@section('content')
<div class="auth-page-wrapper">

    <div class="main-logo-visual">
        <img class="main-logo" src="{{ asset('images/CHRONO_SPAGHETTI-logo.png') }}" alt="CHRONO SPAGHETTI">
        <p class="tagline">Logging every vision from the Event Horizon.</p>
    </div>

    <div class="auth-form-wrapper">

        {{-- ソーシャルログイン --}}
        <div class="social-login">
            <button class="social-btn google">Googleでログイン</button>
            <button class="social-btn apple">Apple IDでログイン</button>
            <button class="social-btn microsoft">Microsoftアカウントでログイン</button>
        </div>

        {{-- 区切り線 --}}
        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">OR</span>
            <div class="divider-line"></div>
        </div>

        {{-- 登録フォーム --}}
        <div class="register-form" method="" action="/">
            @csrf

            <div class="login-item">
                <label for="name" class="login-label">アカウント名</label>
                <input id="name" type="email" class="input-form" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="アカウント名">

                @error('name')
                    <span class="form-error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="login-item">
                <label for="email" class="login-label">メールアドレス</label>
                <input id="email" type="email" class="input-form" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">

                @error('email')
                    <span class="form-error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="login-item">
                <label for="password" class="login-label">パスワード</label>
                <input id="password" type="password" class="input-form" name="password" required autocomplete="password" placeholder="パスワード">

                @error('password')
                    <span class="form-error-message">{{ $message }}</span>
                @enderror
                @error('auth_error')
                    <span class="auth-error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="login-item">
                <label for="password_confirmation" class="login-label">確認用パスワード</label>
                <input id="password_confirmation" type="password" class="input-form" name="password_confirmation" required autocomplete="password_confirmation" placeholder="確認用パスワード">

                @error('password')
                    <span class="form-error-message">{{ $message }}</span>
                @enderror
                @error('auth_error')
                    <span class="auth-error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="orange-button mt-8">
                <button type="submit" 
                        class="submit-btn 
                            relative overflow-hidden group
                            transform transition-all duration-500 ease-out
                            hover:-translate-y-2 hover:scale-105 
                            hover:shadow-[0_0_35px_rgba(255,140,0,0.7)] 
                            active:scale-95 active:duration-75">

                    <span class="relative z-10 tracking-[0.1em]">登録する</span>

                    <div class="absolute inset-0 w-full h-full 
                                bg-gradient-to-r from-transparent via-white/30 to-transparent 
                                -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]">
                    </div>
                </button>
            </div>

        <!-- </form> -->
    </div>
</div>
@endsection