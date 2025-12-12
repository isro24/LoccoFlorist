<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  Color address bar / status bar mobile -->
    <meta name="theme-color" content="#ff4d94">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <title>@yield('title', 'Locco Florist')</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 16 16%22><text y=%2212%22 font-size=%2212%22>🌸</text></svg>">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

</head>
<body class="pb-[65px] lg:pb-0">

    @include('layouts.partials.navigation')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @include('layouts.partials.footnavbar')

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&callback=initMap" async defer></script> -->

    @stack('scripts')

    <a href="https://wa.me/6281234567890"
    target="_blank"
    class="fixed bottom-25 md:bottom-6 right-5 z-50 bg-[#25D366] text-white 
            shadow-lg rounded-full flex items-center
            transition-all duration-300 hover:scale-105 hover:bg-[#1EBE59]">

        <div class="w-14 h-14 flex items-center justify-center text-3xl">
            <i class="bi bi-whatsapp"></i>
        </div>

        <span class="hidden md:inline-block pr-5 font-medium font-serif text-xl">
            Hubungi Kami
        </span>
    </a>


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
</body>
</html>