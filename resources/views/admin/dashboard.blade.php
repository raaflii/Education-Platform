{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Administrator')

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-500 text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::count() }}</p>
            </div>
        </div>
    </div>

    <!-- Total Teachers -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-500 text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Guru</p>
                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::byRole('teacher')->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Total Students -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-500 text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::byRole('student')->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Active Users -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-500 text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Pengguna Aktif</p>
                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::active()->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Content Statistics -->
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

    <!-- Total Courses -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-indigo-100 rounded-lg">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Kursus</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Course::count() }}</p>
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
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\CourseCategory::count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Welcome Section -->
<div class="bg-white rounded-lg shadow mb-8">
    <div class="px-6 py-4 border-b">
        <h3 class="text-lg font-medium text-gray-900">Selamat Datang, {{ Auth::user()->name }}!</h3>
        <p class="text-sm text-gray-600">Kelola platform edukasi online Anda dengan mudah.</p>
    </div>
    <div class="p-6">
        <p class="text-gray-700">Ini adalah dashboard administrator. Dari sini Anda dapat mengelola semua aspek platform edukasi online termasuk pengguna, berita, kursus, dan kategori.</p>
    </div>
</div>

<!-- Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent News -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-900">Berita Terbaru</h2>
        </div>
        <div class="p-6">
            @php
                $recentNews = \App\Models\News::with('news_category')->latest()->limit(5)->get();
            @endphp
            
            @if($recentNews->count() > 0)
                <div class="space-y-4">
                    @foreach($recentNews as $news)
                        <div class="flex items-center justify-between p-4 border rounded-lg">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900">{{ Str::limit($news->title, 40) }}</h3>
                                <div class="flex items-center space-x-2 text-sm text-gray-500 mt-1">
                                    <span class="bg-gray-100 px-2 py-1 rounded">{{ $news->news_category->name }}</span>
                                    <span>{{ $news->created_at->format('d M Y') }}</span>
                                    <span class="px-2 py-1 rounded text-xs {{ $news->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $news->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.news.show', $news) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                    Lihat
                                </a>
                                <a href="{{ route('admin.news.edit', $news) }}" class="text-yellow-600 hover:text-yellow-800 text-sm">
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

    <!-- Recent Courses -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-900">Kursus Terbaru</h2>
        </div>
        <div class="p-6">
            @php
                $recentCourses = \App\Models\Course::with(['teacher', 'category'])->latest()->limit(5)->get();
            @endphp
            
            @if($recentCourses->count() > 0)
                <div class="space-y-4">
                    @foreach($recentCourses as $course)
                        <div class="flex items-center justify-between p-4 border rounded-lg">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900">{{ Str::limit($course->title, 40) }}</h3>
                                <div class="flex items-center space-x-2 text-sm text-gray-500 mt-1">
                                    <span class="bg-gray-100 px-2 py-1 rounded">{{ $course->category->name ?? 'Umum' }}</span>
                                    <span>{{ $course->teacher->name ?? 'Admin' }}</span>
                                    <span>{{ $course->created_at->format('d M Y') }}</span>
                                    <span class="px-2 py-1 rounded text-xs {{ $course->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $course->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.courses.show', $course) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                    Lihat
                                </a>
                                <a href="{{ route('admin.courses.edit', $course) }}" class="text-yellow-600 hover:text-yellow-800 text-sm">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-4 text-center">
                    <a href="{{ route('admin.courses.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        Lihat Semua Kursus →
                    </a>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Belum ada kursus tersedia.</p>
            @endif
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <h2 class="text-lg font-semibold text-gray-900">Aksi Cepat</h2>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.news.create') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors">
                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="font-medium text-gray-700">Tambah Berita</span>
            </a>

            <a href="{{ route('admin.courses.create') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition-colors">
                <div class="p-2 bg-indigo-100 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="font-medium text-gray-700">Tambah Kursus</span>
            </a>

            <a href="{{ route('admin.users.create') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition-colors">
                <div class="p-2 bg-green-100 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="font-medium text-gray-700">Tambah User</span>
            </a>

            <a href="{{ route('admin.news-categories.create') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition-colors">
                <div class="p-2 bg-purple-100 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="font-medium text-gray-700">Tambah Kategori News</span>
            </a>

            <a href="{{ route('admin.course-categories.create') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition-colors">
                <div class="p-2 bg-purple-100 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="font-medium text-gray-700">Tambah Kategori Course</span>
            </a>
        </div>
    </div>
</div>
@endsection