@extends('layouts.first-header')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/first-header.css')}}">
    <link rel="stylesheet" href="{{ asset('css/email-verification.css')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

{{-- メール認証通知画面 --}}
@section('content')
<div class="auth-page-wrapper">

    <div class="email-verification-wrapper">
        <p class="email-verification-text">ご登録いただいたメールアドレスに認証メールを送信しました。</p>
        <p class="email-verification-text">メールの案内に従って、本登録を完了させてください。</p>
    </div>

    {{-- コンポーネント化したログインボタン --}}
    <div class="orange-button mt-12">
        {{-- もしaタグ版を別に作っていない場合は、今の!text-3xlなどを適用 --}}
        <x-submit-button class="!text-2xl tracking-widest uppercase" onclick="location.href='{{ route('login') }}'">
            ログインはこちら
        </x-submit-button>
    </div>

    {{-- コンポーネント化した再送リンク --}}
    <div class="orange-nav mt-8">
        <x-orange-link href="/" class="!text-lg">
            認証メールを再送する
        </x-orange-link>
    </div>
</div>
@endsection