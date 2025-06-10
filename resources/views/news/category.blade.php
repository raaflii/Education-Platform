@extends('layouts.app')

@section('title', 'Kategori: ' . $category->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8">
        <nav class="text-sm text-gray-500 mb-4">
            <a href="{{ route('news.index') }}" class="hover:text-blue-600">Berita</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $category->name }}</span>
        </nav>
        
        <h1 class="text-3xl font-bold text-gray-900">Kategori: {{ $category->name }}</h1>
        @if($category->description)
            <p class="text-gray-600 mt-2">{{ $category->description }}</p>
        @else
            <p class="text-gray-600 mt-2">Berita terkini dalam kategori {{ $category->name }}</p>
        @endif
        
        <div class="mt-4 text-sm text-gray-500">
            {{ $news->total() }} artikel ditemukan
        </div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($news as $article)
            <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                @if($article->image)
                    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">No Image</span>
                    </div>
                @endif
                
                <div class="p-6">
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $article->news_category->name }}</span>
                        <span>{{ $article->formatted_date }}</span>
                    </div>
                    
                    <h2 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2">
                        <a href="{{ route('news.show', $article) }}" class="hover:text-blue-600">
                            {{ $article->title }}
                        </a>
                    </h2>
                    
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">By {{ $article->author }}</span>
                        <a href="{{ route('news.show', $article) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">📰</div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Berita</h3>
                <p class="text-gray-500 text-lg mb-4">Belum ada berita dalam kategori "{{ $category->name }}".</p>
                <a href="{{ route('news.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    ← Kembali ke Semua Berita
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($news->hasPages())
        <div class="mt-8">
            {{ $news->links() }}
        </div>
    @endif
</div>
@endsection