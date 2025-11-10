@extends('layouts.guest')

@section('title', 'Beranda')

@push('styles')
    @vite(['resources/css/customer/index.css'])
@endpush

@section('content')
<div class="bg-page">

    <x-customer.hero-section :imageUrl="asset('assets/images/logo hd.png')" brightness="0.6">
        
        <h1 class="display-4 fw-bold mb-3" style="font-family: 'Times New Roman', Times, serif;">
            Rangkaian Bunga Eksklusif untuk Setiap Momen Spesial
        </h1>
        
        <p class="lead mb-3 fst-italic" style="font-family: 'Times New Roman', Times, serif; font-style: italic;">
            Menyampaikan Kasih & Makna Melalui Keindahan Alam
        </p>
        
        <p class="mb-4" style="font-family: 'Times New Roman', Times, serif;">
            Dari buket romantis hingga dekorasi elegan, setiap rangkaian dibuat dengan cinta, detail, dan sentuhan profesional untuk membuat momen Anda tak terlupakan.
        </p>
        
        <a href="{{ route('product.catalog') }}" 
        class="btn btn-gradient-pink btn-lg rounded-pill shadow-sm" 
        style="font-family: 'Times New Roman', Times, serif;">
            Jelajahi Koleksi Kami
        </a>
        
    </x-hero-section>

    <div class="container py-5">
        <x-customer.search-bar 
            :action="route('product.catalog')" 
            :value="request('search')" 
            placeholder="Cari produk..." 
        />

        <div class="row g-4 mb-5">
            
            <x-customer.feature-card 
                icon="🌺" 
                title="Bunga Segar" 
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit." 
                delay="0" 
            />
            
            <x-customer.feature-card 
                icon="🚚" 
                title="Pengiriman Cepat" 
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit." 
                delay="100" 
            />
            
            <x-customer.feature-card 
                icon="💝" 
                title="Custom Produk" 
                description="Sesuaikan dengan keinginan Anda." 
                delay="200" 
            />
            
        </div>

        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-right">
                <div>
                    <h2 class="fw-bold text-dark mb-1"><span class="text-pink"></span> Produk Pilihan</h2>
                    <p class="text-muted mb-0">Koleksi terbaru saat ini</p>
                </div>
                <a href="{{ route('product.catalog') }}" class="btn btn-outline-dark rounded-pill d-none d-md-inline-block">
                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                @forelse($products->take(4) as $index => $product)
                    <x-customer.product-card :product="$product" :delay="$index * 100" />
                @empty
                    <x-customer.empty-state 
                        title="Belum Ada Produk Tersedia"
                        message="Produk kami akan segera hadir. Nantikan update terbaru!"
                        icon="🌸"
                        buttonText="Pelajari Lebih Lanjut"
                        :buttonLink="route('about.us')"
                    />
                @endforelse
            </div>

            @if($products->count() > 0)
            <div class="text-center mt-4 d-md-none" data-aos="fade-up">
                <a href="{{ route('product.catalog') }}" class="btn btn-dark rounded-pill w-100 max-300px">
                    Lihat Semua Produk <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            @endif
        </div>

        @if($products->count() > 0)
            <x-customer.cta-card 
                title="Butuh Bantuan Memilih?"
                text="Tim kami siap membantu Anda menemukan bunga yang sempurna untuk setiap momen"
                buttonText="Hubungi Kami"
                buttonLink="https://wa.me/6281234567890"
                buttonIcon="bi bi-whatsapp"
            />
        @endif

    </div>
</div>
@endsection
