<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategory;

class AdminNewsCategoryController extends Controller
{
    public function index()
    {
        $news_categories = NewsCategory::withCount('news')->latest()->paginate(10);
        return view('admin.news_categories.index', compact('news_categories'));
    }

    public function create()
    {
        return view('admin.news_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:news_categories',
            'description' => 'nullable|string'
        ]);

        NewsCategory::create($request->all());

        return redirect()->route('admin.news-categories.index')->with('success', 'Kategori berhasil dibuat!');
    }

    public function show(NewsCategory $news_category)
    {
        $news_category->load('news');
        return view('admin.news_categories.show', compact('news_category'));
    }

    public function edit(NewsCategory $news_category)
    {
        return view('admin.news_categories.edit', compact('news_category'));
    }

    public function update(Request $request, NewsCategory $news_category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:news_categories,name,' . $news_category->id,
            'description' => 'nullable|string'
        ]);

        $news_category->update($request->all());

        return redirect()->route('admin.news-categories.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy(NewsCategory $news_category)
    {
        if ($news_category->news()->count() > 0) {
            return redirect()->route('admin.news-categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki berita!');
        }

        $news_category->delete();

        return redirect()->route('admin.news-categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}