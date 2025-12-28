@extends('layouts.guest')

@section('title', 'Beranda')

@section('content')
<div class="bg-bgPage">

    <div class="swiper myHeroSwiper h-[80vh] md:h-[85vh] relative">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="w-full h-full bg-cover bg-center"
                    style="background-image: url('{{ asset('assets/images/Slide1.jpg') }}'); filter: brightness(0.5);">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="w-full h-full bg-cover bg-center"
                    style="background-image: url('{{ asset('assets/images/Slide2.jpg') }}'); filter: brightness(0.5);">
                </div>
            </div>
        </div>

        <div class="swiper-pagination bottom-5!"></div>

        <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-white px-4" data-aos="fade-up">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-4 font-sans text-center">
                Locco Florist
            </h1>
            <h1 class="text-lg md:text-2xl lg:text-3xl font-bold mb-4 font-serif text-center">
                Rangkaian Bunga Eksklusif untuk Setiap Momen Spesial
            </h1>
            <a href="{{ route('product.catalog') }}" 
               class="inline-block font-serif text-xl py-3 px-8 rounded-full shadow-sm bg-pinkBg text-white 
                      transition-all duration-100 hover:scale-105">
                Jelajahi Koleksi Kami
            </a>
        </div>
    </div>

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
            <x-customer.feature-card delay="0" title="Bunga Dekorasi" description="Rangkaian bunga artificial berkualitas dan cantik."
                icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-pink-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364-.614-1.591 1.591M21 12h-2.25m-.614 6.364-1.591-1.591M12 21v-2.25m-6.364.614 1.591-1.591M3 12h2.25m.614-6.364L7.455 7.227M12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z" /></svg>' />
            <x-customer.feature-card delay="100" title="Layanan Pengiriman" description="Pengiriman aman di wilayah Jogja."
                icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-blue-500"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.5l1.5-3a1.5 1.5 0 011.342-.75h10.816a1.5 1.5 0 011.342.75l1.5 3m-16.5 0h16.5m-16.5 0v9a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-9m-3 12a1.5 1.5 0 11-3 0m-9 0a1.5 1.5 0 113 0" /></svg>' />
            <x-customer.feature-card delay="200" title="Custom Produk" description="Sesuaikan produk sesuai keinginan Anda."
                icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-purple-500"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5l6.75-6.75M3 21l6.75-6.75M14.25 3l6 6-6 6-6-6 6-6z" /></svg>' />
        </div>

        <div class="w-full mb-20">
            <div class="flex justify-between items-center mb-6 font-serif " data-aos="fade-right">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-1 flex items-center gap-2">
                        <i class="bi bi-award-fill text-pinkBg"></i>
                        <span class="text-pinkBg">Best</span> Seller
                    </h2>
                    <p class="text-gray-500 text-sm mt-1">Produk terfavorit yang paling banyak dipesan.</p>
                </div>
                <a href="{{ route('product.catalog') }}" class="hidden md:inline-block rounded-full border border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white transition-colors py-2 px-5 text-xl">
                    Lihat Semua <i class="bi bi-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($products as $index => $product)
                    <x-customer.product-card :product="$product" :delay="$index * 100" />
                @empty
                    <div class="col-span-full">
                        <x-customer.empty-state 
                            title="Belum Ada Produk Best Seller"
                            message="Nantikan koleksi terbaik kami segera hadir!"
                            icon="🏆"
                            buttonText="Lihat Katalog Lainnya"
                            :buttonLink="route('product.catalog')"
                        />
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-8 md:hidden" data-aos="fade-up">
                <a href="{{ route('product.catalog') }}" class="inline-block bg-gray-900 text-white hover:bg-gray-800 rounded-full w-full max-w-[350px] py-3 px-5 transition-colors font-serif text-xl leading-none">
                    Lihat Semua Produk <i class="bi bi-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="bg-pink-50 rounded-[2.5rem] p-8 md:p-12 mb-20 text-center" data-aos="zoom-in">
            <h3 class="text-2xl md:text-3xl font-bold font-serif text-gray-900 mb-2">Apa Kata Mereka?</h3>
            <p class="text-gray-500 mb-8">Pengalaman pelanggan setia Locco Florist</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-pink-100 hover:shadow-md transition">
                    <div class="text-yellow-400 text-lg mb-3">★★★★★</div>
                    <p class="text-gray-600 italic mb-4 text-sm leading-relaxed">
                        "Bunganya fresh banget dan rangkaiannya rapi. Adminnya juga fast response pas aku tanya-tanya custom request."
                    </p>
                    <p class="font-bold text-gray-900 font-serif">- Kak Anisa, Jogja</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-pink-100 hover:shadow-md transition">
                    <div class="text-yellow-400 text-lg mb-3">★★★★★</div>
                    <p class="text-gray-600 italic mb-4 text-sm leading-relaxed">
                        "Pesen dadakan buat wisuda temen, untung Locco bisa gercep. Hasilnya bagus pol ga mengecewakan!"
                    </p>
                    <p class="font-bold text-gray-900 font-serif">- Mas Rizky, UMY</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-pink-100 hover:shadow-md transition">
                    <div class="text-yellow-400 text-lg mb-3">★★★★★</div>
                    <p class="text-gray-600 italic mb-4 text-sm leading-relaxed">
                        "Udah langganan 3x disini buat kirim bunga papan. Selalu ontime dan fotonya real pict."
                    </p>
                    <p class="font-bold text-gray-900 font-serif">- Ibu Ratna, Sleman</p>
                </div>
            </div>
        </div>

        <div class="mb-20 overflow-hidden">
            <div class="text-center mb-8" data-aos="fade-up">
                <h3 class="text-3xl font-bold font-serif text-gray-900">Galeri Locco</h3>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up">
                <div class="aspect-square rounded-2xl overflow-hidden relative group">
                    <img src="{{ asset('assets/images/galeri1.jpg') }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Galeri 1">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
                </div>
                <div class="aspect-square rounded-2xl overflow-hidden relative group md:mt-8">
                    <img src="{{ asset('assets/images/galeri2.jpg') }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Galeri 2">
                </div>
                <div class="aspect-square rounded-2xl overflow-hidden relative group">
                    <img src="{{ asset('assets/images/galeri3.jpg') }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Galeri 3">
                </div>
                <div class="aspect-square rounded-2xl overflow-hidden relative group md:mt-8">
                    <img src="{{ asset('assets/images/galeri4.jpg') }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Galeri 4">
                </div>
            </div>
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

@push('scripts')
    @vite('resources/js/customer/index.js')
@endpush
@endsection