<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * カテゴリー一覧画面を表示
     */
    public function index()
    {
        // 全てのカテゴリーを取得（あとで並び替えたい場合は orderBy を使う）
        $categories = Category::all();

        // category/category-index.blade.php にデータを渡す
        return view('category.category-index', compact('categories'));
    }

    /**
     * 特定のカテゴリーに属する映画一覧を表示
     * (slugを使って URL を /category/cyberpunk のようにする想定)
     */
    public function show($slug)
    {
        // slugが一致するカテゴリーを1つ取得
        $category = Category::where('slug', $slug)->firstOrFail();

        // TODO: ここでそのカテゴリーに紐づく映画を取得するロジックを後で追加
        // $movies = $category->movies; 

        return view('category.show', compact('category'));
    }
}