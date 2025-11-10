@extends('layouts.guest')

@section('title', 'Tentang Kami')

@push('styles')
    @vite(['resources/css/customer/about-us.css'])
@endpush

@section('content')
<div class="bg-page">
    <div class="container py-5 ">
        
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-dark">Tentang <span class="text-pink">Locco</span></h2>
            <p class="text-muted about-description mx-auto">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
            </p>
        </div>

        <div class="text-center mb-5" data-aos="fade-up">
            <h4 class="fw-bold mb-4">Mengapa Memilih Kami?</h4>
        </div>

    </div>
</div>

@endsection
