@extends('layouts.admin')

@section('title', 'Daftar Kategori')

@section('content')
<div class="container mx-auto px-4">

    <div class="flex flex-row justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Daftar Kategori</h2>
            <p class="text-gray-500 mb-0">Kelola semua kategori produk Anda</p>
        </div>

        <a href="{{ route('admin.category.create') }}" 
            class="px-4 py-2 bg-pinkButton text-white rounded-lg hover:opacity-80 transition-all no-underline">
            <i class="bi bi-plus mr-2"></i>Tambah Kategori
        </a>
    </div>

    <div id="alert-container"></div>

    <div id="table-view">
        @include('admin.category.partials._category-table')

        @if($categories->hasPages())
            <div class="mt-6 flex justify-center pagination-links">
                {{ $categories->links('pagination::tailwind') }}
            </div>
        @endif
    </div>

</div>

<div id="flash-message" 
     data-success="{{ session('success') ?? '' }}"></div>
@endsection

@push('scripts')
    @vite('resources/js/admin/categories.js')
@endpush

