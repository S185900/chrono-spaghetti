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
</div>