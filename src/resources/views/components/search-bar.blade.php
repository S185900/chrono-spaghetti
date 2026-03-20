<div {{ $attributes->merge(['class' => 'search-console-wrapper flex justify-end']) }}>
    {{-- justify-end と ml-auto でこの塊を右端に固定します --}}
    <form action="#" method="GET" class="search-form flex items-center relative pb-1 lg:pb-2 ml-auto">
        <label for="search-input" class="search-icon-label cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="search-icon w-5 h-5 text-white mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </label>

        <input type="text" id="search-input" name="query" 
            class="search-input bg-transparent text-white outline-none text-left" 
            placeholder="検索" autocomplete="off">

        <div class="search-underline"></div>
    </form>

    <style>
        .search-form {
            display: inline-flex;
            align-items: center;
            position: relative;
            /* width: auto のまま、inputの幅に追従させます */
            padding-bottom: 5px;
        }

        .search-icon {
            width: 20px;
            height: 20px;
            color: #ffffff;
            margin-right: 8px;
            flex-shrink: 0;
        }

        .search-input {
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 18px;
            outline: none;
            /* ★初期の幅をここで指定（160px） */
            width: 160px;
            max-width: calc(100vw - 80px);
            transition: width 0.5s cubic-bezier(0.25, 1, 0.5, 1);
        }

        /* ★クリック（フォーカス）した時に幅を広げる */
        .search-input:focus {
            width: 280px;
            max-width: calc(100vw - 80px);
        }

        .search-underline {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: #ffffff;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .search-input:focus~.search-underline {
            background: #ff8c00;
            box-shadow: 0 0 12px rgba(255, 140, 0, 0.8);
            height: 2px;
        }
    </style>
</div>