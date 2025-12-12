<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 16 16%22><text y=%2212%22 font-size=%2212%22>🌸</text></svg>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/admin-layouts.js'])
    @stack('styles')
</head>
<body class="bg-linier-to-br from-gray-50 via-pink-50 to-rose-50 font-poppins min-h-screen">
    <div id="admin-wrapper" class="flex min-h-screen">
        <nav id="sidebar"
            class="fixed top-0 left-0 z-50 h-screen w-72 flex flex-col p-6 text-white bg-sidebarColor
            shadow-2xl transition-all duration-500 ease-in-out overflow-y-auto
            -translate-x-full lg:translate-x-0">

            <button id="close-sidebar-btn"
                class="lg:hidden absolute top-4 right-4 text-white text-xl hover:bg-white/20 
                    p-2 rounded-full backdrop-blur-md hidden">
                <i class="bi bi-x-lg"></i>
            </button>

            <div class="flex items-center justify-center">
                <a href="{{ route('admin.dashboard.index') }}" class="flex items-center gap-2">
                    <img src="{{ asset('assets/images/logoNoBg.png') }}" alt="Locco Logo" class="h-16 w-auto rounded-xl bg-transparent p-2">
                </a>
            </div>
        <ul class="flex flex-col space-y-3 flex-1 mt-2">
            <li>
                <x-admin.sidebar-item href="{{ route('admin.dashboard.index') }}" icon="bi-speedometer2" label="Dashboard" :active="request()->routeIs('admin.dashboard.*')" />
            </li>
            <li>
                <x-admin.sidebar-item href="{{ route('admin.product.index') }}" icon="bi-box-seam" label="Produk" :active="request()->routeIs('admin.product.*')" />
            </li>
            <li>
                <x-admin.sidebar-item href="{{ route('admin.category.index') }}" icon="bi-grid" label="Kategori" :active="request()->routeIs('admin.category.*')" />
            </li>
            <li>
                <x-admin.sidebar-item href="{{ route('home') }}" icon="bi-globe" label="Halaman Publik" target="_blank" />
            </li>
            <li class="flex-1"></li>
            <li>
                <x-admin.sidebar-item href="#" icon="bi-box-arrow-right" label="Logout" class="logout-btn" />
            </li>
        </ul>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">@csrf</form>
       </nav>
        <div id="main-content-wrapper" class="flex flex-col flex-1 lg:ml-72 transition-all duration-500">
            <nav class="bg-white/80 backdrop-blur-xl sticky top-0 z-40 shadow-lg border-b border-pink-100 h-18 flex items-center px-10 justify-between">
                <div class="flex items-center gap-6">
                    <button id="sidebar-toggle" class="p-3 rounded-xl hover:bg-pink-50 transition-all duration-300 hover:scale-110 lg:hidden cursor-pointer">
                        <i class="bi bi-list text-2xl text-pink-700"></i>
                    </button>
                </div>
            <div class="flex items-center gap-4 ml-auto">
                <form action="{{ route('admin.product.index') }}" method="GET" class="relative hidden lg:block transition-all duration-300">
                    <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Cari produk..."
                        class="h-11 w-56 md:w-64 rounded-2xl pl-5 pr-12 border border-pink-100 focus:ring-1 focus:ring-pink-400 focus:outline-none transition-all duration-300 bg-white/50 backdrop-blur-sm placeholder:text-gray-400">
                    <div class="absolute top-1/2 right-3 transform -translate-y-1/2 flex items-center gap-2">
                        <button type="button" id="clearSearch" class="hidden p-1 hover:bg-gray-100 rounded-full transition-all duration-200">
                            <i class="bi bi-x-lg text-gray-400 text-sm"></i>
                        </button>
                            <div class="w-px h-5 bg-gray-300"></div>
                        <button type="submit" class="p-1 hover:bg-pink-50 rounded-full transition-all duration-200">
                    <i class="bi bi-search text-pink-600 cursor-pointer"></i>
                        </button>
                    </div>
                </form>
                <div class="relative block lg:hidden">
                    <button id="mobile-search-btn" class="p-3 rounded-xl hover:bg-pink-50 transition-all duration-300 cursor-pointer">
                        <i class="bi bi-search text-2xl text-pink-700"></i>
                    </button>
                    <div id="mobile-search-dropdown" class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 opacity-0 invisible transform -translate-y-2 transition-all duration-300">
                        <form id="mobileSearchForm" action="{{ route('admin.product.index') }}" method="GET" class="p-4">
                            <div class="relative">
                                <input type="text" name="search" id="mobileSearchInput" value="{{ request('search') }}" placeholder="Cari produk..."
                                    class="w-full h-11 rounded-2xl pl-5 pr-12 border border-pink-100 focus:ring-1 focus:ring-pink-400 focus:outline-none transition-all duration-300 bg-white placeholder:text-gray-400">
                                <button type="button" id="mobileClearSearch" class="hidden absolute top-1/2 right-3 transform -translate-y-1/2 p-1 hover:bg-gray-100 rounded-full transition-all duration-200">
                                    <i class="bi bi-x-lg text-gray-400 text-sm"></i>
                                </button>
                            </div>
                            <button type="submit" class="mt-3 w-full p-2 rounded-xl bg-pink-50 text-pink-600 hover:bg-pink-100">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </form>
                    </div>
                </div>
                @auth
                <div class="relative group">
                    <button class="flex items-center gap-3 p-2 rounded-2xl hover:bg-pink-50 transition-all duration-300 cursor-pointer">
                        <div class="w-11 h-11 flex items-center justify-center rounded-xl bg-pinkBg text-white font-bold text-lg shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="hidden lg:block text-left">
                            <p class="font-semibold text-sm text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Admin</p>
                        </div>
                        <i class="bi bi-chevron-down text-gray-400 text-sm hidden lg:block group-hover:rotate-180 transition-transform duration-300"></i>
                    </button>
                      <div class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 -translate-y-2">
                          <div class="p-4 border-b border-gray-100">
                              <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                              <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                          </div>
                      </div>
                </div>
                @endauth
          </div>
        </nav>
        <main class="p-6 flex-1 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
            <footer class="bg-white/50 backdrop-blur-xl border-t border-pink-100 p-6">
                <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-center gap-4">
                    <p class="text-sm text-gray-600">
                        &copy; {{ date('Y') }} <strong class="bg-pinkBg bg-clip-text text-transparent">Locco Florist</strong>. All Rights Reserved.
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html>
