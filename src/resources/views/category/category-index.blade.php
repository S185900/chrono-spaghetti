@extends('layouts.auth-header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth-header.css')}}" />
<link rel="stylesheet" href="{{ mix('css/app.css') }}" />
@endsection

@section('content')
{{-- カテゴリー画面 --}}
<div class="w-full px-4 py-12 lg:px-10">
    
    {{-- 2. コンテンツの最大幅を制限せず、.main-content(1400px) に任せる --}}
    <div class="max-w-[1400px] mx-auto space-y-24 flex flex-col items-center">
        @foreach($categories as $category)
        <div class="border-b border-white/10 pb-12">
            
            {{-- カテゴリー見出し（Figma：下向き三角 ▼） --}}
            <div class="flex items-center gap-6 w-full text-left mb-8">
                <span class="text-[#ff8c00] text-2xl">▼</span>

                <!-- text-brand-primary -->
                <!-- text-[#ff8c00]/50 -->
                <h2 class="text-2xl md:text-4xl font-black tracking-[0.2em] text-[#ff8c00] uppercase">
                    {{ $category['name_jp'] }} 
                    <span class="text-sm font-medium tracking-normal text-brand-primary ml-4 italic">
                        ({{ $category['name_en'] }})
                    </span>
                </h2>
            </div>

            {{-- コンテンツエリア（最初から表示） --}}
            <div class="ml-12 space-y-10">
                
                {{-- ジャンル説明文 --}}
                <div class="max-w-3xl border-l-2 border-[#ff8c00]/20 pl-6">
                    <p class="text-sm md:text-base text-gray-300 leading-[1.8] tracking-[0.05em]">
                        {{ $category['description'] }}
                    </p>
                </div>

                {{-- 作品データ（映画・小説） --}}
                <div class="flex flex-col md:flex-row gap-12 text-[12px] tracking-[0.1em]">
                    <div class="flex-1 bg-white/5 p-4 rounded-lg">
                        <span class="text-[#ff8c00]/70 block mb-3 font-bold">■ 映画 (Movies)</span>
                        <p class="leading-loose text-gray-200">
                            『{{ implode('』、『', $category['movies']) }}』
                        </p>
                    </div>
                    <div class="flex-1 bg-white/5 p-4 rounded-lg">
                        <span class="text-[#ff8c00]/70 block mb-3 font-bold">■ 小説 (Novels)</span>
                        <p class="leading-loose text-gray-200">
                            『{{ implode('』、『', $category['novels']) }}』
                        </p>
                    </div>
                </div>

                {{-- 作品カード（Figmaのグレーボックス） --}}
                <div class="flex gap-6 overflow-x-auto pb-6 no-scrollbar">
                    @for($i=0; $i<4; $i++)
                    <div class="min-w-[180px] md:min-w-[220px] aspect-[2/3] bg-[#1e1e1e] rounded-[24px] shadow-[0_10px_30px_rgba(0,0,0,0.5)] border border-white/5 flex flex-col items-center justify-center relative group">
                        {{-- ポスター風の装飾 --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent rounded-[24px]"></div>
                        <div class="z-10 text-[10px] text-white/30 font-bold tracking-[0.4em] uppercase">Poster Archive</div>
                        <div class="z-10 w-10 h-[1px] bg-[#ff8c00]/40 mt-3"></div>

                        {{-- ホバー時の光沢演出（隠し味） --}}
                        <div class="absolute inset-0 rounded-[24px] border border-[#ff8c00]/0 group-hover:border-[#ff8c00]/30 transition-all duration-500"></div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* 横スクロールを綺麗に見せるためのスタイル */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    /* フォントをSFっぽく（もし入っていれば） */
    body {
        letter-spacing: 0.02em;
        text-rendering: optimizeLegibility;
    }
</style>
@endsection