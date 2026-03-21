<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // 本来はDBから取得しますが、まずはFigmaの内容を配列で作ります
        $categories = [
            [
                'id' => 1,
                'name_jp' => 'ハードSF',
                'name_en' => 'Hard Science Fiction',
                'description' => '科学的・技術的な正確さを追求するジャンル。',
                'movies' => ['2001年宇宙の旅', 'インターステラー', 'コンタクト'],
                'novels' => ['三体', '火星の人']
            ],
            [
                'id' => 2,
                'name_jp' => 'スペースオペラ',
                'name_en' => 'Space Opera',
                'description' => '宇宙を舞台にした壮大な冒険活劇。',
                'movies' => ['スター・ウォーズ', 'ガーディアンズ・オブ・ギャラクシー'],
                'novels' => ['銀河英雄伝説']
            ],
            [
                'id' => 3,
                'name_jp' => 'サイバーパンク',
                'name_en' => 'Cyberpunk',
                'description' => 'ハイテクとローライフが交錯する近未来。',
                'movies' => ['ブレードランナー', 'マトリックス'],
                'novels' => ['ニューロマンサー']
            ],
            // スチームパンク、ポスト・アポカリプスなども同様に追加
        ];

        return view('category.category-index', compact('categories'));
    }
}
