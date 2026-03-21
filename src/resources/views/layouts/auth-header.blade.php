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

        <link rel="stylesheet" href="{{ asset('css/auth-header.css')}}">

        @yield('css')
    </head>

    {{-- ログイン後の共通ヘッダー --}}
    <body class="flex flex-col min-h-screen text-white">

        {{-- メモ：将来的にslotでボタンの内容を一部切り替え --}}


        <header class="header">
            <div class="header-container flex flex-col lg:flex-row lg:justify-between lg:items-center px-4 lg:px-10">

                {{-- 【スマホ・PC共通の上段】 --}}
                <div class="flex justify-between items-center w-full lg:w-auto">

                    {{-- ロゴ --}}
                    <div class="main-logo-visual">
                        <a href="/log/index">
                            <img class="main-logo w-[140px] sm:w-[200px] md:w-[250px] transition-all" src="{{ asset('images/CHRONO_SPAGHETTI-logo.png') }}" alt="CHRONO SPAGHETTI">
                        </a>
                    </div>

                    {{-- スマホ時のみ表示（通知・ハンバーガー） --}}
                    <div class="flex items-center gap-3 lg:hidden">

                        <a href="/" class="relative">
                            <x-user-avatar :count="2" class="w-8 h-8 sm:w-10 sm:h-10" />
                        </a>

                        <button id="menu-btn" class="relative z-50 focus:outline-none">
                            <svg id="menu-icon" class="w-10 h-10 sm:w-12 sm:h-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path id="line1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 6h18" class="transition-all duration-300 origin-center"></path>
                                <path id="line2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12h18" class="transition-all duration-300"></path>
                                <path id="line3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 18h18" class="transition-all duration-300 origin-center"></path>
                            </svg>
                        </button>

                    </div>

                </div>

                {{-- 【スマホでは下段 / PCでは右側】検索とナビ --}}
                <div class="flex flex-col lg:flex-row items-center w-full lg:w-auto mt-4 lg:mt-0 gap-6 lg:gap-8 lg:ml-auto">

                    {{-- スマホ・タブレット用：右寄せ＆左に伸びる検索バー --}}
                    <div class="lg:hidden mt-2 w-full flex justify-end">
                        <div class="flex justify-end pr-[22px] sm:pr-[42px] w-auto self-end md:-translate-y-[25px]">
                            <x-search-bar class="ml-auto transition-all duration-300 ease-in-out w-[160px] focus-within:w-[280px] sm:focus-within:w-[350px]" />
                        </div>
                    </div>

                    {{-- PC専用ナビゲーション --}}
                    <div class="hidden lg:flex items-center gap-6">

                        {{-- PC版でも検索バーを表示 --}}
                        <div class="flex items-center lg:translate-y-[18px]">
                            <x-search-bar class="transition-all duration-300 ease-in-out w-[160px] focus-within:w-[270px]" />
                        </div>

                        <div class="inline-block transform lg:translate-y-[10px]">
                            <x-user-avatar :count="2" class="w-[50px] h-[50px]" />
                        </div>

                        {{-- ナビのボタン類 --}}
                        <div class="flex items-center gap-4">

                            <x-submit-button class="!w-52 !h-[55px] !text-lg !rounded-full !tracking-tighter" onclick="location.href='{{ route('comingsoon.index') }}'">
                                もうすぐ公開
                            </x-submit-button>

                            <x-submit-button class="!w-40 !h-[55px] !text-lg !rounded-full" onclick="location.href='{{ route('categories.index') }}'">
                                カテゴリー
                            </x-submit-button>

                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <x-submit-button class="!w-40 !h-[55px] !text-xl uppercase !rounded-full">
                                    logout
                                </x-submit-button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            {{-- スマホ用オーバーレイメニュー（ハンバーガーメニューを開いたとき表示される） --}}
            <div id="mobile-menu" class="fixed inset-0 bg-black/95 backdrop-blur-lg z-40 flex flex-col items-center justify-center gap-8 translate-x-full transition-transform duration-500 lg:hidden">

                <x-submit-button class="!w-64 !h-[70px] !text-2xl !rounded-full" onclick="location.href='{{ route('comingsoon.index') }}'">
                    もうすぐ公開
                </x-submit-button>

                <x-submit-button class="!w-64 !h-[70px] !text-2xl !rounded-full" onclick="location.href='{{ route('categories.index') }}'">
                    カテゴリー
                </x-submit-button>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <x-submit-button class="!w-64 !h-[70px] !text-2xl uppercase !rounded-full">
                        logout
                    </x-submit-button>
                </form>

            </div>
        </header>

        <main class="main-content flex-grow">
            @yield('content')
        </main>

        <footer class="footer w-full bg-black/60 text-center text-white/90 px-4 py-6">
            {{-- 1. コピーライト（既存のものを少し調整） --}}
            <p class="font-['Baloo_Chettan_2'] text-[13px] font-normal tracking-[0.3rem]">
                © 2026 CHRONO SPAGHETTI. All rights reserved.
            </p>

            <div class="h-5"></div>

            {{-- 2. TMDB帰属エリア（ここを追加） --}}
            <div class="tmdb-attribution flex flex-col items-center gap-3">

                {{-- TMDBロゴ：高さを指定して小さく表示し、白黒（invert）にして馴染ませる --}}
                <img src="{{ asset('images/blue_long_tmdb-logo.svg') }}" alt="The Movie Database"
                    class="h-4 w-auto opacity-50 transition-opacity hover:opacity-100">

                {{-- 免責事項：文字を小さく、薄くして目立たせない --}}
                <p class="text-[10px] text-white/50 max-w-[400px] leading-relaxed antialiased">
                    This website uses TMDB and the TMDB APIs but is not endorsed, certified, or otherwise approved by TMDB.
                </p>
            </div>
        </footer>

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
                    mobileMenu.classList.remove('translate-x-full');
                    line1.setAttribute('d', 'M3 3L21 21');
                    line2.style.opacity = '0';
                    line3.setAttribute('d', 'M3 21L21 3');
                } else {
                    mobileMenu.classList.add('translate-x-full');
                    line1.setAttribute('d', 'M3 6h18');
                    line2.style.opacity = '1';
                    line3.setAttribute('d', 'M3 18h18');
                }
            });
        </script>

    </body>
</html>