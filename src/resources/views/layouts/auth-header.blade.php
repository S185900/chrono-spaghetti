<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CHRONO SPAGHETTI</title>

        <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&family=Baloo+Chettan+2:wght@400..800&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/first-header.css')}}">

        @yield('css')
    </head>

    {{-- ログイン前共通ヘッダー --}}
    <body>
        <header class="header">
            <div class="header-container">

            <div class="main-logo-visual">
                <img class="main-logo" src="{{ asset('images/CHRONO_SPAGHETTI-logo.png') }}" alt="CHRONO SPAGHETTI">
            </div>

            {{-- 中：観測コンソール（検索・通知・フィルタ） --}}
            <div class="header-nav-center">
                {{-- 通知・マイページアイコン --}}
                <a href="/" class="notification-wrapper">
                    <div class="user-avatar">
                        {{-- 本来はここに $user->image_url などが入る想定 --}}
                        {{-- <img src="/" alt="マイページ"> --}}
                    </div>
                    <span class="notification-badge">2</span>
                </a>

                {{-- 検索ボックス --}}
                <div class="search-console-wrapper">
                    <form action="#" method="GET" class="search-form">
                        {{-- 検索アイコン（虫眼鏡） --}}
                        <label for="search-input" class="search-icon-label">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="search-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </label>

                        {{-- 入力フィールド --}}
                        <input type="text" id="search-input" name="query" class="search-input" placeholder="検索" autocomplete="off">

                        {{-- デザイン用の下線 --}}
                        <div class="search-underline"></div>
                    </form>
                </div>

                {{-- ボタン類 --}}
                <div class="flex gap-4">
                    <x-submit-button class="!w-44 !h-[60px] !flex !items-center !justify-center !text-xl !p-0 !mt-[-25px] !rounded-full !tracking-[0.5rem]" onclick="location.href='#'">
                        新着
                    </x-submit-button>

                    <x-submit-button class="!w-44 !h-[60px] !flex !items-center !justify-center !text-xl !p-0 !mt-[-25px] !rounded-full" onclick="location.href='#'">
                        カテゴリー
                    </x-submit-button>
                </div>
            </div>

            {{-- ログアウトボタンの追加 --}}
            <div class="header-actions">
                <form method="POST" action="{{ route('logout') }}" class="flex items-center m-0">
                    @csrf
                    <x-submit-button class="!w-44 !h-[60px] !flex !items-center !justify-center !text-2xl !p-0 !mt-[-25px] !leading-none uppercase !rounded-full">
                        logout
                    </x-submit-button>
                </form>
            </div>

        </div>

        </header>
        <main class="main-content">
            @yield('content')
        </main>
    </body>
    <footer class="footer">
        <p class="footer-text">© 2026 CHRONO SPAGHETTI. All rights reserved.</p>
    </footer>
</html>