@extends('layouts.app')

@section('title', 'Berita Terbaru')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Berita Terbaru</h1>
        <p class="text-gray-600 mt-2">Dapatkan informasi terkini seputar dunia pendidikan online</p>
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
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $article->category->name }}</span>
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
                <p class="text-gray-500 text-lg">Belum ada berita tersedia.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $news->links() }}
    </div>
</div>
@endsection