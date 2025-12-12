@extends('layouts.guest')

@section('title', 'Tentang Kami')

@section('content')
<div class="bg-bgPage">

    <x-customer.hero-section :imageUrl="asset('assets/images/hero-florist.jpg')" brightness="0.6">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 font-serif">
            Tentang Locco
        </h1>
        <p class="text-lg md:text-xl max-w-xl text-gray-200 leading-relaxed">
            Kisah Kami & Dedikasi untuk Keindahan
        </p>
    </x-customer.hero-section>

    <div class="container mx-auto px-4 py-16 max-w-7xl">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-20" data-aos="fade-up">

            <div>
                <h2 class="text-4xl font-bold font-serif mb-6">Cerita Kami</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae
                    malesuada lacus, vel elementum massa. Integer sit amet sapien non
                    justo finibus tempor.
                </p>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Nulla facilisi. Praesent id dui nec justo interdum maximus. Proin
                    elementum, ante in volutpat sodales, urna lacus commodo nisi, vel
                    ullamcorper lorem arcu vitae erat.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    Vivamus ultricies, tortor vitae tristique fermentum, ligula lorem
                    tincidunt ipsum, id luctus leo sapien eget turpis.
                </p>
            </div>

            <div class="flex justify-center md:justify-end">
                <img src="{{ asset('assets/images/team-1.jpg') }}"
                     class="rounded-2xl shadow-lg w-[340px] h-[420px] object-cover"
                     alt="Cerita Locco">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
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
        <x-customer.cta-card 
                title="Siap Membuat Momen Anda Berkesan?"
                text="Hubungi kami sekarang dan wujudkan rangkaian bunga impian Anda"
                buttonText="Hubungi Kami"
                buttonLink="https://wa.me/6281234567890"
                buttonIcon="bi bi-whatsapp"
            />
    </div>
</div>
@endsection
