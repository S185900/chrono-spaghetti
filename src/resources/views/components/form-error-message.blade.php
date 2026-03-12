@props(['message'])

@if($message)
    <span {{ $attributes->merge(['class' => 'chrono-error-message']) }}>
        {{ $message }}
    </span>
@endif

<style>
    .chrono-error-message {
        color: #ff8c00;
        /* font-size は inherit にして Blade 側の Tailwind クラスを優先 */
        font-size: inherit;
        font-weight: 700;
        display: block;
        text-align: left;
        padding-top: 8px;
        line-height: 1.4;
        width: 100%;
        text-shadow:
            0 0 5px rgba(255, 140, 0, 0.9),
            0 0 12px rgba(255, 140, 0, 0.6),
            0 0 25px rgba(255, 80, 0, 0.3);
        filter: brightness(1.2);
        animation: neon-pulse 2.5s infinite ease-in-out;
    }

    @keyframes neon-pulse {
        0%, 100% {
            opacity: 1;
            filter: brightness(1.2);
            text-shadow: 0 0 5px rgba(255, 140, 0, 0.9), 0 0 12px rgba(255, 140, 0, 0.6);
        }
        50% {
            opacity: 0.85;
            filter: brightness(1.6);
            text-shadow: 0 0 10px rgba(255, 140, 0, 1), 0 0 20px rgba(255, 140, 0, 0.8);
        }
    }
</style>