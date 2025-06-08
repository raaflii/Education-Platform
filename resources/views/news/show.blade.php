@extends('layouts.app')

@section('title', $news->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('news.index') }}" class="hover:text-blue-600">Berita</a></li>
            <li>/</li>
            <li><a href="{{ route('news.category', $news->category) }}" class="hover:text-blue-600">{{ $news->category->name }}</a></li>
            <li>/</li>
            <li class="text-gray-900">{{ Str::limit($news->title, 50) }}</li>
        </ol>
    </nav>

    <!-- Article -->
    <article class="bg-white rounded-lg shadow-lg overflow-hidden">
        @if($news->image)
            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="w-full h-64 md:h-96 object-cover">
        @endif
        
        <div class="p-8">
            <!-- Meta Info -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $news->category->name }}</span>
                    <span class="text-gray-500 text-sm">{{ $news->formatted_date }}</span>
                </div>
                <span class="text-gray-500 text-sm">By {{ $news->author }}</span>
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $news->title }}</h1>

            <!-- Excerpt -->
            @if($news->excerpt)
                <div class="text-xl text-gray-600 mb-8 border-l-4 border-blue-500 pl-4 italic">
                    {{ $news->excerpt }}
                </div>
            @endif

            <!-- Content -->
            <div class="prose prose-lg max-w-none">
                {!! nl2br(e($news->content)) !!}
            </div>
        </div>
    </article>

    <!-- Related News -->
    @if($relatedNews->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Berita Terkait</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($relatedNews as $related)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        @if($related->image)
                            <img src="{{ Storage::url($related->image) }}" alt="{{ $related->title }}" class="w-full h-32 object-cover">
                        @else
                            <div class="w-full h-32 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400 text-sm">No Image</span>
                            </div>
                        @endif
                        
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                <a href="{{ route('news.show', $related) }}" class="hover:text-blue-600">
                                    {{ $related->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $related->excerpt }}</p>
                            <span class="text-xs text-gray-500">{{ $related->formatted_date }}</span>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection