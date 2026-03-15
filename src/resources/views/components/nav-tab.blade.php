@props(['active' => false, 'label' => '', 'link' => '#'])

<a href="{{ $link }}" {{ $attributes->merge(['class' => 'tab-custom-btn' . ($active ? ' active' : '')]) }}>
    <span>{{ $label }}</span>
</a>

<style>
    .tab-custom-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        
        /* --- スマホ向け（デフォルト） --- */
        padding: 8px 30px;    /* 横幅を抑える */
        font-size: 0.9rem;    /* 文字を少し小さく */
        margin-right: 8px;    /* タブ同士の間隔を詰める */
        
        color: #9ca3af;
        font-family: 'Baloo Chettan 2', cursive;
        font-weight: 700;
        letter-spacing: 0.15em;
        transition: all 0.3s ease;
        text-decoration: none;
        transform: skewX(-30deg); 
    }

    /* --- PC向け (768px以上) --- */
    @media (min-width: 768px) {
        .tab-custom-btn {
            padding: 12px 65px; /* 元のゆったりサイズ */
            font-size: 1.25rem;  /* 大きめのフォント */
            margin-right: 15px;
            letter-spacing: 0.2em;
        }
    }

    /* 背景面 (共通) */
    .tab-custom-btn::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.05);
        z-index: 1;
        transition: all 0.3s ease;
    }

    /* ライン (共通) */
    .tab-custom-btn::after {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 2;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        border-left: 1.5px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }

    /* Active状態の設定は省略せずそのまま残してください */
    .tab-custom-btn.active::after {
        border-top: 2px solid #f97316;
        border-left: 2px solid #f97316;
        filter: drop-shadow(0 0 10px rgba(249, 115, 22, 0.6));
    }

    /* 文字の補正 */
    .tab-custom-btn span {
        position: relative;
        z-index: 3;
        transform: skewX(30deg); 
        display: inline-block;
        margin-left: 4px; /* スマホ用 */
    }

    @media (min-width: 768px) {
        .tab-custom-btn span {
            margin-left: 8px; /* PC用 */
        }
    }
</style>