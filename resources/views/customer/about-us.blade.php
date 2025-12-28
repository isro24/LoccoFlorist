@extends('layouts.guest')

@section('title', 'Tentang Kami')

@section('content')
<div class="bg-bgPage min-h-screen">

    <x-customer.hero-section :imageUrl="asset('assets/images/Slide2.jpg')" brightness="0.5">
        <div class="flex flex-col items-center justify-center text-center h-screen px-4 md:px-8 lg:px-16" data-aos="fade">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-4 font-sans text-white drop-shadow-lg">
                Tentang Locco
            </h1>
            <p class="text-lg md:text-2xl lg:text-3xl font-bold max-w-2xl font-serif text-gray-200 leading-relaxed drop-shadow-md">
                Kisah Kami & Dedikasi untuk Keindahan
            </p>
            <a href="#about" 
            class="mt-8 inline-block bg-pinkButton text-white font-semibold rounded-full py-3 px-8 shadow-lg font-serif hover:bg-pink-600 transition duration-300">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </x-customer.hero-section>

    <div id="about" class="container mx-auto px-4 py-16 max-w-7xl">

        <div class="bg-white rounded-[2.5rem] shadow-xl p-8 md:p-12 mb-20 flex flex-col md:flex-row gap-12 items-center border border-pink-50" data-aos="fade-up">
            <div class="w-full md:w-1/2 order-2 md:order-1">
                <h3 class="text-pinkButton font-bold uppercase tracking-wider text-sm mb-2">Siapa Kami?</h3>
                <h2 class="text-3xl md:text-4xl font-bold font-serif text-gray-800 mb-6">Lebih dari Sekadar Toko Bunga</h2>
                <div class="text-gray-600 space-y-4 leading-relaxed text-justify">
                    <p>
                        Berawal dari hobi merangkai bunga di garasi rumah, <b>Locco Florist</b> kini tumbuh menjadi partner setia momen spesial Anda di Yogyakarta.
                    </p>
                    <p>
                        Kami adalah <b>home-based florist</b> (usaha rumahan). Meskipun tidak memiliki toko display yang besar, setiap tangkai bunga kami pilih dan rangkai dengan penuh cinta dan standar kualitas tinggi.
                    </p>
                    <p>
                        Konsep "Workshop Rumahan" memungkinkan kami menekan biaya operasional toko, sehingga kami bisa memberikan <b>harga yang lebih bersahabat</b> kepada Anda tanpa mengurangi kualitas bunga sedikitpun.
                    </p>
                </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-center order-1 md:order-2">
                <div class="relative">
                    <div class="absolute inset-0 bg-pinkButton rounded-3xl rotate-6 opacity-20"></div>
                    <img src="{{ asset('assets/images/Slide2.jpg') }}" alt="Locco Workshop" 
                         class="relative rounded-3xl shadow-lg w-full max-w-sm h-auto object-cover border-4 border-white rotate-[-2deg] hover:rotate-0 transition duration-500">
                </div>
            </div>
        </div>

        <div class="py-16 bg-white backdrop-blur-sm rounded-[3rem] mb-20 border border-pink-100/50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-pink-500 font-semibold tracking-widest uppercase text-sm mb-2">Filosofi Kami</h2>
                    <h3 class="text-3xl md:text-4xl font-bold font-serif text-gray-800">Visi & Misi Locco</h3>
                    <div class="w-24 h-1 bg-pinkButton mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="relative p-8 bg-white rounded-3xl shadow-sm border border-gray-100 group hover:-translate-y-2 transition-transform duration-300" data-aos="fade-right">
                        <div class="absolute -top-6 left-8 bg-pinkButton text-white p-4 rounded-2xl shadow-lg shadow-pink-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold font-serif mt-6 mb-4 text-gray-800">Visi Kami</h4>
                        <p class="text-gray-600 leading-relaxed text-lg italic">
                            "Menjadi pionir keindahan melalui rangkaian bunga artificial yang menghidupkan setiap sudut ruangan dan mengabadikan setiap momen berharga dengan sentuhan seni yang abadi."
                        </p>
                    </div>

                    <div class="relative p-8 bg-white rounded-3xl shadow-sm border border-gray-100 group hover:-translate-y-2 transition-transform duration-300" data-aos="fade-left">
                        <div class="absolute -top-6 left-8 bg-purple-500 text-white p-4 rounded-2xl shadow-lg shadow-purple-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold font-serif mt-6 mb-4 text-gray-800">Misi Kami</h4>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <div class="bg-pink-100 rounded-full p-1 mt-1"><i class="bi bi-check text-pink-600 text-sm"></i></div>
                                <p class="text-gray-600">Menyediakan produk bunga artificial dengan kualitas material premium.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-pink-100 rounded-full p-1 mt-1"><i class="bi bi-check text-pink-600 text-sm"></i></div>
                                <p class="text-gray-600">Memberikan kemudahan kustomisasi desain sesuai karakter pelanggan.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-pink-100 rounded-full p-1 mt-1"><i class="bi bi-check text-pink-600 text-sm"></i></div>
                                <p class="text-gray-600">Menghadirkan pelayanan yang hangat, responsif, dan profesional.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-10" data-aos="fade-up">
            <h3 class="text-2xl font-bold font-serif text-gray-800">Kenapa Memilih Kami?</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-20">
            <x-customer.feature-card delay="0" title="Bunga Dekorasi" description="Rangkaian bunga artificial berkualitas dan cantik."
                icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-pink-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364-.614-1.591 1.591M21 12h-2.25m-.614 6.364-1.591-1.591M12 21v-2.25m-6.364.614 1.591-1.591M3 12h2.25m.614-6.364L7.455 7.227M12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z" /></svg>' />
            <x-customer.feature-card delay="100" title="Layanan Pengiriman" description="Pengiriman aman di wilayah Jogja."
                icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-blue-500"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.5l1.5-3a1.5 1.5 0 011.342-.75h10.816a1.5 1.5 0 011.342.75l1.5 3m-16.5 0h16.5m-16.5 0v9a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-9m-3 12a1.5 1.5 0 11-3 0m-9 0a1.5 1.5 0 113 0" /></svg>' />
            <x-customer.feature-card delay="200" title="Custom Produk" description="Sesuaikan produk sesuai keinginan Anda."
                icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-purple-500"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5l6.75-6.75M3 21l6.75-6.75M14.25 3l6 6-6 6-6-6 6-6z" /></svg>' />
        </div>

        <div id="workshop" class="bg-white rounded-[2.5rem] shadow-md overflow-hidden border border-none" data-aos="zoom-in">
            <div class="grid grid-cols-1 md:grid-cols-3">
                
                <div class="p-8 md:p-12 bg-white flex flex-col justify-center">
                    <div class="inline-block bg-white text-pinkButton text-xs font-bold px-3 py-1 rounded-full w-fit mb-4 shadow-sm">
                        📍 Lokasi Workshop
                    </div>
                    <h3 class="text-3xl font-bold font-serif text-gray-900 mb-6">Hubungi Kami</h3>
                    
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-full bg-white text-pinkButton flex items-center justify-center shadow-sm shrink-0">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800">Alamat</h5>
                                <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                                    Gonjen, Tamantirto, Kec. Kasihan, Kabupaten Bantul, DIY 55184.
                                    <br><span class="text-xs text-pink-500 font-medium bg-pink-100 px-2 py-0.5 rounded mt-1 inline-block">(Mohon konfirmasi sebelum datang)</span>
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-full bg-white text-pinkButton flex items-center justify-center shadow-sm shrink-0">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800">Jam Operasional</h5>
                                <p class="text-sm text-gray-600 mt-1">
                                    Senin - Minggu<br>
                                    08.00 - 23.00 WIB
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-full bg-white text-pinkButton flex items-center justify-center shadow-sm shrink-0">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800">WhatsApp</h5>
                                <p class="text-sm text-gray-600 mt-1 hover:text-pinkButton transition">
                                    <a href="https://wa.me/628988351393" target="_blank">+62 891-2345-6789</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-2 h-[400px] md:h-auto relative bg-gray-200 group">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4696.26043343996!2d110.32969139192417!3d-7.821442399423763!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a57005bbf0501%3A0xd41f2cd4269c96e0!2sLocco%20Florist!5e1!3m2!1sen!2sid!4v1765993170883!5m2!1sen!2sid"                         
                        width="100%" 
                        height="100%"  
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>       
<a 
                    href="https://www.google.com/maps/search/?api=1&query=Locco+Florist"
                    target="_blank"
                    class="absolute top-6 right-5 bg-white px-5 py-3 rounded-full shadow-lg font-bold hover:bg-pinkButton hover:text-white transition flex items-center gap-2 text-sm z-10">
                        <i class="bi bi-map-fill"></i> Buka di Google Maps
                    </a>

                </div>
            </div>
        </div>
        <div class="mt-20">
            <x-customer.cta-card 
                title="Siap Membuat Momen Anda Berkesan?"
                text="Hubungi kami sekarang dan wujudkan rangkaian bunga impian Anda"
                buttonText="Hubungi Kami"
                buttonLink="https://wa.me/6281234567890"
                buttonIcon="bi bi-whatsapp"
            />
        </div>

    </div>
</div>
@push('scripts')
    @vite('resources/js/customer/about-us.js')
@endpush
@endsection