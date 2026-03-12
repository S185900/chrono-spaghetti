<a {{ $attributes->merge(['class' => 'chrono-orange-link']) }}>
    {{ $slot }}
</a>

<style>
    .chrono-orange-link {
        color: #ff8c00;
        text-decoration: none;
        /* font-size は Blade側から受け取るため、ここでは inherit に設定 */
        font-size: inherit;
        transition: all 0.4s ease;
        cursor: pointer;
        position: relative;
        text-shadow: 0 0 5px rgba(255, 140, 0, 0.3);
        display: inline-block; /* border-bottom の位置を安定させるため */
    }

    .chrono-orange-link:hover {
        color: #ffffff;
        text-shadow: 0 0 8px rgba(255, 255, 255, 0.8),
                    0 0 15px rgba(255, 255, 255, 0.4);
        border-bottom: 1px solid rgba(255, 255, 255, 0.8);
        padding-bottom: 2px;
    }
</style>