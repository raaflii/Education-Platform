@extends('layouts.admin')

@section('title', 'Edit Kursus')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Kursus: {{ $course->title }}</h1>
            <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div>
                        <!-- Judul Kursus -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Kursus
                                *</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $course->title) }}"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $course->description) }}</textarea>
                        </div>

                        <!-- Pengajar -->
                        <div class="mb-4">
                            <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-1">Pengajar *</label>
                            <select id="teacher_id" name="teacher_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ $course->teacher_id == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="course_category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori
                                *</label>
                            <select id="course_category_id" name="course_category_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div>
                        <!-- Level -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Level *</label>
                            <div class="grid grid-cols-3 gap-2">
                                <label
                                    class="flex items-center justify-center p-3 border border-gray-300 rounded-md cursor-pointer">
                                    <input type="radio" name="level" value="beginner" class="sr-only peer"
                                        {{ $course->level == 'beginner' ? 'checked' : '' }}>
                                    <span
                                        class="peer-checked:bg-indigo-100 peer-checked:text-indigo-800 peer-checked:font-semibold p-2 rounded-md w-full text-center">Pemula</span>
                                </label>
                                <label
                                    class="flex items-center justify-center p-3 border border-gray-300 rounded-md cursor-pointer">
                                    <input type="radio" name="level" value="intermediate" class="sr-only peer"
                                        {{ $course->level == 'intermediate' ? 'checked' : '' }}>
                                    <span
                                        class="peer-checked:bg-indigo-100 peer-checked:text-indigo-800 peer-checked:font-semibold p-2 rounded-md w-full text-center">Menengah</span>
                                </label>
                                <label
                                    class="flex items-center justify-center p-3 border border-gray-300 rounded-md cursor-pointer">
                                    <input type="radio" name="level" value="advanced" class="sr-only peer"
                                        {{ $course->level == 'advanced' ? 'checked' : '' }}>
                                    <span
                                        class="peer-checked:bg-indigo-100 peer-checked:text-indigo-800 peer-checked:font-semibold p-2 rounded-md w-full text-center">Mahir</span>
                                </label>
                            </div>
                        </div>

                        <!-- Durasi -->
                        <div class="mb-4">
                            <label for="duration_minutes" class="block text-sm font-medium text-gray-700 mb-1">Durasi
                                (menit) *</label>
                            <input type="number" id="duration_minutes" name="duration_minutes"
                                value="{{ old('duration_minutes', $course->duration_minutes) }}" required min="1"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp) *</label>
                            <input type="number" id="price" name="price" value="{{ old('price', $course->price) }}"
                                required min="0" step="1000"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <div class="flex items-center">
                                <input id="is_active" name="is_active" type="checkbox" value="1"
                                    {{ $course->is_active ? 'checked' : '' }}
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                    Aktifkan kursus
                                </label>
                            </div>
                        </div>

                        <!-- Gratis -->
                        <div class="mb-4">
                            <div class="flex items-center">
                                <input id="is_free" name="is_free" type="checkbox" value="1"
                                    {{ $course->is_free ? 'checked' : '' }}
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_free" class="ml-2 block text-sm text-gray-900">
                                    Jadikan kursus gratis
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="flex items-center">
                                <input id="is_published" name="is_published" type="checkbox" value="1"
                                    {{ $course->is_published ? 'checked' : '' }}
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_published" class="ml-2 block text-sm text-gray-900">
                                    Publish
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-6">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition">
                        Update Kursus
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
