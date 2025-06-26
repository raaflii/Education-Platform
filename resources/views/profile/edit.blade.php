@extends('layouts.admin')

@section('title', 'Edit Profile')
@section('header', 'Edit Profile')

@section('content')
<div class="max-w-6xl mx-auto space-y-10"> {{-- FORM LEBIH LEBAR --}}

    <div class="flex justify-between items-center">
        <a href="{{ route('profile.settings') }}"
        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 shadow hover:bg-gray-100 dark:hover:bg-gray-600">
            <x-heroicon-o-arrow-left class="h-4 w-4 mr-2" />
            Back to Profile
        </a>
    </div>
    
    <!-- Edit Profile -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
        <div class="px-10 py-10"> {{-- Padding besar biar lapang --}}
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-8 flex items-center">
                <x-heroicon-o-user class="h-6 w-6 mr-3 text-gray-400" />
                Edit Profile
            </h2>
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-8">
                @csrf
                <div>
                    <label for="name" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                    <input name="name" type="text" value="{{ old('name', auth()->user()->name) }}" id="name"
                        class="block w-full px-4 py-3 text-base rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="email" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input name="email" type="email" value="{{ old('email', auth()->user()->email) }}" id="email"
                        class="block w-full px-4 py-3 text-base rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div class="pt-2">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 text-base font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
        <div class="px-10 py-10">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-8 flex items-center">
                <x-heroicon-o-lock-closed class="h-6 w-6 mr-3 text-gray-400" />
                Change Password
            </h2>
            <form method="POST" action="{{ route('profile.edit') }}" class="space-y-6">
                @csrf
                <input name="current_password" type="password" placeholder="Current password"
                    class="block w-full px-4 py-3 text-base rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <input name="new_password" type="password" placeholder="New password"
                    class="block w-full px-4 py-3 text-base rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <input name="new_password_confirmation" type="password" placeholder="Confirm new password"
                    class="block w-full px-4 py-3 text-base rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <button type="submit"
                    class="mt-2 inline-flex items-center px-6 py-3 text-base font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow">
                    Update Password
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
