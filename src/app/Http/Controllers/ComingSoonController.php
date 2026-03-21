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
            'with_genres' => 878,
            'language' => 'ja-JP',
            'region' => 'JP',
            'sort_by' => 'primary_release_date.asc',
            'primary_release_date.gte' => $today,
        ]);
        if ($movieResponse->successful()) {
            $this->saveResults($movieResponse->json()['results'], 'movie', $token);
        }

        // --- 2. ドラマ（TV）のSFを公開日順に取得 ---
        $tvResponse = Http::withToken($token)->get('https://api.themoviedb.org/3/discover/tv', [
            'with_genres' => 10765,
            'language' => 'ja-JP',
            'sort_by' => 'first_air_date.asc',
            'first_air_date.gte' => $today,
        ]);
        if ($tvResponse->successful()) {
            $this->saveResults($tvResponse->json()['results'], 'tv', $token);
        }

        // --- 3. 【追加】特定の期待作を「指名検索」して強制追加 ---
        $watchlist = ['Project Hail Mary', 'Disclosure Day']; 
        foreach ($watchlist as $query) {
            $searchResponse = Http::withToken($token)->get('https://api.themoviedb.org/3/search/movie', [
                'query' => $query,
                'language' => 'ja-JP',
            ]);
            if ($searchResponse->successful() && !empty($searchResponse->json()['results'])) {
                // 検索結果の1番目を保存
                $this->saveResults([$searchResponse->json()['results'][0]], 'movie', $token);
            }
        }

        // --- 4. DBから最新データを取得 ---
        // 指名検索した作品は日付が未定（null）や遠い未来の可能性があるので、条件を少し広げて取得
        // 公開日が今日以降、もしくは「公開日が未設定」のものもすべて取得する
        $displayMovies = TmdbContent::orderByRaw('release_date IS NULL ASC') 
            ->orderBy('release_date', 'asc') 
            ->get();

        return view('comingsoon.coming-index', compact('displayMovies'));
    }

    private function saveResults($results, $type, $token)
    {

        // 1. 絶対に表示したくないタイトルのブラックリスト
        $blacklist = ['Touch Me'];

        $limitedResults = array_slice($results, 0, 8);

        foreach ($limitedResults as $item) {

            $title = $item['title'] ?? ($item['name'] ?? 'タイトル不明');

            // 2. ブラックリストに含まれる、またはアダルトフラグが立っていたらスキップ
            if (in_array($title, $blacklist) || ($item['adult'] ?? false)) {
                continue; 
            }

            $detailResponse = Http::withToken($token)
                ->get("https://api.themoviedb.org/3/{$type}/{$item['id']}", [
                    'append_to_response' => 'credits',
                    'language' => 'ja-JP',
                ]);

            if ($detailResponse->successful()) {
                $detail = $detailResponse->json();

                $director = '不明';
                if ($type === 'movie') {
                    $director = collect($detail['credits']['crew'] ?? [])
                        ->firstWhere('job', 'Director')['name'] ?? '不明';
                } else {
                    $director = $detail['created_by'][0]['name'] ?? '不明';
                }

                $cast = collect($detail['credits']['cast'] ?? [])
                    ->take(5)
                    ->pluck('name')
                    ->toArray();

                TmdbContent::updateOrCreate(
                    ['tmdb_id' => $item['id']],
                    [
                        'media_type'   => $type,
                        'title'        => $item['title'] ?? ($item['name'] ?? 'タイトル不明'),
                        'poster_path'  => $item['poster_path'],
                        'release_date' => $item['release_date'] ?? ($item['first_air_date'] ?? null),
                        'overview'     => $item['overview'],
                        'director'     => $director,
                        'cast'         => $cast, 
                    ]
                );
            }
        }
    }
}