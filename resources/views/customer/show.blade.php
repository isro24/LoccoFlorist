
@extends('layouts.guest')

@section('title', $product->name)

@push('styles')
    @vite(['resources/css/customer/show.css'])
@endpush

@section('content')
<div class="bg-page py-5">
    <div class="container px-4 px-md-5">
        <div class="mb-4">
            <x-breadcrumbs :items="Breadcrumbs::generate('product.show', $product)" />
        </div>

        <div class="row align-items-start justify-content-center g-5" data-aos="fade-up">
            <div class="col-md-5">
                <div class="overflow-hidden rounded-2 shadow-sm position-relative zoom-container mb-2">
                    <img 
                        src="{{ asset('storage/' . $product->image) }}" 
                        alt="{{ $product->name }}" 
                        class="img-fluid zoom-image">
                </div>
            </div>

            <div class="col-lg-7">
                <h2 class="fw-bold mb-2">{{ $product->name }}</h2>
                <p class="text-muted mb-1">{{ $product->category->name ?? 'Tanpa Kategori' }}</p>
                <h4 class="fw-semibold text-pink mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>

                <ul class="nav nav-tabs product-tabs mb-4" id="productTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description">Deskripsi</button>
                    </li>
                </ul>

                <div class="tab-content" id="productTabsContent">
                    <div class="tab-pane fade show active" id="description">
                        <p class="text-muted text-justify lh-lg">
                            {!! nl2br(e($product->description)) !!}
                        </p>
                    </div>

                <div class="mt-4">
                    <button type="button" 
                            class="btn btn-lg btn-whatsapp rounded-pill px-5 shadow-sm text-white" 
                            data-bs-toggle="modal" 
                            data-bs-target="#orderModal">
                        <i class="bi bi-whatsapp me-2"></i> Pesan via WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@if($relatedProducts->isNotEmpty())
<div class="container my-5">
    <h4 class="fw-bold text-start text-pink mb-4">Produk Terkait</h4>
    <div class="row g-4">
        @foreach($relatedProducts as $index => $related)
            <x-customer.product-card :product="$related" :delay="($index * 50)" />
        @endforeach
    </div>
</div>
@endif

@include('customer.partials.order-modal', ['product' => $product])

@push('scripts')
    <script src="{{ Vite::asset('resources/js/customer/show.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&callback=initMap" async defer></script>  
@endpush

@endsection
