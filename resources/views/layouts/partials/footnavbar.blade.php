@php
    $mobileLinkClasses = "
        flex flex-col items-center justify-center py-2 px-2.5 
        text-[#2e2d2d] font-medium text-center font-serif text-xl
        transition-colors duration-200 ease-in-out 
        hover:text-pinkText
    ";
@endphp
<nav class="lg:hidden fixed bottom-0 left-0 w-full rounded-t-xl bg-white border-t border-black/10 z-1000">
    <ul class="flex w-full font-serif text-sm">

        <li class="flex-1">
            <a href="{{ route('home') }}"
               class="{{ $mobileLinkClasses }} {{ request()->routeIs('home') ? 'text-pinkText' : '' }}">
                <i class="bi bi-house-door text-xl mb-0.5"></i>
                <span>Beranda</span>
            </a>
        </li>

        <li class="flex-1">
            <a href="{{ route('product.catalog') }}"
               class="{{ $mobileLinkClasses }} {{ request()->routeIs('product.catalog') ? 'text-pinkText' : '' }}">
                <i class="bi bi-view-list text-xl mb-0.5"></i>
                <span>Katalog</span>
            </a>
        </li>

        <li class="flex-1">
            <a href="{{ route('ongkos.kirim') }}"
               class="{{ $mobileLinkClasses }} {{ request()->routeIs('ongkos.kirim') ? 'text-pinkText' : '' }}">
                <i class="bi bi-truck text-xl mb-0.5"></i>
                <span>Ongkir</span>
            </a>
        </li>

        <li class="flex-1">
            <a href="{{ route('about.us') }}"
               class="{{ $mobileLinkClasses }} {{ request()->routeIs('about.us') ? 'text-pinkText' : '' }}">
                <i class="bi bi-info-circle text-xl mb-0.5"></i>
                <span>Tentang</span>
            </a>
        </li>

    </ul>
</nav>
