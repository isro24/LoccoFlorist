@extends('layouts.guest')

@section('title', 'Katalog Produk')

@section('content')
<div class="bg-bgPage">
    
    <div class="container mx-auto px-4 py-12 max-w-7xl">
        <div class="text-center mb-12 font-serif" data-aos="fade-up">
            <h2 class="text-5xl font-bold text-gray-900 mb-3">Kolekasi Kami</h2>
            <p class="text-gray-500 text-xl">
                Temukan bunga, papan ucapan, dan buket pilihan untuk setiap momen spesial Anda
            </p>
        </div>

        <div class="text-center mb-6" data-aos="fade-up">
            <div class="mx-auto max-w-[600px]">
                <x-customer.search-bar 
                    :action="route('product.catalog')" 
                    :value="request('search')" 
                    placeholder="Cari produk..." 
                />
            </div>
        </div>

        <div class="flex flex-wrap justify-end md:justify-between items-center mb-6 gap-2" data-aos="fade-up">
            <button class="md:hidden rounded-full border border-gray-900 px-6 py-2 text-gray-900 transition-colors hover:bg-gray-900 hover:text-white font-serif text-xl cursor-pointer" 
                    type="button" 
                    id="openFilterSidebarBtn">
                <i class="bi bi-funnel"></i> Filter
            </button>

            <form action="{{ route('product.catalog') }}" method="GET" 
                  class="hidden md:flex items-center gap-2">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <x-customer.product-filters :categories="$categories" layout="desktop" />
            </form>
        </div>
        
        <div id="filterSidebarBackdrop"
             class="fixed inset-0 bg-black/50 z-30 hidden opacity-0 transition-opacity duration-300 ease-in-out">
        </div>

        <div id="filterSidebar" tabindex="-1"
             class="fixed top-0 right-0 z-40 h-full w-full max-w-sm bg-white shadow-xl 
                    transform transition-transform duration-300 ease-in-out translate-x-full">
            
            <div class="flex items-center justify-between bg-[#ff4d94] text-white px-5 py-4">
                <h5 class="font-semibold text-white text-xl font-serif">Filter Produk</h5>
                <button type="button" id="closeFilterSidebarBtn" 
                        class="text-white opacity-100 focus:ring-0">
                    <i class="bi bi-x text-2xl cursor-pointer"></i>
                </button>
            </div>
            
            <div class="p-6">
                <form action="{{ route('product.catalog') }}" method="GET">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <x-customer.product-filters :categories="$categories" layout="mobile" />
                </form>
            </div>
        </div>

        @if($products->isEmpty())
            @if(request('search'))
                <x-customer.empty-state 
                    icon="🔍"
                    title="Tidak Ada Hasil untuk '{{ request('search') }}'"
                    message="Kami tidak menemukan produk yang cocok dengan kata kunci pencarian Anda."
                    buttonText="Kembali ke Katalog"
                    :buttonLink="route('product.catalog')" />
            @elseif(request('category'))
                <x-customer.empty-state 
                    icon="🌸"
                    title="Tidak Ada Produk di Kategori Ini"
                    :message="'Belum ada produk untuk kategori ' . request('category') . '.'"
                    buttonText="Lihat Semua Produk"
                    :buttonLink="route('product.catalog')" />
            @else
                <x-customer.empty-state 
                    icon="🌺"
                    title="Belum Ada Produk"
                    message="Belum ada produk yang ditambahkan ke katalog. Silakan cek kembali nanti." />
            @endif
        @else
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $index => $product)
                    <x-customer.product-card :product="$product" :delay="($index % 3) * 50" />
                @endforeach
            </div>

            @if($products->hasPages())
                <div class="mt-12 flex justify-center" data-aos="fade-up">
                    {{ $products->links('pagination::tailwind') }}
                </div>
            @endif
        @endif
    </div>
</div>

@push('scripts')
    @vite('resources/js/customer/catalog.js')
@endpush
@endsection