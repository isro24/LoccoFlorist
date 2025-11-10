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

<body class="bg-gray-50 font-poppins min-h-screen">

  <div id="admin-wrapper" class="flex relative min-h-screen">

    <nav id="sidebar" class="fixed top-0 left-0 z-50 h-full w-64 flex flex-col p-3 text-white bg-sidebarColor shadow-lg transition-transform duration-300 lg:translate-x-0 -translate-x-full">
      <div class="sidebar-logo mb-3 text-center">
        <a href="{{ route('admin.dashboard.index') }}">
          <img src="{{ asset('assets/images/logo hd.png') }}" alt="Locco Logo" class="max-w-[140px] rounded bg-white p-1 transition-all">
        </a>
      </div>
      <hr class="border-white/50">

      <ul class="flex flex-col space-y-2 mt-2">
        <li>
          <a href="{{ route('admin.dashboard.index') }}"
             class="flex items-center gap-2 px-4 py-3 rounded-xl font-medium transition transform hover:scale-105 {{ request()->routeIs('admin.dashboard.*') ? 'bg-white/30 font-semibold shadow-md' : '' }}">
            <i class="bi bi-speedometer2 text-xl"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.product.index') }}"
             class="flex items-center gap-2 px-4 py-3 rounded-xl font-medium transition transform hover:scale-105 {{ request()->routeIs('admin.product.*') ? 'bg-white/30 font-semibold shadow-md' : '' }}">
            <i class="bi bi-box-seam text-xl"></i>
            <span>Produk</span>
          </a>
        </li>
        <li>
          <a href="{{ route('home') }}" target="_blank"
             class="flex items-center gap-2 px-4 py-3 rounded-xl font-medium transition transform hover:scale-105">
            <i class="bi bi-globe text-xl"></i>
            <span>Halaman Publik</span>
          </a>
        </li>
        <li>
          <a href="#" id="logout-btn"
             class="flex items-center gap-2 px-4 py-3 rounded-xl font-medium transition transform hover:scale-105">
            <i class="bi bi-box-arrow-right text-xl"></i>
            <span>Logout</span>
          </a>
        </li>
      </ul>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
    </nav>

    <button id="close-sidebar-btn"
            class="fixed left-64 top-1/2 transform -translate-y-1/2 z-50 bg-white text-pink-700 rounded-full shadow-md p-2 transition hover:bg-pink-700 hover:text-white hidden">
    <i class="bi bi-arrow-left-circle-fill text-xl"></i>
    </button>


    <div id="main-content-wrapper" class="flex flex-col flex-1 lg:ml-64 transition-all duration-300">

      <nav class="bg-white sticky top-0 z-40 shadow-sm border-b border-gray-200 h-14 flex items-center px-4 justify-between">
        <div class="flex items-center gap-3">
          <button id="sidebar-toggle" class="btn-outline-danger block lg:hidden cursor-pointer">
            <i class="bi bi-list text-xl"></i>
          </button>
        </div>

        <div class="flex items-center gap-3 ms-auto">
          <form action="{{ route('admin.product.index') }}" method="GET" class="relative grow md:grow-0 me-0 me-md-3">
            <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                   placeholder="Cari produk..."
                   class="h-10 min-w-[100px] max-w-[300px] rounded-full pl-3 pr-10 border focus:ring-1 focus:ring-pink-500 focus:outline-none">
            <div class="absolute top-1/2 right-2 transform -translate-y-1/2 flex items-center gap-2">
              <button type="button" id="clearSearch" class="hidden p-0">
                <i class="bi bi-x-lg text-gray-400"></i>
              </button>
              <div class="w-px h-6 bg-gray-300"></div>
              <button type="submit" class="p-0 cursor-pointer">
                <i class="bi bi-search text-gray-400"></i>
              </button>
            </div>
          </form>

          @auth
            <div class="relative">
              <button class="profile-initial-circle uppercase font-bold text-white w-10 h-10 flex items-center justify-center rounded-full bg-red-600" title="{{ Auth::user()->name }}">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
              </button>
              <ul class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md hidden group-hover:block">
                <li class="px-3 py-2">
                  <h6 class="font-semibold">{{ Auth::user()->name }}</h6>
                  <small class="text-gray-500">{{ Auth::user()->email }}</small>
                </li>
              </ul>
            </div>
          @endauth
        </div>
      </nav>

      <main class="p-4 grow">
        @yield('content')
      </main>

      <footer class="bg-white border-t border-gray-200 p-3 text-center">
        <p class="text-sm text-gray-400 mb-0">&copy; {{ date('Y') }} <strong>Locco Florist</strong>. All Rights Reserved.</p>
      </footer>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @stack('scripts')
</body>
</html>
