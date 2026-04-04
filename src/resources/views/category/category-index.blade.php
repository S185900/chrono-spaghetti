@extends('layouts.auth-header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth-header.css')}}" />
<link rel="stylesheet" href="{{ asset('css/components.css') }}">
<link rel="stylesheet" href="{{ asset('css/category-index.css') }}">
<link rel="stylesheet" href="{{ mix('css/app.css') }}" />
@endsection

@section('content')
<div class="w-full px-4 py-12 lg:px-10">

    {{-- カテゴリー同士の間隔を space-y-12 〜 16 で広げる --}}
    <div class="max-w-[1400px] mx-auto flex flex-col items-center">
        @foreach($categories as $category)
        {{-- 1. x-data を削除し、JSから見つけるための class="category-item-wrapper" を維持 --}}
        <div class="category-item-wrapper border-b border-white/10 transition-all duration-300">

            {{-- 2. @click を削除し、class="category-header" を追加 --}}
            <div class="category-header flex items-start gap-4 w-full text-left py-6 cursor-pointer group">
                
                {{-- 3. x-text を削除し、class="category-toggle-icon" を追加。初期状態は ▶︎ --}}
                <span class="category-toggle-icon text-brand-primary text-2xl md:text-4xl transform translate-y-1 md:translate-y-2">
                    ▶︎
                </span>

                <h2 class="text-2xl md:text-4xl font-black tracking-[0.2em] text-brand-primary uppercase group-hover:brightness-125 leading-tight">
                    {{ $category->name }} 
                    <span class="block mt-1 text-xs md:text-sm font-medium tracking-normal text-brand-primary/60 italic lowercase md:inline md:ml-4">
                        ({{ $category->english_name }})
                    </span>
                </h2>
            </div>

            {{-- 2. コンテンツエリア --}}
            <div class="category-content ml-6 md:ml-12 space-y-12 mt-6 mb-10" style="display: none;">
                
                <div class="sf-description-wrap">
                    <p class="sf-description-text text-sm md:text-base">
                        {{ $category->description }}
                    </p>
                </div>

                {{-- 作品データ表示エリア --}}
                <div class="flex flex-col md:flex-row gap-8 text-[12px] tracking-[0.1em] mt-0">

                    {{-- CSSクラス：archive-samples-box を適用 --}}
                    <div class="archive-samples-box">

                        {{-- CSSクラス：archive-samples-label --}}
                        <span class="archive-samples-label">■ ARCHIVE SAMPLES (代表作)</span>

                        {{-- CSSクラス：archive-samples-list --}}
                        <div class="archive-samples-list">
                            @foreach(explode('、', $category->examples) as $sample)
                                {{-- クラスを sf-badge に差し替え --}}
                                <span class="sf-badge">
                                    {{ trim($sample) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ボタン --}}
                <div class="flex justify-end pt-4">
                    <a href="{{ route('category.show', ['slug' => $category->slug]) }}" class="text-[10px] text-brand-primary/50 hover:text-brand-primary tracking-[0.3em] transition-colors border-b border-brand-primary/20 pb-1">
                        GO TO ARCHIVE [ {{ $category->slug }} ] →
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
    {{-- パスを通す --}}
    <script src="{{ asset('js/category-toggle.js') }}"></script>
@endsection
