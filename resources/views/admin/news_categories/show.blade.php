@extends('layouts.admin')

@section('title', 'Detail Kategori')
@section('header', 'Detail Kategori')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Category Info -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Kategori</h3>
                
                <div class="space-y-4">
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                            {{ $news_category->name }}
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 min-h-[100px]">
                            {{ $news_category->description ?: 'Tidak ada deskripsi' }}
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Statistik</label>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center p-2 bg-blue-50 rounded">
                                <span class="text-sm text-gray-600">Total Berita:</span>
                                <span class="font-medium text-blue-600">{{ $news_category->news->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                <span class="text-sm text-gray-600">Dibuat:</span>
                                <span class="font-medium">{{ $news_category->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                <span class="text-sm text-gray-600">Diupdate:</span>
                                <span class="font-medium">{{ $news_category->updated_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('admin.news-categories.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Kembali
                    </a>
                    <a href="{{ route('admin.news-categories.edit', $news_category) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- News List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        Berita dalam Kategori ({{ $news_category->news->count() }})
                    </h3>
                </div>

                <div class="divide-y divide-gray-200">
                    @forelse($news_category->news as $news)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="text-base font-medium text-gray-900 mb-2">
                                        {{ $news->title }}
                                    </h4>
                                    @if($news->excerpt)
                                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                            {{ $news->excerpt }}
                                        </p>
                                    @endif
                                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                                        <span>{{ $news->author }}</span>
                                        <span>•</span>
                                        <span>{{ $news->created_at->format('d M Y') }}</span>
                                        <span>•</span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $news->is_published ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $news->is_published ? 'Published' : 'Draft' }}
                                        </span>
                                    </div>
                                </div>
                                @if($news->image)
                                    <div class="ml-4 flex-shrink-0">
                                        <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" 
                                             class="h-16 w-16 object-cover rounded-md">
                                    </div>
                                @endif
                            </div>
                            <div class="mt-4 flex space-x-3">
                                <a href="{{ route('admin.news.show', $news) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat Detail
                                </a>
                                <a href="{{ route('admin.news.edit', $news) }}" 
                                   class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada berita</h3>
                            <p class="mt-1 text-sm text-gray-500">Kategori ini belum memiliki berita.</p>
                            <div class="mt-6">
                                <a href="{{ route('admin.news.create') }}?category={{ $news_category->id }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Tambah Berita
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection