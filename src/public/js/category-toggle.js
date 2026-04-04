// public/js/category-toggle.js

document.addEventListener('DOMContentLoaded', function() {
    // 1. 全てのカテゴリーの親要素を取得（DOM操作: querySelectorAll）
    const categoryItems = document.querySelectorAll('.category-item-wrapper');

    categoryItems.forEach(function(item) {
        // 各アイテム内の要素を取得
        const header = item.querySelector('.category-header');
        const content = item.querySelector('.category-content');
        const icon = item.querySelector('.category-toggle-icon');

        // 2. クリックイベントを登録（DOM操作: addEventListener）
        header.addEventListener('click', function() {

            // 3. 表示・非表示の切り替え（DOM操作: style.display の変更）
            const isHidden = content.style.display === 'none';

            if (isHidden) {
                content.style.display = 'block'; // 表示する
                icon.textContent = '▼';          // テキストを書き換える
            } else {
                content.style.display = 'none';  // 隠す
                icon.textContent = '▶︎';          // テキストを書き換える
            }
        });
    });
});