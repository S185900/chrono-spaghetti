<div class="chrono-btn-container">
    <button type="submit" {{ $attributes->merge(['class' => 'chrono-submit-btn']) }}>
        <span class="btn-text" style="font-size: inherit;">{{ $slot }}</span>
        <div class="shimmer"></div>
    </button>
</div>