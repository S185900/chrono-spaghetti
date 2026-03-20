@extends('layouts.auth-header') @section('css')
<link rel="stylesheet" href="{{ asset('css/auth-header.css')}}" />
<link rel="stylesheet" href="{{ mix('css/app.css') }}" />
@endsection

{{-- ログ一覧画面 --}}
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
            <x-nav-tab label="Cinema" :active="true" link="#" />
            {{-- 重なり幅（-ml-4）も、タブが大きくなるなら -ml-6
            くらいに広げると比率が維持されます --}}
            <x-nav-tab
                label="Episodes"
                :active="false"
                link="#"
                class="-ml-6"
            />
        </div>
    </div>

    <div class="h-[50px] lg:h-[50px]"></div>

    {{-- 3. グリッドエリア：レスポンシブ列数指定 --}}
    <div
        class="log-grid grid grid-cols-2 gap-4 md:grid-cols-3 md:gap-6 xl:grid-cols-4 xl:gap-8"
    >
        @for ($i = 0; $i < 12; $i++) {{-- カード本体：アスペクト比2:3を維持 --}}
        <div
            class="log-card group relative aspect-[2/3] cursor-pointer overflow-hidden rounded-[15px] border border-white/10 bg-white/10 transition-all duration-300 hover:-translate-y-2 hover:border-orange-500 hover:shadow-[0_0_20px_rgba(255,140,0,0.4)]"
        >
            {{-- ポスター風背景 --}}
            <div
                class="poster-placeholder flex h-full w-full items-center justify-center bg-gradient-to-br from-white/5 to-black/30"
            >
                {{-- SF演出用の走査線（hover時に少し光る演出を追加） --}}
                <span
                    class="scan-line absolute inset-0 bg-[linear-gradient(to_bottom,transparent_50%,rgba(255,140,0,0.05)_50%)] bg-[length:100%_4px] transition-all group-hover:bg-[length:100%_2px]"
                ></span>

                {{-- ここに将来ポスター画像が入る --}}
                <div class="text-xs uppercase tracking-tighter text-white/20">
                    No Image
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection
