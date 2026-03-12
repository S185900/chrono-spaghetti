@extends('layouts.first-header')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css')}}">
    <link rel="stylesheet" href="{{ asset('css/first-header.css')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

{{-- 会員登録画面 --}}
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

        {{-- 登録フォーム --}}
        <form class="register-form" method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="login-item">
                <label for="name" class="login-label">ユーザー名</label>
                <input id="name" type="text" class="input-form" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="ユーザー名">

                @error('name')
                    <x-form-error-message :message="$message" class="!text-[14px]" />
                @enderror
            </div>

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

            <div class="login-item">
                <label for="password_confirmation" class="login-label">確認用パスワード</label>
                <input id="password_confirmation" type="password" class="input-form" name="password_confirmation" required autocomplete="password_confirmation" placeholder="確認用パスワード">

                @if($errors->has('password_confirmation'))
                    <x-form-error-message
                        :message="$errors->first('password_confirmation')"
                        class="!text-sm"
                    />
                @endif
            </div>

            <x-submit-button class="mt-8 !text-2xl tracking-widest uppercase">
                登録する
            </x-submit-button>

        </form>
    </div>
</div>
@endsection