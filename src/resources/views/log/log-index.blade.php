@extends('layouts.auth-header')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth-header.css')}}">
    <link rel="stylesheet" href="{{ asset('css/log-index.css')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

{{-- ログ一覧画面 --}}
@section('content')
<div class="log-index-wrapper">
    {{-- 上部ナビゲーション：TIMELINE / Cinema / Episodes --}}
    <div class="timeline-nav">
        <h2 class="timeline-title">TIMELINE</h2>
        <div class="tab-group">
            <a href="#" class="tab-item active">Cinema</a>
            <a href="#" class="tab-item">Episodes</a>
        </div>
    </div>

    {{-- ポスターグリッドエリア --}}
    <div class="log-grid">
        {{-- 本来は @foreach で回します。まずはダミーを12個 --}}
        @for ($i = 0; $i < 12; $i++)
            <div class="log-card">
                <div class="poster-placeholder">
                    {{-- ここに映画ポスター画像が入る --}}
                    <span class="scan-line"></span> {{-- SF演出用の走査線 --}}
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection