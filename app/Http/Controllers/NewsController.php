<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('news_category')
            ->published()
            ->latest()
            ->paginate(10);

        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        if (!$news->is_published) {
            abort(404);
        }

        $relatedNews = News::where('news_category_id', $news->news_category_id)
            ->where('id', '!=', $news->id)
            ->published()
            ->latest()
            ->limit(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }

    public function category(NewsCategory $category)
    {
        $news = News::where('news_category_id', $category->id)
            ->published()
            ->latest()
            ->paginate(10);

        return view('news.category', compact('news', 'category'));
    }
}