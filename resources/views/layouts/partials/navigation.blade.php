@php
    $commonLinkClasses = "relative px-3 py-2 rounded-full font-medium transition-colors transition-transform duration-300 ease-in-out
                          hover:text-[#ff4d94]/80 font-serif text-xl
                          after:content-[''] after:absolute after:bottom-0 after:left-0 after:right-0 after:mx-auto 
                          after:h-[3px] after:bg-[#ff4d94] after:w-0 after:rounded-full after:transition-all after:duration-300 ease-in-out
                          hover:after:w-full";

    $activeLinkClasses = "text-[#ff4d94] after:w-full";
    $inactiveLinkClasses = "text-gray-800";
@endphp

<header class="bg-white shadow-sm sticky lg:top-0 lg:z-50">
    <div class="container mx-auto px-6 md:px-12 h-[70px] flex items-center max-w-7xl justify-between">
        
        <div class="flex items-center ">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logoNoBg.png') }}" alt="Locco Florist Logo" 
                     class="h-[50px] w-auto object-contain transition-transform duration-300 ease-in-out hover:scale-105">
            </a>
        </div>

        <nav class="hidden lg:flex items-center gap-8 font-serif text-xl">
            <a class="{{ $commonLinkClasses }} {{ request()->routeIs('home') ? $activeLinkClasses : $inactiveLinkClasses }}" 
               href="{{ route('home') }}">Beranda</a>
            <a class="{{ $commonLinkClasses }} {{ request()->routeIs('product.catalog*') ? $activeLinkClasses : $inactiveLinkClasses }}" 
               href="{{ route('product.catalog') }}">Katalog</a>
            <a class="{{ $commonLinkClasses }} {{ request()->routeIs('ongkos.kirim') ? $activeLinkClasses : $inactiveLinkClasses }}" 
               href="{{ route('ongkos.kirim') }}">Ongkos Kirim</a>
            <a class="{{ $commonLinkClasses }} {{ request()->routeIs('about.us') ? $activeLinkClasses : $inactiveLinkClasses }}" 
               href="{{ route('about.us') }}">Tentang Kami</a>
        </nav>

    </div>
</header>
