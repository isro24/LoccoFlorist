@extends('layouts.guest')

@section('title', 'Katalog Produk')

@push('styles')
    @vite(['resources/css/customer/catalog.css'])
@endpush

@section('content')
<div class="bg-page">
    <div class="container py-5">

        <!-- <section class="hero-section position-relative text-white">
            <img 
                src="{{ asset('assets/images/bgHome.png') }}" 
                alt="Hero Background" 
                class="bg-hero position-absolute top-0 start-0 w-100 h-100 object-fit-cover" 
                loading="lazy"
                style="object-fit: cover; filter: brightness(0.6);"
            >

            <div class="container position-relative py-5">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">Locco</h1>
                        <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
                        </p>
                        <a href="{{ route('product.catalog') }}" 
                        class="btn btn-pink-gradient btn-lg rounded-pill shadow-sm" 
                        data-aos="fade-up" data-aos-delay="200">
                            Lihat Produk
                        </a>
                    </div>
                </div>
            </div>
        </section> -->
        <div class="text-center mb-4" data-aos="fade-up">
            <div class="mx-auto" style="max-width: 600px;">
                <x-customer.search-bar 
                    :action="route('product.catalog')" 
                    :value="request('search')" 
                    placeholder="Cari produk..." 
                />
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2" data-aos="fade-up">

            <div class="rounded-pill px-4 py-2">
                <span class="text-muted small">
                    Menampilkan 
                    <strong class="text-dark">{{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}</strong> 
                    dari <strong class="text-dark">{{ $products->total() }}</strong> produk
                </span>
            </div>

            <button class="btn btn-outline-dark d-md-none rounded-pill px-4 py-2" 
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#filterSidebar">
                <i class="bi bi-funnel"></i> Filter
            </button>

            <form action="{{ route('product.catalog') }}" method="GET" 
                class="d-none d-md-flex align-items-center gap-2">
                <input type="hidden" name="search" value="{{ request('search') }}">

                <x-customer.product-filters :categories="$categories" layout="desktop" />

            </form>
        </div>

        <div class="offcanvas offcanvas-end floral-offcanvas" tabindex="-1" id="filterSidebar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-white">Filter Produk</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
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
            <div class="row g-4">
                @foreach($products as $index => $product)
                    <x-customer.product-card :product="$product" :delay="($index % 3) * 50" />
                @endforeach
            </div>

            @if($products->hasPages())
                <div class="mt-5 d-flex justify-content-center" data-aos="fade-up">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @endif
        @endif
    </div>
</div>

@push('scripts')
    @vite('resources/js/customer/catalog.js')
@endpush
@endsection
