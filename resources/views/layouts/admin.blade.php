<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .dark-transition {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 dark-transition">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="group fixed md:static inset-y-0 left-0 z-30 w-16 md:w-64 bg-gray-800 dark:bg-gray-950 text-white transition-all duration-300 ease-in-out hover:w-64">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700 dark:border-gray-800">
                <h2 class="text-xl font-bold opacity-0 md:opacity-100 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    Admin Panel
                </h2>

            </div>

            <!-- Navigation -->
            <nav class="mt-4 px-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-3 mb-1 rounded-lg transition-all duration-200 hover:bg-gray-700 dark:hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 dark:bg-gray-800 text-white font-semibold' : 'text-gray-300' }} group/item"
                   title="Dashboard">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="opacity-0 md:opacity-100 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                        Dashboard
                    </span>
                </a>

                <a href="{{ route('admin.news.index') }}"
                   class="flex items-center gap-3 px-3 py-3 mb-1 rounded-lg transition-all duration-200 hover:bg-gray-700 dark:hover:bg-gray-800 {{ request()->routeIs('admin.news.*') ? 'bg-gray-700 dark:bg-gray-800 text-white font-semibold' : 'text-gray-300' }} group/item"
                   title="Berita">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <span class="opacity-0 md:opacity-100 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                        Berita
                    </span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center gap-3 px-3 py-3 mb-1 rounded-lg transition-all duration-200 hover:bg-gray-700 dark:hover:bg-gray-800 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700 dark:bg-gray-800 text-white font-semibold' : 'text-gray-300' }} group/item"
                   title="Kategori">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span class="opacity-0 md:opacity-100 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                        Kategori
                    </span>
                </a>

                <div class="border-t border-gray-700 dark:border-gray-800 mt-4 pt-4">
                    <a href="{{ route('news.index') }}"
                       class="flex items-center gap-3 px-3 py-3 mb-1 rounded-lg transition-all duration-200 hover:bg-gray-700 dark:hover:bg-gray-800 text-gray-300 group/item">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"></path>
                        </svg>
                        <span class="opacity-0 md:opacity-100 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                            Lihat Website
                        </span>
                        <svg class="w-4 h-4 ml-auto opacity-0 md:opacity-100 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 ml-16 md:ml-0">
            <!-- Top Header -->
            <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 dark-transition">
                <div class="flex items-center justify-between px-4 md:px-6 py-4">
                    <!-- Page Title -->
                    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 dark:text-white dark-transition">
                        @yield('header', 'Dashboard')
                    </h1>

                    <!-- User Menu -->
                    <div class="flex items-center space-x-4">
                        <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition-all duration-200">
                            <!-- Sun icon (shown in dark mode) -->
                            <svg id="sun-icon"
                                class="h-5 w-5 hidden dark:block text-gray-600 dark:text-gray-300 stroke-current"
                                viewBox="0 0 24 24" fill="none">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <!-- Moon icon (shown in light mode) -->
                            <svg id="moon-icon"
                                class="h-5 w-5 dark:hidden text-gray-00 dark:text-gray-300 stroke-current"
                                viewBox="0 0 24 24" fill="none">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </button>
         
                        @php
                            $name = Auth::user()->name ?? 'User';
                            $initials = collect(explode(' ', $name))->map(fn($n) => strtoupper($n[0]))->take(2)->implode('');
                        @endphp
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                    class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ $initials }}
                            </button>

                        <!-- Dropdown -->
                        <div x-show="open" x-transition @click.away="open = false"
                           class="absolute right-0 z-50 mt-2 w-64 origin-top-right rounded-lg bg-white shadow-xl ring-1 ring-black ring-opacity-5 p-4"
                            style="display: none;">

                            <!-- User info -->
                            <div class="flex items-center space-x-4 border-b border-gray-200 mb-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}"
                                    alt="Profile picture"
                                    class="w-14 h-14 rounded-full object-cover bg-gray-100">
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                                    
                                    <!-- Role badge -->
                                    <div class="mt-1 inline-flex items-center gap-1 px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded-full">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                        </svg>
                                        <span>{{ auth()->user()->role->name ?? 'User' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Settings Link -->
                            @if(Route::has('profile.settings'))
                                <a href="{{ route('profile.settings') }}"
                                class="flex items-center justify-between pl-3 pr-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                    <span class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        Settings
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                                    </svg>
                                </a>
                            @else
                                <div class="flex items-center justify-between pl-3 pr-4 py-2 text-sm text-gray-400 cursor-not-allowed rounded bg-gray-100">
                                    <span class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" />
                                        </svg>
                                        Settings (belum tersedia)
                                    </span>
                                </div>
                            @endif

                            <!-- Sign out -->
                            <form method="POST" action="/logout" class="mt-2">
                                @csrf
                                <button type="submit"
                                        class="flex items-center gap-2 w-full text-left pl-3 pr-4 py-2 text-sm text-gray-700 hover:bg-red-50 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                                    </svg>
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 p-4 md:p-6 overflow-auto dark-transition">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 px-4 py-3 rounded-lg mb-6 flex items-center dark-transition">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 px-4 py-3 rounded-lg mb-6 flex items-center dark-transition">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 px-4 py-3 rounded-lg mb-6 dark-transition">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <strong>Terjadi kesalahan:</strong>
                        </div>
                        <ul class="list-disc list-inside space-y-1 ml-7">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Main Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const themeToggle = document.getElementById('theme-toggle');
            const html = document.documentElement;
            let hoverTimeout;

            function setTheme(isDark) {
                if (isDark) {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            }

            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                setTheme(true);
            } else {
                setTheme(false);
            }

            themeToggle.addEventListener('click', function() {
                const isDark = html.classList.contains('dark');
                setTheme(!isDark);
            });

            sidebar.addEventListener('mouseenter', function() {
                clearTimeout(hoverTimeout);
                if (window.innerWidth < 768) {
                    this.classList.add('hover:w-64');
                }
            });

            sidebar.addEventListener('mouseleave', function() {
                if (window.innerWidth < 768) {
                    hoverTimeout = setTimeout(() => {
                        this.classList.remove('hover:w-64');
                    }, 300);
                }
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('hover:w-64');
                }
            });

            const closeSidebarButton = document.getElementById('close-sidebar');
            if (closeSidebarButton) {
                closeSidebarButton.addEventListener('click', function() {
                    sidebar.classList.remove('hover:w-64');
                });
            }
        });
    </script>
</body>
</html>