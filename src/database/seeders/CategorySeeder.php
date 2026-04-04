<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Categoryモデルを使用

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'ハードSF',
                'slug' => 'hard-sf',
                'english_name' => 'Hard Science Fiction',
                'description' => '科学的・技術的な正確さを追求するジャンル。',
                'examples' => '2001年宇宙の旅、インターステラー、コンタクト、三体、火星の人',
            ],
            [
                'name' => 'スペースオペラ',
                'slug' => 'space-opera',
                'english_name' => 'Space Opera',
                'description' => '宇宙を舞台にした壮大な冒険活劇。',
                'examples' => 'スター・ウォーズ、ガーディアンズ・オブ・ギャラクシー、銀河英雄伝説、ガンダム',
            ],
            [
                'name' => 'サイバーパンク',
                'slug' => 'cyberpunk',
                'english_name' => 'Cyberpunk',
                'description' => '高度なコンピュータ技術と、退廃した社会・人体改造を描く。',
                'examples' => 'ブレードランナー、マトリックス、攻殻機動隊、ニューロマンサー',
            ],
            [
                'name' => 'スチームパンク',
                'slug' => 'steampunk',
                'english_name' => 'Steampunk',
                'description' => '「もし蒸気機関が高度に発達していたら」というレトロ未来。',
                'examples' => 'スチームボーイ、天空の城ラピュタ、ディファレンス・エンジン',
            ],
            [
                'name' => 'ディストピア',
                'slug' => 'dystopia',
                'english_name' => 'Dystopia / Utopia',
                'description' => '管理社会や暗黒の未来、あるいは一見理想的な管理社会。',
                'examples' => 'マッドマックス 怒りのデス・ロード、華氏451、1984年、すばらしい新世界',
            ],
            [
                'name' => 'タイムトラベル',
                'slug' => 'time-travel',
                'english_name' => 'Time Travel / Loop',
                'description' => '時間旅行や、同じ時間の繰り返し。',
                'examples' => 'バック・トゥ・ザ・フューチャー、TENET テネット、時をかける少女、All You Need Is Kill',
            ],
            [
                'name' => 'ポスト・アポカリプス',
                'slug' => 'post-apocalyptic',
                'english_name' => 'Post-Apocalyptic',
                'description' => '文明崩壊後の世界。',
                'examples' => '猿の惑星、アイ・アム・レジェンド、The Last of Us、フォールアウト',
            ],
            [
                'name' => 'ファーストコンタクト',
                'slug' => 'first-contact',
                'english_name' => 'First Contact',
                'description' => '人類と異星人の初めての接触。',
                'examples' => '未知との遭遇、メッセージ、E.T.',
            ],
            [
                'name' => 'ミリタリーSF',
                'slug' => 'military-sf',
                'english_name' => 'Military Science Fiction',
                'description' => '宇宙戦争や未来の兵士、軍隊組織に焦点を当てる。',
                'examples' => 'スターシップ・トゥルーパーズ、エイリアン2、宇宙の戦士',
            ],
        ];

        foreach ($categories as $category) {
            // slug をキーにして、既存データがあれば更新、なければ新規作成
            Category::updateOrCreate(
                ['slug' => $category['slug']], 
                [
                    'name' => $category['name'],
                    'english_name' => $category['english_name'],
                    'description' => $category['description'],
                    'examples' => $category['examples'],
                ]
            );
        }
    }
}