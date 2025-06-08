@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total News -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-blue-100 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Berita</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\News::count() }}</p>
            </div>
        </div>
    </div>

    <!-- Published News -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-green-100 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Berita Terbit</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\News::published()->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Total Categories -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-purple-100 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Kategori</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Category::count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent News -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <h2 class="text-lg font-semibold text-gray-900">Berita Terbaru</h2>
    </div>
    <div class="p-6">
        @php
            $recentNews = \App\Models\News::with('category')->latest()->limit(5)->get();
        @endphp
        
        @if($recentNews->count() > 0)
            <div class="space-y-4">
                @foreach($recentNews as $news)
                    <div class="flex items-center justify-between p-4 border rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900">{{ $news->title }}</h3>
                            <div class="flex items-center space-x-2 text-sm text-gray-500 mt-1">
                                <span class="bg-gray-100 px-2 py-1 rounded">{{ $news->category->name }}</span>
                                <span>{{ $news->created_at->format('d M Y') }}</span>
                                <span class="px-2 py-1 rounded text-xs {{ $news->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $news->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.news.show', $news) }}" class="text-blue-600 hover:text-blue-800">
                                Lihat
                            </a>
                            <a href="{{ route('admin.news.edit', $news) }}" class="text-yellow-600 hover:text-yellow-800">
                                Edit
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-4 text-center">
                <a href="{{ route('admin.news.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    Lihat Semua Berita →
                </a>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Belum ada berita tersedia.</p>
        @endif
    </div>
</div>
@endsection