@extends('layouts.guest')

@section('title', $product->name)

@section('content')
<div class="bg-bgPage py-12 min-h-screen">
    <div class="container mx-auto px-4 md:px-12 max-w-7xl">
        
        <div class="mb-8">
            <x-breadcrumbs :items="Breadcrumbs::generate('product.show', $product)" />
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-pink-100/40 p-6 md:p-10 border border-white">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <div class="w-full lg:w-5/12">
                    <div class="sticky top-24">
                        
                        <div onclick="openFullscreen()" 
                            class="zoom-container w-full aspect-square bg-gray-50 rounded-2xl overflow-hidden shadow-sm border border-pink-50 relative group cursor-zoom-in mb-4 hover:shadow-md transition-all">
                            
                            <img id="main-product-image"
                                src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}" 
                                alt="{{ $product->name }}" 
                                class="zoom-image w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-110">

                            <div class="absolute top-3 left-3 opacity-100 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity duration-300 z-10 pointer-events-none">
                                <div class="bg-white/90 backdrop-blur-sm text-gray-600 w-10 h-10 flex items-center justify-center rounded-full shadow-sm border border-gray-100">
                                    <i class="bi bi-arrows-fullscreen text-lg"></i>
                                </div>
                            </div>

                            @if($product->is_best_seller)
                                <div class="absolute top-4 right-4 bg-pink-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1 z-10">
                                    <i class="bi bi-star-fill text-[10px]"></i> Best Seller
                                </div>
                            @endif

                        </div> 
                        @if($product->images && $product->images->count())
                            <div class="grid grid-cols-5 gap-3">
                                <button type="button" 
                                        data-src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}"
                                        onclick="changeImage(this.getAttribute('data-src'))"
                                        class="aspect-square rounded-xl overflow-hidden border-2 border-pinkButton hover:opacity-80 transition focus:outline-none focus:ring-2 focus:ring-pinkButton">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}" 
                                        class="w-full h-full object-cover" alt="Main Thumb">
                                </button>
                                
                                @foreach($product->images as $img)
                                    <button type="button" 
                                            data-src="{{ asset('storage/' . $img->image) }}"
                                            onclick="changeImage(this.getAttribute('data-src'))"
                                            class="aspect-square rounded-xl overflow-hidden border-2 border-transparent hover:border-pink-200 transition focus:outline-none focus:ring-2 focus:ring-pinkButton">
                                        <img src="{{ asset('storage/' . $img->image) }}" 
                                            class="w-full h-full object-cover" alt="Thumb">
                                    </button>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
                <div class="w-full lg:w-7/12 flex flex-col">
                    
                    <div class="mb-6">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="bg-pink-50 text-pinkText text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-pink-100">
                                {{ $product->category->name ?? 'Collection' }}
                            </span>
                        </div>

                        <h1 class="text-3xl md:text-4xl font-bold font-serif text-gray-900 mb-2 leading-tight">
                            {{ $product->name }}
                        </h1>
                        <h2 class="text-3xl font-bold text-pinkButton">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </h2>
                    </div>
                    <div class="mb-8">
                        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                            <div class="bg-gray-50 px-5 py-3 border-b border-gray-200 flex items-center gap-2">
                                <i class="bi bi-text-paragraph text-gray-500"></i>
                                <h3 class="text-sm font-bold text-gray-800">Deskripsi Produk</h3>
                            </div>
                            <div class="p-5 text-gray-600 text-sm leading-relaxed text-justify prose-sm">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                            
                            <div class="bg-pink-50/50 px-5 py-4 border-t border-pink-100">
                                <h4 class="text-xs font-bold text-pinkButton mb-2 flex items-center gap-1">
                                    <i class="bi bi-info-circle"></i> Catatan Pemesanan:
                                </h4>
                                <ul class="text-xs text-gray-500 space-y-1 list-disc list-inside">
                                    <li>Pemesan menulis formulir dengan benar dan tepat</li>
                                    <li>Pemesanan H-1 atau H-2 sangat disarankan untuk hasil maksimal</li>
                                    <li>Tidak menerima komplain setelah fix order</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto sticky bottom-0 bg-white p-4 md:p-0 md:static border-t md:border-0 border-gray-100 z-10 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] md:shadow-none">
                        <div class="flex flex-col gap-3">
                            <button type="button" 
                                    id="openOrderModalBtn"
                                    class="w-full bg-greenColor hover:bg-[#1da851] text-white text-lg font-bold py-4 rounded-full shadow-lg shadow-green-100 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3">
                                <i class="bi bi-pencil-square text-xl"></i>
                                <span>Isi Detail Pesanan</span>
                            </button>

                            <div class="text-center space-y-1 hidden md:block">
                                <p class="text-xs text-gray-400">
                                    Transaksi aman & terpercaya via WhatsApp Admin Locco Florist.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @if($relatedProducts->isNotEmpty())
            <div class="mt-16">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold font-serif text-gray-900">Produk Serupa</h3>
                        <p class="text-gray-500 text-sm mt-1">Mungkin kamu juga suka yang ini</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $index => $related)
                        <div class="hover:-translate-y-2 transition-transform duration-300">
                            <x-customer.product-card :product="$related" :delay="($index * 50)" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

@include('customer.partials.order-modal', ['product' => $product])

<div id="fullscreenModal" class="fixed inset-0 z-9999 hidden bg-black/90 backdrop-blur-sm transition-opacity duration-300 opacity-0" aria-hidden="true">
    {{-- Tombol Close --}}
    <button type="button" onclick="closeFullscreen()" class="absolute top-6 right-6 text-white hover:text-pink-400 z-50 transition-colors p-2">
        <i class="bi bi-x-lg text-4xl"></i>
    </button>

    <div class="flex items-center justify-center w-full h-full p-4" onclick="closeFullscreen()">
        <img id="fullscreenImage" src="" alt="Full Preview" 
             class="max-w-full max-h-screen object-contain rounded-lg shadow-2xl scale-95 transition-transform duration-300"
             onclick="event.stopPropagation()"> {{-- Biar klik gambar gak nutup modal --}}
    </div>
</div>

@push('scripts')
    <script src="{{ Vite::asset('resources/js/customer/show.js') }}"></script>
@endpush

@endsection