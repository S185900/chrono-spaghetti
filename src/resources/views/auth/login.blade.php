@extends('layouts.first-header')

@section('css')
{{-- 先に古いファイルを読み込む --}}
    <link rel="stylesheet" href="{{ asset('css/first-header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    {{-- 最後にTailwindを読み込んで、古いスタイルを上書きできるようにする --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

{{-- ログイン画面 --}}
@section('content')
<div class="auth-page-wrapper">

    <div class="auth-form-wrapper">
        {{-- ソーシャルログイン --}}
        <div class="social-login">
            <x-social-button class="google !text-lg">Googleでログイン</x-social-button>
            <x-social-button class="apple !text-lg">Apple IDでログイン</x-social-button>
            <x-social-button class="microsoft !text-lg">Microsoftアカウントでログイン</x-social-button>
        </div>

        {{-- 区切り線 --}}
        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">OR</span>
            <div class="divider-line"></div>
        </div>

        {{-- ログインフォーム --}}
        <form class="register-form" method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="login-item">
                <label for="email" class="login-label">メールアドレス</label>
                <input id="email" type="email" class="input-form" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">

                @error('email')
                    <x-form-error-message :message="$message" class="!text-[14px]" />
                @enderror
            </div>

            <div class="login-item">
                <label for="password" class="login-label">パスワード</label>
                <input id="password" type="password" class="input-form" name="password" required autocomplete="password" placeholder="パスワード">

                @error('password')
                    <x-form-error-message :message="$message" class="!text-[14px]" />
                @enderror
            </div>

            <x-submit-button class="mt-8 !text-3xl tracking-widest uppercase">
                login
            </x-submit-button>

            <div class="orange-nav mt-4 text-center">
                {{-- !text-sm (0.875rem相当) や !text-base (1rem相当) などで調整 --}}
                <x-orange-link href="/" class="!text-sm">
                    パスワードをお忘れですか？
                </x-orange-link>
            </div>
        </form>
    </div>
</div>
@endsection