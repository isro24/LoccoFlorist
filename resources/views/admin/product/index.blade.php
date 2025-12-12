@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex flex-row justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Daftar Produk</h2>
            <p class="text-gray-500 mb-0">Kelola semua produk Anda</p>
        </div>
        <div class="flex flex-row items-stretch gap-2">
            <a href="{{ route('admin.product.create') }}" 
              class="px-4 py-2 bg-pinkButton text-white rounded-lg hover:opacity-80 transition-all no-underline">
                <i class="bi bi-plus mr-2 text-ms"></i>Tambah Produk
            </a>
        </div>
    </div>

    <div id="alert-container"></div>

    <div id="table-view">
        @include('admin.product.partials._product-table')

        @if($products->hasPages())
            <div class="mt-6 flex justify-center pagination-links">
                {{ $products->links('pagination::tailwind') }}
            </div>
        @endif
    </div>

</div>

@include('admin.product.partials._detail-modal')

<div id="flash-message" 
     data-success="{{ session('success') ?? '' }}"></div>

@endsection

@push('scripts')
    @vite('resources/js/admin/product.js')
@endpush

