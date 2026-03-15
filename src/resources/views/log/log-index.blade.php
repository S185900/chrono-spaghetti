@extends('layouts.auth-header')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth-header.css')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

{{-- ログ一覧画面 --}}
@section('content')
{{-- ヘッダーの高さ分だけ空間を強制的に作る --}}
<div class="h-[50px] lg:h-[50px]"></div>

{{-- 1. コンテナ：header-containerと端を揃えるため px-10 (40px) を指定 --}}
<div class="log-index-wrapper w-full max-w-[1400px] mx-auto pb-8 px-4 lg:px-10">
    
    {{-- 2. 上部ナビ：スマホで中央寄せ、タブレット以上で左寄せ＆横並び --}}
    {{-- gap-10 を gap-14 に、mb-8 を mb-12 に広げてゆとりを持たせます --}}
    <div class="timeline-nav flex flex-col items-center md:flex-row md:items-end gap-6 md:gap-14 mb-12">
        
        {{-- text-3xl を text-4xl (または 5xl) にアップ --}}
        {{-- 大きくした分、浮き上がりを調整するために -translate-y の数値も微調整します --}}
        <h2 class="timeline-title text-4xl font-bold tracking-[0.2rem] text-white font-baloo -translate-y-[8px]">
            TIMELINE
        </h2>
        
        <div class="tab-group flex items-end">
            <x-nav-tab label="Cinema" :active="true" link="#" />
            {{-- 重なり幅（-ml-4）も、タブが大きくなるなら -ml-6 くらいに広げると比率が維持されます --}}
            <x-nav-tab label="Episodes" :active="false" link="#" class="-ml-6" />
        </div>
    </div>

    <div class="h-[50px] lg:h-[50px]"></div>

    {{-- 3. グリッドエリア：レスポンシブ列数指定 --}}
    <div class="log-grid grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 xl:gap-8">
        @for ($i = 0; $i < 12; $i++)
            {{-- カード本体：アスペクト比2:3を維持 --}}
            <div class="log-card relative aspect-[2/3] bg-white/10 rounded-[15px] border border-white/10 overflow-hidden cursor-pointer transition-all duration-300 hover:border-orange-500 hover:shadow-[0_0_20px_rgba(255,140,0,0.4)] hover:-translate-y-2 group">
                
                {{-- ポスター風背景 --}}
                <div class="poster-placeholder w-full h-full flex items-center justify-center bg-gradient-to-br from-white/5 to-black/30">
                    {{-- SF演出用の走査線（hover時に少し光る演出を追加） --}}
                    <span class="scan-line absolute inset-0 bg-[linear-gradient(to_bottom,transparent_50%,rgba(255,140,0,0.05)_50%)] bg-[length:100%_4px] group-hover:bg-[length:100%_2px] transition-all"></span>
                    
                    {{-- ここに将来ポスター画像が入る --}}
                    <div class="text-white/20 text-xs tracking-tighter uppercase">No Image</div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection