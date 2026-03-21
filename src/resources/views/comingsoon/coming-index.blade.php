@extends('layouts.auth-header') @section('css')
<link rel="stylesheet" href="{{ asset('css/auth-header.css')}}" />
<link rel="stylesheet" href="{{ mix('css/app.css') }}" />
@endsection

{{-- カミングスーン一覧画面 --}}
@section('content')
<div class="h-[50px] lg:h-[50px]"></div>

{{-- 1. コンテナ：header-containerと端を揃えるため px-10 (40px) を指定 --}}
<div class="log-index-wrapper mx-auto w-full max-w-[1400px] px-4 pb-8 lg:px-10">
    {{-- 2. 上部ナビ：スマホで中央寄せ、タブレット以上で左寄せ＆横並び --}}
    <div class="timeline-nav mb-12 flex flex-col items-center gap-6 md:flex-row md:items-end md:gap-14">
        <h2
            class="timeline-title -translate-y-[8px] font-baloo text-4xl font-bold tracking-[0.2rem] text-white"
        >
            TIMELINE
        </h2>

        <div class="tab-group flex items-end">
            <x-nav-tab label="Coming Soon" :active="true" link="#" />

            <x-nav-tab
                label="Released"
                :active="false"
                link="#"
                class="-ml-6"
            />
        </div>
    </div>

    <div class="h-[50px] lg:h-[50px]"></div>

    {{-- 3. グリッドエリア：レスポンシブ列数指定 --}}
    <div class="log-grid grid grid-cols-2 gap-4 md:grid-cols-3 md:gap-6 xl:grid-cols-4 xl:gap-8">

        <!-- for ($i = 0; $i < 12; $i++) {{-- カード本体：アスペクト比2:3を維持 --}} -->

        @foreach ($displayMovies as $movie)
            <div class="log-card group relative aspect-[2/3] cursor-pointer overflow-hidden rounded-[15px] border border-white/10 bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:border-orange-500 hover:shadow-[0_0_20px_rgba(255,140,0,0.4)]">

                {{-- 作品ポスター --}}
                <div class="poster-placeholder flex h-full w-full items-center justify-center bg-gradient-to-br from-white/5 to-black/30">

                    @if($movie->poster_path)
                        <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" 
                            alt="{{ $movie->title }}" 
                            class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full w-full items-center justify-center text-xs uppercase tracking-tighter text-white/20">
                            No Image
                        </div>
                    @endif

                    {{-- SF演出用の走査線（hover時に少し光る演出を追加） --}}
                    <span class="scan-line absolute inset-0 bg-[linear-gradient(to_bottom,transparent_50%,rgba(255,140,0,0.05)_50%)] bg-[length:100%_4px] transition-all group-hover:bg-[length:100%_2px]"></span>

                    {{-- ホバー時に情報を出す（監督・キャスト対応） --}}
                    <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/90 via-black/40 to-transparent p-4 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        <p class="text-[10px] font-bold text-orange-500 mb-1 uppercase tracking-wider">
                            {{ $movie->media_type === 'movie' ? 'Movie' : 'TV Series' }}
                        </p>
                        <h3 class="text-sm font-bold text-white line-clamp-2 leading-tight mb-2">{{ $movie->title }}</h3>

                        <div class="info-details space-y-1 border-t border-white/20 pt-2">
                            <p class="text-[10px] text-white/70"><span class="text-white/40">Dir:</span> {{ $movie->director }}</p>
                            <p class="text-[10px] text-white/70 leading-relaxed">
                                <span class="text-white/40">Cast:</span> 
                                {{ is_array($movie->cast) ? implode(', ', array_slice($movie->cast, 0, 3)) : '---' }}
                            </p>
                        </div>

                        <p class="text-[10px] text-orange-400 mt-3 font-mono">
                            {{ $movie->release_date ? $movie->release_date->format('Y.m.d') : 'Coming Soon' }}
                        </p>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
