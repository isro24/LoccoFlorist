@extends('layouts.guest')

@section('title', 'Katalog Produk')

@section('content')
<div class="bg-bgPage min-h-screen pb-20">
    
    <div class="pt-16 pb-10 text-center container mx-auto px-4" data-aos="fade-down">
        <h5 class="text-pink-500 font-bold tracking-widest uppercase text-sm mb-3">Locco Florist Collection</h5>
        <h1 class="text-4xl md:text-6xl font-extrabold font-serif text-gray-900 mb-4 leading-tight">
            Koleksi Kami
        </h1>
        <p class="text-gray-500 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed font-serif">
            Temukan bunga, papan ucapan, dan banner pilihan untuk setiap momen spesial Anda.
        </p>
    </div>

    <div class="container mx-auto px-4 max-w-7xl relative z-20">
        
        <div class="max-w-[650px] mx-auto mb-10" data-aos="fade-up">
            
            <div class="w-full">
                <x-customer.search-bar 
                    :action="route('product.catalog')" 
                    :value="request('search')" 
                    placeholder="Cari produk ..." 
                />
            </div>

            <div class="flex justify-end mt-3 md:hidden">
                <button class="flex items-center gap-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:text-pink-500 px-5 py-2 rounded-full transition-all shadow-sm"
                        type="button" 
                        id="openFilterSidebarBtn">
                    <i class="bi bi-funnel text-lg"></i>
                    <span class="text-sm font-medium">Filter</span>
                </button>
            </div>

        </div>

        <div class="hidden md:flex justify-end mb-8 border-b border-gray-200/50 pb-4">
             <form action="{{ route('product.catalog') }}" method="GET" class="flex items-center gap-3">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <span class="text-sm text-gray-400 font-medium uppercase tracking-wide">Filter:</span>
                <x-customer.product-filters :categories="$categories" layout="desktop" />
            </form>
        </div>

        @if($products->isEmpty())
            <div class="mt-12" data-aos="fade-up">
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
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
                @foreach($products as $index => $product)
                    <div class="transform transition duration-500 hover:-translate-y-2">
                        <x-customer.product-card :product="$product" :delay="($index % 4) * 100" />
                    </div>
                @endforeach
            </div>

            @if($products->hasPages())
                <div class="mt-16 flex justify-center" data-aos="fade-up">
                    {{ $products->links('pagination::tailwind') }}
                </div>
            @endif
        @endif
    </div>

    <div id="filterSidebarBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity duration-300"></div>
    <div id="filterSidebar" tabindex="-1" class="fixed top-0 right-0 z-50 h-full w-80 bg-white shadow-2xl transform transition-transform duration-300 translate-x-full">
        <div class="flex items-center justify-between bg-pinkButton text-white px-6 py-5">
            <h5 class="font-bold text-lg font-serif tracking-wide">Filter Produk</h5>
            <button type="button" id="closeFilterSidebarBtn" class="hover:bg-white/20 rounded-full p-1 transition">
                <i class="bi bi-x text-2xl"></i>
            </button>
        </div>
        <div class="p-6 h-[calc(100vh-80px)] overflow-y-auto">
            <form action="{{ route('product.catalog') }}" method="GET" class="space-y-6">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <x-customer.product-filters :categories="$categories" layout="mobile" />
                
                <button type="submit" class="w-full bg-pinkButton text-white font-bold py-3 rounded-xl mt-4 shadow-lg shadow-pink-200 hover:bg-pink-600 transition">
                    Terapkan Filter
                </button>
            </form>
        </div>
    </div>

</div>

@push('scripts')
    @vite('resources/js/customer/catalog.js')
@endpush
@endsection