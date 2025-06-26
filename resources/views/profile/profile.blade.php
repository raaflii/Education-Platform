@extends('layouts.admin')

@section('title', 'Profile')
@section('header', 'Profile')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">

    <!-- Tombol keluar -->
    <div class="flex justify-start">
        <a href="{{ route('admin.dashboard') }}"
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50
                dark:text-gray-200 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700">
            <x-heroicon-o-arrow-left class="h-4 w-4 mr-2" />
            Back
        </a>
    </div>

    <!-- Profile content -->
    <div class="bg-white overflow-hidden shadow rounded-lg dark:bg-gray-800 dark:shadow-lg">
        <div class="px-10 py-10">
            <div class="flex items-center space-x-6 mb-8">
                <img class="h-24 w-24 rounded-full"
                     src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}"
                     alt="Profile">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-300">{{ auth()->user()->email }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->role->name ?? 'User' }}</p>
                    <a href="{{ route('profile.edit') }}"
                       class="mt-2 inline-flex items-center px-3 py-1 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50
                              dark:bg-gray-700 dark:text-gray-200 dark:border-gray-500 dark:hover:bg-gray-600">
                        <x-heroicon-o-pencil class="h-4 w-4 mr-1" />
                        Edit Profile
                    </a>
                </div>
            </div>

            <!-- Profile details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center dark:text-white">
                        <x-heroicon-o-user class="h-5 w-5 mr-2" />
                        Personal Information
                    </h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone</dt>
                            <dd class="text-sm text-gray-900 dark:text-gray-200">{{ auth()->user()->phone ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Joined</dt>
                            <dd class="text-sm text-gray-900 dark:text-gray-200">{{ auth()->user()->created_at->format('F Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                            <dd class="text-sm text-gray-900 dark:text-gray-200">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900">
                                    <x-heroicon-o-check-circle class="h-3 w-3 mr-1" />
                                    Active
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center dark:text-white">
                        <x-heroicon-o-chart-bar class="h-5 w-5 mr-2" />
                        Activity
                    </h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Login</dt>
                            <dd class="text-sm text-gray-900 dark:text-gray-200">{{ auth()->user()->last_login_at ? auth()->user()->last_login_at->diffForHumans() : 'N/A' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
