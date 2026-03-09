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
            <div class="auth-page-wrapper">

            <div class="main-logo-visual">
                <img class="main-logo" src="{{ asset('images/CHRONO_SPAGHETTI-logo.png') }}" alt="CHRONO SPAGHETTI">
                <p class="tagline">Logging every vision from the Event Horizon.</p>
            </div>

            {{-- ログアウトボタンの追加 --}}
            <div class="header-actions">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">LOGOUT</button>
                </form>
            </div>

            <div class="auth-form-wrapper">
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