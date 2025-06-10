@extends('layouts.admin')

@section('title', 'Detail Kursus')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $course->title }}</h1>
            <div class="flex items-center mt-2">
                @php
                    $levelColors = [
                        'beginner' => 'bg-green-100 text-green-800',
                        'intermediate' => 'bg-yellow-100 text-yellow-800',
                        'advanced' => 'bg-red-100 text-red-800'
                    ];
                @endphp
                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $levelColors[$course->level] ?? 'bg-gray-100 text-gray-800' }}">
                    {{ ucfirst($course->level) }}
                </span>
                <span class="ml-2 text-sm text-gray-600">
                    {{ $course->duration_minutes }} menit
                </span>
                <span class="ml-4 text-sm font-medium {{ $course->is_published ? 'text-green-600' : 'text-red-600' }}">
                    {{ $course->is_active ? 'Published' : 'Draft' }}
                </span>
            </div>
        </div>
        <div>
            <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Informasi Utama -->
            <div class="md:col-span-2">
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Deskripsi Kursus</h2>
                <p class="text-gray-600 mb-6">
                    {{ $course->description ?? 'Tidak ada deskripsi tersedia.' }}
                </p>
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Pengajar</h3>
                        <p class="text-gray-900 font-medium">{{ $course->teacher->name ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Kategori</h3>
                        <p class="text-gray-900 font-medium">{{ $course->category->name ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Tanggal Dibuat</h3>
                        <p class="text-gray-900 font-medium">{{ $course->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Terakhir Diperbarui</h3>
                        <p class="text-gray-900 font-medium">{{ $course->updated_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Detail Harga & Status -->
            <div class="bg-gray-50 rounded-lg p-6 h-fit">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Kursus</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Status:</span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $course->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $course->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Level:</span>
                        <span class="font-medium">{{ ucfirst($course->level) }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Durasi:</span>
                        <span class="font-medium">{{ $course->duration_minutes }} menit</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Harga:</span>
                        @if($course->is_free)
                            <span class="font-medium text-green-600">Gratis</span>
                        @else
                            <span class="font-medium">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                        @endif
                    </div>
                    
                    <div class="pt-4 flex justify-between">
                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                            Edit Kursus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection