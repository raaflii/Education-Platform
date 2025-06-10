@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="text-center">
                <h2 class="text-4xl font-bold text-blue-600 mb-2">EduPlatform</h2>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Buat Akun Baru
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Masuk sekarang
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input id="name" name="name" type="text" autocomplete="name" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border 
                                  @error('name') border-red-300 @else border-gray-300 @enderror 
                                  placeholder-gray-500 text-gray-900 rounded-md focus:outline-none 
                                  focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                           placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border 
                                  @error('email') border-red-300 @else border-gray-300 @enderror 
                                  placeholder-gray-500 text-gray-900 rounded-md focus:outline-none 
                                  focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                           placeholder="Masukkan alamat email" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon (Opsional)</label>
                    <input id="phone" name="phone" type="tel" autocomplete="tel" 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border 
                                  @error('phone') border-red-300 @else border-gray-300 @enderror 
                                  placeholder-gray-500 text-gray-900 rounded-md focus:outline-none 
                                  focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                           placeholder="Masukkan nomor telepon" value="{{ old('phone') }}">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Daftar Sebagai</label>
                    <select id="role" name="role" required 
                            class="mt-1 block w-full px-3 py-2 border 
                                   @error('role') border-red-300 @else border-gray-300 @enderror 
                                   bg-white rounded-md focus:outline-none focus:ring-blue-500 
                                   focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih peran</option>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Siswa</option>
                        <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Guru</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border 
                                  @error('password') border-red-300 @else border-gray-300 @enderror 
                                  placeholder-gray-500 text-gray-900 rounded-md focus:outline-none 
                                  focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                           placeholder="Masukkan password">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 
                                  placeholder-gray-500 text-gray-900 rounded-md focus:outline-none 
                                  focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                           placeholder="Konfirmasi password">
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent 
                               text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 
                               transition duration-200">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" 
                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z" />
                        </svg>
                    </span>
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection