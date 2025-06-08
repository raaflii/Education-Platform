<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('category')
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

        $relatedNews = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->published()
            ->latest()
            ->limit(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }

    public function category(Category $category)
    {
        $news = News::where('category_id', $category->id)
            ->published()
            ->latest()
            ->paginate(10);

        return view('news.category', compact('news', 'category'));
    }
}