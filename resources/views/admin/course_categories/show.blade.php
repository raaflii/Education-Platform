@extends('layouts.admin')

@section('title', 'Detail Kategori Kursus')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Kategori</h1>
            <p class="text-gray-600">{{ $category->name }}</p>
        </div>
        <div>
            <a href="{{ route('admin.course-categories.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex flex-col md:flex-row">
            <!-- Informasi Utama -->
            <div class="md:w-1/3 mb-6 md:mb-0">
                @if($category->image)
                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-64 object-cover rounded-lg mb-4">
                @endif
                <div class="flex items-center mb-3">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                    <span class="ml-4 text-sm text-gray-500">
                        Dibuat: {{ $category->created_at->format('d M Y') }}
                    </span>
                </div>
                <div class="text-gray-700 mb-2">
                    <span class="font-medium">Slug:</span> {{ $category->slug }}
                </div>
                <div class="flex space-x-3 mt-4">
                    <a href="{{ route('admin.course-categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-900">Edit Kategori</a>
                    <form action="{{ route('admin.course-categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </div>
            </div>

            <!-- Statistik -->
            <div class="md:w-2/3 md:pl-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Statistik Kategori</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-indigo-50 rounded-lg p-4">
                        <div class="text-3xl font-bold text-indigo-700">{{ $stats['total_courses'] }}</div>
                        <div class="text-gray-600">Total Kursus</div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4">
                        <div class="text-3xl font-bold text-green-700">{{ $stats['published_courses'] }}</div>
                        <div class="text-gray-600">Kursus Terpublikasi</div>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4">
                        <div class="text-3xl font-bold text-yellow-700">{{ $stats['draft_courses'] }}</div>
                        <div class="text-gray-600">Kursus Draft</div>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-4">
                        <div class="text-3xl font-bold text-purple-700">{{ $stats['total_students'] }}</div>
                        <div class="text-gray-600">Total Siswa</div>
                    </div>
                </div>

                <!-- Kursus Terbaru -->
                <h2 class="text-xl font-bold text-gray-800 mb-4">Kursus Terbaru</h2>
                <div class="bg-gray-50 rounded-lg p-4">
                    @if($category->courses->count() > 0)
                        <ul class="divide-y divide-gray-200">
                            @foreach($category->courses as $course)
                            <li class="py-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ $course->title }}</h3>
                                        <div class="flex items-center mt-1">
                                            <span class="px-2 py-1 text-xs rounded-full {{ $course->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $course->is_published ? 'Terpublikasi' : 'Draft' }}
                                            </span>
                                            <span class="ml-2 text-xs text-gray-500">{{ $course->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.courses.show', $course->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">Detail</a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Belum ada kursus dalam kategori ini</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection