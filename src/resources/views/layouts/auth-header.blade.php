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
            {{-- flex-col: スマホでは縦並び / md:flex-row: PCでは横並び --}}
            <div class="header-container flex flex-col lg:flex-row lg:justify-between lg:items-center px-4 lg:px-10">

                {{-- 【スマホでの上段 / PCでの左側】ロゴ + アイコン類 --}}
                <div class="flex justify-between items-center w-full md:w-auto min-w-0">
                    {{-- ロゴ：最小サイズ(390px以下)での幅を少し小さく(w-[140px])設定 --}}
                    <div class="main-logo-visual min-w-0 flex-1">
                        <img class="main-logo w-[140px] sm:w-[200px] md:w-[250px] transition-all" src="{{ asset('images/CHRONO_SPAGHETTI-logo.png') }}" alt="CHRONO SPAGHETTI">
                    </div>

                    {{-- lg:hidden（1024px未満まで表示） --}}
                    <div class="flex items-center gap-2 sm:gap-4 lg:hidden !-mt-[10px]">

                        {{-- 通知アイコン：スマホでは少しコンパクト(w-8 h-8)に --}}
                        <a href="/" class="notification-wrapper relative w-8 h-8 sm:w-10 sm:h-10">
                            <div class="user-avatar w-full h-full rounded-full border-2 border-white/20 bg-gray-400"></div>
                            <span class="notification-badge absolute -top-1 -right-1 bg-red-600 text-white text-[9px] w-4 h-4 sm:w-5 sm:h-5 rounded-full flex items-center justify-center">2</span>
                        </a>

                        {{-- ハンバーガーメニューボタンに id="menu-btn" を追加 --}}
                        {{-- ハンバーガー：svgのサイズを少し調整(w-10 h-10) --}}
                        <button id="menu-btn" class="text-white focus:outline-none ml-1 relative z-50">
                            <svg id="menu-icon" class="w-10 h-10 sm:w-13 sm:h-14 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path id="line1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 6h18" class="transition-all duration-300 origin-center"></path>
                                <path id="line2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12h18" class="transition-all duration-300"></path>
                                <path id="line3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 18h18" class="transition-all duration-300 origin-center"></path>
                            </svg>
                        </button>

                        {{-- スマホ用オーバーレイメニュー（初期状態は隠す） --}}
                        <div id="mobile-menu" class="fixed inset-0 bg-black/90 backdrop-blur-md z-40 flex flex-col items-center justify-center gap-8 translate-x-full transition-transform duration-500 lg:hidden">
                            {{-- ボタン類を縦並びに配置 --}}
                            <x-submit-button class="!w-64 !h-[70px] !text-2xl" onclick="location.href='#'">
                                もうすぐ公開
                            </x-submit-button>

                            <x-submit-button class="!w-64 !h-[70px] !text-2xl" onclick="location.href='#'">
                                カテゴリー
                            </x-submit-button>

                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <x-submit-button class="!w-64 !h-[70px] !text-2xl uppercase">
                                    logout
                                </x-submit-button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- 【下段（スマホ・タブレット） / 右側（PC）】 --}}
                {{-- lg:mt-0（1024px以上で隙間を消す） --}}
                <div class="header-nav-center flex flex-col lg:flex-row items-center gap-4 lg:gap-8 w-full lg:w-auto mt-1 lg:mt-0">
                    {{-- 検索ボックス：スマホでの右マイナスマージンを!-mr-[20px]程度に抑えるとはみ出しにくいです --}}
                    <div class="search-console-wrapper !w-full lg:!w-auto ml-auto lg:ml-0 flex justify-end !-mr-[20px] sm:!-mr-[40px] lg:!mr-0 !-mt-[25px] lg:!mt-0">

                        <form action="#" method="GET" class="search-form flex items-center relative pb-1 lg:pb-2 w-fit">
                            <label for="search-input" class="search-icon-label">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="search-icon w-5 h-5 text-white mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </label>

                            <input type="text" id="search-input" name="query" 
                                class="search-input bg-transparent text-white outline-none w-[180px] lg:w-[140px] lg:focus:w-[300px] transition-all" 
                                placeholder="検索" autocomplete="off">

                            <div class="search-underline"></div>
                        </form>
                    </div>

                    {{-- PC専用：マイページアイコン（ボタン類と同じ高さに合わせるため !-mt を適用） --}}
                    <div class="hidden lg:block !-mt-[15px]">
                        <a href="/" class="notification-wrapper relative block w-[50px] h-[50px]">
                            <div class="user-avatar w-full h-full rounded-full border-2 border-white/20 bg-gray-400"></div>
                            <span class="notification-badge absolute -top-1 -right-1 bg-red-600 text-white text-sm font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-[0_0_8px_rgba(255,0,0,0.6)]">
                                2
                            </span>
                        </a>
                    </div>

                    {{-- PC専用ボタン類：!-mt-[20px] で一括持ち上げ --}}
                    <div class="hidden lg:flex items-center gap-4 !-mt-[40px]">
                        {{-- もうすぐ公開：最大幅 --}}
                        <x-submit-button class="!w-56 !h-[60px] !flex !items-center !justify-center !text-xl !p-0 !rounded-full !tracking-tighter" onclick="location.href='#'">
                            もうすぐ公開
                        </x-submit-button>

                        {{-- カテゴリー：ここを logout と同じ幅に固定 --}}
                        <x-submit-button class="!w-44 !h-[60px] !flex !items-center !justify-center !text-xl !p-0 !rounded-full" onclick="location.href='#'">
                            カテゴリー
                        </x-submit-button>

                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            {{-- logout：カテゴリーと同じ幅に固定 --}}
                            <x-submit-button class="!w-44 !h-[60px] !flex !items-center !justify-center !text-2xl !p-0 !leading-none uppercase !rounded-full">
                                logout
                            </x-submit-button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <main class="main-content">
            @yield('content')
        </main>
        <script>
            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const line1 = document.getElementById('line1');
            const line2 = document.getElementById('line2');
            const line3 = document.getElementById('line3');

            let isOpen = false;

            menuBtn.addEventListener('click', () => {
                isOpen = !isOpen;

                if (isOpen) {
                    // メニューを表示
                    mobileMenu.classList.remove('translate-x-full');
                    // アイコンを×に変形（CSS transitionと組み合わせて動かします）
                    line1.setAttribute('d', 'M3 3L21 21');
                    line2.style.opacity = '0';
                    line3.setAttribute('d', 'M3 21L21 3');
                } else {
                    // メニューを隠す
                    mobileMenu.classList.add('translate-x-full');
                    // アイコンを三本線に戻す
                    line1.setAttribute('d', 'M3 6h18');
                    line2.style.opacity = '1';
                    line3.setAttribute('d', 'M3 18h18');
                }
            });
        </script>
    </body>
    <footer class="footer">
        <p class="footer-text">© 2026 CHRONO SPAGHETTI. All rights reserved.</p>
    </footer>
</html>