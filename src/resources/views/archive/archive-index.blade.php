@extends('layouts.auth-header') @section('css')
<link rel="stylesheet" href="{{ mix('css/app.css') }}" />
<link rel="stylesheet" href="{{ asset('css/auth-header.css')}}" />
<link rel="stylesheet" href="{{ asset('css/components.css') }}">
<link rel="stylesheet" href="{{ asset('css/archive-index.css') }}">
<link rel="stylesheet" href="{{ asset('css/coming-index.css') }}">
@endsection

{{-- ログ一覧画面 --}}
@section('content')
<div class="h-[50px] lg:h-[50px]"></div>

{{-- 1. コンテナ：header-containerと端を揃えるため px-10 (40px) を指定 --}}
<div class="log-index-wrapper mx-auto w-full max-w-[1400px] px-4 pb-8 lg:px-10">
    {{-- 2. 上部ナビ：スマホで中央寄せ、タブレット以上で左寄せ＆横並び --}}
    <div class="timeline-nav mb-12 flex flex-col items-center gap-6 md:flex-row md:items-end md:gap-14 lg:pl-10">
        <h2
            class="timeline-title -translate-y-[8px] font-baloo text-4xl font-bold tracking-[0.2rem] text-white"
        >
            ARCHIVE
        </h2>

        <div class="tab-group flex items-end">
            {{-- $currentTab が 'watched' なら active を true に --}}
            <x-nav-tab 
                label="Watched" 
                :active="$currentTab === 'watched'" 
                :link="route('archive.index', ['tab' => 'watched'])" 
            />

            <x-nav-tab
                label="Bookmarks"
                :active="$currentTab === 'bookmark'"
                :link="route('archive.index', ['tab' => 'bookmark'])"
                class="-ml-6"
            />
        </div>
    </div>

    <div class="h-[50px] lg:h-[50px]"></div>

    {{-- 3. グリッドエリア：レスポンシブ列数指定 --}}
    {{-- 3. グリッドエリア：グリッド数はユーザー指定のまま維持 --}}
    <div class="log-grid grid grid-cols-2 gap-4 md:grid-cols-3 md:gap-6 xl:grid-cols-4 xl:gap-8">

        @forelse ($movies as $movie)
            {{-- 【修正】w-full を追加し、親のグリッド幅いっぱいに広がるように強制します --}}
            <div class="log-card group relative aspect-[2/3] w-full cursor-pointer overflow-hidden rounded-[15px] border border-white/10 bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:border-orange-500 hover:shadow-[0_0_20px_rgba(255,140,0,0.4)]">
                
                <a href="{{ route('archive.show', ['id' => $movie->tmdb_id ?? $movie->id]) }}" class="block h-full w-full">
                    
                    {{-- 【変更】ホバー時に情報を出すエリア（Coming Soonのデザインを移植） --}}
                    <div class="log-card-info-coming z-10">
                        <p class="coming-card-label">SF MOVIE ARCHIVE</p>

                        <h3 class="coming-card-title text-white font-bold">{{ $movie->title }}</h3>

                        <div class="coming-info-details">
                            {{-- 監督情報 --}}
                            <p><span>Dir:</span> {{ $movie->director ?? 'Unknown' }}</p>
                            {{-- キャスト情報：配列か文字列かを判定して表示 --}}
                            <p>
                                <span>Cast:</span> 
                                @php
                                    $castData = is_string($movie->cast) ? json_decode($movie->cast, true) : $movie->cast;
                                @endphp
                                {{ is_array($castData) ? implode(', ', array_slice($castData, 0, 3)) : '---' }}
                            </p>
                        </div>

                        {{-- 日付表示：ブックマーク日または公開日 --}}
                        <p class="coming-release-date">
                            @if(isset($movie->bookmarked_at))
                                {{ \Carbon\Carbon::parse($movie->bookmarked_at)->format('Y.m.d') }}
                            @elseif($movie->release_date)
                                {{ \Carbon\Carbon::parse($movie->release_date)->format('Y.m.d') }}
                            @else
                                Release Date TBD
                            @endif
                        </p>
                    </div>

                    {{-- 背景・ポスター表示エリア --}}
                    <div class="poster-placeholder relative flex h-full w-full items-center justify-center bg-gradient-to-br from-white/5 to-black/30">
                        
                        @if($movie->poster_path)
                            {{-- 【修正】absolute inset-0 でカード全体に画像をフィットさせます --}}
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" 
                                alt="{{ $movie->title }}" 
                                class="absolute inset-0 h-full w-full object-cover">
                        @endif

                        {{-- SF走査線演出（画像より上に重ねる） --}}
                        <span class="scan-line absolute inset-0 z-[5] bg-[linear-gradient(to_bottom,transparent_50%,rgba(255,140,0,0.05)_50%)] bg-[length:100%_4px] transition-all group-hover:bg-[length:100%_2px]"></span>

                        @if(!$movie->poster_path)
                            <div class="text-xs uppercase tracking-tighter text-white/20">
                                No Image
                            </div>
                        @endif
                    </div>
                </a>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <p class="text-white/40 font-baloo tracking-widest uppercase">No Data Found</p>
            </div>
        @endforelse

    </div>
</div>
@endsection
