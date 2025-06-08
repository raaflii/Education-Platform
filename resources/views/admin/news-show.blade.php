@extends('layouts.admin')

@section('title', 'Detail Berita')
@section('header', 'Detail Berita')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                    {{ $news->title }}
                </div>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                    {{ $news->category->name ?? '-' }}
                </div>
            </div>

            <!-- Author -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                    {{ $news->author }}
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $news->is_published ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $news->is_published ? 'Dipublikasikan' : 'Draft' }}
                    </span>
                </div>
            </div>

            <!-- Created At -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dibuat</label>
                <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                    {{ $news->created_at->format('d M Y H:i') }}
                </div>
            </div>

            <!-- Image -->
            @if($news->image)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                <div class="border border-gray-300 rounded-md p-4">
                    <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" 
                         class="max-w-full h-auto rounded-md shadow-sm">
                </div>
            </div>
            @endif

            <!-- Excerpt -->
            @if($news->excerpt)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Ringkasan</label>
                <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 min-h-[80px]">
                    {{ $news->excerpt }}
                </div>
            </div>
            @endif

            <!-- Content -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 min-h-[200px] whitespace-pre-wrap">{{ $news->content }}</div>
            </div>
        </div>

        <div class="flex justify-end space-x-4 mt-6">
            <a href="{{ route('admin.news.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Kembali
            </a>
            <a href="{{ route('admin.news.edit', $news) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection