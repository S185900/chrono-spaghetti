<div class="chrono-btn-container">
    <button type="submit" {{ $attributes->merge(['class' => 'chrono-submit-btn']) }}>
        <span class="btn-text" style="font-size: inherit;">{{ $slot }}</span>
        <div class="shimmer"></div>
    </button>
</div>

<style>
    .chrono-btn-container {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: 20px;
    }

    .chrono-submit-btn {
        width: 80%;
        padding: 10px 0;
        background-color: transparent;
        border: 2px solid #ff8c00;
        border-radius: 30px;
        color: #ff8c00;
        font-family: 'Baloo Chettan 2', cursive;
        /* font-size はここでは指定せず、外から受け取れるようにします */
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 0 10px rgba(255, 140, 0, 0.5), 0 0 20px rgba(255, 140, 0, 0.2);
        text-shadow: 0 0 8px rgba(255, 140, 0, 0.6);
        outline: none;
    }

    .chrono-submit-btn:hover {
        background-color: rgba(255, 140, 0, 0.2);
        color: #fff;
        box-shadow: 0 0 20px rgba(255, 140, 0, 0.7), 0 0 40px rgba(255, 140, 0, 0.4);
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        transform: translateY(-2px);
    }

    /* 1. 光の筋の土台 */
    .shimmer {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            120deg,
            transparent,
            rgba(255, 255, 255, 0.3),
            transparent
        );
        transition: none; /* ホバーしてない時は動かさない */
    }

    /* 2. ホバーした瞬間に光を走らせる */
    .chrono-submit-btn:hover .shimmer {
        animation: shimmer-run 0.7s forwards;
    }

    /* 3. アニメーションの動き（左から右へ） */
    @keyframes shimmer-run {
        0% {
            left: -100%;
        }
        100% {
            left: 100%;
        }
    }

    /* テキストが光に埋もれないように最前面へ */
    .btn-text {
        position: relative;
        z-index: 1;
    }
</style>