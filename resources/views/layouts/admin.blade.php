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
                            <svg id="sun-icon" class="h-5 w-5 hidden dark:block text-gray-600 dark:text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>  
                            <!-- Moon icon (shown in light mode) -->
                            <svg id="moon-icon" class="h-5 w-5 dark:hidden text-gray-600 dark:text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </button>
                        
                        <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center text-gray-700 dark:text-gray-200 dark-transition">
                            <span class="text-xs font-medium">AU</span>
                        </div>
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