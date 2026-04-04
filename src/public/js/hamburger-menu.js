// public/js/hamburger-menu.js

document.addEventListener('DOMContentLoaded', function() {
    // 1. DOM要素の取得
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const line1 = document.getElementById('line1');
    const line2 = document.getElementById('line2');
    const line3 = document.getElementById('line3');
    
    // 状態を管理する変数（開いているかどうか）
    let isOpen = false;

    // ボタンが存在する場合のみ処理を実行（エラー防止）
    if (menuBtn) {
        // 2. イベントリスナーの登録
        menuBtn.addEventListener('click', function() {
            isOpen = !isOpen;

            if (isOpen) {
                // 3. DOM操作：メニューを表示し、アイコンを「×」に変形
                mobileMenu.classList.remove('translate-x-full');
                line1.setAttribute('d', 'M3 3L21 21');
                line2.style.opacity = '0';
                line3.setAttribute('d', 'M3 21L21 3');
            } else {
                // 3. DOM操作：メニューを隠し、アイコンを「三本線」に戻す
                mobileMenu.classList.add('translate-x-full');
                line1.setAttribute('d', 'M3 6h18');
                line2.style.opacity = '1';
                line3.setAttribute('d', 'M3 18h18');
            }
        });
    }
});