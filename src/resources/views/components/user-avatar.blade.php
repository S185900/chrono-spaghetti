{{-- components/user-avatar.blade.php --}}
@props(['count' => 0, 'link' => '/'])

<div {{ $attributes->merge(['class' => 'notification-wrapper relative']) }}>
    <a href="{{ $link }}" class="block w-full h-full">
        <div class="user-avatar w-full h-full rounded-full border-2 border-white/20 bg-gray-400 overflow-hidden">
            {{-- ここにユーザー画像を入れる場合は <img src="..."> --}}
        </div>
        
        {{-- countが0より大きい時だけバッジを表示 --}}
        <span id="nav-notification-badge" class="notification-badge absolute -top-1 -right-1 bg-red-600 text-white rounded-full flex items-center justify-center font-bold shadow-[0_0_8px_rgba(255,0,0,0.6)] text-[12px] w-5 h-5 z-20 {{ $count > 0 ? '' : 'hidden' }}">
            {{ $count }}
        </span>
    </a>
</div>

<style>
    /* 共通のスタイル */
    .notification-badge {
        /* サイズは親要素に合わせて可変にするため、呼び出し側のクラスで制御しやすくします */
        transition: all 0.3s ease;
    }
    .user-avatar {
        transition: border-color 0.3s ease;
    }
    .user-avatar:hover {
        border-color: rgba(255, 255, 255, 0.8);
    }
</style>