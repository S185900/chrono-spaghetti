<button {{ $attributes->merge(['type' => 'button', 'class' => 'chrono-social-btn']) }}>
    <span class="btn-content" style="font-size: inherit;">
        {{ $slot }}
    </span>
    <div class="shimmer"></div>
</button>