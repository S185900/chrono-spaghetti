<button {{ $attributes->merge(['type' => 'button', 'class' => 'chrono-social-btn']) }}>
    <span class="btn-content" style="font-size: inherit;">
        {{ $slot }}
    </span>
    <div class="shimmer"></div>
</button>

<style>
    .chrono-social-btn {
        color: #ffffff;
        background-color: #150029; /* 深い紫 */
        width: 300px;
        padding: 15px;
        margin-top: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
        outline: none;
        font-family: 'Baloo Chettan 2', cursive;
    }

    /* ホバー時の紫色の発光エフェクト */
    .chrono-social-btn:hover {
        background-color: #2a0052;
        border: 1px solid rgba(180, 100, 255, 0.5);
        box-shadow: 0 0 15px rgba(138, 43, 226, 0.4),
                    0 0 30px rgba(138, 43, 226, 0.2);
        text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
    }

    /* シマーエフェクト（キラリと光る） */
    .chrono-social-btn .shimmer {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            120deg,
            transparent,
            rgba(255, 255, 255, 0.1),
            transparent
        );
        transition: none;
    }

    .chrono-social-btn:hover .shimmer {
        animation: social-shimmer 0.8s forwards;
    }

    @keyframes social-shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .btn-content {
        position: relative;
        z-index: 1;
    }
</style>