@extends('layouts.auth-header') @section('css')
<link rel="stylesheet" href="{{ mix('css/app.css') }}" />
<link rel="stylesheet" href="{{ asset('css/auth-header.css')}}" />
<link rel="stylesheet" href="{{ asset('css/components.css') }}">
<link rel="stylesheet" href="{{ asset('css/coming-index.css') }}">
@endsection

{{-- カミングスーン一覧画面 --}}
@section('content')
<div class="h-[50px] lg:h-[50px]"></div>

{{-- 1. コンテナ：header-containerと端を揃えるため px-10 (40px) を指定 --}}
<div class="log-index-wrapper mx-auto w-full max-w-[1400px] px-4 pb-8 lg:px-10">
    {{-- 2. 上部ナビ：スマホで中央寄せ、タブレット以上で左寄せ＆横並び --}}
    <div class="timeline-nav mb-12 flex flex-col items-center gap-6 md:flex-row md:items-end md:gap-14 lg:pl-10">
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
                <div class="poster-placeholder flex h-full w-full items-center justify-center bg-gradient-to-br from-white/5 to-black/30" onclick="openModal({{ $movie->tmdb_id }})">

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
                    <div class="log-card-info-coming">
                        <p class="coming-card-label">SF MOVIE</p>

                        <h3 class="coming-card-title">{{ $movie->title }}</h3>

                        <div class="coming-info-details">
                            <p><span>Dir:</span> {{ $movie->director }}</p>
                            <p>
                                <span>Cast:</span> 
                                {{ is_array($movie->cast) ? implode(', ', array_slice($movie->cast, 0, 3)) : '---' }}
                            </p>
                        </div>

                        <p class="coming-release-date">
                            {{ $movie->release_date ? $movie->release_date->format('Y.m.d') : 'Release Date TBD' }}
                        </p>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- アクション選択モーダル --}}
<div id="action-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black/80 backdrop-blur-sm px-6">
    {{-- モーダルの外側をクリックしたら閉じるための透明なレイヤー（必要なら） --}}
    <div class="absolute inset-0" onclick="closeModal()"></div>

    {{-- 【ここを修正】スマホでは大きく表示し、指定カラーで塗りつぶし、余白（px-10, py-12）を広く --}}
    <div class="relative bg-[var(--color-brand-secondary)] p-12 rounded-none border border-orange-500/50 flex flex-col gap-8 shadow-[0_0_60px_rgba(255,140,0,0.3)] w-full max-w-[400px]">

        <div class="h-[20px] md:h-[20px] lg:h-[20px]"></div>

        <h3 id="modal-title" class="text-center text-white font-baloo text-xl tracking-widest mb-2">選択してください</h3>

        <form id="bookmark-form" action="{{ route('user.movie.bookmark') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="tmdb_content_id" id="modal-movie-id">
        </form>

        {{-- ブックマークボタン --}}
        <x-submit-button class="!w-64 !h-[60px] !text-xl" onclick="submitBookmark()">
            BOOKMARK
        </x-submit-button>

        {{-- 編集して保存ボタン --}}
        <x-submit-button class="!w-64 !h-[60px] !text-xl !bg-gradient-to-r !from-orange-600 !to-red-600" onclick="showEditForm()">
            WATCHED
        </x-submit-button>
        
        {{-- キャンセルボタン（任意） --}}
        <button onclick="closeModal()" class="text-white/40 hover:text-white text-sm mt-2 transition-colors">閉じる</button>

        <div class="h-[20px] md:h-[20px] lg:h-[20px]"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let selectedMovieId = null;

    function openModal(id) {
        selectedMovieId = id; // クリックされた映画のIDを保持
        document.getElementById('modal-movie-id').value = id; // フォームにセット
        document.getElementById('action-modal').classList.remove('hidden');
    }

    function submitBookmark() {
        if (!selectedMovieId) return;
        document.getElementById('bookmark-form').submit();
    }

    function closeModal() {
        document.getElementById('action-modal').classList.add('hidden');
    }
</script>
@endsection
