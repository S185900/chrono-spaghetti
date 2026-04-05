<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\TmdbContent;
use Carbon\Carbon;

class ComingSoonController extends Controller
{
    public function index()
    {
        $token = config('services.tmdb.token');
        $today = now()->format('Y-m-d');

        // --- 1. 映画（Movie）のSFを公開日順に取得 ---
        $movieResponse = Http::withToken($token)->get('https://api.themoviedb.org/3/discover/movie', [
            'with_genres' => 878, // SFジャンル
            'language' => 'ja-JP',
            'region' => 'JP',
            'sort_by' => 'primary_release_date.asc',
            'primary_release_date.gte' => $today,
        ]);
        
        if ($movieResponse->successful()) {
            $this->saveResults($movieResponse->json()['results'], 'movie', $token);
        }

        // --- 2. 特定の期待作を「指名検索」して追加 ---
        // ドラマは除外するため、search/movie を使用
        $watchlist = ['Project Hail Mary', 'Disclosure Day']; 
        foreach ($watchlist as $query) {
            $searchResponse = Http::withToken($token)->get('https://api.themoviedb.org/3/search/movie', [
                'query' => $query,
                'language' => 'ja-JP',
            ]);
            if ($searchResponse->successful() && !empty($searchResponse->json()['results'])) {
                $this->saveResults([$searchResponse->json()['results'][0]], 'movie', $token);
            }
        }

        // --- 3. DBからデータを取得 ---
        // 過去に保存された「tv」データが表示されないよう、media_typeを'movie'に限定して取得
        $displayMovies = TmdbContent::where('media_type', 'movie')
            ->orderByRaw('release_date IS NULL ASC') 
            ->orderBy('release_date', 'asc') 
            ->get();

        return view('comingsoon.coming-index', compact('displayMovies'));
    }

    public function show($id)
    {
        // 今はエラーを消すために、空のレスポンスか詳細ビューを返すように
        // 本来はここで作品の詳細データを取得
        return response()->json(['message' => 'Show method called for ID: ' . $id]);
    }

    private function saveResults($results, $type, $token)
    {
        $blacklist = ['Touch Me'];
        $limitedResults = array_slice($results, 0, 20); // 少し取得数を増やしても良いかもしれません

        foreach ($limitedResults as $item) {
            $title = $item['title'] ?? 'タイトル不明';

            if (in_array($title, $blacklist) || ($item['adult'] ?? false)) {
                continue; 
            }

            $detailResponse = Http::withToken($token)
                ->get("https://api.themoviedb.org/3/movie/{$item['id']}", [
                    'append_to_response' => 'credits',
                    'language' => 'ja-JP',
                ]);

            if ($detailResponse->successful()) {
                $detail = $detailResponse->json();

                // 映画専用の監督取得ロジック
                $director = collect($detail['credits']['crew'] ?? [])
                    ->firstWhere('job', 'Director')['name'] ?? '不明';

                // --- 【追加】国名を取得してカンマ区切りの文字列にする ---
                $countries = collect($detail['production_countries'] ?? [])
                    ->pluck('name')
                    ->toArray(); // ['アメリカ合衆国', 'イギリス'] のような配列

                $cast = collect($detail['credits']['cast'] ?? [])
                    ->take(5)
                    ->pluck('name')
                    ->toArray();

                TmdbContent::updateOrCreate(
                    ['tmdb_id' => $item['id']],
                    [
                        'media_type'   => 'movie',
                        'title'        => $title,
                        'poster_path'  => $item['poster_path'],
                        'release_date' => $item['release_date'] ?? null,
                        'overview'     => $item['overview'],
                        'director'     => $director,
                        'countries'    => $countries,
                        'cast'         => $cast, 
                    ]
                );
            }
        }
    }
}