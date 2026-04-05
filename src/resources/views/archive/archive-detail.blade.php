@extends('layouts.auth-header') 

@section('css')
<link rel="stylesheet" href="{{ mix('css/app.css') }}" />
<link rel="stylesheet" href="{{ asset('css/auth-header.css')}}" />
<link rel="stylesheet" href="{{ asset('css/components.css') }}">
<link rel="stylesheet" href="{{ asset('css/archive-detail.css') }}">
@endsection

@section('content')
<div class="h-[50px] lg:h-[50px]"></div>

<div class="log-index-wrapper mx-auto w-full max-w-[1400px] px-4 pb-8 lg:px-10">
    {{-- 上部ナビ --}}
    <div class="timeline-nav mb-12 flex flex-col items-center gap-6 md:flex-row md:items-end md:gap-14 lg:pl-10">
        <h2 class="timeline-title -translate-y-[8px] font-baloo text-4xl font-bold tracking-[0.2rem] text-white">
            映画鑑賞記録ページ
        </h2>
    </div>

    <div class="h-[40px] md:h-[50px] lg:h-[50px]"></div>

    <span class="text-[var(--color-brand-primary)] text-lg md:text-xl lg:text-2xl font-mono tracking-widest mb-1 opacity-80 block lg:text-center">
        SERIAL NUMBER: #TMDB-{{ $movie->tmdb_id }}
    </span>

    <div class="h-[20px] md:h-[20px] lg:h-[20px]"></div>

    {{-- メインコンテンツエリア：PCでは横並び、中央寄せ --}}
    <div class="max-w-[800px] lg:max-w-[1300px] mx-auto lg:flex lg:flex-row lg:justify-center lg:items-start lg:gap-12">

        {{-- 左カラム：作品基本情報 --}}
        <div class="w-full lg:w-[45%] max-w-[600px] flex-shrink-0">
            <div class="flex flex-row gap-6 items-start">
                {{-- ポスター --}}
                <div class="w-[120px] md:w-[180px] flex-shrink-0 relative aspect-[2/3] overflow-hidden rounded-[15px] border border-white/10 bg-white/10 shadow-[0_0_20px_rgba(0,0,0,0.5)]">
                    <div class="poster-placeholder flex h-full w-full items-center justify-center bg-gradient-to-br from-white/5 to-black/30">
                        @if($movie->poster_path)
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{ $movie->title }}" class="h-full w-full object-cover">
                        @endif
                        <span class="scan-line absolute inset-0 bg-[linear-gradient(to_bottom,transparent_50%,rgba(255,140,0,0.05)_50%)] bg-[length:100%_4px]"></span>
                    </div>
                </div>

                {{-- タイトル・監督 --}}
                <div class="flex-grow pt-2">
                    <div class="mb-6">
                        <div class="h-[1px] w-full bg-gradient-to-r from-[var(--color-brand-primary)]/50 to-transparent mt-1 mb-2"></div>
                        <label class="text-[14px] md:text-[20px] text-[var(--color-brand-primary)]/40 uppercase tracking-[0.2em] block mb-1">Title</label>
                        <textarea readonly class="title-area w-full bg-transparent border-none p-0 font-bold text-white focus:ring-0 font-baloo block">{{ $movie->title }}</textarea>
                    </div>

                    <div>
                        <div class="h-[1px] w-full bg-gradient-to-r from-[var(--color-brand-primary)]/50 to-transparent mt-1 mb-2"></div>
                        <label class="text-[14px] md:text-[20px] text-[var(--color-brand-primary)]/40 uppercase tracking-[0.2em] block mb-1">Directed by</label>
                        <textarea readonly class="title-area w-full bg-transparent border-none p-0 font-bold text-white focus:ring-0 font-baloo block">{{ $movie->director }}</textarea>
                    </div>
                </div>
            </div>

            <div class="h-[20px] md:h-[20px] lg:h-[20px]"></div>

            {{-- カテゴリータグ --}}
            <div class="mt-8 flex flex-wrap gap-3">
                <x-category-tag label="ハードSF" />
                <x-category-tag label="タイムトラベル" />
                <x-category-tag label="ディストピア" />
                <button class="border border-dashed border-white/30 rounded-full px-3 py-1 text-[10px] text-white/50 hover:border-orange-500 hover:text-orange-500 transition-colors">+ ADD TAG</button>
            </div>

            <div class="h-[20px] md:h-[20px] lg:h-[20px]"></div>

            {{-- 詳細データテーブル --}}
            <div class="mt-16 pt-8 border-t border-white/10 space-y-6">
                <div class="h-[20px] md:h-[20px] lg:h-[20px]"></div>

                    {{-- 公開年 --}}
                    <div class="grid grid-cols-[100px_1fr] gap-4">

                        <span class="text-[10px] text-white/40 uppercase tracking-widest pt-1">
                            RELEASE
                        </span>
                        <span class="text-sm text-gray-300">
                            {{ $movie->release_year ?? ($movie->release_date ? $movie->release_date->format('Y年') : '不明') }}
                        </span>

                    </div>

                    {{-- 国 --}}
                    <div class="grid grid-cols-[100px_1fr] gap-4">

                        <span class="text-[10px] text-white/40 uppercase tracking-widest pt-1">
                            COUNTRY
                        </span>
                        <span class="text-sm text-gray-300">
                            {{ !empty($movie->countries) ? implode('、', $movie->countries) : '不明' }}
                        </span>
                        </span>

                    </div>

                    {{-- キャスト --}}
                    <div class="grid grid-cols-[100px_1fr] gap-4">

                        <span class="text-[10px] text-white/40 uppercase tracking-widest pt-1">
                            CAST
                        </span>

                        <div class="text-[11px] text-gray-400 leading-relaxed space-y-1">
                            @php
                                $casts = is_string($movie->cast) ? json_decode($movie->cast, true) : $movie->cast;
                            @endphp
                            @if(is_array($casts))
                                @foreach(array_slice($casts, 0, 5) as $cast)
                                    <p>{{ $cast }}</p>
                                @endforeach
                            @else
                                <p>---</p>
                            @endif
                        </div>
                    </div>

                </div>


                <div class="h-[20px] md:h-[20px] lg:h-[20px]"></div>
            </div>
        </div>

        {{-- 右カラム：ログ（鑑賞記録）セクション --}}
        <div class="w-full lg:w-[55%] max-w-[650px] mt-12 lg:mt-0 space-y-16 pl-8 lg:pl-16 relative">

            {{-- 保存用のフォーム --}}
            <form action="{{ route('user.movie.update', $movie->tmdb_id) }}" method="POST">
                @csrf

                <div class="group relative">
                    <div class="flex items-center justify-between mb-3">

                        <div class="flex items-center gap-3">
                            <span class="text-[10px] text-white/40 uppercase tracking-widest">
                                Log Date:
                            </span>
                            <span class="text-sm text-orange-400 font-mono">
                                {{ $status->created_at ? $status->created_at->format('Y.m.d') : now()->format('Y.m.d') }}
                            </span>
                        </div>

                        <div class="flex text-orange-400 text-sm">
                            ★★★★★
                        </div>
                    </div>

                    <div class="h-[19px] md:h-[19px] lg:h-[19px]"></div>

                    <div class="relative">
                        <textarea
                            name="note"
                            class="log-content w-full bg-white/5 border border-white/10 rounded-lg p-4 text-sm text-gray-200 leading-relaxed focus:border-orange-500/50 focus:ring-0 transition-all resize-none overflow-hidden block"
                            rows="5"
                            oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
                            placeholder="この映画の感想や、自分なりの考察を記録しましょう..."
                        >{{ old('note', $status->note ?? '') }}</textarea>
                    </div>

                </div>

                {{-- 追加ボタン --}}
                <div class="flex justify-center pt-4">
                    <button class="px-6 py-2 border border-dashed border-white/20 rounded-full text-[10px] text-white/40 hover:border-orange-500 hover:text-orange-500 transition-all">
                        + ADD NEW LOG
                    </button>
                </div>

                {{-- 保存ボタン --}}
                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold rounded-full transition-all shadow-[0_0_15px_rgba(255,140,0,0.3)]">
                        SAVE THIS LOG
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- 高さ自動調整スクリプト --}}
<script>
    window.addEventListener('load', () => {
        document.querySelectorAll('textarea').forEach(el => {
            el.style.height = el.scrollHeight + 'px';
        });
    });
</script>
@endsection