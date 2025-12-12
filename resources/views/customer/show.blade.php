@extends('layouts.guest')

@section('title', $product->name)

@section('content')
<div class="bg-bgPage py-12">
    <div class="container mx-auto px-4 md:px-12 max-w-7xl">
        <div class="mb-6
            <x-breadcrumbs :items="Breadcrumbs::generate('product.show', $product)" />
        </div>

        <div class="flex flex-col md:flex-row justify-center gap-12" data-aos="fade-up">
            <div class="w-full md:w-5/12">
                <div class="zoom-container overflow-hidden rounded-lg shadow-sm relative group cursor-zoom-in mb-2">
                    <img 
                        src="{{ asset('storage/' . $product->image) }}" 
                        alt="{{ $product->name }}" 
                        class="zoom-image w-full h-auto transition-transform duration-300 ease-out hover:scale-125">
                </div>
            </div>

            <div class="w-full md:w-7/12">
                <h2 class="text-4xl font-bold mb-2 font-serif  text-pinkText">{{ $product->name }}</h2>
                <p class="text-xl text-gray-500 mb-1 font-serif">{{ $product->category->name ?? 'Tanpa Kategori' }}</p>
                <h4 class="text-2xl font-semibold mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>

                <div class="flex border-b border-gray-200 mb-6" id="productTabs">
                    <button 
                        class="py-3 px-6 text-xl md:text-base font-semibold transition-all duration-300 ease-in-out border-b-2 text-pinkText border-pinkColor font-serif" 
                        data-tab-target="description">Deskripsi</button>
                </div>

                <div id="productTabsContent">
                    <div id="description" data-tab-content>
                        <p class="text-gray-600 text-justify leading-relaxed">
                            {!! nl2br(e($product->description)) !!}
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="button" 
                            id="openOrderModalBtn"
                            class="inline-block text-2xl bg-greenColor text-white rounded-full py-3 px-12 shadow-sm transition-all duration-300 ease-in-out hover:bg-[#1da851] hover:-translate-y-0.5 font-serif cursor-pointer">
                        <i class="bi bi-whatsapp mr-2"></i> Pesan via WhatsApp
                    </button>
                </div>
            </div>
        </div>

        @if($relatedProducts->isNotEmpty())
        <div class="container mx-auto px-4 my-12 bg-gray-50">
            <h4 class="text-3xl font-bold text-left text-pinkText mb-6 font-serif ">Produk Terkait</h4>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $index => $related)
                    <x-customer.product-card :product="$related" :delay="($index * 50)" />
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@include('customer.partials.order-modal', ['product' => $product])

@push('scripts')
    <script src="{{ Vite::asset('resources/js/customer/show.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&callback=initMap" async defer></script> 
@endpush

@endsection
