@extends('layouts.auth-header')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth-header.css')}}">
    <link rel="stylesheet" href="{{ asset('css/log-index.css')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

{{-- ログ一覧画面 --}}
@section('content')
{{-- 1. コンテナ：基本は横幅いっぱい。pcサイズ(xl)以上で最大幅を固定 --}}
<div class="log-index-wrapper w-full py-8">
    
    {{-- 2. 上部ナビ：スマホでは縦並び、タブレット(md)以上で横並びに --}}
    <div class="timeline-nav flex flex-col gap-4 mb-8 border-b border-white/20 pb-4 md:flex-row md:items-end md:gap-10">
        <h2 class="timeline-title text-2xl font-bold tracking-widest text-white">TIMELINE</h2>
        
        <div class="tab-group flex">
            {{-- タブ：スマホでは少し小さく、PCでは大きく --}}
            <a href="#" class="tab-item active bg-orange-500 text-black px-6 py-2 text-sm md:text-base">Cinema</a>
            <a href="#" class="tab-item bg-white/10 text-white px-6 py-2 text-sm md:text-base border border-white/20 border-l-0">Episodes</a>
        </div>
    </div>

    {{-- 3. グリッドエリア：モバイルファーストの真骨頂 --}}
    {{-- 
    grid-cols-2 : スマホ（基本）は2列
    md:grid-cols-3 : タブレット(768px〜)は3列
    xl:grid-cols-4 : PC(1280px〜)は4列
    --}}
<div class="log-grid grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 xl:gap-8">
        @for ($i = 0; $i < 12; $i++)
            {{-- カード本体：ホバー時の動きもPCサイズでのみ強調 --}}
            <div class="log-card relative aspect-[2/3] bg-white/5 rounded-xl border border-white/10 overflow-hidden cursor-pointer transition-all duration-500 hover:border-orange-500 hover:shadow-[0_0_20px_rgba(255,140,0,0.3)] hover:-translate-y-2">
                <div class="poster-placeholder w-full h-full flex items-center justify-center bg-gradient-to-br from-white/5 to-black/30">
                    {{-- SF演出用の走査線 --}}
                    <span class="scan-line absolute inset-0 bg-[linear-gradient(to_bottom,transparent_50%,rgba(255,140,0,0.05)_50%)] bg-[length:100%_4px]"></span>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection