@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total News -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/30 p-6 dark-transition">
        <div class="flex items-center">
            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg dark-transition">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 dark-transition">Total Berita</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white dark-transition">{{ \App\Models\News::count() }}</p>
            </div>
        </div>
    </div>

    <!-- Published News -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/30 p-6 dark-transition">
        <div class="flex items-center">
            <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg dark-transition">
                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 dark-transition">Berita Terbit</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white dark-transition">{{ \App\Models\News::published()->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Total Categories -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/30 p-6 dark-transition">
        <div class="flex items-center">
            <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg dark-transition">
                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 dark-transition">Total Kategori</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white dark-transition">{{ \App\Models\Category::count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent News -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/30 dark-transition">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 dark-transition">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white dark-transition">Berita Terbaru</h2>
    </div>
    <div class="p-6">
        @php
            $recentNews = \App\Models\News::with('category')->latest()->limit(5)->get();
        @endphp
        
        @if($recentNews->count() > 0)
            <div class="space-y-4">
                @foreach($recentNews as $news)
                    <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors dark-transition">
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900 dark:text-white dark-transition">{{ $news->title }}</h3>
                            <div class="flex flex-wrap items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mt-1 dark-transition">
                                <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded dark-transition">{{ $news->category->name }}</span>
                                <span>{{ $news->created_at->format('d M Y') }}</span>
                                @if($news->is_published)
                                    <span class="px-2 py-1 rounded text-xs bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 dark-transition">
                                        Published
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded text-xs bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 dark-transition">
                                        Draft
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.news.show', $news) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 dark-transition">
                                Lihat
                            </a>
                            <a href="{{ route('admin.news.edit', $news) }}" class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-300 dark-transition">
                                Edit
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6 text-center">
                <a href="{{ route('admin.news.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 text-white font-medium rounded-lg transition-colors dark-transition">
                    Lihat Semua Berita
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        @else
            <div class="py-12 flex flex-col items-center justify-center">
                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-lg font-medium dark-transition">Belum ada berita tersedia.</p>
                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1 dark-transition">Mulai dengan menambahkan berita pertama</p>
                <a href="{{ route('admin.news.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-primary hover:bg-primary text-white font-medium rounded-lg transition-colors dark-transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Berita
                </a>
            </div>
        @endif
    </div>
</div>
</div>
@endsection