@extends('layouts.guest')

@section('title', 'Beranda')

@section('content')
<div class="bg-bgPage">

    <x-customer.hero-section :imageUrl="asset('assets/images/2.jpg')" brightness="0.6"
                             class="h-[60vh] md:h-[85vh]">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 font-serif">
            Rangkaian Bunga Eksklusif untuk Setiap Momen Spesial
        </h1>
        <a href="{{ route('product.catalog') }}" 
           class="inline-block font-serif text-xl py-3 px-8 rounded-full shadow-sm bg-pinkBg text-white border-none transition-all duration-100 ease-in-out hover:scale-105 hover:shadow-[0_4px_12px_rgba(0,0,0,0.2)]"
           >
            Jelajahi Koleksi Kami
        </a>
    </x-customer.hero-section>

    <div class="container mx-auto px-4 py-12 max-w-7xl">

        <div class="mx-auto max-w-[600px] pt-5">
            <x-customer.search-bar 
                :action="route('product.catalog')" 
                :value="request('search')" 
                placeholder="Cari produk..." 
            />
        </div>

        <div class="mb-6 text-center" data-aos="fade-up">
            <h3 class="text-xl md:text-2xl font-semibold text-gray-800">
                Keunggulan Kami
            </h3>
            <p class="text-gray-500 mt-2">
                Temukan keunggulan kami yang membuat setiap momen lebih berkesan
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <x-customer.feature-card 
                icon="🌺" 
                title="Bunga Dekorasi" 
                description="Rangkaian bunga artificial berkualitas yang cantik dan tahan lama." 
                delay="0" 
            />
            <x-customer.feature-card 
                icon="🚚" 
                title="Layanan Pengiriman" 
                description="Pengiriman aman di wilayah Jogja." 
                delay="100" 
            />
            <x-customer.feature-card 
                icon="💝" 
                title="Custom Produk" 
                description="Sesuaikan produk sesuai keinginan Anda." 
                delay="200" 
            />
        </div>


        <div class="mb-12">
            <div class="flex justify-between items-center mb-6 font-serif " data-aos="fade-right">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-1">
                        <span class="text-[#ff79b0]"></span> Produk Pilihan
                    </h2>
                </div>
                <a href="{{ route('product.catalog') }}" class="hidden md:inline-block rounded-full border border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white transition-colors py-2 px-5 text-xl">
                    Lihat Semua <i class="bi bi-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
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
                <div class="text-center mt-6 md:hidden" data-aos="fade-up">
                    <a href="{{ route('product.catalog') }}" class="inline-block bg-gray-900 text-white hover:bg-gray-800 rounded-full w-full max-w-[350px] py-3 px-5 transition-colors font-serif text-xl leading-none">
                        Lihat Semua Produk <i class="bi bi-arrow-right ml-1"></i>
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
